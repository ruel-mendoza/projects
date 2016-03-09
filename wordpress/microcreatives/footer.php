<?php

global $global_theme_options;

$social_links = array(  "Facebook"      => "facebook",
                        "Twitter"       => "twitter",
                        "Linkedin"      => "linkedin",
                        "Behance"       => "behance",
                        "Deviantart"    => "deviantart",
                        "Dribble"       => "dribble",
                        "Flickr"        => "flickr",
                        "Google+"       => "google",
                        "Lastfm"        => "lastfm",
                        "Picasa"        => "picasa",
                        "Pinterest"     => "pinterest",
                        "RSS"           => "rss",
                        "Skype"         => "skype",
                        "Stumble"       => "stumble",
                        "Vimeo"         => "vimeo",
                        "Youtube"       => "youtube"
                    );

?>
    
    <!-- Footer -->
    <footer>
		<div class="container no-padding" style="overflow:hidden;">
			<?php dynamic_sidebar( 'footer-sidebar' ); ?>        
            <div style="clear:both;border-bottom: 1px solid #2e2e2e;margin-bottom: 30px;"></div>
			<p class="copyright"><?php echo $global_theme_options['footer_text']; ?></p>
			<p class="powerby">Powered by<br><img src="<?php echo get_template_directory_uri()?>/images/microsourcing_logo.png" alt="MicroSourcing logo"></p>
		</div>
	</footer>
	<!--/Footer -->

<?php wp_footer(); ?>

</body>
	
	<?php get_template_part("inline_scripts"); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51066257-1', 'auto');
  ga('send', 'pageview');

</script>
</html>