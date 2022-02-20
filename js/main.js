(function($){
	"use strict";

	var window_width 		 = $(window).width(),
		window_height 		 = window.innerHeight,
		header_height 		 = $(".site-header").height(),
		header_height_static = $(".site-header.static").outerHeight(),
		fitscreen 			 = window_height - header_height;

	/*----------------------------------------
		Init custom functions
	------------------------------------------*/
	animatedHeader();
	navHover3Animation();
	mobileNav();
	checkNavVisibility();
	dropdown();
	toggleCartInMobile();
	leftSideNav();
	searchPopup();
	disableWindowHeight();
	fullscreen();
	parallax();
	halfBGheight();
	magnificPopup();
	progressBar();
	pieCharts();
	charityDonationFormValidation();
	removePlaceholder();
	
	homeSlider();
	portfolioCarousel();
	productQuantityButton();
	woocommerceInfoToggle();
	scCarousels();
	dealsCountdown();
	bootstrapAccordion();
	twitterFeeds();
	twitterFeedsFooter();
	dribbbleFeeds();
	process5WidthHeight();
	MiscSliderCarousel();
	productCarousel();
	eventCarousel();
	imageGallery1();
	testimonialCarousel();
	teamCarousel();
	dishCarouselImgHeight();
	multipleHoverEffect();
	PortfolioToggle();
	stickySidebar();
	featureOne();
	animationBlockTextHeight();
	productRadioButton();
	goToTop();
	bottomBadgeShape();
	checkIsLibRequired();

	/*----------------------------------------------
	    Window Load function 
	------------------------------------------------*/
	$(window).on("load", function() {
		tab4ImgHeight();
		isotopeAjaxDetails();
		parallax();
		$(".counter").appear(function() {
			counter();
		});
		isotopeMasonry();
	});

	/*----------------------------------------------
	    Window Resize function 
	------------------------------------------------*/
	$(window).on("resize", function() {
		fullscreen();
		checkNavVisibility();
		dishCarouselImgHeight();
		bottomBadgeShape();
		process5WidthHeight();
		halfBGheight();
		stickySidebar();
		animationBlockTextHeight();
	});

	$(".is-in-viewport").appear(function(){
		$(".template-layer").addClass("active");
	});

	$(".quantity-field .add").on("click", function () {
	    $(this).prev().val(+$(this).prev().val() + 1);
	    return false;
	});
	$(".quantity-field .sub").on("click", function () {
	    if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
	    return false;
	});

	/*----------------------------------------
		Initiating Select box
	------------------------------------------*/
	$(".nice-select").niceSelect();
	$(".ml-select").material_select();

	/*----------------------------------------
		Init jQuery Sticky
	------------------------------------------*/
	$(".site-header.sticky, .sticky-js").sticky({
		topOffset: 0
	});

	/*----------------------------------------
		Background Video
	------------------------------------------*/
	$(".background-video").YTPlayer();

	//material date picker
	$(".datepicker").pickadate({
	  	selectMonths: true, // Creates a dropdown to control month
	  	selectYears: 15 // Creates a dropdown of 15 years to control year
	});

	// nice scroll
	$(".custom-scrollbar").niceScroll({
		autohidemode: false,
		cursorborder: 0,
		cursorborderradius: 0
	});

	// initiating date time picker
	$(".date-time-picker").datetimepicker({
		format: 'DD/MM/YYYY',
		icons: {
		    time: "fa fa-clock-o",
		    date: "fa fa-calendar",
		    up: "fa fa-arrow-up",
		    previous: "fa fa-long-arrow-left",
		    next: "fa fa-long-arrow-right",
		    down: "fa fa-arrow-down"
		}
	});
	$(".datepicker-no-icon").datetimepicker({
		format: 'DD/MM/YYYY',
		icons: {
		    time: "fa fa-clock-o",
		    date: "fa fa-calendar",
		    up: "fa fa-arrow-up",
		    previous: "fa fa-long-arrow-left",
		    next: "fa fa-long-arrow-right",
		    down: "fa fa-arrow-down"
		}
	});
	$(".datetime-picker").datetimepicker({
		icons : {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-angle-up',
			down: 'fa fa-angle-down',
			previous: 'fa fa-angle-left',
			next: 'fa fa-angle-right',
			today: 'fa fa-glyphicon-screenshot',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		}
	});
	$(".datetimepicker-time").datetimepicker({
		format: 'LT',
		icons : {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-angle-up',
			down: 'fa fa-angle-down',
			previous: 'fa fa-angle-left',
			next: 'fa fa-angle-right',
			today: 'fa fa-glyphicon-screenshot',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		}
	});

	// WoW js
	var wow = new WOW ({
	    boxClass:     "wow",      // animated element css class (default is wow)
	    animateClass: "animated", // animation css class (default is animated)
	    mobile:       false,       // trigger animations on mobile devices (default is true)
	});
	wow.init();

	/*----------------------------------------
		Toggle footer widget
	------------------------------------------*/
	$(".widget-toggle-btn").on("click", function() {
		$(this).toggleClass("active").next(".toggle-widget").slideToggle();
		return false;
	});
	
	//section-title
	$(".toggle-section-btn").on("click", function() {
		$(this).toggleClass("active").closest(".section-title").next(".toggle-section").slideToggle();
		return false;
	});

	/*----------------------------------------------
	    Custom Fucntions
	------------------------------------------------*/
	/*----------------------------------------
		Animated Header
	------------------------------------------*/
	function animatedHeader () {
		$(window).on("scroll", function() {
			if ($(window).scrollTop() >= header_height ) {
				$(".site-header").addClass("is-sticky");
			} else {
				$(".site-header").removeClass("is-sticky");
			}
		});
	}
	function navHover3Animation() {
		$(".nav-hover-3 > li > a").each(function() {
			$(this).on("mouseover", function() {
				$(this).removeClass("mouseout");
			}).on("mouseleave", function() {
				$(this).addClass("mouseout");
			});
		});
	}
	/*----------------------------------------
		Mobile Nav Toggle
	------------------------------------------*/
	function mobileNav() {
		$(".nav-hamburger").on("click", function() {
			if ( window_width <= 1024 ) {
				$(this).toggleClass("active");
				$(".primary-nav").slideToggle({
					duration: 700,
					easing: "easeInOutQuint"
				});
			}
			return false;
		});
	}
	function checkNavVisibility() {
		if ( window_width >= 1024 ) {
			var nav = $(".primary-nav");
			if ( !nav.is(":visible")) {
				nav.removeAttr('style');
			}
		}
	}
	/*----------------------------------------
		dropdown menu arrow
	------------------------------------------*/
	function dropdown() {
		// dropdows arrow
		$(".sub-menu > li > a").each(function() {
			if ( $(this).next().is("ul") ) {
				$(this).append('<span class="arrow"><i class="fa fa-angle-right"></i></span>');
			}
		});
		$(".menu-list li a, .nav-content li a").on("click", function() {
			if ( $(this).next().is("ul") ) {
				$(this).next().slideToggle();
			}
		});

		// dropdows menu
		$(".has-dropdown .click").each(function() {
			var $this = $(this);
			$this.on("click", function() {
				if ( $this.next().is(".dropdown-holder") ) {
					$this.parent().toggleClass("active").next(".dropdown-holder").slideToggle(250);
				}
				return false;
			});
		});

		$(".nav-content > li > a").on("click", function() {
			if ( $(this).next().is("ul") ) {
				$(this).closest("li").toggleClass("active");
			}
			return false;
		});

		$(".primary-nav").closest(".container").wrapInner('<div class="primary-nav-inner relative clear"></div>');
	}
	/*----------------------------------------
		toggle Cart in mobile
	------------------------------------------*/
	function toggleCartInMobile() {
		if ( window_width < 768 ) {
			$(".top-cart").on("click", function() {
				$(this).toggleClass("active");
				return false;
			});
		}
	}
	/*----------------------------------------
		Left side nav
	------------------------------------------*/
	function leftSideNav() {
		$(".toggle-side-nav").each(function() {

			if ( window_width > 1366 ) {
				$(this).addClass("active").closest(".side-nav-wrap").addClass("opened");
			}

			$(this).on("click", function() {
				$(this).toggleClass("active");
				return false;
			});

			$(this).on("click", function() {
				if ( window_width > 1366 ) {
					$(".left-side-nav").toggleClass("closed");
					$(this).closest(".side-nav-wrap").toggleClass("opened");
				} else {
					$(this).closest(".side-nav-wrap").toggleClass("opened");
				}
				return false;
			});

		});
		$(".sidenav-overlay").on("click", function() {
			$(".side-nav-wrap").removeClass("opened");
			$(".toggle-side-nav").removeClass("active");
			return false;
		});
		$(document).keyup(function(e) {
		    if (e.keyCode === 27) { // escape key maps to keycode `27`
		        $(".side-nav-wrap").removeClass("opened");
		        $(".toggle-side-nav").removeClass("active");
		    }
		});
	}
	/*----------------------------------------
		Popup search
	------------------------------------------*/
	function searchPopup() {
		var search_input = ".search-wrapper #search";

		$(".top-search .top-search-trigger").on("click", function() {
			$(".top-search, .search-wrapper").addClass("active");
			setTimeout(function(){
				$(search_input).focus();
			}, 200);
			return false;
		});
		$(".search-wrapper .close-search").on("click", function() {
			$(".top-search").removeClass("active");
			$(".search-wrapper").removeClass("active");
			return false;
		});
		$("body").on("focusout", search_input, function() {
			var input_length = $(search_input).val().length;
			if ( input_length === 0	) {
				$(this).next().removeClass("active");				
			}
		})
		$(document).keyup(function(e) {
		    if ( e.keyCode === 27 ) { // escape key maps to keycode `27`
		        $(".top-search, .search-wrapper").removeClass("active");
		        $(search_input).val("");
		    }
		});
	}
	/*----------------------------------------
		disableWindowHeight
	------------------------------------------*/
	function disableWindowHeight() {
		if ( window_width < 768 ) {
			$(".remove-fullscreen-xs").removeClass("fullscreen fitscreen")
		}
	}
	/*----------------------------------------
		fullscreen
	------------------------------------------*/
	function fullscreen() {
		var window_height 		 = window.innerHeight,
			header_height 		 = $(".site-header").height(),
			header_height_static = $(".site-header.static").outerHeight(),
			fitscreen 			 = window_height - header_height;

		$(".fullscreen").css("height", window_height);
		$(".fitscreen").css("height", fitscreen);
	}
	/*----------------------------------------
		Parallax
	------------------------------------------*/
	function parallax() {
		$(".parallax1").parallax("50%", 0.5);
		$(".parallax2").parallax("50%", 0.5);
		$(".parallax3").parallax("50%", 0.5);
		$(".parallax4").parallax("50%", 0.5);
		$(".parallax5").parallax("50%", 0.5);
		$(".parallax6").parallax("50%", 0.5);
		$(".parallax8").parallax("50%", 0.5);
	}
	/*----------------------------------------
		Half BG Height
	------------------------------------------*/
	function halfBGheight() {
		$(".half-bg").each(function() {
			if ( window_width < 768 ) {
				var first_height = $(this).find(".container").find(".first-child").outerHeight(true)+90;
				$(this).children(".half-bg-container").css("height", first_height);
			}
		});
	}
	/*----------------------------------------
		Magnific Popup Ajax
	------------------------------------------*/
	function magnificPopup() {
		$(".image-popup").magnificPopup({
		  	type: "image",
		  	removalDelay: 500,
		  	closeOnContentClick: true,
		  	midClick: true,
		  	image: {
		  	  	cursor: null
		  	},
		  	callbacks: {
		  	  	beforeOpen: function() {
		  	    // just a hack that adds mfp-anim class to markup 
		  	     	this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
		  	     	this.st.mainClass = this.st.el.attr('data-effect');
		  	  	}
		  	}
		});
		$(".image-popup-dark-overlay").magnificPopup({
		  	type: "image",
		  	removalDelay: 500,
		  	closeOnContentClick: true,
		  	midClick: true,
		  	mainClass: "dark",
		  	image: {
		  	  	cursor: null
		  	}
		});
		$(".image-gallery-popup").magnificPopup({
		  	type: "image",
		  	removalDelay: 500,
		  	closeOnContentClick: true,
		  	midClick: true,
		  	image: {
		  	  	cursor: null,
		  	  	titleSrc: "title"
		  	},
		  	gallery: {
		  	  	enabled: true
		  	},
		  	callbacks: {
		  	  	beforeOpen: function() {
		  	    // just a hack that adds mfp-anim class to markup 
		  	     	this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
		  	     	this.st.mainClass = this.st.el.attr('data-effect');
		  	  	}
		  	}
		});
		$(".video-gallery-dark-overlay").magnificPopup({
		  	type: "iframe",
		  	removalDelay: 500,
		  	closeOnContentClick: true,
		  	midClick: true,
		  	mainClass: "dark",
		  	gallery: {
		  	  	enabled: true
		  	}
		});
		$(".image-gallery-dark-overlay").magnificPopup({
		  	type: "image",
		  	removalDelay: 500,
		  	closeOnContentClick: true,
		  	midClick: true,
		  	mainClass: "dark",
		  	image: {
		  	  	cursor: null,
		  	  	titleSrc: "title"
		  	},
		  	gallery: {
		  	  	enabled: true
		  	}
		});
		$(".ajax-popup").magnificPopup({
		  	type: "ajax",
		  	ajax: {
		  	  	cursor: null
		  	}
		});
		$(".ajax-portfolio-popup").magnificPopup({
		  	type: "ajax",
		  	ajax: {
		  	  	cursor: null
		  	},
		  	mainClass: "dark"
		});
		$(".single-team-ajax").magnificPopup({
		  	type: "ajax",
		  	ajax: {
		  	  	cursor: null
		  	},
		  	callbacks: {
		  	  	ajaxContentAdded: function() {
		  	   		progressBar();
		  	   		$(".single-team-ajax").magnificPopup({
		  	   		  	type: "ajax",
		  	   		  	ajax: {
		  	   		  	  	cursor: null
		  	   		  	},
		  	   		  	callbacks: {
		  	   		  	  	ajaxContentAdded: function() {
		  	   		  	   		progressBar();
		  	   		  	  	}
		  	   		  	}
		  	   		})
		  	  	}
		  	}
		});
		$(document).on("click", ".close-mfp", function() {
			$.magnificPopup.close();
			return false;
		});
	}
	/*----------------------------------------
		Progress Bar
	------------------------------------------*/
	function progressBar() {
		$(".progress").each(function() {
		  	var barValue = $(this).children(".progress-bar").attr("aria-valuenow") + "%";
		  	$(this).children().animate({ width: barValue }, { duration: 700, easing: "easeOutCirc" });
		  	$(this).find(".value").text(barValue);
		});
	}
	/*----------------------------------------
		Pie Charts
	------------------------------------------*/
	function pieCharts() {
		var picharSelcetor = $(".chart-item");
		picharSelcetor.appear(function () {
		    picharSelcetor.easyPieChart({
		        easing: "easeOutBounce",
		        trackColor: null,
		        barColor: "#b71c0c",
		        lineCap: "butt",
		        size: "190",
		        scaleColor: false,
		        lineWidth: 5,
		        animate: 2000,
		        onStep: function (from, to, percent) {
		            $(this.el).find(".percent").text(Math.round(percent));
		        }
		    });
		});
	}
	/*----------------------------------------
		Slider And Carousel
	------------------------------------------*/
	/*-------	Slider 1 --------------------*/
	function homeSlider() {
		$(".slider1").owlCarousel({
			items: 1,
			loop: true,
			nav: true,
			mouseDrag: false,
			smartSpeed: 700,
			animateOut: 'fadeOut',
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			onInitialized: function() {
				$(".slider1 .owl-prev, .slider1 .owl-next").addClass("btn-floating btn-large waves-effect btn-white");
			}
		});
	/*-------	Slider 2 --------------------*/
		$(".slider2").owlCarousel({
			items: 1,
			loop: true,
			nav: true,
			mouseDrag: false,
			smartSpeed: 700,
			animateOut: 'fadeOut',
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			onInitialized: function() {
				$(".slider2 .owl-prev, .slider2 .owl-next").addClass("btn-floating btn-large waves-effect btn-white");
			}
		});
	/*-------	Slider 3  --------------------*/
		$(".slider3").owlCarousel({
			items: 1,
			loop: true,
			nav: true,
			mouseDrag: false,
			smartSpeed: 700,
			animateOut: 'fadeOut',
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			onInitialized: function () {
				$(".slider3 .owl-prev, .slider3 .owl-next").addClass("btn-floating btn-large waves-effect btn-white");
			}
		});
	/*-------	Slider 4  --------------------*/
		$(".slider4").owlCarousel({
			items: 1,
			loop: true,
			nav: true,
			mouseDrag: false,
			smartSpeed: 700,
			animateOut: 'fadeOut',
			// move navContainer outside the primary owl wrapper
		    navContainer: '#customNav',
		    // move dotsContainer outside the primary owl wrapper
		    dotsContainer: '#customDots',
			navText: ['<i class="material-icons">keyboard_arrow_left</i>', '<i class="material-icons">keyboard_arrow_right</i>']
		});
		/*-------	Slider 5  --------------------*/
		$(".slider5").owlCarousel({
			items: 1,
			loop: true,
			nav: true,
			mouseDrag: false,
			smartSpeed: 700,
			animateOut: 'fadeOut',
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			onInitialized: function () {
				$(".slider5 .owl-prev, .slider5 .owl-next").addClass("btn-floating btn-large waves-effect btn-white");
			}
		});
		/*-------	magazine slider1 / home-magazine.php  --------------------*/
		$(".mag-slider-1").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			animateOut: 'fadeOut'
		});
		/*-------	magazine slider2 / home-magazine.php  --------------------*/
		$(".post-grid-slider").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			dots: false,
			smartSpeed: 700
		});
		// Custom Navigation Events
		$(".gpc-control .prev-arrow").on("click", function(){
		  	$(".post-grid-slider").trigger("prev.owl.carousel");
		  	return false;
		});
		$(".gpc-control .next-arrow").on("click", function(){
		  	$(".post-grid-slider").trigger("next.owl.carousel");
		  	return false;
		});

		/*-------	magazine slider2 / home-magazine.php  --------------------*/
		$(".latest-article-carousel").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 700
		});

		/*-------	popular-news-carousel / home-magazine.php  --------------------*/
		$(".popular-news-carousel").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			dots: false,
			margin: 30,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				1280: {
					items: 3
				}
			}
		});
		// Custom Navigation Events
		$(".pnc-custom-control .owl-prev").on("click", function(){
		  	$(".popular-news-carousel").trigger("prev.owl.carousel");
		  	return false;
		});
		$(".pnc-custom-control .owl-next").on("click", function(){
		  	$(".popular-news-carousel").trigger("next.owl.carousel");
		  	return false;
		});
		/*-------	mag-review-post-carousel / home-magazine.php  --------------------*/
		$(".mag-review-post-carousel").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			dots: false,
			nav: true,
			margin: 30,
			navText: ['<i class="material-icons icon-share">trending_flat</i>','<i class="material-icons">trending_flat</i>'],
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				}
			}
		});
		/*-------  dish carousel  --------------------*/
		$(".dish-carousel").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
		});
		/*-------  home-interior  --------------------*/
		$(".interior-slider-wrap").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			dots: false,
			nav: true,
			smartSpeed: 700,
			navText: ['<span class="icon"><i class="material-icons icon-share">trending_flat</i></span><span class="text">Prev</span>','<span class="text">Next</span><span class="icon"><i class="material-icons">trending_flat</i></span>'],
		});
		/*-------  home-shop  --------------------*/
		$(".single-product-gallery").owlCarousel({
			items: 1,
			loop: true,
			autoplay: true,
			mouseDrag: false,
			smartSpeed: 700
		});
		/*-------  home-shop  --------------------*/
		$(".shop-slider-1").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 700
		});
		/*-------  home-shop  --------------------*/
		$(".shop-slider-2").owlCarousel({
			items: 1,
			loop: true,
			autoHeight: true,
			mouseDrag: false,
			smartSpeed: 700
		});
		/*-------  shop-3  --------------------*/
		$(".shop-slider-3").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 700
		});
		/*-------  home-shop  --------------------*/
		$(".shop2-img-loop").owlCarousel({
			items: 1,
			loop: true,
			autoplay: true,
			autoplayTimeout: 2500,
			mouseDrag: false,
			smartSpeed: 700,
			dots: false,
			animateOut: 'fadeOut'
		});
		/*-------  shop-3-cat slider  --------------------*/
		$(".shop3-cat-slider").owlCarousel({
			items: 1,
			loop: true,
			//autoplay: true,
			smartSpeed: 700,
		});

	}
	/*------- shop product countdown --------------------*/
	function dealsCountdown() {
		$(".deals-countdown-clock").countdown('2017/08/29', function(event) {
		  var $this = $(this).html(event.strftime(''
		    + '<div class="time-block"><span class="time">%D</span> <span class="label">Days</span></div>'
		    + '<div class="time-block"><span class="time">%H</span> <span class="label">Hours</span></div>'
		    + '<div class="time-block"><span class="time">%M</span> <span class="label">Mins</span></div>'
		    + '<div class="time-block"><span class="time">%S</span> <span class="label">Secs</span></div>'));
		});
		$(".product-countdown").countdown('2017/08/29', function(event) {
		  var $this = $(this).html(event.strftime(''
		    + '<div class="time-slot"><span class="time">%D :&nbsp;</span></div>'
		    + '<div class="time-slot"><span class="time">%H :&nbsp;</span></div>'
		    + '<div class="time-slot"><span class="time">%M :&nbsp;</span></div>'
		    + '<div class="time-slot"><span class="time">%S</span></div>'));
		});
		// $(".product-countdown").countdown('stop');
	}
	/*----------------------------------------
		product Quantity
	------------------------------------------*/
	function productQuantityButton() {
		$(".quantity-field .add").on("click", function (e) {
			var $that = $(this);
			$(".quantity-field button").removeClass("active");
			$that.addClass("active");
		    $that.next().val(+$that.next().val() + 1);
		    return false;
		});
		$(".quantity-field .sub").on("click", function (e) {
			var $that = $(this);
			$(".quantity-field button").removeClass("active");
			$that.addClass("active");
		    if ( $that.prev().val() > 1) $that.prev().val(+$that.prev().val() - 1 );
		    return false;
		});
	}
	/*----------------------------------------
		Woocommerce shipping info toggle
	------------------------------------------*/
	function woocommerceInfoToggle(){
		$(".woocommerce-info").each(function() {
			$(this).find(".woocommerce-info-toggle").on("click", function() {
				$(this).next("form").slideToggle();
				return false;
			});
		});

		$(".create-account label").on("click", function() {
			$(this).closest(".create-account").next(".password-field").slideToggle();
			return false;
		});

		$(".diff_shipping_address").on("click", function() {
			$(this).closest(".custom-checkbox").next(".diff-shipping-address").slideToggle();
			return false;
		});

		$(".wc_payment_method .custom-radio label").each(function() {
			$(this).on("click", function() {
				$(".wc_payment_method .payment_box").slideUp();
				$(this).closest(".custom-radio").next(".payment_box").slideDown();
				return false;
			});
		});
	}
	/*-------	Portfolio Carousel --------------------*/
	function portfolioCarousel() {
		$(".portfolio-carousel").owlCarousel({
			loop: true,
			nav: true,
			center: true,
			autoplay: true,
			mouseDrag: false,
			margin: 30,
			smartSpeed: 700,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 3
				},
				1265: {
					items: 4
				}
			},
			onInitialized: function() {
				$(".portfolio-carousel .owl-prev, .portfolio-carousel .owl-next").addClass("btn-floating btn-large waves-effect btn-white");
			}
		});

        $(".pf-slider-1col").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<a href="#" class="btn-large waves-effect btn-floating slick-prev"><i class="fa fa-long-arrow-left"></i></a>',
            nextArrow: '<a href="#" class="btn-large waves-effect btn-floating slick-next"><i class="fa fa-long-arrow-right"></i></a>',
        });

        $(".pf-carousel-3col-details").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: ".pf-carousel-3col"
        });
        $(".pf-carousel-3col").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            centerPadding: 0,
            asNavFor: ".pf-carousel-3col-details",
            arrows: true,
            centerMode: true,
            focusOnSelect: true,
            prevArrow: '<a href="#" class="btn-large waves-effect btn-floating slick-prev"><i class="fa fa-long-arrow-left"></i></a>',
            nextArrow: '<a href="#" class="btn-large waves-effect btn-floating slick-next"><i class="fa fa-long-arrow-right"></i></a>',
            responsive: [{
                breakpoint: 769,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });
	}
	/*-------	Team Carousel --------------------*/
	function teamCarousel() {
		$(".team-carousel-1").owlCarousel({
			loop: true,
			items: 2,
			mouseDrag: false,
			smartSpeed: 700,
			margin: 30,
			autoplay: true,
			autoplayHoverPause: true,
			responsive: {
				0: {
					items: 1
				},
				960: {
					items: 2
				}
			},
		});
		$(".team-carousel-2").owlCarousel({
			loop: true,
			items: 1,
			mouseDrag: false,
			smartSpeed: 700,
			margin: 30,
			autoplay: true,
			autoplayHoverPause: true
		});
	}
	/*-------	Testimonial Carousel --------------------*/
	function testimonialCarousel() {
		$(".tm-carousel-1").owlCarousel({
			loop: true,
			items: 1,
			mouseDrag: false,
			smartSpeed: 700,
			autoplay: true,
			autoplayHoverPause: true,
			animateOut: 'fadeOut',
			onInitialized: function() {
				$(".tm-carousel-1 .owl-prev, .tm-carousel-1 .owl-next").addClass("btn-floating btn-large waves-effect btn-white");
			}
		});
		$(".tm-carousel-2").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			autoplay: true,
			autoplayHoverPause: true,
			margin: 30,
			nav: true,
			dots: false,
			navText: ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				1025: {
					items: 3
				}
			},
			onInitialized: function() {
				$(".tm-carousel-2 .owl-prev, .tm-carousel-2 .owl-next").addClass("waves-effect");
			}
		});
		$(".tm-carousel-3").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			autoplay: true,
			autoplayHoverPause: true,
			navText: ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
			items: 1,
			onInitialized: function() {
				$(".tm-carousel-3 .owl-prev, .tm-carousel-3 .owl-next").addClass("waves-effect");
			}
		});
		$(".tm-carousel-4").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			autoplay: true,
			autoplayHoverPause: true,
			margin: 30,
			nav: true,
			dots: false,
			navText: ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				}
			},
			onInitialized: function() {
				$(".tm-carousel-4 .owl-prev, .tm-carousel-4 .owl-next").addClass("waves-effect");
			}
		});
		$(".tm-carousel-5").owlCarousel({
			loop: true,
			smartSpeed: 700,
			nav: true,
			dots: false,
			items: 1,
			autoplay: true,
			autoplayHoverPause: true,
			// animateOut: 'slideOutUp',
			// animateIn: 'slideInUp',
			navText: ['<i class="fa fa-long-arrow-left"></i>','<i class="fa fa-long-arrow-right"></i>'],
			onInitialized: function() {
				$(".tm-carousel-5 .owl-prev, .tm-carousel-5 .owl-next").addClass("waves-effect");
			}
		});
		$(".tm-carousel-6").owlCarousel({
			loop: true,
			items: 1,
			mouseDrag: false,
			smartSpeed: 700,
			//autoplay: true,
			nav: true,
			autoplayHoverPause: true,
			navText: ['<i class="material-icons">navigate_before</i>', '<i class="material-icons">navigate_next</i>'],
			onInitialized: function() {
				$(".tm-carousel-6 .owl-prev, .tm-carousel-6 .owl-next").addClass("btn-floating btn-large waves-effect btn-white");
			}
		});
		$(".tm-carousel-7").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			autoplay: true,
			autoplayHoverPause: true,
			margin: 8,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				1025: {
					items: 3
				}
			}
		});
		$(".tm-carousel-8").slick({
			vertical: true,
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
			centerMode: true,
			responsive: [
			  {
			    breakpoint: 1023,
			    settings: {
			      	vertical: false,
			      	slidesToShow: 1,
			      	slidesToScroll: 1
			    }
			  }
			]
		});
		$(".tm-carousel-9").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			autoplay: true,
			autoplayHoverPause: true,
			margin: 30,
			responsive: {
			    0: {
			        items: 1
			    },
		        768: {
		            items: 2
		        }
			}
		});
		$(".tm-carousel-10").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			autoplay: true,
			autoplayHoverPause: true,
			margin: 18,
			center: true,
			responsive: {
			    0: {
			        items: 1
			    },
		        768: {
		            items: 2
		        },
		        1024: {
		            items: 3
		        }
			}
		});
		$(".tm-carousel-11").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			autoplay: true,
			autoplayHoverPause: true,
			margin: 18,
			items: 1
		});
		$(".tm-carousel-12").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			autoplay: true,
			autoplayHoverPause: true,
			margin: 18,
			items: 1
		});
		$(".tm-carousel-13").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 700,
			autoplay: true,
			autoplayHoverPause: true,
			autoplayTimeout: 1200,
			responsive: {
		        0: {
		            items: 1
		        },
		        1024: {
		            items: 1
		        },
		        1280: {
		            items: 2
		        }
			}
		});
		$(".about-me-carousel").owlCarousel({
			loop: true,
			items: 2,
			mouseDrag: false,
			smartSpeed: 700,
			margin: 100,
			autoplay: true,
			autoplayHoverPause: true,
			responsive: {
				0: {
					items: 1
				},
				960: {
					items: 2
				}
			},
		});
		$(".food-carousel").slick({
			centerPadding: 0,
			infinite: true,
			speed: 1000,
			arrows: false,
			autoplay: true,
			dots: false,
			slidesToShow: 5,
			slidesToScroll: 4,
			centerMode: true,
			asNavFor: '.food-nav',
			responsive: [
			  {
			    breakpoint: 960,
			    settings: {
			      slidesToShow: 3,
			      slidesToScroll: 3
			    }
			  }
			]
		});

		$('.food-nav').slick({
		  	slidesToShow: 1,
		  	slidesToScroll: 1,
		  	autoplay: true,
		  	arrows: false,
		  	dots: true,
		  	fade: true,
		  	asNavFor: '.food-carousel'
		});

		$(".dish--carousel-1").slick({
			centerPadding: 0,
			infinite: true,
			speed: 1000,
			dots: false,
			slidesToShow: 3,
			slidesToScroll: 3,
			centerMode: true,
			focusOnSelect: true,
			asNavFor: ".dish--content-1",
			prevArrow: '<button class="slick-arrow slick-prev"><i class="fa fa-angle-left"></i></button>',
			nextArrow: '<button class="slick-arrow slick-next"><i class="fa fa-angle-right"></i></button>',
			responsive: [
			  {
			    breakpoint: 600,
			    settings: {
			      slidesToShow: 1,
			      slidesToScroll: 1
			    }
			  }
			]
		});
		 $(".dish--content-1").slick({
		  	slidesToShow: 1,
		  	slidesToScroll: 1,
		  	arrows: false,
		  	fade: true,
		  	asNavFor: ".dish--carousel-1"
		});
		$(".dish--carousel-2").slick({
			centerPadding: 0,
			infinite: true,
			speed: 1000,
			dots: false,
			slidesToShow: 3,
			slidesToScroll: 3,
			centerMode: true,
			focusOnSelect: true,
			asNavFor: ".dish--content-2",
			prevArrow: '<button class="slick-arrow slick-prev"><i class="fa fa-angle-left"></i></button>',
			nextArrow: '<button class="slick-arrow slick-next"><i class="fa fa-angle-right"></i></button>',
			responsive: [
			  {
			    breakpoint: 600,
			    settings: {
			      slidesToShow: 1,
			      slidesToScroll: 1
			    }
			  }
			]
		});
		 $(".dish--content-2").slick({
		  	slidesToShow: 1,
		  	slidesToScroll: 1,
		  	arrows: false,
		  	fade: true,
		  	asNavFor: ".dish--carousel-2"
		});
		$(".dish--carousel-3").slick({
			centerPadding: 0,
			infinite: true,
			speed: 1000,
			dots: false,
			slidesToShow: 3,
			slidesToScroll: 3,
			centerMode: true,
			focusOnSelect: true,
			asNavFor: ".dish--content-3",
			prevArrow: '<button class="slick-arrow slick-prev"><i class="fa fa-angle-left"></i></button>',
			nextArrow: '<button class="slick-arrow slick-next"><i class="fa fa-angle-right"></i></button>',
			responsive: [
			  {
			    breakpoint: 600,
			    settings: {
			      slidesToShow: 1,
			      slidesToScroll: 1
			    }
			  }
			]
		});
		 $(".dish--content-3").slick({
		  	slidesToShow: 1,
		  	slidesToScroll: 1,
		  	arrows: false,
		  	fade: true,
		  	asNavFor: ".dish--carousel-3"
		});
	}
	/*-------	Product Carousel --------------------*/
	function productCarousel() {
		$(".product-carousel-1").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 1000,
			//autoplay: true,
			margin: 30,
			nav: true,
			navText: ["", ""],
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				1265: {
					items: 3
				}
			},
		});
	}
	/*-------	Portfolio Carousel --------------------*/
	function scCarousels() {
		$(".sc-carousel-4-col").owlCarousel({
			loop: true,
			nav: true,
			autoplay: true,
			smartSpeed: 700,
			navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>'],
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				1024: {
					items: 3
				},
				1265: {
					items: 4
				}
			},
			onInitialized: function() {
				$(".sc-carousel-4-col .owl-prev, .sc-carousel-4-col .owl-next").addClass("btn-floating btn-large waves-effect");
			}
		});
		$(".sc-carousel-3-col").owlCarousel({
			loop: true,
			nav: true,
			margin: 30,
			autoplay: true,
			smartSpeed: 700,
			navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>'],
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				1024: {
					items: 3
				}
			},
			onInitialized: function() {
				$(".sc-carousel-3-col .owl-prev, .sc-carousel-3-col .owl-next").addClass("btn-floating btn-large waves-effect");
			}
		});
	}
	/*-------	Bootstrap Accordion --------------------*/
	function bootstrapAccordion() {
		$(".accordion-title").on("click", function() {
			$(this).parent(".accordion-item").toggleClass("active");
			return false;
		});

		$("[data-accordion]").on("click",function(e){
		    if( $(this).parents(".panel").children(".panel-collapse").hasClass("in") ) {
		        e.stopPropagation();
		        e.preventDefault();
		    }
		    
		    $(".panel-heading[data-accordion]").removeClass("active");
		    $(this).addClass("active");
		});

		$("[data-mt-toggle]").on("click",function(e){
		    $(this).closest(".panel").toggleClass("active");
			return false;
		});
	}
	/*-------	Twitter Feeds --------------------*/
	function twitterFeeds() {
		$(".twitter-feed-widget").twittie({
		    count: 4,
		    dateFormat: "%B %d, %Y",
		    apiPath: "libs/api/tweet.php",
		    template: "<p>{{tweet}}</p><time datetime='{{date}}'>{{date}}</time>"
		}); 
	}
	/*-------	Twitter Feeds for footer --------------------*/
	function twitterFeedsFooter() {
		$(".twitter-feed-footer").twittie({
		    count: 3,
		    dateFormat: "%B %d, %Y",
		    apiPath: "libs/api/tweet.php",
		    template: "<p>{{tweet}}</p><time datetime='{{date}}'>{{date}}</time>"
		}); 
	}
	/*-------	Instagram Feeds --------------------*/
	function instagramFeeds() {
		var feed = new Instafeed({
		    get: "user",
		    limit : 6,
		    userId: 2159114835,
		    accessToken: "2159114835.9e667eb.7a37f9b944ea4023b94541c661cbf43d",
		    template: '<li><a href="{{link}}" target="_blank"><img src="{{image}}" alt="{{caption}}"></a></li>'
		});
		feed.run();
	}
	/*-------	Process 5 width height --------------------*/
	function process5WidthHeight() {
		$(".process-5").each(function() {
			var processWidth = $(this).closest("[class^='col-']").width();
			$(this).children(".icon").css({
				width: processWidth,
				height: processWidth,
				lineHeight: processWidth+"px"
			});
		});
	}
	/*-------	Dribbble Feeds --------------------*/
	function dribbbleFeeds() {
		$.jribbble.setToken("f688ac519289f19ce5cebc1383c15ad5c02bd58205cd83c86cbb0ce09170c1b4");
		$.jribbble.users("op45").likes({
			per_page: 9
		}).then(function(likes) {
		    var html = [];

		    likes.forEach(function(like) {
		        html.push('<li class="shots-single">');
		        html.push('<a href="' + like.shot.html_url + '" target="_blank">');
		        html.push('<img alt="" src="' + like.shot.images.normal + '">');
		        html.push('</a></li>');
		    });

		    $(".dribble-shots").html(html.join(''));
		});
	}
	/*-------	MISC Slider Carousel --------------------*/
	function MiscSliderCarousel() {
		$(".misc-slider-1").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 1000,
			autoplay: true
		});
		// realestate, left half width slider
		$(".misc-slider-2").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 1000,
			autoplay: true,
			dots: false,
			nav: true,
			navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>'],
			onInitialized: function() {
				$(".misc-slider-2 .owl-prev, .misc-slider-2 .owl-next").addClass("waves-effect");
			}
		});
		// business3, text slider
		$(".misc-slider-3").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 1000,
			autoplay: true,
			onInitialized: function() {
				$(".misc-slider-3").append('<div class="bottom-badge"></div>');
			}
		});
		// App carousel / home-app
		$(".app-carousel").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 1000,
			autoplay: true,
			margin: 30,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				960: {
					items: 3
				},
				1260: {
					items: 4
				}
			}
		});
		// fruits-carousel / home-fruits
		$(".fruits-carousel").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 1000,
			autoplay: true
		});
		// widget-post-slider / blog.php
		$(".widget-post-slider").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 1000,
			autoplay: true,
			dots: false,
			nav: true,
			navText: ['<i class="material-icons">keyboard_arrow_left</i>','<i class="material-icons">keyboard_arrow_right</i>']
		});
		
		//feature carousel 
		$(".feature-carousel-1").slick({
			vertical: true,
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
			centerMode: true,
			centerPadding: 0,
			responsive: [
			  {
			    breakpoint: 767,
			    settings: {
			      	vertical: false,
			      	slidesToShow: 1,
			      	slidesToScroll: 1
			    }
			  }
			]
		});
		// sp-carousel-1, home-single-product
		$(".sp-carousel-1").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 1000,
			autoplay: true
		});
		// sp-carousel-2, home-single-product
		$(".sp-carousel-2").owlCarousel({
			items: 1,
			loop: true,
			mouseDrag: false,
			smartSpeed: 1000,
			autoplay: true,
			dots: false,
			nav: true,
			navText: ['<i class="material-icons">keyboard_arrow_left</i>','<i class="material-icons">keyboard_arrow_right</i>']
		});
		// client log carousel / index-1
		$(".envato-logos-carousel").owlCarousel({
			loop: true,
			mouseDrag: false,
			smartSpeed: 1000,
			autoplay: true,
			autoplayTimeout: 800,
			autoplayHoverPause: true,
			dots: false,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 3
				},
				1024: {
					items: 4
				},
				1280: {
					items: 5
				}
			}
		});
	}
	function bottomBadgeShape(){
		var borderWidth = $(".misc-slider-3").innerWidth() / 2,
			borderHeight =  $(".misc-slider-3 .bottom-badge").css("border-left-width"),
			calc = (26.8 / 100) * borderHeight;

		$(".misc-slider-3 .bottom-badge").css({
			"border-left-width": borderWidth,
			"border-right-width": borderWidth,
			"border-bottom-width": calc
		});
	}
	/*-------	Event Carousel --------------------*/
	function eventCarousel(){
		$(".event-carousel-1").owlCarousel({
			items: 1,
			smartSpeed: 700
		});
	}
	/*-------	dishCarouselHeight --------------------*/
	function dishCarouselImgHeight() {
		if (window_width >= 768 ) {
			$(".content--dish-wrapper").each(function() {
				var dishWrapperHeight = $(this).innerHeight();
				$(this).find(".imgs[class^='dish--content-'] .item").css("height", dishWrapperHeight-2);
			});
		}
	}
	/*-------	Tab 4 img height --------------------*/
	function tab4ImgHeight() {
		$(".tab-4").each(function() {
			var cntHeight = $(this).find(".content").innerHeight();
			$(this).find(".img").css("height", cntHeight);
		});
	}
	/*-------	Image Gallery 1 --------------------*/
	function imageGallery1() {
		$(".image-gallery-1").owlCarousel({
			items: 1,
			loop: true,
			nav: true,
			smartSpeed: 900,
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			onInitialized: function() {
				$(".image-gallery-1 .owl-prev, .image-gallery-1 .owl-next").addClass("btn-floating btn-large waves-effect btn-white");
			}
		});
	}
	/*----------------------------------------
		Portfolio Multiple hover color
	------------------------------------------*/
	function multipleHoverEffect() {
		$("[data-hover-color], [data-hover-opacity]").each(function() {
			var hoverColor = $(this).attr("data-hover-color");
			var hoverColorOpacity = $(this).attr("data-hover-opacity");
			$(this).css({
				backgroundColor: hoverColor,
				opacity: hoverColorOpacity
			});
			$(this).removeAttr("data-hover-color data-hover-opacity");
		});
	}
	/*----------------------------------------
		Portfolio Toggle
	------------------------------------------*/
	function PortfolioToggle() {
		$(document).on("click", ".portfolio-toggle", function() {
			$(this).children("i").toggleClass(" fa-angle-down");
			if ( $(this).closest(".portfolio-heading").next().hasClass("portfolio-wrapper") ) {
				$(this).closest(".portfolio-heading").next(".portfolio-wrapper").slideToggle();
			}
			return false;
		});
	}
	/*----------------------------------------
		sticky Sidebar
	------------------------------------------*/
	function stickySidebar() {
		if ( window_width > 768 ) {
			$(".portfolio-sticky-sidebar").stickr({
				offsetTop: header_height-20,
				offsetBottom: -110
			});
		}
	}
	/*----------------------------------------
		Isotope Masonry
	------------------------------------------*/
	function isotopeMasonry() {
		$(".isotope").isotope({
		    itemSelector: '[class^="col-"]',
		    layoutMode: 'fitRows',
		    masonry: {
		      	columnWidth: 1
		    }
		});
		$(".isotope-gutter").isotope({
		    itemSelector: '[class^="col-"]',
		    percentPosition: true
		});
		// in shop left sidebar
		$(".isotope-specific-cat").isotope({
		    itemSelector: '[class^="col-"]',
		    filter: ".pc_new_items",
		    percentPosition: true
		});
		$(".isotope-no-gutter").isotope({
		    itemSelector: '[class^="col-"]',
		    percentPosition: true,
		    masonry: {
		        columnWidth: 1
		    }
		});
		$(".isotope-1-col").isotope({
		    itemSelector: ".row",
		    percentPosition: true,
		    masonry: {
		        columnWidth: 1
		    }
		});
		$(".event-schedule").isotope({
		    itemSelector: ".entry-post.style5",
		    masonry: {
		        columnWidth: 1
		    }
		});

		$(".masonry-filter:not(.not-isotope):not(.tab):not(.matex-sorting):not(.ajax-details-filter) a").each(function() {
			$(this).on("click", function() {

				$(this).closest(".masonry-filter").find("a").removeClass("active");
				$(this).addClass("active");

				var selector = $(this).attr("data-filter"),
					isotope_rows = $(".isotope-gutter, .isotope-no-gutter, .isotope-1-col, .isotope-specific-cat");

				isotope_rows.isotope({
				    filter: selector,
				    animationOptions: {
				        duration: 750,
				        easing: "linear",
				        queue: false
				    }
				});

				return false;
				
			});
		});
	}

	/*----------------------------------------
		Isotope Ajax Details
	------------------------------------------*/
	function isotopeAjaxDetails() {

		var isotope_ajax_container		 = $(".isotope-ajax-container"),
	    	isotope_expander_wrapper	 = $(".expander-details-wrapper"),
	    	isotope_show_ajax_expander	 = $(".show-ajax-expander"),
	    	isotope_ajax_item 			 = ".isotope-ajax-item";

		function checkCompareId(id,data){
		    var cOptions = {
		        id: id,
		        added: false
		    }
		    if( typeof data !== "object" ) {
		        data = null;
		    }
		    return false;
		}

	    isotope_ajax_container.isotope({
	        filter: "*",
	        animationOptions: {
	            duration: 750,
	            easing: "linear",
	            queue: false
	        }
	    });


	    $(".ajax-details-filter a").on("click", function(){
	        isotope_expander_wrapper.slideUp("slow");
	        $(isotope_ajax_item).css({
	            marginBottom: 0
	        });

	        $(".ajax-details-filter .active").removeClass("active");
	        $(this).addClass("active");
	 
	        var selector = $(this).attr("data-filter");
	        isotope_ajax_container.isotope({
	            filter: selector,
	            animationOptions: {
	                duration: 750,
	                easing: "linear",
	                queue: false
	            }
	        });
	        return false;
	    });

	    isotope_show_ajax_expander.on("click",function(){
	        isotope_expander_wrapper.slideUp(0);

	        isotope_show_ajax_expander.removeClass("current_action");
	        $(this).addClass("current_action").fadeOut();
	        $(this).closest("[data-product-id]").addClass("hover");

	        var current_action_pos = $(".current_action").closest(isotope_ajax_item).offset().top;
	        
	        var data = {
	            currentPosition: current_action_pos,
	            parrentHeight: $(".current_action").closest(isotope_ajax_item).innerHeight(),
	            ajaxContentHeight: isotope_expander_wrapper.height(),
	            id: $(this).closest("data-product-id").attr("data-product-id")
	        }

	        $(isotope_ajax_item).css({
	            marginBottom: 0
	        });

	        $(".isotope-ajax-item").each(function() {
	            var thisOffset = $(this).offset().top;
	            var current_action_pos = $(".current_action").closest(isotope_ajax_item).offset().top;

	            if( thisOffset === current_action_pos ) {
	                $(this).css({
	                    marginBottom: data.ajaxContentHeight
	                })
	            }
	        });

	        var setTime = setInterval(function(){
	            $("html, body").stop().animate({
	                scrollTop: current_action_pos,
	            }, 1500, "easeInOutExpo");
	            isotope_expander_wrapper.css({
	                top: current_action_pos + data.parrentHeight,
	            }).slideDown(1000,function(){
	                checkCompareId(data.id);
	            });
	            clearInterval(setTime);
	        },500);
	        
	        // appear data product ID in compare button
	        isotope_ajax_container.isotope({"layout":"masonry"});
	        return false;
	    });

	    $(".show-details").on("click", function() {

	    	$(".expander-details-wrapper.static").slideDown();

	    	if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
	    	    var target = $(this.hash);
	    	    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	    	    if (target.length) {
	    	        $('html, body').animate({
	    	            scrollTop: target.offset().top - 120
	    	        }, 1500, "easeInOutExpo" );
	    	        return false;
	    	    }
	    	};

			return false;
	    });

	    $("body").on("click", ".expander-close", function() {

	        $("[data-product-id]").removeClass("hover");
	        isotope_expander_wrapper.slideUp("slow");
	        isotope_show_ajax_expander.fadeIn();

	        $(isotope_ajax_item).each(function(){
	        	var current_action_pos = $(".current_action").closest(isotope_ajax_item).offset().top;
	            $(this).animate({
	                marginBottom: 0
	            },"slow",function(){
	                isotope_ajax_container.isotope({"layout": "masonry"});
	                $("html, body").stop().animate({
	                    scrollTop: current_action_pos - 130
	                }, 1500, "easeInOutExpo");
	            })
	        });

			return false;
	    });
	}
	/*----------------------------------------
		product radio button
	------------------------------------------*/
	function productRadioButton() {
		$(".product-radio").each(function() {
			var $that = $(this);
			var colorCode = $that.children("label").attr("data-color-code");
			$that.css("border-color", colorCode);
			$that.children("label").css("background-color", colorCode);
		});
		// product category
		$(".product-categories li a").on("click", function() {
			var $that = $(this);
			if ( $that.next().is("ul") ) {
				$that.parent("li").toggleClass("active");
				$that.next("ul").slideToggle();
			}

			return false;
		});
	}
	/*----------------------------------------
		Feature 1
	------------------------------------------*/
	function featureOne() {
		$(".feature-1").on("mouseover", function() {
		    $(".feature-1").removeClass("active");
		    $(this).addClass("active");
		});
		$(".feature-1").on("mouseout", function() {
		    $(".feature-1").removeClass("active");
		    $(".feature-1:nth-child(2)").addClass("active")
		});
	}
	/*----------------------------------------
		Go to top
	------------------------------------------*/
	function goToTop() {
		$(window).scroll(function () {
		    if ( $(window).scrollTop() >= 100 ) {
		        $("#go-top").addClass("active");
		    } else {
		        $("#go-top").removeClass("active");
		    }
		});
		$("#go-top").on("click", function () {
		    $("html, body").stop().animate({
		        scrollTop: 0
		    }, 1500, "easeInOutExpo");
			return false;
		}); 
	}
	
	/*----------------------------------------
		Charity donation form validation
	------------------------------------------*/
	function charityDonationFormValidation() {
		// add the rule here
		$.validator.setDefaults({
		  	debug: true,
		  	success: "valid"
		});

		$(".charity-donation-form").validate({
		    rules: {
		    	charityProject: {
		    		required: true
		    	},
		        full_name: {
		            required: true
		        },
		        your_email: {
		            required: true,
		            email: true
		        },
		        donation_amount: {
		            required: true,
		            number: true
		        },
		        your_message: {
		            required: false
		        }
		    },
		    messages: {
		    	charityProject: {
		    		valueNotEquals: "Please select an item!"
		    	},
		        full_name: {
		            required: "Please enter your name"
		        },
		        your_email: {
		            required: "Please enter your email"
		        },
		        donation_amount: {
		            required: "Please write donation amount"
		        }
		    },
		    errorPlacement: function(error, element) {
		        element.after(error);
		        error.hide().slideDown();
		    }
		}); 
	}

	/*----------------------------------------
		Remove Placeholder On click
	------------------------------------------*/
	function removePlaceholder() {
	    $("input:not(.ml-input)").focusin(function(){
	        $("input:not(.ml-input)").data("holder", $(this).attr("placeholder"));
	        $(this).attr("placeholder", "");
	    });

	    $("input:not(.ml-input)").focusout(function(){
	        $(this).attr("placeholder", $(this).data("holder"));
	    });

	    $("textarea:not(.materialize-textarea)").focusin(function(){
	        $("textarea").data("holder", $(this).attr("placeholder"));
	        $(this).attr("placeholder", "");
	    });

	    $("textarea:not(.materialize-textarea)").focusout(function(){
	        $(this).attr("placeholder", $(this).data("holder"));
	    });
	}

	/*----------------------------------------
		Animation block text height
	------------------------------------------*/
    function animationBlockTextHeight() {
        if ( window_width >= 768 ) {
        	$(".animation-block").each(function() {
        		var $this = $(this);
        		var thumb_height = $this.children(".thumb").height();
        		$this.children(".col-xs-12:not(.thumb)").css("height", thumb_height);
        	});
        }
    }

	/*----------------------------------------
		Odometer Counter
	------------------------------------------*/
	function counter() {
		$(".odometer").each(function() {
			$(this).text( $(this).attr("data-to") );
		});
	}

	/*----------------------------------------
		Include map api js dynamically
	------------------------------------------*/
	function checkIsLibRequired() {

		jQuery.fn.exists = function() {
			return this.length;
		}

		if ( $("#instafeed").exists() ) {
		    document.write('<script src="js/instafeed.min.js"><\/script>');
		    instagramFeeds();
		}

		var mapIDs = $("#sc-map-1, #sc-map-2, #sc-map-3, #sc-map-4, #map-half");

		if ( mapIDs.exists() ) {

			document.write('<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXTb9aq2FYsKd03dOrqjUdCQ-vYnsN6BY"><\/script>');
			document.write('<script src="js/map-init.js"><\/script>');

		}

	}

})(jQuery);