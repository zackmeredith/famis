<?php
/**
 * Template :: Degree Programs
 */

 class Degrees {

     public static function get_posts($args = array()) {

         $default_args = array(
                 'post_type' => 'degree',
                 'posts_per_page' => 4,
                 'orderby' => 'menu_order',
                 'order' => 'ASC',
                 'post_status' => 'publish',
         );
         $args += $default_args;
     }
 }

// $context['post'] = Degrees::get_posts();
$page = new TimberPost();
$context = Timber::get_context();
$context['page'] = $page;

// $post = new TimberPost($post_type = 'degree');
// $context['post'] = Timber::get_posts($post_type = 'degree');

Timber::render('page-degree-programs.twig', $context);
