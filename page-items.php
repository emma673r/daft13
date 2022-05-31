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
			<nav id="filtrering">
				
					<button data-item="alle">Alle</button>
						
		

			
			</nav>
      <section id="liste"></section>

		</main><!-- #main -->
			</div><!-- #primary -->


<script>

		const url = "https://emsportfolio.dk/kea/10_eksamensprojekt/eksamen_projekt/wp-json/wp/v2/item?per_page=100";
		const katurl = "https://emsportfolio.dk/kea/10_eksamensprojekt/eksamen_projekt/wp-json/wp/v2/categories";

		let filter = "alle";
		let filterItem = "alle";

		let items = [];
		let categories = [];



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
	})
}

function filtrering() {
	console.log("this is this.dataset.item = " + this.dataset.item);

	if (this.dataset.item != "alle") {

		filterItem = parseInt(this.dataset.item);
	}

	else {
		filterItem = this.dataset.item;
	}

	visItems();
}

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
