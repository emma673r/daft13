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

        <button class="tilbage-button" >Tilbage</button>

      <article>
        <h3 class="overskrift"></h3>
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
        }

        hentData();

        document.querySelector(".tilbage").addEventListener("click", ()=>{ history.back()});

    </script>



<?php
get_footer();
