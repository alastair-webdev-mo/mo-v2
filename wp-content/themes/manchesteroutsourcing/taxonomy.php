<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage manchesteroutsourcing
 * @since 1.0
 * @version 1.0
 */

$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$alt = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
$term =  get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$slug = $term->slug;
get_header(); ?>

<main>
	<div class="wrapper">

		<div class="page__top page--news">
			<div class="contain">
				<div class="page__breadcrumbs">
					<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
				</div>
				<div class="page__title">
					<h2>Vacancies</h2>
				</div>
			</div>
		</div>

		<div class="news__wrapper news__main">
			<div class="contain">

				<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'parts/posts/job', get_post_format() );

						// End of the loop.
					endwhile;
				?>

				<?php echo do_shortcode('[ajax_load_more category="' . $slug . '" post_type="job" pause="true" posts_per_page="2" scroll="false" button_label="Load More Jobs"]') ?>

			</div>
		</div>
	
	</div>
</main>

<?php get_footer();
