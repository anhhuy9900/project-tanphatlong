/*jshint jquery:true */
/*global $:true */

var $ = jQuery.noConflict();

$(document).ready(function($) {
	"use strict";

	/* global google: false */
	/*jshint -W018 */

	/*-------------------------------------------------*/
	/* =  portfolio isotope
	/*-------------------------------------------------*/

	var winDow = $(window);
		// Needed variables
		var $container=$('.iso-call');
		var $filter=$('.filter');

		try{
			$container.imagesLoaded( function(){
				$container.trigger('resize');
				$container.isotope({
					filter:'*',
					layoutMode:'masonry',
					animationOptions:{
						duration:750,
						easing:'linear'
					}
				});

				$('.triggerAnimation').waypoint(function() {
					var animation = $(this).attr('data-animate');
					$(this).css('opacity', '');
					$(this).addClass("animated " + animation);

				},
					{
						offset: '75%',
						triggerOnce: true
					}
				);
				setTimeout(Resize, 1500);
			});
		} catch(err) {
		}

		winDow.bind('resize', function(){
			var selector = $filter.find('a.active').attr('data-filter');

			try {
				$container.isotope({
					filter	: selector,
					animationOptions: {
						duration: 750,
						easing	: 'linear',
						queue	: false,
					}
				});
			} catch(err) {
			}
			return false;
		});

		// Isotope Filter
		$filter.find('a').on('click', function(){
			var selector = $(this).attr('data-filter');

			try {
				$container.isotope({
					filter	: selector,
					animationOptions: {
						duration: 750,
						easing	: 'linear',
						queue	: false,
					}
				});
			} catch(err) {

			}
			return false;
		});


	var filterItemA	= $('.filter li a');

		filterItemA.on('click', function(){
			var $this = $(this);
			if ( !$this.hasClass('active')) {
				filterItemA.removeClass('active');
				$this.addClass('active');
			}
		});

	/*-------------------------------------------------*/
	/* =  Search animation
	/*-------------------------------------------------*/

	var searchToggle = $('.open-search'),
		inputAnime = $(".form-search"),
		body = $('body');

	searchToggle.on('click', function(event){
		event.preventDefault();

		if ( !inputAnime.hasClass('active') ) {
			inputAnime.addClass('active');
		} else {
			inputAnime.removeClass('active');
		}
	});

	body.on('click', function(){
		inputAnime.removeClass('active');
	});

	var elemBinds = $('.open-search, .form-search');
	elemBinds.bind('click', function(e) {
		e.stopPropagation();
	});

	/*-------------------------------------------------*/
	/* =  fullwidth carousell
	/*-------------------------------------------------*/
	try {
		var owlWrap = $('.owl-wrapper');

		if (owlWrap.length > 0) {

			if (jQuery().owlCarousel) {
				owlWrap.each(function(){

					var carousel= $(this).find('.owl-carousel'),
						dataNum = $(this).find('.owl-carousel').attr('data-num'),
						dataNum2,
						dataNum3;

					if ( dataNum == 1 ) {
						dataNum2 = 1;
						dataNum3 = 1;
					} else if ( dataNum == 2 ) {
						dataNum2 = 2;
						dataNum3 = dataNum - 1;
					} else {
						dataNum2 = dataNum - 1;
						dataNum3 = dataNum - 2;
					}

					carousel.owlCarousel({
						autoPlay: 10000,
						navigation : true,
						items : dataNum,
						itemsDesktop : [1199,dataNum2],
						itemsDesktopSmall : [979,dataNum3]
					});

				});
			}
		}

	} catch(err) {

	}

	/*-------------------------------------------------*/
	/* =  flexslider
	/*-------------------------------------------------*/

	try {

		var SliderPost = $('.flexslider');

		SliderPost.flexslider({
			slideshowSpeed: 3000,
			easing: "swing"
		});
	} catch(err) {

	}


	/* ---------------------------------------------------------------------- */
	/*	Contact Map
	/* ---------------------------------------------------------------------- */
	var map_lat = $(".info_map").data('lat');
	var map_long = $(".info_map").data('long');
	var img_map = $(".info_map").data('img');
	var img_logo = $(".info_map").data('logo');
	var contact_address = '<img src="' +img_logo+ '" class="contact-logo" />' + '<br>' + $(".info_map").data('address');
	var contact = {lat : map_lat, lng : map_long}; //Change a map coordinate here!

	/*try {
		$('#map').gmap3({
			zoom: 18,
			center: contact,
			marker:{
				options:{
					icon: new google.maps.MarkerImage(
						img_map,
						new google.maps.Size(20, 20),
						new google.maps.Point(0, 0)
					)
				}
			},
			action: 'addMarker',
			icon: img_map

		})
		.infowindow({
			position: contact,
			content: contact_address,
		})
		.then(function (infowindow) {
			infowindow.open(this.get(0)); // this.get(0) return the map (see "get" feature)
		});
	} catch(err) {

	}*/

	if($('#map').length > 0){
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 18,
			center: new google.maps.LatLng(map_lat, map_long),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		var infowindow = new google.maps.InfoWindow();

		var marker, i;

		marker = new google.maps.Marker({
			position: new google.maps.LatLng(map_lat, map_long),
			map: map,
			//options:{
			//	icon: new google.maps.MarkerImage(
			//		img_map
			//	)
			//}
		});

		infowindow.setContent(contact_address);
		infowindow.open(map, marker);
	}



	/*-------------------------------------------------*/
	/* = slider Testimonial
	/*-------------------------------------------------*/

	var slidertestimonial = $('.bxslider');
	try{
		slidertestimonial.bxSlider({
			mode: 'vertical'
		});
	} catch(err) {
	}

	/* ---------------------------------------------------------------------- */
	/*	Contact Form
	/* ---------------------------------------------------------------------- */

	var submitContact = $('#submit_contact'),
		message = $('#msg');

	submitContact.on('click', function(e){
		e.preventDefault();

		var $this = $(this);
		$.ajax({
			type: "POST",
			url: ajaxurl,
			dataType: 'json',
			cache: false,
			data: $('#contact-form').serialize(),
			success: function(data) {

				if(data.status == 1){
					$this.parents('form').find('input[type=text],textarea,select').filter(':visible').val('');
					message.hide().removeClass('success').removeClass('error').addClass('success').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
					setTimeout(function(){
						location.reload();
					},2000);
				} else {
					message.hide().removeClass('success').removeClass('error').addClass('error').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
				}
			}
		});
	});


	/*-------------------------------------------------*/
	/* =  about tabs
	/*-------------------------------------------------*/

	var tabLinK = $('.about-post a'),
		tabContenT = $('.tab-cont');

		tabLinK.on('click', function(event){
			event.preventDefault();
			var dataLink = $(this).attr('data-link'),
				dataTab = $('.tab-cont.active').attr('data-tab');

			if(!$(this).hasClass('active')) {
				$('.about-post a').removeClass('active');
				$(this).addClass('active');
			}

			if ( dataLink == dataTab ) {
			} else {
				tabContenT.removeClass('active');
				$('.tab-cont[data-tab='+ dataLink +']').addClass('active');
			}
		});

	/* ---------------------------------------------------------------------- */
	/*	Header animate after scroll
	/* ---------------------------------------------------------------------- */

	(function() {

		var docElem = document.documentElement,
			didScroll = false,
			changeHeaderOn = 50;
			document.querySelector( 'header' );
		function init() {
			window.addEventListener( 'scroll', function() {
				if( !didScroll ) {
					didScroll = true;
					setTimeout( scrollPage, 100 );
				}
			}, false );
		}

		function scrollPage() {
			var sy = scrollY();
			if ( sy >= changeHeaderOn ) {
				$( 'header' ).addClass('active');
			}
			else {
				$( 'header' ).removeClass('active');
			}
			didScroll = false;
		}

		function scrollY() {
			return window.pageYOffset || docElem.scrollTop;
		}

		init();

	})();

	/* ---------------------------------------------------------------------- */
	/*	Slider Gallery for detail page
	/* ---------------------------------------------------------------------- */
	$('.gallery-image-bxslider').bxSlider({
		auto : true,
		pause : 4000,
      	minSlides: 1,
      	maxSlides: 4,
		moveSlides : 1,
      	slideWidth: 150,
      	slideMargin: 10,
      	pager : false,
      	infiniteLoop : true,
		onSliderLoad : function($slideElement, newIndexoldIndex, newIndex){
			$(".image-thumb-detail > a").on('click', function(event) {
				//var image_url = $(this).data('url');
				var current_index = $(this).parent().data('index');
				$(".show-first-image > a").fadeOut(500);
				$(".show-first-image > a").eq(current_index).fadeIn(500);
				//var slider = $('.gallery-image-bxslider').bxSlider();
				//slider.goToSlide(current_index);

			});

		},
		onSlideBefore : function($slideElement, newIndexoldIndex, newIndex){
			var current_index = $slideElement.data('index');
			$(".show-first-image > a").fadeOut(500);

		},
		onSlideAfter : function($slideElement, oldIndex, newIndex){
			//console.log($(".show-first-image > a").eq(newIndex));
			$(".show-first-image > a").eq(newIndex).fadeIn(500);

		}

    });

	$( "#birthday" ).datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: "1970:2016"
	});

});

function Resize() {
	$(window).trigger('resize');
}


function redirect_link(url){
	window.location.href = url;
}