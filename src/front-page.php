<?php

$data = Timber::get_context();
$args = 'post_type=post';
$data['news'] = Timber::get_posts($args);
$page = new TimberPost();
$data['page'] = $page;
$data['categories'] = Timber::get_terms('category');
Timber::render( 'front-page.twig', $data );
