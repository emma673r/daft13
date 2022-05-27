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

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <button class="tilbage button" >Tilbage</button>

      <article>
        <h3 class="title"></h3>
        <img class="img" src="" alt="">
         <span class="beskrivelse"></span>
         <span class="pris"></span>
      </article>
    	</main>
		</div><!-- #primary -->

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const id = <?php echo get_the_ID() ?>;
        // console.log({id});
        let item;

        const url = `http://emsportfolio.dk/kea/10_eksamensprojekt/eksamen_projekt/wp-json/wp/v2/item/${id}`;

        async function hentData() {
        const respons = await fetch(url);
        item = await respons.json();
        console.log({item});
        vis();
        }

        function vis(){
            
          document.querySelector(".title").textContent = item.title;
          document.querySelector(".beskrivelse").innerHTML = item.beskrivelse.rendered;
          document.querySelector(".img").src = item.image;
          document.querySelector(".img").alt = item.title;
          document.querySelector(".pris").innerHTML = item.pris;
        }

        hentData();

        document.querySelector(".tilbage").addEventListener("click", ()=>{ history.back()});

    </script>



<?php
get_footer();
