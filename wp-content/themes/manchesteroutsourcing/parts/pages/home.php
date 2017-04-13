<?php
/**
 * Template part for displaying homepage content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package manchesteroutsourcing
 */


$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$hero_title = get_field('hero_title');
$hero_text = get_field('hero_text');
$hero_leading = get_field('hero_leading_text');
?>

<div class="hero">
	<div class="contain">
		<div class="hero__wrapper hero__wrapper--home" style="background-image:url(<?php echo $url; ?>);">
			<div class="hero__content">
				<h2><?php echo $hero_title; ?></h2>
				<p><?php echo $hero_text; ?></p>
			</div>
			<div class="hero__bottom">
				<a href="#content__top"><p><?php echo $hero_leading; ?></p><span class="arrow-down"><i class="fa fa-chevron-down" aria-hidden="true"></i></span></a>
			</div>
		</div>
	</div>
</div>

<div id="content__top"></div>
<div class="main__content">
	<div class="contain">
		<?php the_content(); ?>
	</div>
</div>