<?php
/**
 * Template :: Page
 */

$data = Timber::get_context();
$page = new TimberPost();
$data['page'] = $page;
$post = Timber::get_post();
$data['post'] = $post;
$data['admissions_sidebar'] = Timber::get_widgets('admissions_sidebar');
$data['categories'] = Timber::get_terms('category');

Timber::render(array('page-' . $page->post_name . '.twig', 'page.twig'), $data);
