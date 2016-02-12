<?php
/**
 * Template :: Degree Programs
 */


 $degargs = array(
 		'post_type'      => 'degree',
 		'orderby' => 'menu_order',
 		'order' => 'ASC',
 		'posts_per_page' => '99'
 );


$context['page'] = $page;
query_posts( $degargs );
$data = Timber::get_context();
$page = new TimberPost();
$data['page'] = $page;
$post = Timber::get_posts( $degargs );
$data['post'] = $post;
$data['categories'] = Timber::get_terms('category');

Timber::render('page-degree-programs.twig', $data);
