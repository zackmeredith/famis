jQuery( document ).ready( function( $ ) {

///////////////////////////////
// smooth scrolling
//////////////////////////////
$(function() {
  $("a[rel^='scrolling']").click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1500);
      }
    }
  });
});


///////////////////////////////
// Accordion
//////////////////////////////

(function(){
	var d = document,
	accordionToggles = d.querySelectorAll('.js-accordionTrigger'),
	setAria,
	setAccordionAria,
	switchAccordion,
  touchSupported = ('ontouchstart' in window),
  pointerSupported = ('pointerdown' in window);

  skipClickDelay = function(e){
    e.preventDefault();
    e.target.click();
  }

		setAriaAttr = function(el, ariaType, newProperty){
		el.setAttribute(ariaType, newProperty);
	};
	setAccordionAria = function(el1, el2, expanded){
		switch(expanded) {
      case "true":
      	setAriaAttr(el1, 'aria-expanded', 'true');
      	setAriaAttr(el2, 'aria-hidden', 'false');
      	break;
      case "false":
      	setAriaAttr(el1, 'aria-expanded', 'false');
      	setAriaAttr(el2, 'aria-hidden', 'true');
      	break;
      default:
				break;
		}
	};
//function
switchAccordion = function(e) {
	e.preventDefault();
	var thisAnswer = e.target.parentNode.nextElementSibling;
	var thisQuestion = e.target;
	if(thisAnswer.classList.contains('is-collapsed')) {
		setAccordionAria(thisQuestion, thisAnswer, 'true');
	} else {
		setAccordionAria(thisQuestion, thisAnswer, 'false');
	}
  	thisQuestion.classList.toggle('is-collapsed');
  	thisQuestion.classList.toggle('is-expanded');
		thisAnswer.classList.toggle('is-collapsed');
		thisAnswer.classList.toggle('is-expanded');

  	thisAnswer.classList.toggle('animateIn');
	};
	for (var i=0,len=accordionToggles.length; i<len; i++) {
		if(touchSupported) {
      accordionToggles[i].addEventListener('touchstart', skipClickDelay, false);
    }
    if(pointerSupported){
      accordionToggles[i].addEventListener('pointerdown', skipClickDelay, false);
    }
    accordionToggles[i].addEventListener('click', switchAccordion, false);
  }
})();

///////////////////////////////////////
// Menu Button
/////////////////////////////////////

$('.menu').click(function(){
  $(this).toggleClass('open');
  $('.nav-main-wrapper').toggleClass('slide-in-right');
});


$('.nav-drop-button').on('click', function(){
  $(this).parent().toggleClass('nav-drop-open');
  $(this).parent().siblings().removeClass('nav-drop-open');

});

$('.sidebar-nav-drop-button').on('click', function(){
  $('.sidebar-nav').toggleClass('md-show');
  $('.sidebar-nav-drop-icon').toggleClass('flip');
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

  ////////////////////////////////
  //
  ///////////////////////////



var openclose;
  openclose = function () {
          $('.open-close-button').click(function () {
          $(this).toggleClass('open');
          $('.degree-guide-wrapper').toggleClass('sm-show');
      });
  };
openclose();

});


//////////////////////////////////////
// nav
/////////////////////////////////
