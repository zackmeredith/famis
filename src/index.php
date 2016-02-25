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

$data = Timber::get_context();
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 12,
    'paged' => $paged
);
$templates = array('index.twig');

if (is_home()){
  $args = array(
      'post_type' => 'post',
      'cat' => '-72',
      'posts_per_page' => 12,
      'paged' => $paged
  );
  array_unshift($templates, 'page-news.twig');
}



$page = new TimberPost();
$data['page'] = $page;
$data['news_sidebar'] = Timber::get_widgets('news_sidebar');
$data['main_feat_post'] = new TimberTerm('main-featured-post');
$data['secondary_feat_post'] = new TimberTerm('secondary-featured-post');
$data['forum'] = new TimberTerm('forum');
$data['categories'] = Timber::get_terms('category');

/* THIS LINE IS CRUCIAL */
/* in order for WordPress to know what to paginate */
/* your args have to be the defualt query */
query_posts($args);

$data['pagination'] = Timber::get_pagination();
$data['posts'] = Timber::get_posts($args);





Timber::render($templates, $data);
