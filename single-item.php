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

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        <button class="tilbage button" >Tilbage</button>


    


      <article>
        <h3 class="overskrift"></h3>
        <img class="img" src="" alt="">
        <span class="beskrivelse"></span>
        <span class="pris"></span>
        <span class="obs"></span>
        <button class="btns koeb"><a href="https://www.instagram.com/daft13/">Køb</a></button>
      </article>
    	</main>
		</div><!-- #primary -->


<style>

  .koeb {
    margin-top: 40px;
    display:flex;
    place-content:center;
  }

  	.btns, button, .elementor-widget-button,
.elementor-button,
.button  {
		font-family: "Specialelite Regular";
		background: #ffed00;
		background-color: #ffed00;
		color: #1d1d1b;
		padding: 10px;
		border-radius: 0;
	}

	.btns:hover {
		font-family: "Specialelite Regular";
		background: #1d1d1b;
		background-color: #1d1d1b;
		color: #ffed00;
		padding: 10px;
		box-shadow: 4px 4px 0px 4px;
		border-radius: 0;
	}

	.btns:active, button:active, .elementor-widget-button:active,
.elementor-button:active,
.button:active {
		font-family: "Specialelite Regular";
		background: #ffed00;
		background-color: #ffed00;
		color: #ffed00;
		padding: 10px;
		box-shadow: 0px 5px 0px 4px;
		border-radius: 0;
	} 
</style>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const id = <?php echo get_the_ID() ?>;
        // console.log({id});
        let item;

        const url = `https://emsportfolio.dk/kea/10_eksamensprojekt/eksamen_projekt/wp-json/wp/v2/item/${id}`;

        async function hentData() {
        const respons = await fetch(url);
        item = await respons.json();
        console.log({item});
        vis();
        }

        function vis(){
            
          document.querySelector(".overskrift").textContent = item.overskrift;
          document.querySelector(".beskrivelse").innerHTML = item.beskrivelse;
			document.querySelector(".img").src = item.image.guid;
			document.querySelector(".img").alt = item.overskrift;
          document.querySelector(".pris").innerHTML = `Pris. ${item.pris}dkk`;
          document.querySelector(".obs").innerHTML = `Obs. Købet forgår via instagram eller mail hendvendelser. Venligst skriv til mig <a href="https://www.instagram.com/daft13/">her</a>. `;

        }

        hentData();

        document.querySelector(".tilbage").addEventListener("click", ()=>{ history.back()});

    </script>



<?php

