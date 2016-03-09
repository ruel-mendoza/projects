<?php
/*
Template name: Blog Template
*/

get_header();

global $global_theme_options;

$global_theme_options['blog_layout'] = "Normal";

get_template_part('sections/menu_section');

if( have_posts() ){

    the_post();

    // retrieve the background color for this section. A section has gray background (#f5f5f5) by default, therefore
    // we care only if the section has white background
    $section_style = '';
    if( get_post_meta(get_the_ID(), 'mc_page_default_background', true) == 'white' ){

        $section_style = 'style="background-color:#FFF;"';
    }

    $container_type = get_post_meta(get_the_ID(), 'mc_page_default_container', true);
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

<section id="<?php echo $post->post_name; ?>" class="content" <?php echo $section_style; ?> >
        <!-- Container -->
        	<?php 
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
			?>
            <div class="BlogHeader" style="background: url('<?php echo $large_image_url[0];?>');background-size: auto, 100%;background-repeat: no-repeat;background-position: top center;">
                <div class="BlogPage homebanner" style="margin-bottom: 0px;">
                    <div class="homebannerInner" style="text-align: center;margin: 12.37% auto;">
                       <?php if( get_post_meta( $post->ID, "mc_show_page_title", true ) == "yes" ){ ?>
                        <!-- Section Title -->
                            <h2 class="homeh2"><?php the_title(); ?></h2>
                            <h4 class="homeh4"><?php echo get_post_meta(get_the_ID(), 'mc_page_subtitle', true); ?></h4>
                        <!--/Section Title -->
                        <?php } ?>        
                    </div>
                </div>
            </div>        
        <!-- Container --> 
<?php
	the_content();
}
?>
	</section>	
    <!-- Blog Contents -->
    <div id="blog" class="clearfix">

    <!-- Container -->
    <div class="container">


        <!-- Blog Posts Content -->
        <div class="three_fourth blog-posts-content">

            <?php

            global $paged;
            query_posts('numberposts=-1&post_type=post&paged='.$paged);

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
    <div class="cta"></div>
<?php
get_footer();

?>