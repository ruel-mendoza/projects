					<div class="type-date">                    
                    	<div class="blog-type"><img src="<?php echo get_template_directory_uri()."/images/blog-quote.png"; ?>" alt=""></div>
                        <div class="blog-date"><h5><?php the_time('d'); ?></h5><h5><?php the_time('M'); ?></h5></div>                    
                    </div>
                	
                    
                    <!-- Post Content -->
                	<div class="post-content">
                            
                        <div class="post-quote">
                        	<?php echo get_post_meta($post->ID, 'newave_blog_post_quote', true); ?>
                        </div>
                    