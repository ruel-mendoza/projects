<?php require_once ('include/defines.php');

// admin framework
require_once ( get_template_directory() . '/admin/index.php');

// Support for automatic plugin installation
require_once(  get_template_directory() . '/components/helper_classes/tgm-plugin-activation/class-tgm-plugin-activation.php');
require_once(  get_template_directory() . '/components/helper_classes/tgm-plugin-activation/required_plugins.php');

// Widgets
require_once(  get_template_directory() . '/components/widgets/widgets.php');

// Like posts
require_once(  get_template_directory() . '/components/post_like/mc-like.php');

// Shortcodes
require_once(  get_template_directory() . '/shortcodes.php');

// Multilanguage support
add_theme_support( 'post-formats', array('gallery', 'link', 'quote', 'audio', 'video')); 

/**
 * Tell WordPress to run mc_setup() when the 'after_setup_theme' hook is run.
 */
 
    add_action('init', 'myStartSession', 1);
	function myStartSession() {
		if(!session_id()) {
			session_start();
			$_SESSION['myKey'] = "true";
		}
	}
add_action( 'after_setup_theme', 'mc_setup' );

if ( ! function_exists( 'mc_setup' ) ){

	function mc_setup() {

		// Load up our theme options page and related code.
		require( get_template_directory() . '/include/theme-options.php' );

        // Set content width 
        if ( ! isset( $content_width ) ) $content_width = 1180;
        
        // Allow shortcodes in widget text
        add_filter('widget_text', 'do_shortcode');

        register_nav_menu( 'main', __( 'Main Menu', THEME_LANGUAGE_DOMAIN ) );
        
        // support for multiple featured images
		if (class_exists('MultiPostThumbnails')) {
        
            // set multiple post thumbnails
            for( $idx = 2; $idx <= 5; $idx++ ){
                new MultiPostThumbnails(
                    array(
                        'label' => 'Featured Image ' . $idx,
                        'id' => 'featured-image-' . $idx,
                        'post_type' => 'post'
                    )
                );
            }
            
            // set multiple portfolio item thumbnails
            for( $idx = 2; $idx <= 5; $idx++ ){
                new MultiPostThumbnails(
                    array(
                        'label' => 'Featured Image ' . $idx,
                        'id' => 'featured-image-' . $idx,
                        'post_type' => 'mc_portfolio'
                    )
                );
            }
            
        }

        // add support for multiple languages
        load_theme_textdomain( THEME_LANGUAGE_DOMAIN, get_template_directory() . '/languages' );

        // add blog excerpt filter
        global $global_theme_options;
        if( $global_theme_options['content_length'] == 'Excerpt' )
            add_filter( 'excerpt_length', 'mc_custom_excerpt_length', 999 );
}

} // mc_setup


if ( ! function_exists( 'mc_load_scripts' ) ){

	function mc_load_scripts() {

        // detect browser version; if chrome disable the smooth scrolling
        $bIsChrome = false;
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
        {
            // User agent is Google Chrome
            $bIsChrome = true;
        }
    	// Register css files
		/*Cuber*/

			wp_register_style( 'cube', get_template_directory_uri() . '/js/cuber/build/styles/cube.css', TRUE);
			wp_register_style( 'base', get_template_directory_uri() . '/js/cuber/examples/basic/styles/base.css', TRUE);
			wp_register_style( 'animation', get_template_directory_uri() . '/css/animation.css', TRUE);
		
		/*Cuber*/
		
        wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', TRUE);

        wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', TRUE);

        wp_register_style( 'bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css', TRUE);
            
        wp_register_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', TRUE);
        wp_register_style( 'jqparallax', get_template_directory_uri() . '/css/parallax.css', TRUE);
        wp_register_style( 'media1300', get_template_directory_uri() . '/1300px.css', TRUE);
        wp_register_style( 'media1024', get_template_directory_uri() . '/1024px.css', TRUE);
        wp_register_style( 'media768', get_template_directory_uri() . '/768px.css', TRUE);
        wp_register_style( 'media480', get_template_directory_uri() . '/480px.css', TRUE);
        wp_register_style( 'iestyle', get_template_directory_uri() . '/ie.css', TRUE);
        wp_register_style( 'ffstyle', get_template_directory_uri() . '/ff.css', TRUE);
		wp_register_style( 'rsstyle', get_template_directory_uri() . '/rs.css', TRUE);
		
        global $global_theme_options;
        //navigation menu
        if( $global_theme_options['header_layout'] == 'v2' ){

            wp_register_style( 'navigation', get_template_directory_uri() . '/css/navigation-style-2.css', TRUE);

        } else if( $global_theme_options['header_layout'] == 'v3' ){

            wp_register_style( 'navigation', get_template_directory_uri() . '/css/navigation-style-3.css', TRUE);

        }
        else if( $global_theme_options['header_layout'] == 'v4' ){

            wp_register_style( 'navigation', get_template_directory_uri() . '/css/navigation-style-4.css', TRUE);

        }
        else{

            wp_register_style( 'navigation', get_template_directory_uri() . '/css/navigation-style-1.css', TRUE);

        }

        // color skin
        if( !isset( $global_theme_options['color_skin'] ) ){

            $global_theme_options['color_skin'] = 'gray';
        }

        if( $global_theme_options['color_skin'] == 'blue' ){

            wp_register_style( 'colorskin', get_template_directory_uri() . '/css/colors/color-blue.css', TRUE);

        } else if( $global_theme_options['color_skin'] == 'green' ){

            wp_register_style( 'colorskin', get_template_directory_uri() . '/css/colors/color-green.css', TRUE);

        }
        else if( $global_theme_options['color_skin'] == 'yellow' ){

            wp_register_style( 'colorskin', get_template_directory_uri() . '/css/colors/color-yellow.css', TRUE);

        }
        else if( $global_theme_options['color_skin'] == 'red' ){

            wp_register_style( 'colorskin', get_template_directory_uri() . '/css/colors/color-red.css', TRUE);

        }
        else if( $global_theme_options['color_skin'] == 'custom' ){

            // we enqueue the gray style but we set the inline custom styles
            wp_register_style( 'colorskin', get_template_directory_uri() . '/css/colors/color-gray.css', TRUE);

        }
        else{

            wp_register_style( 'colorskin', get_template_directory_uri() . '/css/colors/color-gray.css', TRUE);

        }

        
        // Register scripts
        if( is_page_template( 'one-page.php' ) ) {

            if( $global_theme_options['contact_show_map'] ){

                wp_register_script(
        		    'google-maps',
            	    'http://maps.google.com/maps/api/js?sensor=false',
            	    'jquery',
            	    false,
            	    true
        	    );
            
       		    wp_register_script(
        		    'gmap-lib',
           		    get_template_directory_uri() .'/js/gmap.js',
            	    'jquery',
            	    false,
            	    true
        	    );

            }

            wp_register_script(
                'ytplayer',
                get_template_directory_uri() .'/js/jquery.mb.YTPlayer.js',
                'jquery',
                false,
                true
            );

        }

        wp_register_script(
            'waitforimages',
            get_template_directory_uri() .'/js/jquery.waitforimages.js',
            'jquery',
            false,
            true
        );

        wp_register_script(
            'jqparallax',
            get_template_directory_uri() .'/js/jquery.parallax.js',
            'jquery',
            false,
            true
        );		

        wp_register_script(
            'jquery-sticky',
            get_template_directory_uri() .'/js/jquery.sticky.js',
            'jquery',
            false,
            true
        );

        wp_register_script(
			'swiper',
			get_template_directory_uri() . '/js/idangerous.swiper-2.1.min.js', 
			'jquery', 
			false,
			true
		);
        
		wp_register_script(
			'jquery-easing',
			get_template_directory_uri() . '/js/jquery.easing-1.3.pack.js', 
			'jquery', 
			false,
			true
		);
		
		wp_register_script(
			'bootstrapjs',
			get_template_directory_uri() . '/js/bootstrap.min.js', 
			'jquery', 
			false,
			true
		);
		
		wp_register_script(
			'parallax-jquery',
			get_template_directory_uri() . '/js/jquery.parallax-1.1.3.js', 
			'jquery', 
			false,
			true
		);
		
		wp_register_script(
			'appearjs',
			get_template_directory_uri() . '/js/appear.js', 
			'jquery', 
			false,
			true
		);
		
		wp_register_script(
			'modernizrjs',
			get_template_directory_uri() . '/js/modernizr.js', 
			'jquery', 
			false,
			true
		);
		
		wp_register_script(
			'prettyphotojs',
			get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 
			'jquery', 
			false,
			true
		);
		
		wp_register_script(
			'isotopejs',
			get_template_directory_uri() . '/js/isotope.js', 
			'jquery', 
			false,
			true
		);
		
		wp_register_script(
			'bxslider-jquery',
			get_template_directory_uri() . '/js/jquery.bxslider.min.js', 
			'jquery', 
			false,
			true
		);
		
		wp_register_script(
			'cycle-all-jquery',
			get_template_directory_uri() . '/js/jquery.cycle.all.js', 
			'jquery', 
			false,
			true
		);
		
		wp_register_script(
			'maximage-jquery',
			get_template_directory_uri() . '/js/jquery.maximage.js', 
			'jquery', 
			false,
			true
		);

        if( $bIsChrome && $global_theme_options['enable_smooth_scrolling'] ){
		    wp_register_script(
			    'sscrjs',
			    get_template_directory_uri() . '/js/sscr.js',
			    'jquery',
			    false,
			    true
		    );
        }

		wp_register_script(
			'tweenMax',
			get_template_directory_uri() . '/js/greensock/TweenMax.min.js', 
			'jquery', 
			false,
			true
		);

		wp_register_script(
			'TweenLite',
			get_template_directory_uri() . '/js/greensock/TweenLite.min.js', 
			'jquery', 
			false,
			true
		);			

		wp_register_script(
			'lettering',
			get_template_directory_uri() . '/js/jquery.lettering-0.6.1.min.js', 
			'jquery', 
			false,
			true
		);		

		wp_register_script(
			'ScrollToPlugin',
			get_template_directory_uri() . '/js/greensock/plugins/ScrollToPlugin.min.js', 
			'jquery', 
			false,
			true
		);		
		

		wp_register_script(
			'superscrollorama',
			get_template_directory_uri() . '/js/jquery.superscrollorama.js', 
			'jquery', 
			false,
			true
		);		
		wp_register_script(
			'scrollmagic',
			get_template_directory_uri() . '/js/jquery.scrollmagic.js', 
			'jquery', 
			false,
			true
		);		
		
		wp_register_script(
			'skrollrjs',
			get_template_directory_uri() . '/js/skrollr.js', 
			'jquery', 
			false,
			true
		);
		wp_register_script(
			'nicescroll',
			get_template_directory_uri() . '/js/jquery.nicescroll.js', 
			'jquery', 
			false,
			true
		);	
		wp_register_script(
			'nicescrollplus',
			get_template_directory_uri() . '/js/jquery.nicescroll.plus.js', 
			'jquery', 
			false,
			true
		);				

/*Cuber*/
	if ( is_front_page() ) {
	// This is a homepage
			wp_register_script(
				'cuber_cuberJs',
				get_template_directory_uri() .'/js/cuber/build/cuber.js',
				'jquery',
				false,
				true
			);
			wp_register_script(
				'cuber_patches',
				get_template_directory_uri() .'/js/patches.js',
				'jquery',
				false,
				true
			);			
			wp_register_script(
				'cuber_TweenMinJs',
				get_template_directory_uri() .'/js/cuber/src/scripts/vendor/tween.min.js',
				'jquery',
				false,
				true
			);
			
			wp_register_script(
				'cuber_iecss3dJs',
				get_template_directory_uri() .'/js/cuber/src/scripts/extras/renderers/iecss3d.js',
				'jquery',
				false,
				true
			);
			wp_register_script(
				'cuber_ierendererJs',
				get_template_directory_uri() .'/js/cuber/src/scripts/extras/renderers/ierenderer.js',
				'jquery',
				false,
				true
			);
			wp_register_script(
				'cuber_lockedJs',
				get_template_directory_uri() .'/js/cuber/src/scripts/extras/controls/locked.js',
				'jquery',
				false,
				true
			);
			wp_register_script(
				'cuber_deviceMotionJs',
				get_template_directory_uri() .'/js/cuber/src/scripts/extras/deviceMotion.js',
				'jquery',
				false,
				true
			);
			wp_register_script(
				'cuber_mainJs',
				get_template_directory_uri() .'/js/cuber/examples/basic/scripts/main.js',
				'jquery',
				false,
				true
			);
	}
/*Cuber*/

		
		wp_register_script(
			'migrate',
			get_template_directory_uri() . '/js/jquery-migrate-1.2.1.min.js', 
			'jquery', 
			false,
			true
		);
		wp_register_script(
			'scriptsjs',
			get_template_directory_uri() . '/js/scripts.js', 
			'jquery', 
			false,
			true
		);

		wp_register_script(
			'smoothPageScroll',
			get_template_directory_uri() . '/js/smoothPageScroll.js', 
			'jquery', 
			false,
			true
		);
				
		
		// enqueue styles
		if (is_front_page()) {
			wp_enqueue_style('cube');
			wp_enqueue_style('base');
			wp_enqueue_style('jqparallax');
		}
		wp_enqueue_style('animation');		
		wp_enqueue_style('bootstrap');
		wp_enqueue_style('theme', get_stylesheet_uri(), 'bootstrap');
		
        wp_enqueue_style('media1300');
        wp_enqueue_style('media1024');
        wp_enqueue_style('media768');
        wp_enqueue_style('media480');
        wp_enqueue_style('iestyle');
        wp_enqueue_style('ffstyle');
        wp_enqueue_style('rsstyle');
		
        wp_enqueue_style('colorskin');
		wp_enqueue_style('prettyPhoto');
		wp_enqueue_style('bxslider');
		wp_enqueue_style('fontawesome');
        wp_enqueue_style('navigation');

        
		// enqueue google fonts styles
        if( !isset( $global_theme_options['google_font_body'] ) ){

            $global_theme_options['google_font_body'] = '';
        }
        if( !isset( $global_theme_options['google_font_htag'] ) ){

            $global_theme_options['google_font_htag'] = '';
        }

        $protocol = is_ssl() ? 'https' : 'http';
        if( $global_theme_options['google_font_body'] && ($global_theme_options['google_font_body'] != 'Select Font') ){
            wp_enqueue_style( 'mytheme-body-font', $protocol . "://fonts.googleapis.com/css?family=" . urlencode($global_theme_options['google_font_body']) . ":400,400italic,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese");
        }
        else{
            wp_enqueue_style( 'mc-open-sans-font', $protocol . "://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
        }
        if( $global_theme_options['google_font_htag'] && ($global_theme_options['google_font_htag'] != 'Select Font') ){
            wp_enqueue_style( 'mytheme-htag-font', $protocol . "://fonts.googleapis.com/css?family=" . urlencode($global_theme_options['google_font_htag']) . ":400,400italic,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese");
        }
        else{
            wp_enqueue_style( 'mc-montserrat-font', $protocol . "://fonts.googleapis.com/css?family=Montserrat:400,700");
        }


		// enqueue scripts		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-sticky');
		wp_enqueue_script('jquery-easing');
		wp_enqueue_script('bootstrapjs');
		wp_enqueue_script('parallax-jquery');
		wp_enqueue_script('appearjs');
		wp_enqueue_script('modernizrjs');
		wp_enqueue_script('prettyphotojs');
		wp_enqueue_script('isotopejs');
		wp_enqueue_script('bxslider-jquery');
		wp_enqueue_script('cycle-all-jquery');
		wp_enqueue_script('maximage-jquery');

        if( $bIsChrome && $global_theme_options['enable_smooth_scrolling'] ){
		    wp_enqueue_script('sscrjs');
        }
		wp_enqueue_script('smoothPageScroll');
		wp_enqueue_script('tweenMax');
//		wp_enqueue_script('TweenLite');
		wp_enqueue_script('lettering');		
		wp_enqueue_script('ScrollToPlugin');		
//		wp_enqueue_script('superscrollorama');		
		wp_enqueue_script('scrollmagic');		
//		wp_enqueue_script('skrollrjs');
		wp_enqueue_script('nicescroll');
		wp_enqueue_script('nicescrollplus');
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		if( is_page_template( 'one-page.php' ) ) {
            if( $global_theme_options['contact_show_map'] ){
                wp_enqueue_script('google-maps');
             	wp_enqueue_script('gmap-lib');
            }
            wp_enqueue_script('ytplayer');
		}

        wp_enqueue_script('waitforimages');

        wp_enqueue_script('cuber_cuberJs');
        wp_enqueue_script('cuber_patches');
        wp_enqueue_script('cuber_TweenMinJs');
       

		wp_enqueue_script('cuber_iecss3dJs');
        wp_enqueue_script('cuber_ierendererJs');
        wp_enqueue_script('cuber_lockedJs');
        wp_enqueue_script('cuber_deviceMotionJs');
//        wp_enqueue_script('cuber_mainJs');


		if (is_front_page()) {
			wp_enqueue_script('jqparallax');
		}		

		
		wp_enqueue_script('swiper');
        wp_enqueue_script('scriptsjs');
	}
		
	add_action('wp_enqueue_scripts', 'mc_load_scripts');

}

// wp_head hook
if ( ! function_exists( 'mc_wp_head_hook' ) ){

    function mc_wp_head_hook(){

        global $global_theme_options;

        if( !isset( $global_theme_options['color_skin'] ) ){

            $global_theme_options['color_skin'] = 'gray';
        }
        if( $global_theme_options['color_skin'] == 'custom' ){

            require_once( get_template_directory() . '/css/colors/color-custom.css.template' );

            global $custom_css_template;

            if( $custom_css_template != FALSE ){

                $rgb_values = hex2rgb( $global_theme_options['custom_color'] );

                $custom_css = str_replace("#000000", $global_theme_options['custom_color'], $custom_css_template);
                $custom_css = str_replace("0,0,0", $rgb_values[0].','.$rgb_values[1].','.$rgb_values[2], $custom_css);

                echo '<style type="text/css">';
                echo trim( $custom_css );
                echo '</style>';
            }
        }

        if( !isset( $global_theme_options['google_font_body'] ) ){

            $global_theme_options['google_font_body'] = '';
        }
        if($global_theme_options['google_font_body'] && $global_theme_options['google_font_body'] != 'Select Font'){

            echo '<style type="text/css">';
            echo 'html, body, .project-counters .counters li, .navbar .nav > li > a.collapse_menu1, .navbar .nav > li > a.dropdown-toggle, .navbar .nav > li > a.external  {';
            echo 'font-family: "' . $global_theme_options['google_font_body'] . '", sans-serif;';
            echo '}';
            echo '</style>';
        }

        if( !isset( $global_theme_options['google_font_htag'] ) ){

            $global_theme_options['google_font_htag'] = '';
        }
        if($global_theme_options['google_font_htag'] && $global_theme_options['google_font_htag'] != 'Select Font'){

            echo '<style type="text/css">';
            echo 'h1, h2, h3, h4, h5, h6, .dropcap-normal, .dropcap, .counters li, .counters li span, a.mc-button, .ultralarge, .four-zero-four, .text-slide-vertical, .project-counters .counters li .count, .company-phone a, #contact-formular input[type="text"], #contact-formular input[type="email"], input[type="password"], textarea, #contact-formular input[type="submit"], input[type="submit"], #commentsform input[type="text"], textarea, input#search, .navbar .nav > li > a {';
            echo 'font-family: "' . $global_theme_options['google_font_htag'] . '", sans-serif;';
            echo '}';
            echo '</style>';

        }

        if( isset( $global_theme_options['custom_css'] ) ){

            if( trim($global_theme_options['custom_css']) ){

                echo '<style type="text/css">';
                echo trim($global_theme_options['custom_css']);
                echo '</style>';
            }
        }

        echo $global_theme_options['space_head'];

    }

    add_action('wp_head', 'mc_wp_head_hook');

}

if ( ! function_exists( 'add_opengraph' ) ){

    function add_opengraph() {

        global $post; // Ensures we can use post variables outside the loop

        // Start with some values that don't change.
        echo "<meta property='og:site_name' content='". get_bloginfo('name') ."'/>"; // Sets the site name to the one in your WordPress settings
        echo "<meta property='og:url' content='" . get_permalink() . "'/>"; // Gets the permalink to the post/page

        if (is_singular()) { // If we are on a blog post/page
            echo "<meta property='og:title' content='" . get_the_title() . "'/>"; // Gets the page title
            echo "<meta property='og:type' content='article'/>"; // Sets the content type to be article.
        } elseif(is_front_page() or is_home()) { // If it is the front page or home page
            echo "<meta property='og:title' content='" . get_bloginfo("name") . "'/>"; // Get the site title
            echo "<meta property='og:type' content='website'/>"; // Sets the content type to be website.
        }

        if(has_post_thumbnail( $post->ID )) { // If the post has a featured image.
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            echo "<meta property='og:image' content='" . esc_attr( $thumbnail[0] ) . "'/>"; // If it has a featured image, then display this for Facebook
        }

    }

    add_action( 'wp_head', 'add_opengraph', 5 );

}


// wp_footer hook
if ( ! function_exists( 'mc_wp_footer_hook' ) ){

    function mc_wp_footer_hook(){

        global $global_theme_options;

        echo $global_theme_options['google_analytics'];

    }

    // change priority here if there are more important actions associated with the hook
    add_action('wp_footer', 'mc_wp_footer_hook', 100);

}


// pagination
if( !function_exists('mc_pagination') ){
	
	function mc_pagination( $current_query = null ){
    
    	// see what is the page # we are on
    	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    	if(empty($paged)) $paged = 1;

    	// pages represent the total number of pages 
    	global $wp_query;
    	if( $current_query == null )
        	$current_query = $wp_query;
    
    	$pages = ($current_query->max_num_pages) ? $current_query->max_num_pages : 1;

     	if( $pages > 1 )
     	{
     		echo '<div id="blog-footer" class="clearfix">';
    	
       		echo '<div class="container no-padding">';
        
        	echo '<ul class="inner-navigation masonry clearfix">';
        	
        	if ( get_previous_posts_link() ){
                echo '<li class="blog-pagination-prev">';
                previous_posts_link( '<span><img src="'.get_template_directory_uri().'/images/prev_article.png" alt="' . __("Previous", THEME_LANGUAGE_DOMAIN) . '"></span>');
                echo '</li>';
            }

         	if( get_next_posts_link( '', $current_query->max_num_pages ) ) {
                echo '<li class="blog-pagination-next">';
                next_posts_link( '<span><img src="'.get_template_directory_uri().'/images/next_article.png" alt="' . __("Previous", THEME_LANGUAGE_DOMAIN) . '"></span>', $current_query->max_num_pages );
                echo '</li>';
            }

         	echo '</ul>';
         	
         	echo '</div>';
         	
         	echo '</div>';
     	}
	}

} // pagination function


// pagination
if( !function_exists('mc_comment') ){
	
	function mc_comment($comment, $args, $depth) {
        
        $GLOBALS['comment'] = $comment;
        $add_below = '';
		echo '<div style="clear:both;">&nbsp;</div>';
        echo '<div class="user_comment" ';
        comment_class();
        echo ' id="div-comment-';
        comment_ID();
        echo '">';
        echo '<div class="avatar">'. get_avatar($comment) . '</div>';
        echo '<div class="commentFrom"><p><strong>'. get_comment_author_link() . '</strong></p>';
        echo '<p class="comment-date">' . get_comment_date() . ' ' . __('at', THEME_LANGUAGE_DOMAIN ) . ' ' . get_comment_time() . '</p></div>';

        echo '<div class="comment-text">';
        if ($comment->comment_approved == '0'){
            echo '<em>' . __("Your comment is awaiting moderation", THEME_LANGUAGE_DOMAIN) . '</em><br />';
        }
        comment_text();
        echo '</div>';
        
        comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', THEME_LANGUAGE_DOMAIN), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])));

	}
}


// custom excerpt length
if( !function_exists('mc_custom_excerpt_length') ){
	
    function mc_custom_excerpt_length( $length ) {
        
        global $global_theme_options;
        
		return intval( $global_theme_options['excerpt_length_blog'] );
    }
}


if ( ! function_exists( 'Menu_Walker::start_el' ) ){


class Menu_Walker extends Walker_Nav_Menu
{

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $wp_query;
           
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

        // add submenu class if current item is a top menu item
        $menu_link_class = '"';
        $bIsTopMenuItem  = false;
        if( in_array("menu-item-has-children", $classes) ){

            $classes[]          = 'dropdown';
            $menu_link_class    = ' dropdown-toggle" data-toggle="dropdown"';
            $bIsTopMenuItem     = true;
        }

        if( (in_array("current-menu-item", $classes)) || (in_array("current_page_item", $classes)) ){

            $classes[]          = 'active';
        }

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
		if( $item->object == 'page' )
        {
        	$page_post 			= get_post( $item->object_id );                
            $section_page 		= (get_post_meta( $item->object_id, "mc_is_page_section", true ) == 'yes');
            $disable_menu 		= (get_post_meta( $item->object_id, "mc_menu_disable_page", true ) == 'yes');
			$main_page_id 		= get_option( 'page_on_front' );
			
			if( !$disable_menu && ( $page_post->ID != $main_page_id ) ){

                if( !$bIsTopMenuItem ){
				    if ( !$section_page )
	                    $attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';
	                else{
	               	    if (is_front_page())
	               		    $attributes .= ' href="#' . $page_post->post_name . '"';
	               	    else
	               		    $attributes .= ' href="' . home_url() . '#' . $page_post->post_name . '"';
	                }
                }

	            $item_output = $args->before;
                if( !$bIsTopMenuItem ){
	                if ( $section_page && is_front_page() )
					    $item_output .= '<a class="collapse_menu1' . $menu_link_class . ' '. $attributes .'>';
				    else
					    $item_output .= '<a class="external' . $menu_link_class . ' '. $attributes .'>';
                }
                else{
                    $item_output .= '<a class="' . $menu_link_class . ' '. $attributes .'>';
                }
		
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;

                global $global_theme_options;
                $css_margin         = '';
                $margin             = '';
                $threshold_margin   = '';
                if( $global_theme_options['header_layout'] == 'v1' ){
                    if( trim(get_post_meta( $item->object_id, "mc_menu_item_margin_right", true )) != '' ){
                        $css_margin = ' style="margin-right: ' . get_post_meta( $item->object_id, "mc_menu_item_margin_right", true ) . 'px"';
                        $margin = ' data-margin-right="' . get_post_meta( $item->object_id, "mc_menu_item_margin_right", true ) . '"';
                    }

                    if( trim(get_post_meta( $item->object_id, "mc_menu_item_threshold_margin_right", true )) != '' ){
                        $threshold_margin = ' data-threshold-margin-right="' . get_post_meta( $item->object_id, "mc_menu_item_threshold_margin_right", true ) . '"';
                    }
                }

                $output .= $indent . '<li' . $id . $value . $class_names . $css_margin . $margin . $threshold_margin .'>';
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
				
			}
			
        }
        else {

            if( !$bIsTopMenuItem ){
        	    $attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';
            }
        	
        	$item_output = $args->before;
			$item_output .= '<a class="external' . $menu_link_class . ' '. $attributes .'>';
		
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

            $output .= $indent . '<li' . $id . $value . $class_names .'>';
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        	
        }
		
	}

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu dropdown-menu\">\n";
    }

}
	
}

function new_excerpt_more($more) {
   global $post;
   return '… <a href="'. get_permalink($post->ID) . '" class="cReadMore">' . 'Read More' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
	
	return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// get taxonomies terms links
function custom_taxonomies_terms_links(){
  $post = get_post( $post->ID );
  $post_type = $post->post_type;
  $taxonomies = get_object_taxonomies( $post_type, 'objects' );
  $out = array();
  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
    $terms = get_the_terms( $post->ID, $taxonomy_slug );

    if ( !empty( $terms ) ) {
      foreach ( $terms as $term ) {
        $out[] =
          '  <li class="licategory"><a href="'
        .    esc_url( get_permalink( get_page_by_title( 'Portfolio' ) ) ) . "?t=" . $term->slug .'" class="external">'
        .    $term->name 
        . "</a></li>\n";
      }
    }
  }

  return implode('', $out );
}
// get taxonomies terms links
function custom_taxonomies_terms_links_blog($total_pages_post = 1){
			  if($total_pages_post > 1){
		         $l_str = '<li class="licategory"><a href="'.esc_url( get_permalink( get_page_by_title( 'blog' ) ) ) . "page/" . $total_pages_post .'/">&nbsp;</a></li>';
			  }else{
		         $l_str = '<li class="licategory"><a href="'.esc_url( get_permalink( get_page_by_title( 'blog' ) ) ).'">&nbsp;</a></li>';
			  }
			  return $l_str;
}
//Completely Hellesh set of function for custom post type post navigation that traverse same category according to the query being used or supplied
function get_adjacent_post_plus($r, $previous = true ) {
	global $post, $wpdb;

	extract( $r, EXTR_SKIP );

	if ( empty( $post ) )
		return null;

//	Sanitize $order_by, since we are going to use it in the SQL query. Default to 'post_date'.
	if ( in_array($order_by, array('post_date', 'post_title', 'post_excerpt', 'post_name', 'post_modified')) ) {
		$order_format = '%s';
	} elseif ( in_array($order_by, array('ID', 'post_author', 'post_parent', 'menu_order', 'comment_count')) ) {
		$order_format = '%d';
	} elseif ( $order_by == 'custom' && !empty($meta_key) ) { // Don't allow a custom sort if meta_key is empty.
		$order_format = '%s';
	} elseif ( $order_by == 'numeric' && !empty($meta_key) ) {
		$order_format = '%d';
	} else {
		$order_by = 'post_date';
		$order_format = '%s';
	}
	
//	Sanitize $order_2nd. Only columns containing unique values are allowed here. Default to 'post_date'.
	if ( in_array($order_2nd, array('post_date', 'post_title', 'post_modified')) ) {
		$order_format2 = '%s';
	} elseif ( in_array($order_2nd, array('ID')) ) {
		$order_format2 = '%d';
	} else {
		$order_2nd = 'post_date';
		$order_format2 = '%s';
	}
	
//	Sanitize num_results (non-integer or negative values trigger SQL errors)
	$num_results = intval($num_results) < 2 ? 1 : intval($num_results);

//	Queries involving custom fields require an extra table join
	if ( $order_by == 'custom' || $order_by == 'numeric' ) {
		$current_post = get_post_meta($post->ID, $meta_key, TRUE);
		$order_by = ($order_by === 'numeric') ? 'm.meta_value+0' : 'm.meta_value';
		$meta_join = $wpdb->prepare(" INNER JOIN $wpdb->postmeta AS m ON p.ID = m.post_id AND m.meta_key = %s", $meta_key );
	} elseif ( $in_same_meta ) {
		$current_post = $post->$order_by;
		$order_by = 'p.' . $order_by;
		$meta_join = $wpdb->prepare(" INNER JOIN $wpdb->postmeta AS m ON p.ID = m.post_id AND m.meta_key = %s", $in_same_meta );
	} else {
		$current_post = $post->$order_by;
		$order_by = 'p.' . $order_by;
		$meta_join = '';
	}

//	Get the current post value for the second sort column
	$current_post2 = $post->$order_2nd;
	$order_2nd = 'p.' . $order_2nd;
	
//	Get the list of post types. Default to current post type
	if ( empty($post_type) )
		$post_type = "'$post->post_type'";

//	Put this section in a do-while loop to enable the loop-to-first-post option
	do {
		$join = $meta_join;
		$excluded_categories = $ex_cats;
		$included_categories = $in_cats;
		$excluded_posts = $ex_posts;
		$included_posts = $in_posts;
		$in_same_term_sql = $in_same_author_sql = $in_same_meta_sql = $ex_cats_sql = $in_cats_sql = $ex_posts_sql = $in_posts_sql = '';

//		Get the list of hierarchical taxonomies, including customs (don't assume taxonomy = 'category')
		$taxonomies = array_filter( get_post_taxonomies($post->ID), "is_taxonomy_hierarchical" );

		if ( ($in_same_cat || $in_same_tax || $in_same_format || !empty($excluded_categories) || !empty($included_categories)) && !empty($taxonomies) ) {
			$cat_array = $tax_array = $format_array = array();

			if ( $in_same_cat ) {
				$cat_array = wp_get_object_terms($post->ID, $taxonomies, array('fields' => 'ids'));
			}
			if ( $in_same_tax && !$in_same_cat ) {
				if ( $in_same_tax === true ) {
					if ( $taxonomies != array('category') )
						$taxonomies = array_diff($taxonomies, array('category'));
				} else
					$taxonomies = (array) $in_same_tax;
				$tax_array = wp_get_object_terms($post->ID, $taxonomies, array('fields' => 'ids'));
			}
			if ( $in_same_format ) {
				$taxonomies[] = 'post_format';
				$format_array = wp_get_object_terms($post->ID, 'post_format', array('fields' => 'ids'));
			}

			$join .= " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id AND tt.taxonomy IN (\"" . implode('", "', $taxonomies) . "\")";

			$term_array = array_unique( array_merge( $cat_array, $tax_array, $format_array ) );
			if ( !empty($term_array) )
				$in_same_term_sql = "AND tt.term_id IN (" . implode(',', $term_array) . ")";

			if ( !empty($excluded_categories) ) {
//				Support for both (1 and 5 and 15) and (1, 5, 15) delimiter styles
				$delimiter = ( strpos($excluded_categories, ',') !== false ) ? ',' : 'and';
				$excluded_categories = array_map( 'intval', explode($delimiter, $excluded_categories) );
//				Three category exclusion methods are supported: 'strong', 'diff', and 'weak'.
//				Default is 'weak'. See the plugin documentation for more information.
				if ( $ex_cats_method === 'strong' ) {
					$taxonomies = array_filter( get_post_taxonomies($post->ID), "is_taxonomy_hierarchical" );
					if ( function_exists('get_post_format') )
						$taxonomies[] = 'post_format';
					$ex_cats_posts = get_objects_in_term( $excluded_categories, $taxonomies );
					if ( !empty($ex_cats_posts) )
						$ex_cats_sql = "AND p.ID NOT IN (" . implode($ex_cats_posts, ',') . ")";
				} else {
					if ( !empty($term_array) && !in_array($ex_cats_method, array('diff', 'differential')) )
						$excluded_categories = array_diff($excluded_categories, $term_array);
					if ( !empty($excluded_categories) )
						$ex_cats_sql = "AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
				}
			}

			if ( !empty($included_categories) ) {
				$in_same_term_sql = ''; // in_cats overrides in_same_cat
				$delimiter = ( strpos($included_categories, ',') !== false ) ? ',' : 'and';
				$included_categories = array_map( 'intval', explode($delimiter, $included_categories) );
				$in_cats_sql = "AND tt.term_id IN (" . implode(',', $included_categories) . ")";
			}
		}

//		Optionally restrict next/previous links to same author		
		if ( $in_same_author )
			$in_same_author_sql = $wpdb->prepare("AND p.post_author = %d", $post->post_author );

//		Optionally restrict next/previous links to same meta value
		if ( $in_same_meta && $r['order_by'] != 'custom' && $r['order_by'] != 'numeric' )
			$in_same_meta_sql = $wpdb->prepare("AND m.meta_value = %s", get_post_meta($post->ID, $in_same_meta, TRUE) );

//		Optionally exclude individual post IDs
		if ( !empty($excluded_posts) ) {
			$excluded_posts = array_map( 'intval', explode(',', $excluded_posts) );
			$ex_posts_sql = " AND p.ID NOT IN (" . implode(',', $excluded_posts) . ")";
		}
		
//		Optionally include individual post IDs
		if ( !empty($included_posts) ) {
			$included_posts = array_map( 'intval', explode(',', $included_posts) );
			$in_posts_sql = " AND p.ID IN (" . implode(',', $included_posts) . ")";
		}

		$adjacent = $previous ? 'previous' : 'next';
		$order = $previous ? 'DESC' : 'ASC';
		$op = $previous ? '<' : '>';

//		Optionally get the first/last post. Disable looping and return only one result.
		if ( $end_post ) {
			$order = $previous ? 'ASC' : 'DESC';
			$num_results = 1;
			$loop = false;
			if ( $end_post === 'fixed' ) // display the end post link even when it is the current post
				$op = $previous ? '<=' : '>=';
		}

//		If there is no next/previous post, loop back around to the first/last post.		
		if ( $loop && isset($result) ) {
			$op = $previous ? '>=' : '<=';
			$loop = false; // prevent an infinite loop if no first/last post is found
		}
		
		$join  = apply_filters( "get_{$adjacent}_post_plus_join", $join, $r );

//		In case the value in the $order_by column is not unique, select posts based on the $order_2nd column as well.
//		This prevents posts from being skipped when they have, for example, the same menu_order.
		$where = apply_filters( "get_{$adjacent}_post_plus_where", $wpdb->prepare("WHERE ( $order_by $op $order_format OR $order_2nd $op $order_format2 AND $order_by = $order_format ) AND p.post_type IN ($post_type) AND p.post_status = 'publish' $in_same_term_sql $in_same_author_sql $in_same_meta_sql $ex_cats_sql $in_cats_sql $ex_posts_sql $in_posts_sql", $current_post, $current_post2, $current_post), $r );

		$sort  = apply_filters( "get_{$adjacent}_post_plus_sort", "ORDER BY $order_by $order, $order_2nd $order LIMIT $num_results", $r );

		$query = "SELECT DISTINCT p.* FROM $wpdb->posts AS p $join $where $sort";
		$query_key = 'adjacent_post_' . md5($query);
		$result = wp_cache_get($query_key);
		if ( false !== $result )
			return $result;

//		echo $query . '<br />';

//		Use get_results instead of get_row, in order to retrieve multiple adjacent posts (when $num_results > 1)
//		Add DISTINCT keyword to prevent posts in multiple categories from appearing more than once
		$result = $wpdb->get_results("SELECT DISTINCT p.* FROM $wpdb->posts AS p $join $where $sort");
		if ( null === $result )
			$result = '';

	} while ( !$result && $loop );

	wp_cache_set($query_key, $result);
	return $result;
}

/**
 * Display previous post link that is adjacent to the current post.
 *
 * Based on previous_post_link() from wp-includes/link-template.php
 *
 * @param array|string $args Optional. Override default arguments.
 * @return bool True if previous post link is found, otherwise false.
 */
function previous_post_link_plus($args = '') {
	return adjacent_post_link_plus($args, '&laquo; %link', true);
}

/**
 * Display next post link that is adjacent to the current post.
 *
 * Based on next_post_link() from wp-includes/link-template.php
 *
 * @param array|string $args Optional. Override default arguments.
 * @return bool True if next post link is found, otherwise false.
 */
function next_post_link_plus($args = '') {
	return adjacent_post_link_plus($args, '%link &raquo;', false);
}

/**
 * Display adjacent post link.
 *
 * Can be either next post link or previous.
 *
 * Based on adjacent_post_link() from wp-includes/link-template.php
 *
 * @param array|string $args Optional. Override default arguments.
 * @param bool $previous Optional, default is true. Whether display link to previous post.
 * @return bool True if next/previous post is found, otherwise false.
 */
function adjacent_post_link_plus($args = '', $format = '%link &raquo;', $previous = true) {
	$defaults = array(
		'order_by' => 'post_date', 'order_2nd' => 'post_date', 'meta_key' => '', 'post_type' => '',
		'loop' => false, 'end_post' => false, 'thumb' => false, 'max_length' => 0,
		'format' => '', 'link' => '%title', 'date_format' => '', 'tooltip' => '%title',
		'in_same_cat' => false, 'in_same_tax' => false, 'in_same_format' => false,
		'in_same_author' => false, 'in_same_meta' => false,
		'ex_cats' => '', 'ex_cats_method' => 'weak', 'in_cats' => '', 'ex_posts' => '', 'in_posts' => '',
		'before' => '', 'after' => '', 'num_results' => 1, 'return' => false, 'echo' => true
	);

//	If Post Types Order plugin is installed, default to sorting on menu_order
	if ( function_exists('CPTOrderPosts') )
		$defaults['order_by'] = 'menu_order';
	
	$r = wp_parse_args( $args, $defaults );
	if ( empty($r['format']) )
		$r['format'] = $format;
	if ( empty($r['date_format']) )
		$r['date_format'] = get_option('date_format');
	if ( !function_exists('get_post_format') )
		$r['in_same_format'] = false;

	if ( $previous && is_attachment() ) {
		$posts = array();
		$posts[] = & get_post($GLOBALS['post']->post_parent);
	} else
		$posts = get_adjacent_post_plus($r, $previous);

//	If there is no next/previous post, return false so themes may conditionally display inactive link text.
	if ( !$posts )
		return false;

//	If sorting by date, display posts in reverse chronological order. Otherwise display in alpha/numeric order.
	if ( ($previous && $r['order_by'] != 'post_date') || (!$previous && $r['order_by'] == 'post_date') )
		$posts = array_reverse( $posts, true );
		
//	Option to return something other than the formatted link		
	if ( $r['return'] ) {
		if ( $r['num_results'] == 1 ) {
			reset($posts);
			$post = current($posts);
			if ( $r['return'] === 'id')
				return $post->ID;
			if ( $r['return'] === 'href')
				return get_permalink($post);
			if ( $r['return'] === 'object')
				return $post;
			if ( $r['return'] === 'title')
				return $post->post_title;
			if ( $r['return'] === 'date')
				return mysql2date($r['date_format'], $post->post_date);
		} elseif ( $r['return'] === 'object')
			return $posts;
	}

	$output = $r['before'];

//	When num_results > 1, multiple adjacent posts may be returned. Use foreach to display each adjacent post.
	foreach ( $posts as $post ) {
		$title = $post->post_title;
		if ( empty($post->post_title) )
			$title = $previous ? __('Previous Post') : __('Next Post');

		$title = apply_filters('the_title', $title, $post->ID);
		$date = mysql2date($r['date_format'], $post->post_date);
		$author = get_the_author_meta('display_name', $post->post_author);
	
//		Set anchor title attribute to long post title or custom tooltip text. Supports variable replacement in custom tooltip.
		if ( $r['tooltip'] ) {
			$tooltip = str_replace('%title', $title, $r['tooltip']);
			$tooltip = str_replace('%date', $date, $tooltip);
			$tooltip = str_replace('%author', $author, $tooltip);
			$tooltip = ' title="' . esc_attr($tooltip) . '"';
		} else
			$tooltip = '';

//		Truncate the link title to nearest whole word under the length specified.
		$max_length = intval($r['max_length']) < 1 ? 9999 : intval($r['max_length']);
		if ( strlen($title) > $max_length )
			$title = substr( $title, 0, strrpos(substr($title, 0, $max_length), ' ') ) . '...';
	
		$rel = $previous ? 'prev' : 'next';

		$anchor = '<a href="'.get_permalink($post).'" rel="'.$rel.'"'.$tooltip.'>';
		$link = str_replace('%title', $title, $r['link']);
		$link = str_replace('%date', $date, $link);
		$link = $anchor . $link . '</a>';
	
		$format = str_replace('%link', $link, $r['format']);
		$format = str_replace('%title', $title, $format);
		$format = str_replace('%date', $date, $format);
		$format = str_replace('%author', $author, $format);
		if ( ($r['order_by'] == 'custom' || $r['order_by'] == 'numeric') && !empty($r['meta_key']) ) {
			$meta = get_post_meta($post->ID, $r['meta_key'], true);
			$format = str_replace('%meta', $meta, $format);
		} elseif ( $r['in_same_meta'] ) {
			$meta = get_post_meta($post->ID, $r['in_same_meta'], true);
			$format = str_replace('%meta', $meta, $format);
		}

//		Get the category list, including custom taxonomies (only if the %category variable has been used).
		if ( (strpos($format, '%category') !== false) && version_compare(PHP_VERSION, '5.0.0', '>=') ) {
			$term_list = '';
			$taxonomies = array_filter( get_post_taxonomies($post->ID), "is_taxonomy_hierarchical" );
			if ( $r['in_same_format'] && get_post_format($post->ID) )
				$taxonomies[] = 'post_format';
			foreach ( $taxonomies as &$taxonomy ) {
//				No, this is not a mistake. Yes, we are testing the result of the assignment ( = ).
//				We are doing it this way to stop it from appending a comma when there is no next term.
				if ( $next_term = get_the_term_list($post->ID, $taxonomy, '', ', ', '') ) {
					$term_list .= $next_term;
					if ( current($taxonomies) ) $term_list .= ', ';
				}
			}
			$format = str_replace('%category', $term_list, $format);
		}

//		Optionally add the post thumbnail to the link. Wrap the link in a span to aid CSS styling.
		if ( $r['thumb'] && has_post_thumbnail($post->ID) ) {
			if ( $r['thumb'] === true ) // use 'post-thumbnail' as the default size
				$r['thumb'] = 'post-thumbnail';
			$thumbnail = '<a class="post-thumbnail external" href="'.get_permalink($post).'" rel="'.$rel.'"'.$tooltip.'>' . get_the_post_thumbnail( $post->ID, $r['thumb'] ) . '</a>';
			$format = $thumbnail . '<span class="post-link">' . $format . '</span>';
		}

//		If more than one link is returned, wrap them in <li> tags		
		if ( intval($r['num_results']) > 1 )
			$format = '<li>' . $format . '</li>';
		
		$output .= $format;
	}

	$output .= $r['after'];

	//	If echo is false, don't display anything. Return the link as a PHP string.
	if ( !$r['echo'] || $r['return'] === 'output' )
		return $output;

	$adjacent = $previous ? 'previous' : 'next';
	echo apply_filters( "{$adjacent}_post_link_plus", $output, $r );

	return true;
}
//end of Hellesh set of function for custom post type post navigation that traverse same category according to the query being used or supplied

//This is use to create a ajax load for wordpress

function custom_ajax_process_request() {
	// first check if data is being sent and that it is the data we want
  	if ( isset( $_POST["post_var"] ) ) {
		echo do_shortcode('[recent_posts posts="4" post_content_length="5"]');
		die();
	}
}
add_action('wp_ajax_test_response', 'custom_ajax_process_request');
add_action('wp_ajax_nopriv_test_response', 'custom_ajax_process_request');



/*** Remove Query String from Static Resources ***/
function remove_cssjs_ver( $src ) {
 if( strpos( $src, '?ver=' ) )
 $src = remove_query_arg( 'ver', $src );
 return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 ); 
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' ); ?>