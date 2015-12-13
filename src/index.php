<?php
/**
 * Template :: Index
 */

if (!class_exists('Timber')){
  echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
  return;
}

global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}

$args = array(
    'post_type' => 'post',
    'cat' => '-72',
    'posts_per_page' => 8,
    'paged' => $paged
);
/* THIS LINE IS CRUCIAL */
/* in order for WordPress to know what to paginate */
/* your args have to be the defualt query */


$data = Timber::get_context();
$page = new TimberPost();
$data['page'] = $page;
$data['news_sidebar'] = Timber::get_widgets('news_sidebar');
$data['main_feat_post'] = new TimberTerm('main-featured-post');
$data['secondary_feat_post'] = new TimberTerm('secondary-featured-post');
$data['forum'] = new TimberTerm('forum');
query_posts($args);
$data['pagination'] = Timber::get_pagination();
$data['posts'] = Timber::get_posts($args);


$templates = array('index.twig');

if (is_home()){
  array_unshift($templates, 'page-news.twig');
}

Timber::render($templates, $data);
