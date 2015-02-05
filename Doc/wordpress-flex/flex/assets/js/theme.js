(function($){

"use strict";
$.fn.fixHeight = function(){
	 this.height( Math.max.apply(this, $.map( this , function(e){ return $(e).height() }) ) ) ;
};

var THEME = window.THEME || {};

THEME.loaderSite = function(){
	if($('#loader-site').length){
		$('#wrap').hide();

		$(window).load(function(){
			$('#loader-site').fadeOut(400, function(){
				$('#wrap').delay(1000).queue(function(){
					$('#wrap').fadeIn();
				});
			});
		})
	}
}


THEME.header = function(){
	function sticky(){
		$(".device-desktop header.attachment-fixed .header-content").sticky();
	}
	sticky();

	function search(){
		$('#search-open').on('click', function(){
			$('.header-search').fadeToggle();
			return false;
		});

	}
	search();
}

THEME.menu = function(){
	function megaMenu(){
		var $speed = 60;

		$('#header-menu .megamenu').mouseover(function(){
			$(this).find('ul:first').fadeIn($speed).find('li ul').fixHeight();
		}).mouseleave(function(){
			$(this).find('ul:first').fadeOut($speed);
		});

	}
	megaMenu();

	function arrowSubmenu(){
		$('#header-menu .simple .sub-menu li').each(function(){
			if($(this).find('ul.sub-menu').length > 0) {
				 $(this).find('> a').append('<i class="icon-angle-right arrow"></i>');
			}
		});
	}
	arrowSubmenu();

	function mobileMenu(){
		$('#menu-mobile-trigger').on('click', function(){
			$(this).toggleClass('open');
			$('.header-mobile').slideToggle();
			return false;
		});

		$('#header-menu-mobile .menu-item-has-children > a').on('click', function(){
			$(this).toggleClass('open').next('ul').slideToggle();	
			return false;
		});
	}
	mobileMenu();
}


THEME.blog = function(){
	function blogMasonry(){
		var $container = $('.md-blog.masonry');
		$container.masonry({
		  columnWidth: '.item',
		  itemSelector: '.item'
		});
	}
	blogMasonry();
}


THEME.portfolio = function(){
	function portfolioMasonry(){
		var $container = $('.md-portfolio.masonry');
		$container.masonry({
		  columnWidth: '.item',
		  itemSelector: '.item'
		});
	}
	portfolioMasonry();

	function portfolioFilter(){
		$('.portfolio-filtered').isotope({
			itemSelector : '.item'
		});

		
		$('.md-portfolio-filter a').on('click', function(){
			var selector = $(this).attr('data-filter');
			
			$('.portfolio-filtered').isotope({ filter: selector });

			$('.md-portfolio-filter a').removeClass('active');
			$(this).addClass('active');
			
			$(this).parent('.md-portfolio-filter').find('.current').text($(this).text());
			
			return false;
		});
	}
	portfolioFilter();
	
}

THEME.customSelect = function(){
	$('.widget select, .woocommerce-ordering select').customSelect();
}

THEME.breadcrumbs = function(){
	var $breadBottom = ($('.page-section:first').hasClass('arrow-down')) ? 12 : 0;
	$('.breadcrumbs').css({
		'bottom' : $breadBottom
	});
}

THEME.breadcrumbs();


THEME.woocommerce = function(){
	function productsMasonry(){
		var $container = $('.products');
		$container.masonry({
		  columnWidth: '.product',
		  itemSelector: '.product'
		});
	}
	productsMasonry();
}


THEME.init = function(){
	THEME.loaderSite();
	THEME.header();
	THEME.menu();
	THEME.blog();
	THEME.portfolio();
	THEME.customSelect();
	THEME.woocommerce();
}

$(window).load(function(){
	THEME.init();
})

})(jQuery);