<?php

$post_icon = get_template_directory_uri()."/images/blog-text.png";
if( has_post_thumbnail() )
    $post_icon = get_template_directory_uri()."/images/blog-image.png";

?>

                        <h5 class="the-date"><span style="margin-right:20px"><i class="fa fa-clock-o"></i> <?php the_time('F j, Y'); ?></span><span style="margin-right:20px"><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span><i class="fa fa-comment"></i> <?php comments_popup_link(); ?></h5>                   
                                        
                    <!-- Post Contents -->
                	<div class="post-content">                  
