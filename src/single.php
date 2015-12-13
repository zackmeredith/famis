<?php
/**
* Template :: Single
*/

$data = Timber::get_context();
$page = new TimberPost();
$data['page'] = $page;
$post = Timber::get_post();
$data['post'] = $post;
$data['comment_form'] = TimberHelper::get_comment_form();

if ( has_post_format( 'video' )) {

  if ( get_post_meta( get_the_ID(), 'wpcf-video-embed-code', true ) ) {
    $data['video'] = get_post_meta( get_the_ID(), 'wpcf-video-embed-code', true );
  }

  else if ( get_post_meta(get_the_ID(), '_stag_video_embed', true)) {
    $data['video'] = get_post_meta(get_the_ID(), '_stag_video_embed', true);
  }
} else if ( has_post_format( 'audio' )) {
  $data['video'] = get_post_meta( get_the_ID(), 'wpcf-video-embed-code', true );
}

if (post_password_required($post->ID)){
  Timber::render('single-password.twig', $data);
} else {
  Timber::render(array('single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig'), $data);
}
