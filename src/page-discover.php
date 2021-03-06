<?php
/**
 * Template :: Archive
 */

 global $paged;
 if (!isset($paged) || !$paged){
     $paged = 1;
 }

 $args = array(
     'post_type' => 'post',
     'posts_per_page' => 12,
     'paged' => $paged
 );

$templates = array('page-discover.twig', 'index.twig');

$data = Timber::get_context();
$page = new TimberPost();
$data['page'] = $page;
query_posts($args);


$data['title'] = 'Archive';
if (is_day()){
  $data['title'] = 'Archive: '.get_the_date( 'D M Y' );
} else if (is_month()){
  $data['title'] = 'Archive: '.get_the_date( 'M Y' );
} else if (is_year()){
  $data['title'] = 'Archive: '.get_the_date( 'Y' );
} else if (is_tag()){
  $data['title'] = single_tag_title('', false);
} else if (is_category()){
  $data['title'] = single_cat_title('', false);
  array_unshift($templates, 'archive-'.get_query_var('cat').'.twig');
} else if (is_post_type_archive()){
  $data['title'] = post_type_archive_title('', false);
  array_unshift($templates, 'archive-'.get_post_type().'.twig');
}

$data['posts'] = Timber::get_posts($args);
$data['pagination'] = Timber::get_pagination();
$data['categories'] = Timber::get_terms('category');

Timber::render($templates, $data);
