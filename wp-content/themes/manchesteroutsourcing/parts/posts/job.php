<?php
/**
 * Template part for displaying job content in careers.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package manchesteroutsourcicng
 */

$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$categories = get_the_category();
$category_id = $categories[0]->cat_ID;

$salary = get_field('salary');
$closing_date = get_field('closing_date');
$summary = get_field('job_summary');

$terms = get_the_terms( $post->ID , 'jobs_categories' );

?>

<div class="job-item">
    <div class="col <?php echo $category_id; ?> col--flex">
        <div class="col2 job-meta">
            <h5>Department</h5>
            <span class="job__department"><?php foreach ( $terms as $term ) {  echo $term->name; } ?></span>
            <span class="job__date"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></span>
            <span class="job__author">By: <?php the_author(); ?></span>
        </div>
        <div class="col10 job-content">
             <?php the_title( sprintf( '<h3 class="job__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
             <span class="job__salary"><?php echo $salary; ?></span>
             <?php echo $summary; ?>

             <div class="job-content__footer">
             <span class="job__closing">
                <h5>Closing Date</h5>
                <p><?php echo $closing_date; ?></p>
             </span>
             <a href="<?php echo esc_url( get_permalink() ); ?>"><button class="button button--start">View Job</button></a>
             </div>
        </div>
    </div>
</div>