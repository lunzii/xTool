<?php 
if(is_home()):

	if(get_option('page_for_posts')){
		$page_custom = get_post_custom(get_option('page_on_front'));
		
		if(isset($page_custom['page-loading-enabled']) && filter_var($page_custom['page-loading-enabled'][0], FILTER_VALIDATE_BOOLEAN)):
			echo '<div id="loader-site"></div>';
		endif;
	}
	else return;


elseif(!is_404() && get_the_id()):

	$page_custom = get_post_custom(get_the_id());
	
	if(isset($page_custom['page-loading-enabled']) && filter_var($page_custom['page-loading-enabled'][0], FILTER_VALIDATE_BOOLEAN)):
		echo '<div id="loader-site"></div>';
	endif;

endif;
?>