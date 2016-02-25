<?php
/**
 * Template Name: Thin Container
 * Description: Page template for centered container
 */

$data = Timber::get_context();
$page = new TimberPost();
$data['page'] = $page;
$post = Timber::get_post();
$data['post'] = $post;
$data['categories'] = Timber::get_terms('category');
Timber::render('template-thin-container.twig', $data);
