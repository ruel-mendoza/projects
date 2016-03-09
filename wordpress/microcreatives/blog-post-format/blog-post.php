<?php

global $global_theme_options;

$post_icon = get_template_directory_uri()."/images/blog-text.png";
if( has_post_thumbnail() )
    $post_icon = get_template_directory_uri()."/images/blog-image.png";

?>
    			<!-- Blog Post -->
    			<?php if( $global_theme_options['blog_layout'] == "Normal" ) { ?>
    			<div id="post-<?php the_ID(); ?>" <?php post_class("blog-post"); ?>>
    			<?php } else { ?>
    			<div id="post-<?php the_ID(); ?>" <?php post_class("blog-post masonry"); ?>>
    			<?php } ?>
    			
    				<?php if( $global_theme_options['blog_layout'] == "Normal" ) { ?>
                    <a href="<?php the_permalink(); ?>" class="external">
                    <div class="type-date bluedate">
                        <div class="blog-date"><h5><?php the_time('d'); ?></h5><h5><?php the_time('M'); ?></h5></div>                    
                    </div>
                    </a>
                    <?php } ?>
                	
                    
                    <!-- Post Contents -->
                	<div class="post-content">

                        <?php if( has_post_thumbnail() ){
                            $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array(385, 304));
                        ?>
                        <div class="post-slider one_half">
                            <ul class="blog-slider">
                                <li><img src="<?php echo $full_image[0]; ?>" alt="" width="<?php echo $full_image[1]; ?>" height="<?php echo $full_image[2]; ?>"></li>
                            </ul>
                        </div>
                        <?php }else{?>
                        <div class="post-slider one_half">
                            <ul class="blog-slider">
                                <li><img src="<?php echo get_template_directory_uri() ?>/images/blog-no-image.png" alt="" width="385" height="304"></li>
                            </ul>
                        </div>
						<?php }?>
                        <div class="one_half last">
                        <div class="post-excerpt">
                        <h5 class="the-date"><i class="fa fa-clock-o"></i><?php the_time('F j, Y'); ?></h5>
                        <?php get_template_part('blog-post-format/post-common'); ?>
                        </div>
                        </div>
                    
                    </div>
                	<!--/Post Content -->
                    
                </div>
            	<!-- Blog Post -->


