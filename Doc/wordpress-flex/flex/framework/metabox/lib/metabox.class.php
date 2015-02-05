<?php 

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-------------------------------------------------------------------------------------*/

class METABOX_HELPER {

	function init(){

		if( isset($_REQUEST['post']) ):
			$post_id = $_REQUEST['post'];

		elseif (isset($_REQUEST['post_ID'])):
			$post_id = $_REQUEST['post_ID'];
		
		else:
			$post_id = 99999999999999;
		
		endif;

		global $md_metabox;
		
		function subval_sort($a,$subkey) {
			foreach($a as $k=>$v) {
				$b[$k] = strtolower($v[$subkey]);
			}
			asort($b);
			foreach($b as $key=>$val) {
				$c[] = $a[$key];
			}
			return $c;
		}
		
		$md_metabox = subval_sort($md_metabox, 'order'); 

		$form_helper = new FORM_HELPER($post_id, $md_metabox);
		
		add_action( 'add_meta_boxes', 'page_metabox_init' );
		add_action( 'save_post', 'page_metabox_save' );

		function page_metabox_init() {
		    add_meta_box(
		        'page-metabox',
		        'Advanced Page Options',
		        'page_metabox_ui'
		    );
		}


		function page_metabox_ui($post){
			global $md_metabox;

			wp_nonce_field( plugin_basename( __FILE__ ), 'nonce_page_metabox' );
		
		 	$form_helper = new FORM_HELPER($post->ID, $md_metabox);
		 	$form_helper->metabox_init();
		}

		function page_metabox_save($post_id){

			if(isset($_POST['nonce_page_metabox']))
			{
				// Autosave, do nothing
				if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
						return;
				// Ajax not used here
				if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) 
						return;
				// Check user permissions
				if ( ! current_user_can( 'edit_post', $post_id ) )
						return;
				// Return if it's a post revision
				if ( false !== wp_is_post_revision( $post_id ) )
						return;			
				// verify this came from the our screen and with proper authorization
				if ( !wp_verify_nonce( $_POST['nonce_page_metabox'], plugin_basename( __FILE__ ) ) )
						return;	
				// OK, we're authenticated
				global $md_metabox;

				$form_helper = new FORM_HELPER($post_id, $md_metabox);
				$form_helper->metabox_save();				
			}
		}

	}
}


function md_disable_metabox($ids){}