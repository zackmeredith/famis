<?php
/**
* Template :: Single Degree
*/

if (is_single ( '19871' )) {
  $degreeterms = 'bfa-filmmaking';
  $freshmandegreeterms = 'freshman-year-bfa-filmmaking';
  $springfreshmandegreeterms = 'spring-freshman-year-bfa-filmmaking';
  $fallfreshmandegreeterms = 'fall-freshman-year-bfa-filmmaking';
  $sophomoredegreeterms = 'sophomore-year-bfa-filmmaking';
  $springsophomoredegreeterms = 'spring-sophomore-year-bfa-filmmaking';
  $fallsophomoredegreeterms = 'fall-sophomore-year-bfa-filmmaking';
  $juniordegreeterms = 'junior-year-bfa-filmmaking';
  $springjuniordegreeterms = 'spring-junior-year-bfa-filmmaking';
  $falljuniordegreeterms = 'fall-junior-year-bfa-filmmaking';
  $seniordegreeterms = 'senior-year-bfa-filmmaking';
  $springseniordegreeterms = 'spring-senior-year-bfa-filmmaking';
  $fallseniordegreeterms = 'fall-senior-year-bfa-filmmaking';
} elseif (is_single ( '19872' )) {
  $degreeterms = 'bs-mis';
  $freshmandegreeterms = 'freshman-year-bs-mis';
  $springfreshmandegreeterms = 'spring-freshman-year-bs-mis';
  $fallfreshmandegreeterms = 'fall-freshman-year-bs-mis';
  $sophomoredegreeterms = 'sophomore-year-bs-mis';
  $springsophomoredegreeterms = 'spring-sophomore-year-bs-mis';
  $fallsophomoredegreeterms = 'fall-sophomore-year-bs-mis';
  $juniordegreeterms = 'junior-year-bs-mis';
  $springjuniordegreeterms = 'spring-junior-year-bs-mis';
  $falljuniordegreeterms = 'fall-junior-year-bs-mis';
  $seniordegreeterms = 'senior-year-bs-mis';
  $springseniordegreeterms = 'spring-senior-year-bs-mis';
  $fallseniordegreeterms = 'fall-senior-year-bs-mis';
} elseif (is_single ( '19873' )) {
  $degreeterms = 'bm-mis';
  $freshmandegreeterms = 'freshman-year-bm-mis';
  $springfreshmandegreeterms = 'spring-freshman-year-bm-mis';
  $fallfreshmandegreeterms = 'fall-freshman-year-bm-mis';
  $sophomoredegreeterms = 'sophomore-year-bm-mis';
  $springsophomoredegreeterms = 'spring-sophomore-year-bm-mis';
  $fallsophomoredegreeterms = 'fall-sophomore-year-bm-mis';
  $juniordegreeterms = 'junior-year-bm-mis';
  $springjuniordegreeterms = 'spring-junior-year-bm-mis';
  $falljuniordegreeterms = 'fall-junior-year-bm-mis';
  $seniordegreeterms = 'senior-year-bm-mis';
  $springseniordegreeterms = 'spring-senior-year-bm-mis';
  $fallseniordegreeterms = 'fall-senior-year-bm-mis';
}
elseif (is_single ( '19874' )) {
  $degreeterms = 'ba-popular-commercial-music';
  $freshmandegreeterms = 'freshman-year-ba-pop';
  $springfreshmandegreeterms = 'spring-freshman-year-ba-pop';
  $fallfreshmandegreeterms = 'fall-freshman-year-ba-pop';
  $sophomoredegreeterms = 'sophomore-year-ba-pop';
  $springsophomoredegreeterms = 'spring-sophomore-year-ba-pop';
  $fallsophomoredegreeterms = 'fall-sophomore-year-ba-pop';
  $juniordegreeterms = 'junior-year-ba-pop';
  $springjuniordegreeterms = 'spring-junior-year-ba-pop';
  $falljuniordegreeterms = 'fall-junior-year-ba-pop';
  $seniordegreeterms = 'senior-year-ba-pop';
  $springseniordegreeterms = 'spring-senior-year-ba-pop';
  $fallseniordegreeterms = 'fall-senior-year-ba-pop';
}


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


$data['degree'] = new TimberTerm($degreeterms, 'degree-requirement');
$data['fallfreshman'] = new TimberTerm($fallfreshmandegreeterms, 'degree-requirement');
$data['springfreshman'] = new TimberTerm($springfreshmandegreeterms, 'degree-requirement');
$data['fallsophomore'] = new TimberTerm($fallsophomoredegreeterms, 'degree-requirement');
$data['springsophomore'] = new TimberTerm($springsophomoredegreeterms, 'degree-requirement');
$data['falljunior'] = new TimberTerm($falljuniordegreeterms, 'degree-requirement');
$data['springjunior'] = new TimberTerm($springjuniordegreeterms, 'degree-requirement');
$data['fallsenior'] = new TimberTerm($fallseniordegreeterms, 'degree-requirement');
$data['springsenior'] = new TimberTerm($springseniordegreeterms, 'degree-requirement');


  if ( get_post_meta( get_the_ID(), 'wpcf-video-embed-code', true ) ) {
    $data['video'] = get_post_meta( get_the_ID(), 'wpcf-video-embed-code', true );
  }


  Timber::render('single-degree.twig', $data);
