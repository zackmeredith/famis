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
$context = Timber::get_context();
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 12,
    'paged' => $paged
);
/* THIS LINE IS CRUCIAL */
/* in order for WordPress to know what to paginate */
/* your args have to be the defualt query */
    query_posts($args);

$context['posts'] = Timber::get_posts();
$page = new TimberPost();
$context['page'] = $page;
$context['pagination'] = Timber::get_pagination();
Timber::render( 'page-news.twig', $context );
