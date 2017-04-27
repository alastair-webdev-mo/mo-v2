<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage manchesteroutsourcing
 * @since 1.0
 * @version 4.0
 */

$alt = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
$category = get_category( get_query_var( 'cat' ) );
$slug = $category->slug;
get_header(); ?>

<main>
	<div class="wrapper">

		<div class="page__top page--careers">
			<div class="contain">
				<div class="page__breadcrumbs">
					<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
				</div>
				<div class="page__title">
					<h2>Current Vacancies</h2>
				</div>
			</div>
		</div>

		<div class="news__wrapper job__main">
			<div class="contain">
				<div class="col">
					<?php $the_query = new WP_Query(array(
						'post_type' => 'job',
						'paged' => get_query_var('paged'))); 
					?>

					<?php if ( $the_query->have_posts() ) : ?>
			  		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<?php get_template_part( 'parts/posts/job', get_post_format() ); ?>

					<?php endwhile; ?>
					<?php endif;?>
				</div>
			</div>
		</div>

	</div>
</main>


<?php get_footer();
