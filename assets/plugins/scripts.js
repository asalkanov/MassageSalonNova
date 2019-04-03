/** ********************************************** **
	@Author			Dorin Grigoras
	@Website		www.stepofweb.com
	@Last Update	10:36 AM Monday, February 17, 2014

	TABLE CONTENTS
	-------------------------------
	Top Nav
	Scroll To
	Owl Carousel
	Lightbox

	GOOGLE MAP
	FITVIDS

	PHP CONTACT FORM
	PHP RESERVATION FORM
*************************************************** **/


	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-34016412-8', 'auto');
	ga('send', 'pageview');


	// GOOGLE MAP
	var	$googlemap_latitude 	= -37.812344,
		$googlemap_longitude	= 144.968900,
		$googlemap_zoom			= 13,

		// @CONTACT FORM - TRANSLATE OR EDIT
		errMsg 						= 'Please complete all fields!',
		errEmail					= 'Invalid Email!',
		okSent						= '<strong>Thank You!</strong> Your message successfully sent!',
		contact_buttonDisabled		= 'MESSAGE SENT',
		reservation_buttonDisabled	= 'RESERVATION SENT';



/** Begin **/
(function() {
	"use strict";

	var	Core = {

			initialized: false,
			initialize: function() {

				if(this.initialized) return;
				this.initialized = true;

				this.init();
				this.events();

			},

			init: function() {

				// Scroll To
				this.scrollTo();

				// Owl Carousel
				this.owlCarousel();

				// Lightbox
				this.lightbox();

				/**
					Tooltip
				**/
				jQuery("a[data-toggle=tooltip]").tooltip();
				
				/**
					Fitvids
				**/
				if(jQuery(".fullwidthbanner iframe").length < 1 && jQuery(".fullscreenbanner iframe").length < 1) { // disable fitvids if revolution slider video is present!
					jQuery("body").fitVids();
				}

				/**
					Drop Down
				**/
				jQuery('.dropdown-toggle').dropdown();
			},

			events: function() {


				// On Resize
				jQuery(window).resize(function() {

					if(this.afterResize) {
						clearTimeout(this.afterResize);
					}

					this.afterResize = setTimeout(function() {

						/**
							After Resize Code
							.................
						**/

						// keep footer at bottom on resize
						if(jQuery("#middle").height() < (jQuery(window).height() - 270) && jQuery(window).height() > 768) {
							jQuery("#middle").css({"min-height":(jQuery(window).height() - 270) + "px"});
						}

					}, 500);

				});

				// keep footer at bottom
				if(jQuery("#middle").height() < jQuery(window).height()) {
					jQuery("#middle").css({"min-height":(jQuery(window).height() - 270) + "px"});
				}

			},

			/**
				Owl Carousel
			**/
			owlCarousel: function(options) {

				var total = jQuery("div.owl-carousel:not(.manual)").length,
					count = 0;

				jQuery("div.owl-carousel:not(.manual)").each(function() {

					var slider = jQuery(this);

					var defaults = {
						 // Most important owl features
						items : 5,
						itemsCustom : false,
						itemsDesktop : [1199,4],
						itemsDesktopSmall : [980,3],
						itemsTablet: [768,2],
						itemsTabletSmall: false,
						itemsMobile : [479,1],
						singleItem : true,
						itemsScaleUp : false,

						//Basic Speeds
						slideSpeed : 200,
						paginationSpeed : 800,
						rewindSpeed : 1000,

						//Autoplay
						autoPlay : false,
						stopOnHover : false,

						// Navigation
						navigation : false,
						navigationText : ["<i class=\"fa fa-chevron-left\"></i>","<i class=\"fa fa-chevron-right\"></i>"],
						rewindNav : true,
						scrollPerPage : false,

						//Pagination
						pagination : true,
						paginationNumbers: false,

						// Responsive
						responsive: true,
						responsiveRefreshRate : 200,
						responsiveBaseWidth: window,

						// CSS Styles
						baseClass : "owl-carousel",
						theme : "owl-theme",

						//Lazy load
						lazyLoad : false,
						lazyFollow : true,
						lazyEffect : "fade",

						//Auto height
						autoHeight : false,

						//JSON
						jsonPath : false,
						jsonSuccess : false,

						//Mouse Events
						dragBeforeAnimFinish : true,
						mouseDrag : true,
						touchDrag : true,

						//Transitions
						transitionStyle : false,

						// Other
						addClassActive : false,

						//Callbacks
						beforeUpdate : false,
						afterUpdate : false,
						beforeInit: false,
						afterInit: false,
						beforeMove: false,
						afterMove: false,
						afterAction: false,
						startDragging : false,
						afterLazyLoad : false
					}

					var config = jQuery.extend({}, defaults, options, slider.data("plugin-options"));

					// Initialize Slider
					slider.owlCarousel(config).addClass("owl-carousel-init");

				});

			},

			/**
				Lightbox
			**/
			lightbox: function(options) {

				if(typeof(jQuery.magnificPopup) == "undefined") {
					return false;
				}

				// Internationalization of Lightbox
				jQuery.extend(true, jQuery.magnificPopup.defaults, {
					tClose: 'Close (Esc)', // Alt text on close button
					tLoading: 'Loading...', // Text that is displayed during loading. Can contain %curr% and %total% keys
					gallery: {
						tPrev: 'Previous (Left arrow key)', // Alt text on left arrow
						tNext: 'Next (Right arrow key)', // Alt text on right arrow
						tCounter: '%curr% of %total%' // Markup for "1 of 7" counter
					},
					image: {
						tError: '<a href="%url%">The image</a> could not be loaded.' // Error message when image could not be loaded
					},
					ajax: {
						tError: '<a href="%url%">The content</a> could not be loaded.' // Error message when ajax request failed
					}
				});

				jQuery(".lightbox").each(function() {

					var el 			=jQuery(this),
						config		= {},
						defaults 	= {
							type: 				'image',
							fixedContentPos: 	false,
							fixedBgPos: 		false,
							mainClass: 			'mfp-no-margins mfp-with-zoom',
							image: {
								verticalFit: 	true
							},
							zoom: {
								enabled: 		false,
								duration: 		300
							},
							gallery: {
								enabled: false,
								navigateByImgClick: true,
								preload: [0,1], // Will preload 0 - before current, and 1 after the current image
								arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button
								tPrev: 'Previous (Left arrow key)', // title for left button
								tNext: 'Next (Right arrow key)', // title for right button
								tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
							},
						};

					if(el.data("plugin-options")) {
						config = jQuery.extend({}, defaults, options, el.data("plugin-options"));
					}

					jQuery(this).magnificPopup(config);

				});


			},

			/**
				Scroll To
			**/
			scrollTo: function() {

				jQuery("a.scrollTo").bind("click", function(e) {
					e.preventDefault();

					var href = jQuery(this).attr('href');

					if(href != '#') {
						jQuery('html,body').animate({scrollTop: jQuery(href).offset().top - 60}, 1000, 'easeInOutExpo');
					}
				});

				jQuery("a.toTop").bind("click", function(e) {
					e.preventDefault();
					jQuery('html,body').animate({scrollTop: 0}, 1000, 'easeInOutExpo');
				});

			},

		}

		jQuery(window).ready(function () {
			Core.initialize();
		});

})();




/** **************************************************************************************************************** **/
/** **************************************************************************************************************** **/
/** **************************************************************************************************************** **/
/** **************************************************************************************************************** **/


/**	GOOGLE MAP
*************************************************** **/
	function contactMap() {

		var latLang = new google.maps.LatLng($googlemap_latitude,$googlemap_longitude);

		var mapOptions = {
			zoom:$googlemap_zoom,
			center: latLang,
			disableDefaultUI: false,
			navigationControl: false,
			mapTypeControl: false,
			scrollwheel: false,
			// styles: styles,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		var map = new google.maps.Map(document.getElementById('gmap'), mapOptions);
		google.maps.event.trigger(map, 'resize');
		map.setZoom( map.getZoom() );

		var marker = new google.maps.Marker({
			icon: 'data:image/png;base64,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',
			position: latLang,
			map: map,
			title: ""
		});

		marker.setMap(map);
		google.maps.event.addListener(marker, "click", function() {
			// Add optionally an action for when the marker is clicked
		});

		// kepp googlemap responsive - center on resize
		google.maps.event.addDomListener(window, 'resize', function() {
			map.setCenter(latLang);
		});

	}

	
	function showMap(initWhat) {
		var script 		= document.createElement('script');
		script.type 	= 'text/javascript';
		script.src 		= 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&callback='+initWhat;
		document.body.appendChild(script);
	}

	
	// INIT CONTACT, NLY IF #contactMap EXISRS
	if(jQuery("#gmap").length > 0) {
		showMap('contactMap');
	}



/** FITVIDS
	http://fitvidsjs.com/
 **************************************************************** **/
(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    };

    if(!document.getElementById('fit-vids-style')) {

      var div = document.createElement('div'),
          ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];

      div.className = 'fit-vids-style';
      div.id = 'fit-vids-style';
      div.style.display = 'none';
      div.innerHTML = '&shy;<style>         \
        .fluid-width-video-wrapper {        \
           width: 100%;                     \
           position: relative;              \
           padding: 0;                      \
        }                                   \
                                            \
        .fluid-width-video-wrapper iframe,  \
        .fluid-width-video-wrapper object,  \
        .fluid-width-video-wrapper embed {  \
           position: absolute;              \
           top: 0;                          \
           left: 0;                         \
           width: 100%;                     \
           height: 100%;                    \
        }                                   \
      </style>';

      ref.parentNode.insertBefore(div,ref);

    }

    if ( options ) {
      jQuery.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = jQuery(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); // SwfObj conflict patch

      $allVideos.each(function(){
        var $this = jQuery(this);
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
})(jQuery);

// remove fitvids for a specific element: jQuery("#myDiv").unFitVids();
jQuery.fn.unFitVids = function () {
    var id = jQuery(this).attr("id");
    var $children = jQuery("#" + id + " .fluid-width-video-wrapper").children().clone();
    jQuery("#" + id + " .fluid-width-video-wrapper").remove(); //removes the element
    jQuery("#" + id).append($children); //adds it to the parent
};





/**	PHP CONTACT FORM
*************************************************** **/
	jQuery("#contact_submit").bind("click", function(e) {
		e.preventDefault();

		var contact_name 	= jQuery("#contact_name").val(),			// required
			contact_email 	= jQuery("#contact_email").val(),			// required
			contact_subject = jQuery("#contact_subject").val(),			// optional
			contact_comment = jQuery("#contact_comment").val(),			// required
			captcha 		= jQuery("#captcha").val(),					// required TO BE EMPTY if humans
			_action			= jQuery("#contactForm").attr('action'),	// form action URL
			_method			= jQuery("#contactForm").attr('method'),	// form method
			_err			= false;									// status

		// Remove error class
		jQuery("input, textarea").removeClass('err');

		// Spam bots will see captcha field - that's how we decet spams.
		// It's very simple and not very efficient antispam method but works for bots.
		if(captcha != '') {
			return false;
		}


		// Name Check
		if(contact_name == '') {
			jQuery("#contact_name").addClass('err');
			var _err = true;
		}

		// Email Check
		if(contact_email == '') {
			jQuery("#contact_email").addClass('err');
			var _err = true;
		}

		// Comment Check
		if(contact_comment == '') {
			jQuery("#contact_comment").addClass('err');
			var _err = true;
		}

		// Stop here, we have empty fields!
		if(_err === true) {
			return false;
		}


		// SEND MAIL VIA AJAX
		$.ajax({
			url: 	_action,
			data: 	{ajax:"true", action:'email_send', contact_name:contact_name, contact_email:contact_email, contact_comment:contact_comment, contact_subject:contact_subject},
			type: 	_method,
			error: 	function(XMLHttpRequest, textStatus, errorThrown) {

				alert('Server Internal Error'); // usualy on headers 404

			},

			success: function(data) {
				data = data.trim(); // remove output spaces


				// PHP RETURN: Mandatory Fields
				if(data == '_required_') {
					alert(errMsg);
				} else

				// PHP RETURN: INVALID EMAIL
				if(data == '_invalid_email_') {
					alert(errEmail);
				} else

				// VALID EMAIL
				if(data == '_sent_ok_') {

					// append message and show ok alert
					jQuery("#_msg_txt_").empty().append(okSent);
					jQuery("#_sent_ok_").removeClass('hide');

					// reset form
					jQuery("#contact_name, #contact_email, #contact_subject, #contact_comment").val('');

					// disable button - message already sent!
					jQuery("#contact_submit").empty().append(contact_buttonDisabled);
					jQuery("#contact_submit").addClass('disabled');

				} else {

					// PHPMAILER ERROR
					alert(data); 

				}
			}
		});

	});
	
	




/** PHP RESERVATION FORM
*************************************************** **/
	jQuery("#reservation_submit").bind("click", function(e) {
		e.preventDefault();

		var
			// for restaurants and massage
			reservation_day 	= jQuery("#reservation_day").val(),				// required
			reservation_month 	= jQuery("#reservation_month").val(),			// required
			reservation_year 	= jQuery("#reservation_year").val(),			// required
			reservation_hour 	= jQuery("#reservation_hour").val(),			// required
			reservation_minute 	= jQuery("#reservation_minute").val(),			// required
			reservation_ampm 	= jQuery("#reservation_ampm").val(),			// required

			// For hotels [checkin|checkout]
			reservation_ckin_day 		= jQuery("#reservation_ckin_day").val(),		// required
			reservation_ckin_month 		= jQuery("#reservation_ckin_month").val(),		// required

			reservation_ckout_day 		= jQuery("#reservation_ckout_day").val(),		// required
			reservation_ckout_month 	= jQuery("#reservation_ckout_month").val(),		// required

			reservation_name 	= jQuery("#reservation_name").val(),			// required
			reservation_email 	= jQuery("#reservation_email").val(),			// required
			reservation_phone 	= jQuery("#reservation_phone").val(),			// required
			reservation_people 	= jQuery("#reservation_people").val(),			// required
			reservation_comment = jQuery("#reservation_comment").val(),
			captcha 			= jQuery("#captcha").val(),						// required TO BE EMPTY for humans

			reservation_type	= jQuery("#reservationForm").attr('data-type'),	// restaurant|hotel|massage
			_action				= jQuery("#reservationForm").attr('action'),	// form action URL
			_method				= jQuery("#reservationForm").attr('method'),	// form method
			_err				= false;										// status

		// Remove error class
		jQuery("input, textarea").removeClass('err');

		// Spam bots will see captcha field - that's how we decet spams.
		// It's very simple and not very efficient antispam method but works for bots.
		if(captcha != '') {
			return false;
		}


		// Restaurant and Massage
		if(reservation_type == 'restaurant' || reservation_type == 'massage') {

			if(reservation_day == '') {
				jQuery("#reservation_day").addClass('err');
				var _err = true;
			}

			if(reservation_month == '') {
				jQuery("#reservation_month").addClass('err');
				var _err = true;
			}

			if(reservation_year == '') {
				jQuery("#reservation_year").addClass('err');
				var _err = true;
			}

			if(reservation_hour == '') {
				jQuery("#reservation_hour").addClass('err');
				var _err = true;
			}

			if(reservation_minute == '') {
				jQuery("#reservation_minute").addClass('err');
				var _err = true;
			}

			if(reservation_ampm == '') {
				jQuery("#reservation_ampm").addClass('err');
				var _err = true;
			}

		}

		// Hotel
		if(reservation_type == 'hotel') {

			if(reservation_ckin_day == '') {
				jQuery("#reservation_ckin_day").addClass('err');
				var _err = true;
			}

			if(reservation_ckin_month == '') {
				jQuery("#reservation_ckin_month").addClass('err');
				var _err = true;
			}

			if(reservation_ckout_day == '') {
				jQuery("#reservation_ckout_day").addClass('err');
				var _err = true;
			}

			if(reservation_ckout_month == '') {
				jQuery("#reservation_ckout_month").addClass('err');
				var _err = true;
			}

		}

		// --

		if(reservation_name == '') {
			jQuery("#reservation_name").addClass('err');
			var _err = true;
		}

		if(reservation_email == '') {
			jQuery("#reservation_email").addClass('err');
			var _err = true;
		}

		if(reservation_phone == '') {
			jQuery("#reservation_phone").addClass('err');
			var _err = true;
		}		

		if(reservation_people == '') {
			jQuery("#reservation_people").addClass('err');
			var _err = true;
		}

		if(reservation_comment == '') {
			jQuery("#reservation_comment").addClass('err');
			var _err = true;
		}

		// --

		// Stop here, we have empty fields!
		if(_err === true) {
			return false;
		}


		// SEND MAIL VIA AJAX
		jQuery.ajax({
			url: 	_action,
			data: 	{	ajax:"true", 
						action:'reservation',
						reservation_type:reservation_type,

						// Restaurant and Massage
						reservation_day:reservation_day,
						reservation_month:reservation_month,
						reservation_year:reservation_year,
						reservation_hour:reservation_hour,
						reservation_minute:reservation_minute,
						reservation_ampm:reservation_ampm,

						// Hotel
						reservation_ckin_day:reservation_ckin_day,
						reservation_ckin_month:reservation_ckin_month,
						reservation_ckout_day:reservation_ckout_day,
						reservation_ckout_month:reservation_ckout_month,

						// Reservation Details [Restaurant|Massage|Hotel]
						reservation_name:reservation_name,
						reservation_email:reservation_email,
						reservation_phone:reservation_phone,
						reservation_people:reservation_people,
						reservation_comment:reservation_comment
					},
			type: 	_method,
			error: 	function(XMLHttpRequest, textStatus, errorThrown) {

				alert('Server Internal Error'); // usualy on headers 404

			},

			success: function(data) {
				data = data.trim(); // remove output spaces


				// PHP RETURN: Mandatory Fields
				if(data == '_required_') {
					alert(errMsg);
				} else

				// PHP RETURN: INVALID EMAIL
				if(data == '_invalid_email_') {
					alert(errEmail);
				} else

				// VALID EMAIL
				if(data == '_sent_ok_') {

					// append message and show ok alert
					jQuery("#_sent_ok_").removeClass('hide');

					// reset form
					jQuery("input, textarea").val('');

					// disable button - message already sent!
					jQuery("#reservation_submit").empty().append(reservation_buttonDisabled);
					jQuery("#reservation_submit").addClass('disabled');

				} else {

					// PHPMAILER ERROR
					alert(data); 

				}
			}
		});


	});





/** MISC
*************************************************** **/
	// easing - only needed
	jQuery.extend( jQuery.easing,{
		easeInOutExpo: function (x, t, b, c, d) {
			if (t==0) return b;
			if (t==d) return b+c;
			if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
			return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
		},
	});




		jQuery('#full-slider').maximage({

			cycleOptions: {
				slideActiveClass: 'activeSlide',
				skipInitializationCallbacks: true,
				after: function(currSlideElement, nextSlideElement) {
					jQuery(currSlideElement).removeClass('current-slide');
				},
				before: function(currSlideElement, nextSlideElement, options, forwardFlag) {
					jQuery(nextSlideElement).addClass('current-slide');
					jQuery(jQuery(currSlideElement).data('href')).removeClass('current-slide-content');
					jQuery(jQuery(nextSlideElement).data('href')).addClass('current-slide-content');
				},
			},

			onFirstImageLoaded: function() {
				jQuery('#cycle-loader').hide();
				jQuery('#full-slider .mc-image:first-child').addClass('current-slide');
				jQuery('#full-slider').animate({"opacity":"1"}, 1500, function() {});
			}

		});