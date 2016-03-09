<?php


class MCLike {
	
	 function __construct()   {	
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
        add_action('wp_ajax_mc-like', array(&$this, 'ajax'));
		add_action('wp_ajax_nopriv_mc-like', array(&$this, 'ajax'));
	}
	
	function enqueue_scripts() {
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'mc-like', get_template_directory_uri() . '/components/post_like/js/mc-like.js', 'jquery', '1.0', TRUE );
		
		wp_localize_script( 'mc-like', 'mcLike', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}
	
	function ajax($post_id) {
		
		//update
		if( isset($_POST['likes_id']) ) {
			$post_id = str_replace('mc-like-', '', $_POST['likes_id']);
			echo $this->like_post($post_id, 'update');
		} 
		
		//get
		else {
			$post_id = str_replace('mc-like-', '', $_POST['likes_id']);
			echo $this->like_post($post_id, 'get');
		}
		
		exit;
	}
	
	
	function like_post($post_id, $action = 'get')
	{
		if(!is_numeric($post_id)) return;
	
		switch($action) {
		
			case 'get':
				$like_count = get_post_meta($post_id, '_mc_like', true);
				if( !$like_count ){
					$like_count = 0;
					add_post_meta($post_id, '_mc_like', $like_count, true);
				}
				
				return '<span class="mc-like-count">'. $like_count .'</span>';
				break;
				
			case 'update':
				$like_count = get_post_meta($post_id, '_mc_like', true);
				if( isset($_COOKIE['mc_like_'. $post_id]) ) return $like_count;
				
				$like_count++;
				update_post_meta($post_id, '_mc_like', $like_count);
				setcookie('mc_like_'. $post_id, $post_id, time()*20, '/');
				
				return '<span class="mc-like-count">'. $like_count .'</span>';
				break;
		
		}
	}


	function add_like() {

		global $post;

		$output = $this->like_post($post->ID);
  
  		$class = 'mc-like';
  		$title = __('Like this', THEME_LANGUAGE_DOMAIN);
		if( isset($_COOKIE['mc_like_'. $post->ID]) ){
			$class = 'mc-like liked';
			$title = __('You already liked this!', THEME_LANGUAGE_DOMAIN);
		}
		
		return '<a href="#" class="'. $class .'" id="mc-like-'. $post->ID .'" title="'. $title .'"> <i class="fa fa-heart"></i> '. $output .'</a>';
	}
	
}


global $mc_like;
$mc_like = new MCLike();

function mc_like($return = '') {
	
	global $mc_like;

	if($return == 'return') {
		return $mc_like->add_like();
	} else {
		echo $mc_like->add_like();
	}
	
}

?>
