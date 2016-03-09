    <!-- Parallax Section -->
	<div id="<?php echo $post->post_name; ?>" class="scene">
    <ul id="scene" class="scene">
    <?php
	$min = -2;
	$max = 2;
    ?>
<?php if(get_post_meta(get_the_ID(), 'mc_page_parallax_background_image', true) != '') { ?>    
        <li class="layer layer1"><div class="background parallax parallaxz scrollable" style="height: initial;background-image: url('<?php echo get_post_meta(get_the_ID(), 'mc_page_parallax_background_image', true); ?>');"></div></li>
<?php } else { ?>
        <li class="layer layer1"><div class="background parallax parallaxz"></div></li>
<?php } ?>
<?php if(get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay', true) != '') { ?>    
        <li class="layer layer2" data-depth="0.23"><div class="background" style="height: initial;background-image: url('<?php echo get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay', true); ?>');"></div></li>
<?php } else { ?>
        <li class="layer layer2" data-depth="0.23"><div class="background parallax parallaxz"></div></li>
<?php } ?>
<?php if(get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay2', true) != '') { ?>    
        <li class="layer layer3" data-depth="-0.25"><div class="background" style="height: initial;background-image: url('<?php echo get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay2', true); ?>');"></div></li>
<?php } else { ?>
        <li class="layer layer3" data-depth="-0.25"><div class="background parallax parallaxz"></div></li>        
<?php } ?>
<?php if(get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay3', true) != '') { ?>    
        <li class="layer layer4" data-depth="-0.5"><div class="background" style="height: initial;background-image: url('<?php echo get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay3', true); ?>');"></div></li>
<?php } else { ?>
        <li class="layer layer4" data-depth="-0.5"><div class="background parallax parallaxz"></div></li>        
<?php } ?>
<?php if(get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay4', true) != '') { ?>    
        <li class="layer layer5" data-depth="0.5"><div class="background" style="height: initial;background-image: url('<?php echo get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay4', true); ?>');"></div></li>
<?php } else { ?>
        <li class="layer layer5" data-depth="0.5"><div class="background parallax parallaxz"></div></li>        
<?php } ?>
        <li class="layer layer6" data-depth="0.0">
	        <div id="<?php echo $post->post_name; ?>" style="text-align:center;">
                <?php
                $container_type = get_post_meta(get_the_ID(), 'mc_page_parallax_container', true);
                if( $container_type == 'normal' ){
        
                    $container_type = '';
                }
                else if( $container_type == 'small' ){
        
                    $container_type = 'small-width';
                }
                else if( $container_type == 'full' ){
        
                    $container_type = 'full-width';
                }
                else {
        
                    $container_type = '';
                }
                ?>
        
                <?php
                $overlay_type = get_post_meta(get_the_ID(), 'mc_page_parallax_image_overlay', true);
                if( $overlay_type == 'pattern' ){
        
                    $overlay_type = 'parallax-pattern-overlay';
                } else if( $overlay_type == 'color_dark' ) {
        
                    $overlay_type = 'parallax-overlay';
                } else if( $overlay_type == 'color_primary' ) {
        
                    $overlay_type = 'parallax-overlay parallax-background-color';
                } else if( $overlay_type == 'color_none' ) {
        
                    $overlay_type = 'no-overlay';
                } else  {
                    $overlay_type = '';
                }
                ?>
            	<div class="<?php echo $overlay_type; ?>">
                    <div class="container <?php echo $container_type; ?>">
                    
                        <?php the_content(); ?>
                        
                    </div>    
            	</div>
            </div>       
        </li>
    </ul> 
	</div>
    <!--/Parallax Section -->