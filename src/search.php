<?php
/**
 * Template :: Search
 */

$templates = array('search.twig', 'archive.twig', 'index.twig');
$data = Timber::get_context();
$data['pagination'] = Timber::get_pagination();

$data['title'] = 'Search results for '. get_search_query();
$data['posts'] = Timber::get_posts();
$data['categories'] = Timber::get_terms('category');

Timber::render($templates, $data);
