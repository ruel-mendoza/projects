<?php

get_header();

global $global_theme_options;

get_template_part('sections/menu_section');

if ( have_posts() ) {

    the_post();
            $total_post_count = wp_count_posts();
            $published_post_count = $total_post_count->publish;
            $total_pages = ceil( $published_post_count / $posts_per_page );     
        
              $position_query = array( 'post_type' => 'post','order'=>'DESC', 'numberposts' => -1 );
              $position_posts = get_posts($position_query); $count = 0;
            
              foreach ($position_posts as $position_post) { $count++;
                    if ($position_post->ID == $post->ID) { $current_page = $count; break; }
              }
            
              $total_posts = count($position_posts);
              $total_pages_post = ceil( $current_page / $posts_per_page );  
              
?>
    
    
    <!-- Blog Header -->
    <div id="blog-header">
    </div>
    <!--/Blog Header -->



    <style type="text/css">

        @media only screen and (min-width: 769px) and (max-width: 1023px){
            .mc-blog-post-content, .mc-sidebar{
                margin-top:10px;
            }
            .mc-blog-content{
                margin-left: 3%;
                width: 70%;
            }
            .mc-blog-content .post{
                width: 95%;
            }
        }
        @media only screen and (min-width: 1024px){
            .mc-blog-content{
                width: 70%;
            }
            .mc-blog-content .post{
                width: 95%;
            }
        }

        @media only screen and (max-width: 768px){
            .mc-blog-content{
                margin-left: 3%;
                width: 95%;
            }
            .mc-blog-content .post{
                width: 95%;
            }
            .post-content{
                width: 100%;
            }

        }

    </style>


    <div id="blog" class="clearfix">
<!-- Blog Content -->
        <!--/Container -->
        <div class="container no-padding post-nav">
        
            <ul class="inner-navigation masonry clearfix">
                <?php previous_post_link( '<li class="blog-pagination-prev">%link</li>', '<span style="background:url(' . get_template_directory_uri() . '/images/next_article_org.png)" class="prev"></span>'); ?>
                <?php echo custom_taxonomies_terms_links_blog($total_pages_post); ?>
                <?php next_post_link( '<li class="blog-pagination-next">%link</li>', '<span style="background: url(' . get_template_directory_uri() . '/images/prev_article_org.png)" class="next"></span>'); ?>
                
            </ul>
        
        </div>
        <!--/Container -->          
        <!-- Container -->
        <div class="container no-padding">
        
        
            <!-- Blog Posts Content -->
            <div class="blog-posts-content mc-blog-post-content">


                <div class="mc-blog-content">



                <!-- Blog Post -->
                <div id="post-<?php the_ID(); ?>" <?php post_class("blog-post three_fourth"); ?>>

                        <?php get_template_part( 'blog-post-format/single', get_post_format() );  ?>

                        <?php if( $global_theme_options['blog_post_title'] ) { ?>
                        <h3 class="blog-title"><?php the_title(); ?></h3>
                        <?php } ?>

                        <!--p class="blog-meta">
                            <?php if( $global_theme_options['author_info'] ){ ?>
                                <?php _e( 'Posted by', THEME_LANGUAGE_DOMAIN ); ?> <?php the_author_posts_link(); ?> |
                            <?php } ?>
                            <?php if ( has_tag() ) { ?>
                                <?php the_tags('', ' · ', ''); ?> |
                            <?php } else { ?>
                                <?php _e( 'No Tags', THEME_LANGUAGE_DOMAIN ); ?> |
                            <?php } ?>
                            <?php the_category(' · '); ?>
                            <?php if( $global_theme_options['blog_comments'] ){ ?>
                             | <?php comments_popup_link(); ?>
                            <?php } ?>
                        </p-->
                        
                        <!--div class="blog-border"></div-->   
                                        
                        <!-- Blog Content -->
                        <div class="blog-content">
                            <?php the_content(); ?>
                            
                            <div class="page-links">
                            <?php
                                
                                wp_link_pages();

                            ?>
                            </div>
                            
                        </div>
                        <!--/Blog Content -->
                        
                        
                        <hr>
                                                
                        <?php comments_template(); ?>                        
                        
                    </div>
                    <!--/Post Content -->
                
                
                </div>
                <!-- Blog Post -->

            </div>
                    <?php if( is_active_sidebar( 'blog-sidebar' ) ){ ?>
                                <!-- Sidebar -->
                                <div id="sidebar" class="mc-sidebar one_fourth last">
                            
                                    <?php dynamic_sidebar( 'blog-sidebar' ); ?>
                            
                                </div>
                                <!--/Sidebar -->
                        <?php } ?>            
            </div>
            <!-- Blog Posts Content -->
            
        </div>
        <!--/Container -->
<!-- Blog Navigation -->
    <div id="blog-footer" class="clearfix">
        
        <!--/Container -->
        <div class="container no-padding post-nav">

            <ul class="inner-navigation masonry clearfix">
                <?php previous_post_link( '<li class="blog-pagination-prev">%link</li>', '<span style="background:url(' . get_template_directory_uri() . '/images/next_article_org.png)" class="prev"></span>'); ?>
                <?php echo custom_taxonomies_terms_links_blog($total_pages_post); ?>
                <?php next_post_link( '<li class="blog-pagination-next">%link</li>', '<span style="background: url(' . get_template_directory_uri() . '/images/prev_article_org.png)" class="next"></span>'); ?>
                
            </ul>
        
        </div>
        <!--/Container -->
    
    </div>
    <!--/Blog Navigation -->        
    </div>
    <!--/Blog Content -->
    
    
    
    
    
<?php

} // if have posts
            
wp_reset_query();
?>
<div class="cta"></div>
<?php
get_footer();
?>