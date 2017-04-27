<?php
/**
 * Template part for displaying single post content in single.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package manchesteroutsorucing
 */

$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$imgID  = get_post_thumbnail_id($post->ID);
$image_alt = get_post_meta($imgID,'_wp_attachment_image_alt', true);
$title = urlencode(get_the_title());
$url2 = urlencode(get_permalink());
$twitter_username = 'mcroutsourcing';
$pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
$terms = get_the_terms( $post->ID , 'jobs_categories' );
$salary = get_field('salary');
$closing_date = get_field('closing_date');
?>

<div class="col2">
	<div class="entry__meta">
		<h5>Job</h5>
		<div class="entry__author">by <?php the_author(); ?></div>
		<div class="entry__cat"><ul class="post-categories"><?php foreach ( $terms as $term ) { echo '<li id="cat-item cat-' . $term->term_id . '"><a class="'.$term->slug.'" href="/jobs/' . $term->slug . '">' . $term->name . '</a></li>'; }?></ul></div>
	</div>
	<div class="entry__share">
		<a class="entry__social entry__social--single fb-share" href="#" target="_blank">
			<i class="fa fa-fw fa-facebook" aria-hidden="true"></i>
		</a>
		<a class="entry__social entry__social--single" title="Share this on Twitter" href="http://twitter.com/intent/tweet/?text=<?php echo $title; ?>&url=<?php echo $url2; ?>&via=<?php echo $twitter_username; ?>" target="_blank">
			<i class="fa fa-fw fa-twitter" aria-hidden="true"></i>
		</a>
		<div class="entry__social entry__drawer" target="_blank">
			<ul class="entry__sociallist">
				<li class="initial"><a href=""><i class="fa fa-fw fa-ellipsis-h" aria-hidden="true"></i></a></li>
				<li><a href="http://www.tumblr.com/share/link?url=<?php echo $url2; ?>&name=<?php echo $title; ?>&description=<?php echo urlencode(the_excerpt()) ?>"><i class="fa fa-fw fa-tumblr" aria-hidden="true"></i></a></li>
				<li><a href="http://pinterest.com/pin/create/button/?url=<?php echo $url2; ?>&media=<?php echo $pinterestimage[0]; ?>&description=<?php echo $title; ?>" data-pin-do="buttonBookmark" data-pin-custom="true"><i class="fa fa-fw fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a href="" class="copy-url"><i class="fa fa-fw fa-link" aria-hidden="true"></i><span class="copy-url__tooltip"></span></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="col10 post job">
	<div class="entry__text">
		<?php the_title( '<h2 class="article__title">', '</h2>' ); ?>
		<div class="job__header">
			<div class="job__salary"><h5>Salary</h5> <p><?php echo $salary; ?></p></div>
			<div class="job__closing"><h5>Closing Date</h5> <p><?php echo $closing_date; ?></p></div>
		</div>
	</div>
	<div id="post-<?php the_ID(); ?>" class="entry__content article__content job__content">
		<?php the_content(); ?>
	</div>
	<div class="post__footer">
		<div class="post__related">
			<h5>More Jobs</h5>
			<?php
				$related = get_posts( array( 'post_type' => 'job', 'numberposts' => 5, 'post__not_in' => array($post->ID) ) );
				if( $related ) foreach( $related as $post ) {
				setup_postdata($post); ?>
				 <ul> 
				    <li>
				        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?><span class="related__date">/ <?php echo get_the_date( 'F j, Y' ); ?></span></a>
				    </li>
				</ul>   
				<?php }
				wp_reset_postdata(); ?>
		</div>
		<div class="post__end">
			<h5><a href="/careers/">Back to careers</a></h5>
		</div>
	</div>
</div>