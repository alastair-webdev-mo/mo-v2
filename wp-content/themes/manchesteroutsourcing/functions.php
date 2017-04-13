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
