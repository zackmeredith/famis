<?php

require_once dirname( __FILE__ ) . '/functions/dependencies.php';

// Load configuration defaults for this theme; anything not set in the custom configuration (above) will be set here
require_once( trailingslashit( get_stylesheet_directory() ) . 'functions-config-defaults.php' );
// An example of how to manage loading front-end assets (scripts, styles, and fonts)
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/assets.php' );
// Required to demonstrate WP AJAX Page Loader (as WordPress doesn't ship with simple post navigation functions)
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/navigation.php' );

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated</p></div>';
		} );
	return;
}


class FamisSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'woocommerce' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}



	function register_post_types() {
		//this is where you can register custom post types


	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies

	}

	function add_to_context( $context ) {
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['primary_menu'] = new TimberMenu('868');
		$context['footer_menu'] = new TimberMenu('869');
		$context['site'] = $this;
		return $context;
	}


	function add_to_twig( $twig ) {
		/* this is where you can add fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
		return $twig;
	}

	function setup() {
  add_theme_support( 'html5', array( 'search-form', 'gallery' ) );
  // $content_width limits the size of the largest image size available via the media uploader
  // It should be set once and left alone apart from that; don't do anything fancy with it; it is part of WordPress core
  global $content_width;
  if ( !isset( $content_width ) || !is_int( $content_width ) )
    $content_width = (int) 1500;
	}

	function widgets(){
		$context = array();
		$context['dynamic_sidebar'] = Timber::get_widgets('dynamic_sidebar');
		Timber::render('sidebar.twig', $context);
	}

}

new FamisSite();

/*
function myfoo( $text ) {
	$text .= ' bar!';
	return $text;
}
*/

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'News Sidebar',
		'id'            => 'news_sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="srt">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => 'Admissions Sidebar',
		'id'            => 'admissions_sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="mt0">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );


//Make Font Awesome available
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

}
