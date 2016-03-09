<?php 
/*
Template name: Thankyou Template
*/
get_header(); 

global $global_theme_options;

?>

    <!-- Home Section -->
    <div id="thank-you">

        <div class="home-pattern">

            <div class="container clearfix">
                <!-- <div id="tymsg"></div> -->
                <div id="home-center" class="element_fade_in">

                    <div class="div-align-center tymsg">

                        <strong><a href="http://microcreatives.com/" style="color:#e97626;font-family:Raleway;">Click to continue ›</a></strong>
                        

                        <!-- <h1 class="four-zero-four "><span class="text-color"><?php the_title(); ?></span></h1> -->

                        <p class="below-four-zero-four">
                            <?php
                            /*if( have_posts() ){
                                the_post();
                                the_content();
                            }*/
                            ?>                        
                        </p>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <style type="text/css">
        .tymsg{
            /*remove*/
            /*height: 111px;*/
            font-size: 18px;
        }  

        @media only screen and (max-width: 480px){
            .tymsg{
                font-size: 14px;
            }  
        }

        @media only screen and (min-width: 1024px){
            .tymsg{
                /*remove*/
                /*height: 300px;*/
                font-size: 18px;
            }
        }

    </style>
    <!-- End Home Section -->
    
<?php get_footer(); ?>