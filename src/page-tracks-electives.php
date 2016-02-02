<?php
/**
* Template :: Tracks & Electives
*/



$data = Timber::get_context();

$page = new TimberPost();
$data['page'] = $page;
$post = Timber::get_post();
$data['post'] = $post;

$courseargs = array(
		'post_type'      => 'course',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => '99',
);

query_posts( $courseargs );

// $course = Timber::get_posts($courseargs);
// $data['course'] = $course;

// Arts Tracks
$data['commercial_music']     = new TimberTerm('commercial-music');
$data['creative_writing']     = new TimberTerm('creative-writing');
$data['digital_filmmaking']   = new TimberTerm('digital-filmmaking');
$data['film_studies']         = new TimberTerm('3295');
$data['screenwriting']        = new TimberTerm('screenwriting');

// Crafts & Skills
$data['audio_technology']     = new TimberTerm('audio-technology');
$data['digital_media']        = new TimberTerm('3137');
$data['graphic_design']       = new TimberTerm('graphic-design');
$data['mass_communication']   = new TimberTerm('mass-communication');
$data['music_technology']     = new TimberTerm('2801');
$data['production']           = new TimberTerm('2913');



  if ( get_post_meta( get_the_ID(), 'wpcf-video-embed-code', true ) ) {
    $data['video'] = get_post_meta( get_the_ID(), 'wpcf-video-embed-code', true );
  }


  Timber::render('page-tracks-electives.twig', $data);
