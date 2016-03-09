					<div class="type-date">                    
                    	<div class="blog-type"><img src="<?php echo get_template_directory_uri()."/images/blog-audio.png"; ?>" alt=""></div>
                        <div class="blog-date"><h5><?php the_time('d'); ?></h5><h5><?php the_time('M'); ?></h5></div>                    
                    </div>
                	
                    
                    <!-- Post Content -->
                	<div class="post-content">

                        <?php if( get_post_meta( $post->ID, 'newave_blog_post_audio', true ) ){ ?>
                        <div class="audio-wrapper">
                            <div class="audio-container">
                                <?php echo get_post_meta( $post->ID, 'newave_blog_post_audio', true ); ?>
                            </div>
                        </div>
                        <?php } ?>