<?php // ==== ASSETS ==== //

// Now that you have efficiently generated scripts and stylesheets for your theme, how should they be integrated?
// This file walks you through the approach I use...

// Enqueue front-end scripts and styles
if ( !function_exists( 'voidx_enqueue_scripts' ) ) : function voidx_enqueue_scripts() {

  $script_name = '';                // Empty by default, may be populated by conditionals below
  $script_vars = array();           // An empty array that can be filled with variables to send to front-end scripts
  $script_handle = 'voidx';         // A generic script handle
  $suffix = '.min';                 // The suffix for minified scripts
  $ns = 'wp';                       // Namespace

  // Load original scripts when debug mode is on
  if ( WP_DEBUG === true )
    $suffix = '';

  // Figure out which script bundle to load based on various options set in `src/functions-config-defaults.php`
  // Note: bundles require less HTTP requests at the expense of addition caching hits when different scripts are requested
  // You could also load one main bundle on every page with supplementary scripts as needed (e.g. for commenting)

  // WP AJAX Page Loader (pg8); this requires a bit more setup as outlined in the documentation: https://github.com/synapticism/wp-ajax-page-loader
  $script_vars_pg8 = '';
  if ( VOIDX_SCRIPTS_PAGELOAD && ( is_archive() || is_home() || is_search() ) ) {
    $script_name .= '-pg8';

    global $wp_query;

    // What page are we on? And what is the page limit?
    $max = $wp_query->max_num_pages;
    $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

    // Prepare script variables; note that these are separate from the rest of the script variables
    $script_vars_pg8 = array(
      'startPage'   => $paged,
      'maxPages'    => $max,
      'nextLink'    => next_posts( $max, false )
    );
  } // end PG8

  // Default script name
  if ( empty( $script_name ) )
    $script_name = '-core';

  // Load theme-specific JavaScript bundles with versioning based on last modified time; http://www.ericmmartin.com/5-tips-for-using-jquery-with-wordpress/
  // The handle is the same for each bundle since we're only loading one script; if you load others be sure to provide a new handle
  wp_enqueue_script( $script_handle, get_stylesheet_directory_uri() . '/js/' . $ns . $script_name . $suffix . '.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/' . $ns . $script_name . $suffix . '.js' ), true );

  // Pass variables to JavaScript at runtime; see: http://codex.wordpress.org/Function_Reference/wp_localize_script
  $script_vars = apply_filters( 'voidx_script_vars', $script_vars );
  if ( !empty( $script_vars ) )
    wp_localize_script( $script_handle, 'voidxVars', $script_vars );

  // Script variables for WP AJAX Page Loader (these are separate from the main theme script variables due to the naming requirement)
  if ( !empty( $script_vars_pg8 ) )
    wp_localize_script( $script_handle, 'PG8Data', $script_vars_pg8 );

  // Register and enqueue our main stylesheet with versioning based on last modified time
  wp_register_style( 'voidx-style', get_stylesheet_uri(), $dependencies = array(), filemtime( get_template_directory() . '/style.css' ) );
  wp_enqueue_style( 'voidx-style' );

} endif;
add_action( 'wp_enqueue_scripts', 'voidx_enqueue_scripts' );



// Provision the front-end with the appropriate script variables
function voidx_update_script_vars( $script_vars = array() ) {

  // Non-destructively merge script variables if a particular condition is met
  if ( 1 == 1 ) {
    $script_vars = array_merge( $script_vars, array(
      'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
      'nameSpaced'    => array(
        'test1'         => __( 'Testing 1, 2, 3!', 'voidx' ),
        'test2'         => __( 'This is easier than it looks :)', 'voidx' )
    ) ) );
  }
  return $script_vars;
}
add_filter( 'voidx_script_vars', 'voidx_update_script_vars' );
