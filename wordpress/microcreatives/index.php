<?php
get_header();

global $global_theme_options;

$global_theme_options['blog_layout'] = "Normal";

get_template_part('sections/menu_section');

?>        
    
    <!-- Blog Header -->
    <div id="blog-header">
    
    	<?php echo '<h1>' . __('', THEME_LANGUAGE_DOMAIN) . '</h1>'; ?>
    
    </div>
    <!--/Blog Header -->
    
    
    
    
    
    <!-- Blog Content -->
    <div id="blog" class="clearfix">

        <!-- Container -->
    	<div class="container">
        
        
            <!-- Blog Posts Content -->
    		<div class="three_fourth blog-posts-content">

<?php
    // the loop
    while(have_posts()){ 

    	the_post();
    	
    	get_template_part( 'blog-post-format/blog-post', get_post_format() ); 
 
	} 
?>            	
    		
			</div>
            <!--/Blog Posts Content -->    		
    		

			<?php if( is_active_sidebar( 'blog-sidebar' ) ){ ?>
            <!-- Sidebar -->
            <div id="sidebar" class="one_fourth last">

                <?php dynamic_sidebar( 'blog-sidebar' ); ?>

            </div>
            <!--/Sidebar -->
        	<?php } ?>   		
    		
            
        </div>
    	<!--/Container -->
        
    </div>
    <!--/Blog Content -->
    
    		    
<?php

if(function_exists('wp_paginate')) {
    wp_paginate();
}
else {
	mc_pagination();
}
wp_reset_query();
?>
    <div class="cta">
        <div class="angelSet" style="background-color: #aac631;">
        <div class="container"><span class="animAngel animAngelPlayIn" style="background: url('<?php echo do_shortcode('[homeurl]');?>/wp-content/uploads/2014/05/Angel-CTA-start.png')"><img class="alignnone size-full wp-image-349" alt="blank" src="<?php echo do_shortcode('[homeurl]');?>/wp-content/uploads/2014/03/blank.png" width="300"></span><span class="angelReady"><span class="angelH1Style">Ready To Start Your Projects?<span class="angelH3Style">Take the first step and fill out the project briefs today!</span></span><span class="angelBtn"><a class="external mc-button large  outline black" href="<?php echo do_shortcode('[homeurl]');?>/resources/">START NOW</a></span></span></div>
        </div>    
    </div>
<?php
get_footer();
?>
<script type="text/javascript">

var controller01 = new ScrollMagic({
		  			globalSceneOptions: {
		  				triggerHook: "onLeave",
						reverse:true
		  			}
		  		});

xx = new ScrollScene({triggerElement: ".angelSet", duration: 250,offset: -150})
			.addTo(controller01)
                        .triggerHook("onCenter")
.on("enter", function(event){
jQuery(".animAngel").removeClass("animAngelPlayOut");
jQuery(".animAngel").addClass("animAngelPlayIn");
}).on("leave", function(event){
if(event.scrollDirection == 'REVERSE'){
jQuery(".animAngel").removeClass("animAngelPlayIn");
jQuery(".animAngel").addClass("animAngelPlayOut");
}
});
</script>