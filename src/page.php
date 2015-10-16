<?php
/**
 * Template :: Page
 */

$page = new TimberPost();
$data = Timber::get_context();
$data['page'] = $page;
Timber::render(array('page-' . $post->post_name . '.twig', 'page.twig'), $data);
