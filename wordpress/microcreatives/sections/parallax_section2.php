<!-- Parallax Section -->

<div id="<?php echo $post->post_name; ?>" class="parallax <?php echo (get_post_meta(get_the_ID(), 'mc_page_parallax_background_image', true) != '') ? 'parallaxz': ''?>" style=" <?php echo (get_post_meta(get_the_ID(), 'mc_page_parallax_background_image', true) != '') ? "background-image: url('".get_post_meta(get_the_ID(), 'mc_page_parallax_background_image', true)."');" : "" ?>">
  <div id="<?php echo $post->post_name; ?>2" class="parallax <?php echo (get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay', true) != '') ? 'parallaxz': ''?>" style="background-image: url('<?php echo get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay', true); ?>');">
    <div id="<?php echo $post->post_name; ?>3" class="parallax <?php echo (get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay2', true) != '') ? 'parallaxz': ''?>" style="background-image: url('<?php echo get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay2', true); ?>');">
      <div id="<?php echo $post->post_name; ?>4" class="parallax <?php echo (get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay3', true) != '') ? 'parallaxz': ''?>" style="background-image: url('<?php echo get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay3', true); ?>');">
        <div id="<?php echo $post->post_name; ?>5" class="parallax <?php echo (get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay4', true) != '') ? 'parallaxz': ''?>" style="background-image: url('<?php echo get_post_meta(get_the_ID(), 'mc_page_parallax_background_image_overlay4', true); ?>');">
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
        }
        else if( $overlay_type == 'color_dark' ){

            $overlay_type = 'parallax-overlay';
        }
        else if( $overlay_type == 'color_primary' ){

            $overlay_type = 'parallax-overlay parallax-background-color';
        }
        else if( $overlay_type == 'color_none' ){

            $overlay_type = 'no-overlay';
        }
        else {

            $overlay_type = '';
        }
        ?>
          <div class="<?php echo $overlay_type; ?>">
            <div class="container <?php echo $container_type; ?>">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
	  </div>
	</div>
  </div>
</div>        
<!--/Parallax Section -->