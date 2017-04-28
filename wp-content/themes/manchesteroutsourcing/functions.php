<?php
/**
 * Neat functions and definitions
 *
 * @package Neat
 */

/**
 * Paths
 *
 * @since  1.0
 */
if ( !defined( 'AA_THEME_DIR' ) ){
    define('AA_THEME_DIR', ABSPATH . 'wp-content/themes/' . get_template());
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1000; /* pixels */
}

if ( ! function_exists( 'neat_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function neat_setup() {


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'neat' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'neat_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // neat_setup
add_action( 'after_setup_theme', 'neat_setup' );



/**
 * Styles and scripts
 *
 * @since 1.0.0
 */

/**
 *
 * Scripts: Frontend with no conditions, Add Custom Scripts to wp_head
 *
 * @since  1.0.0
 *
 */
add_action('wp_enqueue_scripts', 'aa_scripts');
function aa_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {


    	wp_enqueue_script('jquery'); // Enqueue it!
        wp_deregister_script('jquery'); // Deregister WordPress jQuery
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js', array(), '1.11.2');

      	wp_register_script('aa_validate', '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js', array(), '1.16.0', true);
        wp_enqueue_script('aa_validate');

        wp_register_script('aa_customJs', get_template_directory_uri() . '/assets/js/main.min.js'); // Custom scripts
        wp_enqueue_script('aa_customJs'); // Enqueue it!

    }

}


/**
 *
 * Styles: Frontend with no conditions, Add Custom styles to wp_head
 *
 * @since  1.0
 *
 */
add_action('wp_enqueue_scripts', 'aa_styles'); // Add Theme Stylesheet
function aa_styles()
{

    /**
     *
     * Minified and Concatenated styles
     *
     */
    // wp_register_style('aa_style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_register_style('aa_style', get_template_directory_uri() . '/style.min.css', array(), '1.0', 'all');
    wp_enqueue_style('aa_style'); // Enqueue it!

}

/**
 *
 * Comment Reply js to load only when thread_comments is active
 *
 * @since  1.0.0
 *
 */
add_action( 'wp_enqueue_scripts', 'aa_enqueue_comments_reply' );
function aa_enqueue_comments_reply() {
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

remove_filter( 'the_content', 'wpautop' );

add_filter('the_content','if_is_post');

function if_is_post($content){
if(is_singular('post'))
    return wpautop($content);
elseif (is_singular('job'))
	return wpautop($content);
else
    return $content;//no autop
}

add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Product Cards', 'product-cards' ),
        'id' => 'product-cards',
        'description' => __( 'Product Cards', 'product-cards' ),
        'before_widget' => '<div class="col4">',
        'after_widget'  => '</div>',
    ) );
}

add_action( 'wp_ajax_nopriv_load-filter', 'prefix_load_cat_posts' );
add_action( 'wp_ajax_load-filter', 'prefix_load_cat_posts' );
function prefix_load_cat_posts () {
    $cat_id = $_POST[ 'cat' ];
    $args = array (
        'cat' => $cat_id,
        'posts_per_page' => -1,
        'order' => 'DESC'
      );

    global $post;

    $posts = get_posts( $args );

    ob_start ();

    foreach ( $posts as $post ) {
    setup_postdata( $post );

   	$post_id = get_the_category( $post->ID );

    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
    $url = $thumb['0']; 

    ?>
<div class="col4 news__post">
<?php get_template_part( 'parts/posts/post', get_post_format() ); ?>
</div>

<?php } wp_reset_postdata();

$response = ob_get_contents();
ob_end_clean();

echo $response;

die(1);
}

/**

CARD WIDGET 

**/

// Creating the widget 
class product_card_plugin extends WP_Widget {
// constructor
	function product_card_plugin() {
		parent::WP_Widget(false, $name = __('Product Cards', 'product_card_plugin') );

		add_action('admin_enqueue_scripts', array($this, 'photo_upload_option'));
	}

	function photo_upload_option($hook) {
	    if( $hook != 'widgets.php' ) 
	        return;
	    //enque Javasript Media API
	    wp_enqueue_media();
	    wp_enqueue_script( 'uploadphoto', get_template_directory_uri() . '/assets/js/upload_image.js', array('jquery'), '1.0', 'true' );
	}

	// widget form creation
	function form($instance) {	
		// Check values
	if( $instance) {
	     $title = esc_attr($instance['title']);
	     $content = esc_attr($instance['content']);
	     $image_alt = esc_attr($instance['image_alt']);
	     $button_url = esc_attr($instance['button_url']);
	     $button_text = esc_attr($instance['button_text']);
	} else {
	     $title = '';
	     $content = '';
	     $button_url = '';
	     $image_alt = '';
	     $button_text = '';
	}

	$image = '';
        if(isset($instance['image'])) {
            $image = $instance['image'];
        }

	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Product Title', 'product_card_plugin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p>
    <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Product Image:' ); ?></label>
    <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat image1" type="text" size="36"  value="<?php echo $instance['image']; ?>" />
    <input class="upload_card_image" type="button" value="Upload Image" />
    </p>

    <p>
    <label for="<?php echo $this->get_field_name( 'image_alt' ); ?>"><?php _e( 'Image Alt Text:' ); ?></label>
    <input name="<?php echo $this->get_field_name( 'image_alt' ); ?>" id="<?php echo $this->get_field_name( 'image_alt' ); ?>" class="widefat" type="text" size="36" value="<?php echo $image_alt; ?>"/>
    </p>

    <p>
    <label for="<?php echo $this->get_field_name( 'content' ); ?>"><?php _e( 'Product Content:' ); ?></label>
    <input name="<?php echo $this->get_field_name( 'content' ); ?>" id="<?php echo $this->get_field_name( 'content' ); ?>" class="widefat" type="text" size="36" value="<?php echo $content; ?>"/>
    </p>

	<p>
	<label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e('Button Link:', 'product_card_plugin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text:', 'product_card_plugin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
	</p>

	<?php
	}

	// widget update
	function update($new_instance, $old_instance) {
	$instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['content'] = strip_tags($new_instance['content']);
      $instance['image'] = strip_tags($new_instance['image']);
      $instance['image_alt'] = strip_tags($new_instance['image_alt']);
      $instance['button_text'] = strip_tags($new_instance['button_text']);
      $instance['button_url'] = strip_tags($new_instance['button_url']);

     return $instance;
	}

	// widget display
	function widget($args, $instance) {
	extract( $args );

   $title = apply_filters('widget_title', $instance['title']);
   $content = $instance['content'];
   $image = $instance['image'];
   $image_alt = $instance['image_alt'];
   $button_text = $instance['button_text'];
   $button_url = $instance['button_url'];

   echo $before_widget;
   // Display the widget
   echo '<div class="card card--border">';

   if ( $image ) {
   		echo '<div class="card__image"><img src="' . $image  . '" alt="' . $image_alt . '"></div>';
   }

   if ( $title ) {
      echo '<div class="card__content"><h3><span>' . $title . '</span></h3>';
   }

   if ( $content ) {
      echo  '<p>' . $content . '</p>';
   }

   if( $button_url ) {
      echo '<a class="button" href="' . $button_url . '">';
   }

   if( $button_text ) {
     echo '<button class="button button--read button--card">'.$button_text.'</button></a></div>';
   }

   echo '</div>';
   echo $after_widget;
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("product_card_plugin");'));


function col($params,$content=null){
    extract(shortcode_atts(array(
    	'align' => '',
        'no' => ''
    ), $params));
    return '<div class="col'.$no.' '.$align.'">'.do_shortcode($content).'</div>';
}
add_shortcode("col", "col");

function box($params,$content=null){
    extract(shortcode_atts(array(
    	'class' => '',
    ), $params));
    return '<div class="box '.$class.'">'.do_shortcode($content).'</div>';
}
add_shortcode("box", "box");

function boximg($params,$content=null){
    extract(shortcode_atts(array(
    	'class' => '',
    	'img' => '',
    ), $params));
    return '<div class="box '.$class.'" style="background-image:url('.$img.'">'.do_shortcode($content).'</div>';
}
add_shortcode("boximg", "boximg");

function col_wrapper($atts,$content,$tag){
	
	//collect values, combining passed in values and defaults
	$values = shortcode_atts(array(
		'align-items' => '',
		'flex' => '',
	),$atts);  
	
	
	//based on input determine what to return
	$output = '';
	if($values['align-items'] == 'center'){
		$output = '<div class="col col--center">'.do_shortcode($content).'</div>';
	}
	else if($values['flex'] == 'true'){
		$output = '<div class="col col--flex">'.do_shortcode($content).'</div>'; 
	}
	else{
		$output = '<div class="col">'.do_shortcode($content).'</div>'; 
	}
	
	return $output;
	
}
add_shortcode('col_wrapper','col_wrapper');

function grid($atts,$content,$tag){
	
	//collect values, combining passed in values and defaults
	$values = shortcode_atts(array(
		'align-items' => '',
		'flex' => '',
		'class' => '',
	),$atts);  
	
	
	//based on input determine what to return
	$output = '';
	if($values['align-items'] == 'center'){
		$output = '<div class="col col--center col--nomargin '. $atts['class'].'">'.do_shortcode($content).'</div>';
	}
	else if($values['flex'] == 'true'){
		$output = '<div class="col col--flex col--nomargin '. $atts['class'].'">'.do_shortcode($content).'</div>'; 
	}
	else{
		$output = '<div class="col col--nomargin '. $atts['class'].'">'.do_shortcode($content).'</div>'; 
	}
	return $output;
	
}
add_shortcode('grid','grid');

function button_shortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'class' => '',
			'text' => '',
			'url' => '',
		),
		$atts,
		'button'
	);

	// Return custom embed code
	return '<a href="'.$atts['url'].'"><button class="button '.$atts['class'].'">' . $atts['text'] . '</button></a>';

}
add_shortcode( 'button', 'button_shortcode' );

function banner_shortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'class' => '',
			'title' => '',
			'text' => '',
			'button_url' => '',
			'button_text' => '',
			'button_class' => ''
		),
		$atts,
		'banner'
	);

	// Return custom embed code
	return '<div class="banner '. $atts['class'] .'"><div class="banner__contain banner__padding"><span>
	         <h2 class="up">' . $atts['title'] . '</h2>
	         <p>' . $atts['text'] . '</p></span>
	         <a href="' . $atts['button_url'] . '">
	         <button class="button '. $atts['button_class'] .'">' . $atts['button_text'] . '</button></a>
	         </div></div>';

}
add_shortcode( 'banner', 'banner_shortcode' );

function card_shortcode( $atts, $content ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'class' => '',
			'title' => '',
			'image_url' => '',
		),
		$atts,
		'card'
	);

	// Return custom embed code
	return '<div class="card '. $atts['class'] .'">
			<div class="card__image" style="background-image:url('. $atts['image_url'] .'"></div>
			<div class="card__content">
			<h3><span>'. $atts['title'] .'</span></h3>' . do_shortcode($content) . '</div></div>';

}
add_shortcode( 'card', 'card_shortcode' );

function sidebar_shortcode($atts, $content="null"){
  extract(shortcode_atts(array('name' => '', 'width' => '',), $atts));

  ob_start();
  dynamic_sidebar($name);
  $sidebar= ob_get_contents();
  ob_end_clean();

  $output = '';

  if ( $atts['width'] == 'full' ) {
  	$output = '<div class="col col--flex col--productcards col--'. $atts['width'] .'"><div class="contain">'. $sidebar .'</div></div>';
  } else {
  	$output = '<div class="col col--flex col--productcards>'. $sidebar .'</div>';
  }

  return $output;
}

add_shortcode('get_sidebar', 'sidebar_shortcode');

function generalform( $atts ) {
    $a = shortcode_atts( array(
        'class' => '',
        'action' => '',
    ), $atts );

    return '<form class="form '. $atts['class'] .'" action="'. $atts['action'] .'" method="POST">
	<div class="form__wrapper">
	<fieldset>
		<label class="title">Full name</label>
		<span class="input__wrap">
			<input type="text" id="name" class="input__field" placeholder="What is your full name?" name="full-name" required>
		</span>
	</fieldset>
	<fieldset>
		<label class="title">Company</label>
		<span class="input__wrap">
			<input type="text" id="company" class="input__field" placeholder="Your company..." name="company" required>
		</span>
	</fieldset>
	<fieldset>
	<label class="title">Email address</label>
		<span class="input__wrap">
			<input type="email" id="email" class="input__field" placeholder="Your email address..." name="email" required>
		</span>
	</fieldset>
	<fieldset>
	<label class="title">Phone</label>
		<span class="input__wrap">
			<input type="tel" id="phone" class="input__field input__phone" placeholder="Best number to contact you on..." name="phone" required>
		</span>
	</fieldset>
	<span class="submit">
		<button class="button button--blue form__submit" name="submit">Start your journey <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
	</span>
	<span class="opt">
		<fieldset> 
			<span class="input__wrap input__wrap--checkbox">
				<input type="checkbox" name="optIn" class="input__check">
				<label for="check" class="input__label--check">
					<span>This tick indicates your consent to receive contact from one of our trusted funeral planning experts to discuss your wishes and requirements by telephone, email or SMS.</span>
				</label>
			</span>
		</fieldset>
	</span>								
</div><div id="form-messages"></div></form>';
}
add_shortcode( 'genform', 'generalform' );

// add tag and category support to pages
function tags_categories_support_all() {
  register_taxonomy_for_object_type('post_tag', 'page');
  register_taxonomy_for_object_type('category', 'page');  
}

// ensure all tags and categories are included in queries
function tags_categories_support_query($wp_query) {
  if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
  if ($wp_query->get('category_name')) $wp_query->set('post_type', 'any');
}

// tag and category hooks
add_action('init', 'tags_categories_support_all');
add_action('pre_get_posts', 'tags_categories_support_query');

// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Jobs', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Jobs', 'text_domain' ),
		'name_admin_bar'        => __( 'Job', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Event:', 'text_domain' ),
		'all_items'             => __( 'All Jobs', 'text_domain' ),
		'add_new_item'          => __( 'Add New Job Vacancy', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Job', 'text_domain' ),
		'edit_item'             => __( 'Edit Job', 'text_domain' ),
		'update_item'           => __( 'Update Job', 'text_domain' ),
		'view_item'             => __( 'View Job', 'text_domain' ),
		'view_items'            => __( 'View Jobs', 'text_domain' ),
		'search_items'          => __( 'Search Jobs', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into event', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this event', 'text_domain' ),
		'items_list'            => __( 'Jobs list', 'text_domain' ),
		'items_list_navigation' => __( 'Jobs list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter events list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Job', 'text_domain' ),
		'description'           => __( 'This is an job post type.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'post-formats', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'query_var' 			=> true,
		'menu_position'         => 7,
		'menu_icon'           	=> 'dashicons-sticky',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'jobs',		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'job', $args );

}
add_action( 'init', 'custom_post_type', 0 );

function create_event_taxonomies() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'jobs' ),
    );

    register_taxonomy( 'jobs_categories', array( 'job' ), $args );
}
add_action( 'init', 'create_event_taxonomies', 0 );

function awesome_excerpt($text, $raw_excerpt) {
    if( ! $raw_excerpt ) {
        $content = apply_filters( 'the_content', get_the_content() );
        $text = substr( $content, 0, strpos( $content, '</p>' ) + 4 );
    }
    $text = preg_replace("/<img[^>]+\>/i", "", $text); 
    return $text;
}
add_filter( 'wp_trim_excerpt', 'awesome_excerpt', 10, 2 );

function venform( $atts ) {
    $v = shortcode_atts( array(
        'class' => '',
        'action' => '',
    ), $atts );

    return '<form class="form '. $atts['class'] .'" action="'. $atts['action'] .'" method="POST">
	<div class="form__wrapper">
			<fieldset>
				<label class="title">Full name</label>
				<span class="input__wrap">
					<input type="text" id="name" class="input__field" placeholder="What is your full name?" name="full-name" required>
				</span>
			</fieldset>
			<fieldset>
			<label class="title">Email address</label>
				<span class="input__wrap">
					<input type="email" id="email" class="input__field" placeholder="Your email address..." name="email" required>
				</span>
			</fieldset>
			<fieldset>
			<label class="title">Phone</label>
				<span class="input__wrap">
					<input type="tel" id="phone" class="input__field input__phone" placeholder="Best number to contact you on..." name="phone" required>
				</span>
			</fieldset>
			<fieldset>
				<label class="title">Tell us about your passion for business</label>
				<span class="input__wrap--textarea">
					<textarea id="passion" name="passion" required></textarea>
				</span>
			</fieldset>
			<fieldset>
				<label class="title">What\'s your vision?</label>
				<span class="input__wrap--textarea">
					<textarea id="vision" name="vision" required></textarea>
				</span>
			</fieldset>
	<span class="submit">
		<h4>It\'s time to work together</h4>
		<button class="button button--blue form__submit" name="submit">Let\'s get started <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
	</span>							
</div><div id="form-messages"></div></form>';
}
add_shortcode( 'venform', 'venform' );
