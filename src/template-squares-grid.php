<?php
/**
* Template Name: Squares Grid
* Description: Page template for pages with a grid of square posts or items
 */

if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

$data = Timber::get_context();

global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}

if (is_page ( 'students' )) {
	$main_feat_terms = 'main-featured-post';
	$secondary_feat_terms = 'secondary-featured-post';

	$args = array(
	    'post_type' => 'student-artist',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			// 'cat' => '-72',
	    // 'posts_per_page' => 12,
	    'paged' => $paged
	);
}

elseif (is_page ( 'faculty' )) {
	$main_feat_terms = 'main-featured-forum';
	$secondary_feat_terms = 'secondary-featured-forum';

	$args = array(
	    'post_type' => 'faculty-member',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			// 'cat' => '72',
	    'posts_per_page' => 99,
	    'paged' => $paged
	);
}

/* THIS LINE IS CRUCIAL */
/* in order for WordPress to know what to paginate */
/* your args have to be the defualt query */

$page = new TimberPost();
$data['page'] = $page;
$data['categories'] = Timber::get_terms('category');
$data['pagination'] = Timber::get_pagination();


query_posts($args);

$data['posts'] = Timber::get_posts($args);
$data['main_feat_post'] = new TimberTerm($main_feat_terms, 'featured-posts');
$data['secondary_feat_post'] = new TimberTerm($secondary_feat_terms, 'featured-posts');

Timber::render( 'template-squares-grid.twig', $data );
