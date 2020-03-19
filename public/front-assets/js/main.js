$(function() {
	
// Wow Js Init
//new WOW().init();

	$('.video-play-button').each(function(){

		$(document).on('click', '[video-data]', lity);	

	});

	$(".sm-nav-area .navbar-items").niceScroll({cursorcolor:"#FFD414"});

	  $('a.btn-scroll-down[href*="#"]:not([href="#"])').click(function() {
	    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	      if (target.length) {
	        $('html, body').animate({
	          scrollTop: (target.offset().top - 10)
	        }, 1000, "easeInOutQuart");
	        return false;
	      }
	    }
	  });

	Splitting({
		target: $('.eskor_slideshow_area .eskor_slideshow_content .content-area h2'),
		by: 'chars'
	});

	// Global Variable
	var controller_ScrollMagic = new ScrollMagic.Controller();


	// Window Load Function


	// Header Area
	$('.header-area').each(function(){
		// Header Area
		var NavTl = new TimelineMax({paused:true});

		NavTl
		.set($('body'), {'overflow':'hidden'})
		.to($('.sm-nav-overlay'), 0.5, {autoAlpha:1, ease: Power3.easeInOut})
		.to($('.sm-nav-area'), 0.7, {x:'0%', ease: Power3.easeInOut},'-=0.5')
		.to($('.root'), 0.5, {x:'-15px', ease: Power3.easeInOut},'-=0.5')
		.staggerFromTo($('.sm-nav-area .navbar-items .nav-item .nav-link'), 0.4, {
			x:60,
			autoAlpha:0
		},{
			x:0,
			autoAlpha:1
		}, 0.05,'-=0.3')

		NavTl.reverse();
		$('.hamburger').on('click', function() {
			 $(this).toggleClass('open-nav');
			 NavTl.reversed(!NavTl.reversed());
		});

		$('.sm-nav-area .navbar-items .nav-item .nav-link').on('click',function(){
			NavTl.reversed(!NavTl.reversed());
			$('.hamburger').removeClass('open-nav')
		})
	});


// Slide Show Init js start
$('.eskor_slideshow').each(function(){

	var Caption = [];

	$('.eskor_slideshow_content .swiper-slide').each(function(i){

			Caption.push($(this).find('.content-area').attr('data-cap'));
	});

	console.log(Caption);

	var interleaveOffset = 0.5;
	var HeroSlideImages =new Swiper('.eskor_slideshow', {
		loop: false,
		speed: 1200,
		grabCursor: true,
		watchSlidesProgress: true,
		mousewheelControl: true,
		keyboardControl: true,
		navigation: {
			nextEl: ".slideshow-control .eskor-slide-nav .next",
			prevEl: ".slideshow-control .eskor-slide-nav .prev"
		},
		pagination: {
	        el: '.slideshow-pagination',
	        clickable: true,
	        renderBullet: function (index, className) {
		        return (`<div class="pagination ${className}">
		        	<div class="pagination-line"></div>
		        </div>`);
	        }
	    },
		on: {
			progress: function() {
			  var swiper = this;
			  for (var i = 0; i < swiper.slides.length; i++) {
			    var slideProgress = swiper.slides[i].progress;
			    var innerOffset = swiper.width * interleaveOffset;
			    var innerTranslate = slideProgress * innerOffset;
			    swiper.slides[i].querySelector(".slide-bg").style.transform =
			      "translate3d(" + innerTranslate + "px, 0, 0)";
			  }      
			},
			touchStart: function() {
			  var swiper = this;
			  for (var i = 0; i < swiper.slides.length; i++) {
			    swiper.slides[i].style.transition = "";
			  }
			},
			setTransition: function(speed) {
			  var swiper = this;
			  for (var i = 0; i < swiper.slides.length; i++) {
			    swiper.slides[i].style.transition = speed + "ms";
			    swiper.slides[i].querySelector(".slide-bg").style.transition =
			      speed + "ms";
			  }
			}

		}
	});

	// Slide Content
	var HeroSlideContent = new Swiper('.eskor_slideshow_content', {
		speed: 1200,
        loop: false,
		pagination: {
	        el: '.counter-slideshow',
	        clickable: true,
	        renderBullet: function (index, className) {
		        return (`<div class="counter-area ${className}">
		        	<div class="caption-area">
						<span class="cap-info">${Caption[index]}</span>
		        	</div>
					<div class="counter">
						<span class="counter-num">0${(index + 1)}</span>
					</div>
		        </div>`);
	        }
	    }

    });

    // Slide Controller
	HeroSlideContent.controller.control = HeroSlideImages;
    HeroSlideImages.controller.control = HeroSlideContent;

	$('.eskor_slideshow_area .eskor_slideshow_content .content-area h2 .word').each(function() {
		var el = $(this).html();
		$(this).empty();
		$(this).html(` 
			<span class="w-el">${el}</span>
		`);

	});

});

	// Slide Show Init js End
	$('.parallax-box').each(function() {

		var bg = $(this).find('.parallax-bg');

		// Add tweenmax for backgroundParallax
		var parallax = TweenMax.to(bg, 1, {
			y: '50%',
			ease: Linear.easeNone
		})
		// Create scrollmagic scene
		var parallaxScene = new ScrollMagic.Scene({
			triggerElement: this, // <-- Use this to select current element
			triggerHook: 1,
			duration: '200%',
		})
		.setTween( parallax )
		.addTo(controller_ScrollMagic);	
	});

	$('.cap-box').each(function(){

		Splitting({
			target: $(this).find('.text-info h3'),
			by: 'chars'
		});

		Splitting({
			target: $(this).find('.text-info .sm-cap'),
			by: 'chars'
		});

		var capBoxHeadInfo = $(this).find('.text-info h3 .char');
		var capBoxInfo = $(this).find('.text-info .sm-cap .char');
		var capBoxBtn = $(this).find('.btn-box');
		var capBoxInfoArea = $(this).find('.cap-box-info');

		TweenMax.set(capBoxBtn, {y:20,autoAlpha:0})
		TweenMax.set(capBoxInfoArea, {y:'100%'})
		TweenMax.set(capBoxHeadInfo, {x:10,autoAlpha:0});
		TweenMax.set(capBoxInfo, {x:10,autoAlpha:0});

		var capBoxTl = new TimelineMax();

		capBoxTl.to(capBoxInfoArea, 0.8, {y:'0%', ease: Power2.easeInOut})
				.staggerTo(capBoxHeadInfo, 0.3, {x:0,autoAlpha:1},0.03,'-=0.4')
				.staggerTo(capBoxInfo, 0.3, {x:0,autoAlpha:1},0.03,'-=0.4')
				.to(capBoxBtn, 0.2, {y:0,autoAlpha:1},'-=0.4')

		var CapBoxScene = new ScrollMagic.Scene({
			triggerElement: this, // <-- Use this to select current element
			triggerHook:0.8,
			reverse:false

		})
		.setTween( capBoxTl )
		.addTo(controller_ScrollMagic);	
		

	});

	function window_load_(){

    	var header_menu_item = $('.header-area .nav-menu-area .navbar-items .nav-item .nav-link'),
    		header_logo = $('.header-area .navbar-brand'),
    		hero_heding_text = $('.eskor_slideshow_area .eskor_slideshow_content .swiper-slide-active .content-area h2 .word .w-el'),
    		hero_heding_line = $('.eskor_slideshow_area .eskor_slideshow_content .swiper-slide-active .content-area h2 .line'),
    		hero_control_info = $('.eskor_slideshow_area .slideshow-control .slideshow-control-content'),
    		hero_control = $('.slideshow-control .control-tl')
    		scroll_down = $('.btn-scroll-down');

    		TweenMax.set(header_menu_item, {x:25,autoAlpha:0});
    		TweenMax.set(header_logo, {x:25,autoAlpha:0});
    		TweenMax.set(hero_heding_text, {x:'100%'});
    		TweenMax.set(hero_heding_line, {'width':'0%'});
    		TweenMax.set(hero_control, {y:'100%'});
    		TweenMax.set(scroll_down, {y:'-10%', autoAlpha:0});
    		TweenMax.set(hero_control_info, {autoAlpha:0});

		var priloader_area = $('.preloader-area'),
		priloader_before = $('.logo-ani .before'),
		priloader_span = $('.logo-ani .before span'),
		priloader_span_span = $('.logo-ani .before span span'),
		priloader_logo_text = $('.logo-ani h3');

		var E_tl = new TimelineMax({onComplete: load_Complete});

		E_tl.to(priloader_logo_text, 0.5, {autoAlpha:1, ease: Power0.easeInOut})

    	E_tl.to(priloader_before, 0.7, {x:0, ease: Power3.easeInOut},'+=1.5')
    		.to(priloader_span_span, 0.7, {x:0, ease: Power3.easeInOut},'-=0.4')
    		.to(priloader_logo_text, 0.7, {autoAlpha:0, ease: Power3.easeInOut},'-=0.5')
    		.to(priloader_span_span, 0.7, {x:'100%', ease: Power3.easeInOut},'+=0.4')
    		.to(priloader_before, 0.7, {x:'100%', ease: Power3.easeInOut},'-=0.5')
    		.to(priloader_area, 0.7, {y:'-100%', ease: Power3.easeOut})
    		.set(priloader_area, {autoAlpha:0})

	    function load_Complete(){
	    	var load_tl = new TimelineMax();
	    		load_tl
	    		.to(header_logo, 0.5, {x:0,autoAlpha:1})
	    		.staggerTo(header_menu_item, 0.6, {x:0,autoAlpha:1}, 0.1,'-=0.4')
	    		.staggerTo(hero_heding_text, 0.5, {x:'0%'}, 0.2,'-=0.4')
	    		.to(hero_heding_line, 0.5, {'width':'200px', ease: Power3.easeInOut},'-=0.4')
	    		.to(hero_control, 0.5, {y:'0%', ease: Power3.easeInOut},'-=0.2')
	    		.set(hero_control_info, {autoAlpha:1})
	    		.to(hero_control, 0.5, {y:'-100%', ease: Power3.easeInOut})
	    		.to(scroll_down, 0.5, {y:'0%',autoAlpha:1, ease: Power3.easeInOut},'-=0.4')

	    }	
	} window_load_(); // init function


	function portfolio_filter(){

		// PORTFOLIO CONTENT  
	    $('#grid-container').cubeportfolio({
	        layoutMode: 'grid',
	        filters: '.portfolio-filter',
	        gridAdjustment: 'responsive',
	        animationType: 'slideDelay',
	        defaultFilter: '*',
	        gapVertical: 0,
	        gapHorizontal: 0,
	        singlePageAnimation: 'fade',
	        mediaQueries: [{
	                width: 767,
	                cols: 2,
	            }, {
	                width: 480,
	                cols: 1,
	                options: {
	                    caption: '',
	                    gapHorizontal: 0,
	                    gapVertical: 0,
	                }
	            }, {
	                width: 320,
	                cols: 1,
	                options: {
	                    caption: '',
	                    gapHorizontal: 0,
	                }
	            }],            
	        singlePageCallback: function (url, element) {
	            var t = this;
	            $.ajax({
	                    url: url,
	                    type: 'GET',
	                    dataType: 'html',
	                    timeout: 30000
	                })
	                .done(function (result) {
	                    t.updateSinglePage(result);
	                })
	                .fail(function () {
	                    t.updateSinglePage('AJAX Error! Please refresh the page!');
	                });
	        },
	            plugins: {
	                loadMore: {
	                    element: '#port-loadMore',
	                    action: 'click',
	                    loadItems: 3,
	                }
	            }
	    }); 

	} portfolio_filter(); // Portfolio Function Init


	function single_slide(){

		$('.single-slideshow-area').each(function(slide_index, slide_el) {

			$(this).find('.single-slide-bg').addClass('single-slide-bg-'+slide_index);
			$(this).find('.single-slide-content').addClass('single-slide-content-'+slide_index);
			$(this).find('.slideshow-control').addClass('slideshow-control-'+slide_index);

			var caption = $(this).find('.single-slide-content-'+slide_index)
			  .find('.swiper-slide');

			var Caption = [];

			caption.each(function(i){
					Caption.push($(this).find('.slideshwo-content').attr('data-cap'));
			});

			var interleaveOffset = 0.5;
			var SlideImages = new Swiper('.single-slide-bg-'+slide_index, {
				loop: false,
				speed: 1200,
				grabCursor: true,
				watchSlidesProgress: true,
				mousewheelControl: true,
				keyboardControl: true,
				navigation: {
					nextEl: '.slideshow-control-'+slide_index+' .eskor-slide-nav .prev',
					prevEl: '.slideshow-control-'+slide_index+' .eskor-slide-nav .next',
				},
				pagination: {
			        el: ".slideshow-control-"+slide_index+" .slideshow-pagination",
			        clickable: true,
			        renderBullet: function (index, className) {
				        return (`<div class="pagination ${className}">
				        	<div class="pagination-line"></div>
				        </div>`);
			        }
			    },
				on: {
					progress: function() {
					  var swiper = this;
					  for (var i = 0; i < swiper.slides.length; i++) {
					    var slideProgress = swiper.slides[i].progress;
					    var innerOffset = swiper.width * interleaveOffset;
					    var innerTranslate = slideProgress * innerOffset;
					    swiper.slides[i].querySelector(".slide-bg").style.transform =
					      "translate3d(" + innerTranslate + "px, 0, 0)";
					  }      
					},
					touchStart: function() {
					  var swiper = this;
					  for (var i = 0; i < swiper.slides.length; i++) {
					    swiper.slides[i].style.transition = "";
					  }
					},
					setTransition: function(speed) {
					  var swiper = this;
					  for (var i = 0; i < swiper.slides.length; i++) {
					    swiper.slides[i].style.transition = speed + "ms";
					    swiper.slides[i].querySelector(".slide-bg").style.transition =
					      speed + "ms";
					  }
					}
				}

			});

			// Slide Content
			var SlideContent = new Swiper('.single-slide-content-'+slide_index, {
				speed: 1200,
		        loop: false,
		        effect:'coverflow',
				pagination: {
			        el: '.slideshow-control-'+slide_index+' .counter-slideshow',
			        clickable: true,
			        renderBullet: function (index, className) {
				        return (`<div class="counter-area ${className}">
				        	<div class="caption-area">
								<span class="cap-info">${Caption[index]}</span>
				        	</div>
							<div class="counter">
								<span class="counter-num">0${(index + 1)}</span>
							</div>
				        </div>`);
			        }
			    }

		    });

		    // Slide Controller
			SlideContent.controller.control = SlideImages;
		    SlideImages.controller.control = SlideContent;


		});
	} single_slide(); // single slide area


});