<?php
/*
 * Template Name: Admissions Pages
 * Description: Page template for admissions pages with sidebar
 */

$data = Timber::get_context();
$page = new TimberPost();
$data['page'] = $page;
$data['categories'] = Timber::get_terms('category');
$data['admissions_sidebar'] = Timber::get_widgets('admissions_sidebar');
Timber::render('template-admissions-sidebar.twig', $data);
