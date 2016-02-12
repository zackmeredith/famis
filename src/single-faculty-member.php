<?php
/**
 * Template :: Single Faculty Member
 */

$data = Timber::get_context();
$post = Timber::query_post();
$data['post'] = $post;
$data['categories'] = Timber::get_terms('category');
Timber::render('single-faculty-member.twig', $data);
