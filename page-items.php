<style>
<?php include 'CSS/style.css'; ?>
</style>

<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */



get_header();
?>

			
      <template>

        <article id="items">
          <h3 class="overskrift"></h3>
          <img src="" alt=""/>
          <p class="beskrivelse"></p>
          <p class="pris"></p>
        </article>
      </template>


	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<h1>Art Shop</h1>

			<p class="besk">I min Art Shop kan du se og købe gotiske malerier, plakater, og skulpturer kreeret af mig. <br>
				Købet foregår over besked på Instagram, hvor vi også aftaler nærmere hvordan produktet kommer hjem til dig.</p>
		  <h2 id="kategoriH2"></h2>
			<nav id="filtrering">
				
					<button class="btns" data-item="alle">Alle</button>

			</nav>
      <section id="liste"></section>
	  			<div class="video">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/ISxEbDU2L2g" title="Daft13 splash video" description="splash video Daft13 med kunst og tatoveringer. Showcase af hans arbejde." frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

		</main><!-- #main -->
			</div><!-- #primary -->
			
<style>
	h1 {
		display:flex;
		place-content: center;
	}

	#kategoriH2 {
				display:flex;
		place-content: center;
		font-size:1.2em;
		color: #e30613;
	}


	.besk {
		display:flex;
		place-content: center;
	}

	.video {
		display:flex;
		place-content:center;
		padding-top:40px;
	}

	iframe {
		margin:auto auto;
		width:50vw;
		aspect-ratio:560/315;
		height:auto;
		border-style:solid;
		border-width:2px;
		border-color: #e30613;
	}


.elementor-widget-button,
.elementor-button,
button,
.button {
  font-family: "Specialelite Regular";
  /* background: #ffed00; */
  /* background-color: #ffed00; */
  color: #1d1d1b;
  /* padding: 10px; */
  border-radius: 0;
}

.elementor-button:hover,
button:hover,
.button:hover,
button:hover,
input[type="button"]:hover,
input[type="reset"]:hover,
input[type="submit"]:hover {
  font-family: "Specialelite Regular";
  /* background: #1d1d1b; */
  /* background-color: #1d1d1b; */
  color: #ffed00;
  /* padding: 10px; */
  box-shadow: 0px 5px 0px 4px;
  border-radius: 0;
}

.elementor-button:active,
button:active,
.button:active {
  font-family: "Specialelite Regular";
  /* background: #1d1d1b; */
  /* background-color: #1d1d1b; */
  color: #ffff00;
  padding: 10px;
  box-shadow: 0px 5px 0px 4px;
  border-radius: 0;
}


</style>

<script>

		const url = "https://emsportfolio.dk/kea/10_eksamensprojekt/eksamen_projekt/wp-json/wp/v2/item?per_page=100";
		const katurl = "https://emsportfolio.dk/kea/10_eksamensprojekt/eksamen_projekt/wp-json/wp/v2/categories";

		let filter = "alle";
		let filterItem = "alle";

		let items = [];
		let categories = [];

		const h2 = document.querySelector("#kategoriH2");



window.addEventListener("DOMContentLoaded", start);

function start() {
  hentData();
}

async function hentData() {
	// fetch url
  const respons = await fetch(url);
  const katData = await fetch(katurl);

	// json

  items = await respons.json();
  categories = await katData.json();


  visItems();
  opretKnapper();
}

function opretKnapper() {
	// knapper til kategorierne
	categories.forEach (categories => {
	document.querySelector("#filtrering").innerHTML += `<button class="filter" data-item="${categories.id}">${categories.name}</button>`
	})

	addEventListenersToButtons ();
}

function addEventListenersToButtons () {
	document.querySelectorAll("#filtrering button").forEach(elm => {
		elm.addEventListener("click", filtrering)
		elm.classList.add("btns");
	})
}

function filtrering() {
	console.log("this is this.dataset.item = " + this.dataset.item);

 	// butt.classList = "btns";

	if (this.dataset.item != "alle") {

		filterItem = parseInt(this.dataset.item);
	}

	else {
		filterItem = this.dataset.item;
	}


	// this.onclick = selected();

	// this.classList.add("selected");


 h2.textContent = this.textContent;

	visItems();
}

// function selected() {
// 		this.classList.add("selected");

// 	visItems();
// }

function visItems() {

	let temp = document.querySelector("template");
	let container = document.querySelector("#liste");

	container.innerHTML = "";

	items.forEach((item) => {
		
		if (filterItem == "alle" || item.categories.includes(filterItem)) {
	
console.log("item.categories.includes(filterItem) is " + item.categories.includes(filterItem))

			let klon = temp.cloneNode(true).content;

			klon.querySelector(".overskrift").innerHTML = item.overskrift;
			klon.querySelector(".beskrivelse").innerHTML = item.beskrivelse;
			klon.querySelector(".pris").innerHTML = `Pris. ${item.pris}dkk`;
			klon.querySelector("img").src = item.image.guid;
			klon.querySelector("img").alt = item.overskrift;

			klon
				.querySelector("article")
				.addEventListener("click", () => location.href = item.link);
			
			container.appendChild(klon);
    	}
		
  	});
}

	  </script>



<?php
get_footer();
