<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
if(isset($_SESSION['myKey'])) {
    $value = $_SESSION['myKey'];
} else {
    $value = 'false';
}
?>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, minimal-ui">
    <title><?php wp_title('', true, 'right'); ?> | <?php bloginfo('name'); ?></title>

    <?php global $global_theme_options; ?>
    
    <link rel="shortcut icon" href="<?php if( $global_theme_options['favicon'] ){ echo $global_theme_options['favicon']; } else { echo get_template_directory_uri()."/images/favicon.ico"; } ?>">
	<?php
	echo "<script> jLoader = ".$value."</script>"; 
    ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-spy="scroll" data-target=".navbar" data-offset="75">
	<a id="back-top"><div id="menu_top" class="nodisplay"><div id="menu_top_inside"></div></div></a>
    <?php
    if( $global_theme_options['loading_img'] ){
    ?>
    <!-- Preloader -->
		<div class="mask"><div id="loader" class="bird"></div></div>
    <!--/Preloader -->
	<?php			
    }
	