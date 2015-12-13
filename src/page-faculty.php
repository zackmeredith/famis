<?php
/**
 * Template :: Page Faculty
 */

$facargs = array(
		'post_type'      => 'faculty-member',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => '99'
);

query_posts( $facargs );
$data = Timber::get_context();
$page = new TimberPost();
$data['page'] = $page;
$post = Timber::get_posts( $facargs );
$data['post'] = $post;


Timber::render('page-faculty.twig', $data);
