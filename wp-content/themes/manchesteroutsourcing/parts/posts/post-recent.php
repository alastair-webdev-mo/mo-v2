<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package manchesteroutsourcicng
 */

$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$categories = get_the_category();
$category_id = $categories[0]->cat_ID;

?>

<div class="col6">
<div class="news__image" style="background: url('<?php echo $url; ?>');background-size:cover;background-position: center;background-repeat:no-repeat;"></div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="news__content" class="<?php echo $category_id; ?>">
        <div class="news__title">
            <?php the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
        </div>
        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="news__meta">
            <span class="news__meta__author">By: <?php the_author(); ?></span> 
            <span class="news__meta__cat"><?php the_category(); ?> / <div class="news__time"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></div></span> 
        </div>
        <?php endif; ?>
        </div>
</article>
</div>