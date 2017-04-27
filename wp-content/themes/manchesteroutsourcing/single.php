<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package manchesteroutsourcing
 */

get_header(); ?>

<?php if( get_post_type() === 'job' ) { ?>

<main>
	<div class="wrapper">
		<div class="contain">
			<div class="col">
				<div class="col__wrapper col__nowrap">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'parts/posts/post-single-job', get_post_format() );
					endwhile;
					?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php } else { ?>

<main>
	<div class="wrapper">
		<div class="contain">
			<div class="col">
				<div class="col__wrapper col__nowrap">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'parts/posts/post-single', get_post_format() );
					endwhile;
					?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php } ?>

<?php
get_footer();
