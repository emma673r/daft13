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
          <h3 class="title"></h3>
          <img src="" alt=""/>
          <p class="beskrivelse"></p>
          <p class="pris"></p>
        </article>
      </template>


	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<nav id="filtrering">
				
					<button data-item="alle">Alle</button>
						<div id="filt-kat" class="button_drop"></div>
		

			
			</nav>
      <section id="liste"></section>

		</main><!-- #main -->
			</div><!-- #primary -->


<script>

		const url = "http://emsportfolio.dk/kea/10_eksamensprojekt/eksamen_projekt/wp-json/wp/v2/item?per_page=100";
		const katurl = "http://emsportfolio.dk/kea/10_eksamensprojekt/eksamen_projekt/wp-json/wp/v2/categories";

		let filter = "alle";
		let filterItem = "alle";

		let items = [];
		let kategori = [];



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
  kategori = await katData.json();


  visitems();
  opretKnapper();
}

function opretKnapper() {
	// knapper til verdensmål
	kategori.forEach (kategori => {
	document.querySelector("#filt-kat").innerHTML += `<button class="filter" data-item="${kategori.id}">${kategori.slug}</button>`
	})

	addEventListenersToButtons ();
}

function addEventListenersToButtons () {
	document.querySelectorAll("#filtrering button").forEach(elm => {
		elm.addEventListener("click", filtrering)
	})
}

function filtrering() {
	console.log("filtrering");
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
		
		if (filterItem == "alle" || item.kategori.includes(filterItem)) {
	

			let klon = temp.cloneNode(true).content;

			klon.querySelector(".title").innerHTML = item.title;
			klon.querySelector(".beskrivelse").innerHTML = item.beskrivelse.rendered;

// 
// 
			// FÅ NOGET TEXT OVERFLOW ELLISPSIS IN CSS
// 
// 

			klon.querySelector(".pris").innerHTML = item.pris;
			klon.querySelector("img").src = item.image.guid;
			klon.querySelector("img").alt = item.title;

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
