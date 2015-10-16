jQuery( document ).ready( function( $ ) {

///////////////////////////////////////
// Menu Button
/////////////////////////////////////

$('.menu').click(function(){
  $(this).toggleClass('open');
  $('.nav-main-wrapper').toggleClass('slide-in-right');
});

///////////////////////////////////////
// Sliders
/////////////////////////////////////

$('.hero-carousel').slick({
  dots: true,
  arrows: false,
  infinite: true,
  speed: 1500,
  autoplay: true,
  autoplaySpeed: 5000,
  fade: true,
  slidesToShow: 1,
  slidesToScroll: 1,
});

$('.video-carousel').slick({
  dots: false,
  arrows: true,
  infinite: true,
  speed: 300,
  autoplay: false,
  slidesToShow: 3,
  slidesToScroll: 1,
});

// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('.nav').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        console.log('hasScrolled');
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();

    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta) {
        return;
      }

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight && $(window).width() > 1085){
        // Scroll Down
        $('.nav').removeClass('nav-down').addClass('nav-up');
    }
      else if ($(window).scrollTop() < 300 && $(window).width() > 1085) {
        $('.nav').removeClass('nav-down').removeClass('nav-up');
      }
     else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            console.log('nav-down');
            $('.nav').removeClass('nav-up').addClass('nav-down');
        }
    }

    lastScrollTop = st;
}


///////////////////////////////
// smooth scrolling
//////////////////////////////
$(function() {
$('a[href*=#]:not([href=#])').click(function() {
  if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
      $('html,body').animate({
        scrollTop: target.offset().top
      }, 1000);
      return false;
      }
    }
  });
});

/********************
* Contact Form
********************/

  $('#name').keyup(function(){
  $('.name').addClass('typing');
  if( $(this).val().length === 0 ) {
      $('.name').removeClass('typing');
  }
});
$('#email').keyup(function(){
  $('.email').addClass('typing');
  if( $(this).val().length === 0 ) {
      $('.email').removeClass('typing');
  }
});

$('#subject').keyup(function(){
  $('.subject').addClass('typing');
  if( $(this).val().length === 0 ) {
      $('.subject').removeClass('typing');
  }
});

$('#message').keyup(function(){
  $('.message').addClass('typing');
  if( $(this).val().length === 0 ) {
      $('.message').removeClass('typing');
  }
});

$('.toggle-contact').click(function() {
    $('.modal-contact-form').toggleClass('modal-showing');
    $('body').toggleClass('stop-scroll');
});

  $('.modal-overlay').click(function() {
      $('.modal-contact-form').removeClass('modal-showing');
      $('body').removeClass('stop-scroll');
  });
});


//////////////////////////////////////
// nav
/////////////////////////////////
