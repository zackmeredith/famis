<?php
/**
 * Template :: Page
 */

 $facargs = array(
 		'post_type'      => 'facility',
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
Timber::render('page-facilities.twig', $data);
