<?php
/**
* Template Name: Featured Posts
* Description: Page template for page with featured posts sections
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

if (is_page ( 'news' )) {
	$main_feat_terms = 'main-featured-post';
	$secondary_feat_terms = 'secondary-featured-post';

	$args = array(
	    'post_type' => 'post',
			'cat' => '-72',
	    'posts_per_page' => 12,
	    'paged' => $paged
	);
} elseif (is_page ( 'forum' )) {
	$main_feat_terms = 'main-featured-forum';
	$secondary_feat_terms = 'secondary-featured-forum';

	$args = array(
	    'post_type' => 'post',
			'cat' => '72',
	    'posts_per_page' => 12,
	    'paged' => $paged
	);
}

elseif (is_page ( 'student-achievements' )) {
	$main_feat_terms = 'main-feat-student-achievement';
	$secondary_feat_terms = 'secondary-feat-student-achievement';

	$args = array(
	    'post_type' => 'post',
			'cat' => '3326',
	    'posts_per_page' => 12,
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

Timber::render( 'template-featured-posts.twig', $data );
