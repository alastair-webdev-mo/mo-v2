<?php
/**
 * Template part for displaying homepage content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package manchesteroutsourcing
 */

$page_id = $post->post_parent;

$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>

<div class="page__top" style="background-image:url(<?php echo $url; ?>);">
	<div class="contain">
		<div class="page__breadcrumbs">
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
		</div>
		<div class="page__title">
			<h2><?php the_title(); ?></h2>
		</div>
		<hr class="page__hr">
	</div>
</div>

<div id="content__top"></div>
<div class="main__content">
	<div class="contain">
		<?php the_content(); ?>

		<?php if(is_page('outsourcing')) : ?>
			<?php if ( is_active_sidebar( 'product-cards' ) ): ?>
					<div class="col col--flex col--productcards">
						<?php dynamic_sidebar( 'product-cards' ); ?>
					</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<?php if(is_page('outsourcing')) : ?>
	<div class="testimonals-area">
		<div class="col">
			<div class="col6 col--leftfull col--testimonials">
				<div class="testimonials">
					<ul>
						<li>
							<div class="testimonial__content">
								<p>“Connex Solutions capabilities are unique in this industry. In addition to a superior product and cost effective solution, the level of support, customer service and responsiveness has been outstanding.”</p>
								<p class="author">Ross Gale - Manchester Outsourcing</p>
							</div>
						</li>
						<li>Another slide</li>
						<li>My last slide</li>
					</ul>
				</div>
				<a href="" class="absolute"><button class="button button--read button--card">More endorsements</button></a>
			</div>
			<div class="col6 col--rightfull col--bespoke">
				<div class="bespoke__content">
					<h4>Looking for bespoke?</h4>
					<p>We understand that outsourcing is not a one size fits all solution, that’s why we’ll take the time to get to know your business.</p>
				</div>
				<a href="" class="absolute"><button class="button button--read button--card">What we do</button></a>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if ( $post->post_parent === $page_id ) : ?>
	<div class="related-pages related-pages--contain">
		<div class="contain">
			<h3>Related Pages</h3>
			<p>Some related pages which may be of interest to you.</p>

			<div class="col col--pages">
				<div class="col3">
					<div class="page__image"></div>
					<div class="page__title">
						<h5>Page Title</h5>
					</div>
				</div>
			</div>

		</div>
	</div>
	<?php endif; ?>

</div>