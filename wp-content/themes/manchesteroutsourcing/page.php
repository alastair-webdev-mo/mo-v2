<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package manchesteroutsourcing
 */

get_header(); ?>

<?php if(is_page('homepage')) : ?>

<main>
	<div class="wrapper">

		<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'parts/pages/home' );

				// End of the loop.
			endwhile;
		?>
	
	</div>
</main>

<?php else : ?>

<main>
	<div class="wrapper">

		<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'parts/pages/default' );

				// End of the loop.
			endwhile;
		?>
	
	</div>
</main>

<?php endif; ?>

<?php
get_footer();