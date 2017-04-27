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

		<div class="page__top page--news">
			<div class="contain">
				<div class="page__breadcrumbs">
					<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
				</div>
				<div class="page__title">
					<h2>News</h2>
				</div>
			</div>
		</div>

		<div class="news__wrapper news__main">
			<div class="contain">
				<div class="col">
					<?php $data = new WP_Query(array(
						'post_type' => 'post',
						'cat' => get_query_var('cat'),
						'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
					));?>


					<?php if($data->have_posts()) : while($data->have_posts())  : $data->the_post(); ?>
						<div class="col4 news__post">
							<?php get_template_part( 'parts/posts/post', get_post_format() ); ?>
						</div>
					<?php endwhile; ?>

					<?php $total_pages = $data->max_num_pages;

								if ($total_pages > 1) {
									$current_page = max(1, get_query_var('paged'));

									echo '<div class="blog__pagination">'; 
									echo paginate_links( array(
										'base' => get_pagenum_link(1) . '%_%',
							            'format' => 'page/%#%',
							            'current' => $current_page,
							            'total' => $total_pages,
							            'prev_text'    => __('&#139; Prev'),
							            'next_text'    => __('Next &#155;'),
									) );
								}; 
									echo '</div>'; ?>

					<?php else : ?>

						<h2>Sorry</h2>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

					<?php endif; ?>
				</div>
			</div>
		</div>

	</div>
</main>


<?php get_footer();
