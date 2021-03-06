<?php
/**
 * Index File
 */

get_header();
?>

<main class="main__content">
	<div class="wrapper">

		<div class="page__top page--news" style="background-image:url(<?php echo $url; ?>);">
			<div class="contain">
				<div class="page__breadcrumbs">
					<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
				</div>
				<div class="page__title">
					<h2>News</h2>
				</div>
			</div>
		</div>

		<div class="news__wrapper">
			<div class="contain">
				<div class="col">
					<div class="col6 news__post news__first">
						<?php $the_query = new WP_Query( array(
							     'post_type' => 'post',
							     'posts_per_page' => 1,
							   )); 
						?>

						<?php if ( $the_query->have_posts() ) : ?>
  						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<?php get_template_part( 'parts/posts/post-first', get_post_format() ); ?>

						<?php endwhile; ?>
						<?php endif;?>

						<?php wp_reset_postdata(); ?>

					</div>
					<div class="col6 news__post">
						<div class="col">
							<?php $the_query = new WP_Query( array(
								     'post_type' => 'post',
								     'posts_per_page' => 2,
								     'offset' => 1,
								   )); 
							?>

							<?php if ( $the_query->have_posts() ) : ?>
	  						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

							<?php get_template_part( 'parts/posts/post-recent', get_post_format() ); ?>

							<?php endwhile; ?>
							<?php endif;?>

							<?php wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="news__wrapper news__main">
			<div class="contain">
				<div class="news__categories">
					<h4>Filter by category</h4>

					<ul>
					<?php 
					    $categories = get_categories( array(
						    'orderby' => 'name'
						) );
					?>
					<?php 
					  foreach ( $categories as $category ) {
						echo '<li id="cat-item cat-' . $category->term_id . '"><a class="'.$category->slug.' ajax" href="'. $category->slug . '" onclick="cat_ajax_get(' .$category->term_id . ');">' . $category->name . '</a></li>';
						    };
					?>
				</div>
				<div id="loading" style="display: none;"><img src="<?php echo admin_url ( 'images/news-loading.gif' ); ?>"/></div>
				<div class="col">
					<?php $the_query = new WP_Query( array(
						'post_type' => 'post',
						'posts_per_page' => 6,
						'offset' => 3,
						)); 
					?>
					<?php if ( $the_query->have_posts() ) : ?>
	  				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
					<div class="col4 news__post">
					<?php get_template_part( 'parts/posts/post', get_post_format() ); ?>
					</div>

					<?php endwhile; ?>
					<?php endif;?>

					<?php wp_reset_postdata(); ?>
					
					<?php echo do_shortcode('[ajax_load_more id="3006704007" container_type="div" post_type="post" offset="7" posts_per_page="6" button_label="Load More News" button_loading_label="Loading News..."]'); ?>
				</div>
			</div>
		</div>


	</div>
</main>


<?php get_footer(); ?>
