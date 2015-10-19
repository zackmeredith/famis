<?php

$context = Timber::get_context();
$args = 'post_type=post';
$context['news'] = Timber::get_posts($args);
$page = new TimberPost();
$context['page'] = $page;
Timber::render( 'front-page.twig', $context );
