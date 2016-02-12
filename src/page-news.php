<?php
/**
 */

if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 12,
    'paged' => $paged
);
/* THIS LINE IS CRUCIAL */
/* in order for WordPress to know what to paginate */
/* your args have to be the defualt query */
query_posts($args);

$data = Timber::get_context();
$data['news_sidebar'] = Timber::get_widgets('news_sidebar');
$page = new TimberPost();
$data['page'] = $page;
$data['posts'] = Timber::get_posts();
$data['posts'] = $posts;
$data['pagination'] = Timber::get_pagination();
$data['categories'] = Timber::get_terms('category');

Timber::render( 'page-news.twig', $data );
