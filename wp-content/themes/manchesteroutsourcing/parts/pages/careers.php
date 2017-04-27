<?php
/**
 * Template part for displaying homepage content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package manchesteroutsourcing
 */

$page_id = get_the_ID();
$slug = $post->post_name;
$currentID = get_the_ID();
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>

<div class="page__top page--<?php echo $slug; ?>" style="background-image:url(<?php echo $url; ?>);">
	<div class="contain">
		<div class="page__breadcrumbs">
			<?php if ( is_page() && $post->post_parent ) : ?>
				<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
			<?php endif; ?>
		</div>
		<div class="page__title">
			<h2><?php the_title(); ?></h2>
		</div>
	</div>
</div>

<div id="content__top"></div>
<div class="main__content main__careers">
	<div class="contain">
		<?php the_content(); ?>
		<div class="job-board">
			<h3>Current Vacancies</h3>
			<?php $the_query = new WP_Query( array(
					'post_type' => 'job',
					'posts_per_page' => 3,
				)); 
			?>

			<?php if ( $the_query->have_posts() ) : ?>
	  		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<?php get_template_part( 'parts/posts/job', get_post_format() ); ?>

			<?php endwhile; ?>
			<?php endif;?>

			<?php wp_reset_postdata(); ?>
			<a href="/jobs/"><button class="button button--continue button--white">See All Current Vacancies</button></a>
		</div>
	</div>
</div>