<?php
/*
 * Template Name: Single Degree View
 * Description: A Degree Page
 */

$page = new TimberPost();
$context = Timber::get_context();
$context['page'] = $page;

// $context['post'] = Timber::get_posts($post_type = 'degree');

Timber::render('single-degree.twig', $context);
