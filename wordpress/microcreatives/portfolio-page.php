<?php
/*
Template name: Portfolio Template
*/

get_header();
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

<!-- Portfolio -->
<section id="<?php echo $post->post_name; ?>" class="content" <?php echo $section_style; ?> > 
  <!-- Container -->
  <?php 
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
?>
  <div class="PortfolioHeader" style="background: url('<?php echo $large_image_url[0];?>');">
    <div class="PortfolioPage homebanner" style="margin-bottom: 0px;">
      <div class="homebannerInner" style="text-align: center;margin: 12.38% auto;">
        <?php if( get_post_meta( $post->ID, "mc_show_page_title", true ) == "yes" ){ ?>
        <!-- Section Title -->
        <h2 class="homeh2">
          <?php the_title(); ?>
        </h2>
        <h4 class="homeh4"><?php echo get_post_meta(get_the_ID(), 'mc_page_subtitle', true); ?></h4>
        <!--/Section Title -->
        <?php } ?>
      </div>
    </div>
  </div>
  <!-- Container -->
  
  <div class="portfolio-top"></div>
  
  <!-- Portfolio Plus Filters -->
  <div class="container">
    <div class="portfolio">
      <?php
       global $global_theme_options;
       $style_filters = '';
       if( isset( $global_theme_options['show_portfolio_filter'] ) && ($global_theme_options['show_portfolio_filter'] != 1) ){
           $style_filters = 'style="display: none"';
       }
       $portfolio_columns = 4;
       if( isset($global_theme_options['portfolio_columns']) && $global_theme_options['portfolio_columns'] ){

           $portfolio_columns = $global_theme_options['portfolio_columns'];
       }
       wp_localize_script( 'scriptsjs', 'PortfolioColumnsOptions',array( "columns_no" => $portfolio_columns ) );
       ?>
      <!-- Portfolio Filters -->
      <div  id="filters" class="sixteen columns" <?php echo $style_filters; ?>>
        <ul class="clearfix porfolio-tab">
          <?php
				$count = 0;
            	$portfolio_category = get_terms('portfolio_category', array( 'hide_empty' => 0 ));
            	if($portfolio_category){
            		foreach($portfolio_category as $portfolio_cat){
						  if($count == 0){
							?>
          <li><a href="#" data-filter=".<?php echo $portfolio_cat->slug; ?>" class="active">
            <h5><?php echo  $portfolio_cat->name; ?></h5>
            </a></li>
          <?php
						  }else{
							?>
          <li><a href="#" data-filter=".<?php echo $portfolio_cat->slug; ?>">
            <h5><?php echo  $portfolio_cat->name; ?></h5>
            </a></li>
          <?php                      
						  }
						  $count =+ 1;
                    }
				}
            ?>
        </ul>
      </div>
      
      <!--/Portfolio Filters --> 
      
      <!-- Portfolio Wrap -->
      <div id="portfolio-wrap">
        <?php
        	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array('post_type' => 'mc_portfolio','paged' => $paged,'posts_per_page' => 1000,);
            $pcats = get_post_meta(get_the_ID(), 'mc_portfolio_category', true);
            if( $pcats && $pcats[0] == 0 ) {
				unset($pcats[0]);
            }
            if( $pcats ){
				$args['tax_query'][] = array('taxonomy' => 'portfolio_category','field' => 'ID','terms' => $pcats);
            }
			
            $gallery = new WP_Query($args);
			
					
            while($gallery->have_posts()){
            	
            	$gallery->the_post();
						
                 if( has_post_thumbnail() ){
	
                 	$item_classes 		= '';
                 	$item_categories 	= '';
					$item_cats = get_the_terms($post->ID, 'portfolio_category');
						if($item_cats){
	
							foreach($item_cats as $item_cat) {
								$item_classes 		.= $item_cat->slug . ' ';
								$item_categories 	.= $item_cat->name . ' / ';
							}
							$item_categories = rtrim($item_categories, ' / ');
	
						}
						$full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
						$thumbnail  = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-thumbnail');
        ?>
        
                <!-- Portfolio Item -->
                <div class="portfolio-item one-four <?php echo $item_classes; ?>">
                  <div class="portfolio-image" style="background-image: url('<?php echo $full_image[0]; ?>')"> </div>
                  <?php
                        $post_layout = get_post_meta(get_the_ID(), 'mc_portfolio_item_layout', true);
                        
                        if( $post_layout == "image_popup" ){ ?>
                  <a title="<?php the_title(); ?>" rel="prettyPhoto[galname]" href="<?php echo $full_image[0]; ?>">
                  <?php } ?>
                  <?php if( $post_layout == "external" ){ ?>
                  <a href="<?php the_permalink(); ?>" class="external">
                  <?php } ?>
                  <div class="project-overlay">
                    <?php
                        if( ($post_layout == "normal") || ($post_layout == "slider") || ($post_layout == "full_screen") ){
                            ?>
                    <div class="open-project-link"> <a class="open-project" href="<?php the_permalink(); ?>" title="Open Project"></a> </div>
                    <?php
                        }else{
                   ?>
                    <div class="open-project-link"> <a class="open-project external" href="<?php the_permalink(); ?>" title="Open Project"></a> </div>
                    <?php
                        }
                        ?>
                    <div class="project-info">
                      <div class="zoom-icon"></div>
                      <h4 class="project-name">
                        <?php the_title(); ?>
                      </h4>
                      <p class="project-categories"><?php echo $item_categories; ?></p>
                    </div>
                  </div>
                  <?php if( $post_layout == "image_popup" ){ ?>
                  </a>
                  <?php } ?>
                  <?php if( $post_layout == "external" ){ ?>
                  </a>
                  <?php } ?>
                </div>
                <!--/Portfolio Item -->
        <?php
                 } // if post has thumbnail
            } // while gallery has posts 
            /*
              CREATIVE WRITING PLACEHOLDER
            */
            ?>
        <div id="placeholder" class="creative-writing" style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 341px, 0px) scale3d(1, 1, 1); opacity: 1; width: 100% !important; height: 400px;">
          <div id="placeholder-image"> <img src="http://microcreatives.com/wp-content/themes/microcreatives/images/CopyWriter-Placeholder.png"> </div>
          <h2 id="placeholder-title" class="lineh230">Creative Writing</h2>
          <p id="placeholder-text" class="lineh180 fontSize115">Looking for samples of our copywriting work? Unfortunately, we are under NDA contracts with most of our clients. What we can tell you is that we have written for various types of companies in various types of industries. We have written for a church that provides salon services; we have written about e-commerce shops that offer knowledge from the stars; we have written about how plumbing should be done by professionals. From finance-related news to travel-related articles, our copywriters have almost read and written about it all (yes, even about the adult industry). Do check our blog to see what our copywriters are up to.</p>
        </div>
        <?php
            /*
              END CREATIVE WRITING PLACEHOLDER
            */
       ?>
      </div>
      <!--/Portfolio Wrap --> 
      
    </div>
  </div>
  <!--/Portfolio Plus Filters -->
  
  <div class="portfolio-bottom"></div>
  
  <!-- Project Page Holder-->
  <div id="project-page-holder">
    <div class="clear"></div>
    <div id="project-page-data"></div>
  </div>
  <!--/Project Page Holder--> 
  
  <!-- Container -->
  <div class="container <?php echo $container_type; ?>">
    <?php

                wp_reset_postdata();

                the_content();

           ?>
  </div>
  <!-- Container --> 
  
</section>
<!--/Portfolio -->

<?php
}
get_footer();