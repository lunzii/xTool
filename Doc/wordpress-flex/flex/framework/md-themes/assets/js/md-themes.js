(function($){

"use strict";


if(!$('#themes-list').length) return;


function getThemes(){
	var $service = 'http://demo.themesholic.com/md-themes.php?callback=listThemes';
	$.getScript($service);
}

getThemes();


})(jQuery);


function listThemes(data) {
	var $ = jQuery;

	$(data.themes).each(function(i, theme){
		var $title = theme.title;
		var $subtitle = theme.subtitle;
		var $description = theme.description;
		var $demo = theme.demo;
		var $purchase = theme.purchase;
		var $price = theme.price;
		var $thumb = theme.thumb;

		$html = '<div class="theme">';
			$html += '<div class="theme-price">'+$price+'</div>';
			$html += '<div class="theme-image"><a href="'+$purchase+'" target="_blank"><img src="'+$thumb+'" alt=""></a></div>';
			$html += '<div class="theme-content">';
				$html += '<h3>'+$title+' - '+$subtitle+'</h3>';
				$html += '<p>'+$description+'</p>';
				$html += '<div class="theme-links">';
					$html += '<a href="'+$demo+'" target="_blank">VIEW DEMO</a>';
					$html += '<a href="'+$purchase+'" target="_blank">PURCHASE</a>';
				$html += '</div>';
			$html += '</div>';
		$html += '</div>';

		$('#themes-list').append($html);

	});
}