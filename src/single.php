<?php
/**
 * Template :: Single
 */

$data = Timber::get_context();
$post = Timber::query_post();
$data['post'] = $post;
$data['comment_form'] = TimberHelper::get_comment_form();

if (get_field('post_parent') == '58'){
	Timber::render('single-degree.twig', $context);
} else if (post_password_required($post->ID)){
  Timber::render('single-password.twig', $data);
}

else {
  Timber::render(array('single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig'), $data);
}
