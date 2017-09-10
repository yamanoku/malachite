<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/reset.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosansjapanese.css" type="text/css">
        <?php 
		$content_text_color = get_option('content_text_color');
		$content_main_color = get_option('content_main_color');
		$content_sub_color = get_option('content_sub_color');
		$content_hover_color = get_option('content_hover_color');
	?>
        <style>body{color:<?php echo $content_text_color; ?>}
	a{color:<?php echo $content_main_color; ?>}
	header{background:<?php echo $content_main_color;?>}
	.news-cat a{background:<?php echo $content_main_color; ?>}
	.pagination > ul > li{background:<?php echo $content_main_color; ?>;color:<?php echo $content_main_color; ?>;}
	.nav-below a{background:<?php echo $content_main_color; ?>}
	#respond .form-submit input{background:<?php echo $content_main_color; ?>}
	.widget-container h3{background:<?php echo $content_main_color; ?>}
	.gb-nav{background:<?php echo $content_sub_color; ?>}
	.gb-nav li a:hover{background:<?php echo $content_hover_color; ?>}
	#respond .form-submit input:hover{background:<?php echo $content_hover_color; ?>}
	.nav-below a:hover{background:<?php echo $content_hover_color; ?>}</style>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>

<a class="sitetitle" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
<h1 class="sitename"><?php bloginfo( 'name' ); ?></h1>
<h2 class="sitedisc"><?php bloginfo('description'); ?></h2>
<p class="siteimage"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="header-images" /></p>
</a>

<div class="sp-menu">MENU</div>
<?php wp_nav_menu( array (
'theme_location' => 'gb-nav',
'container_class' => 'gb-nav',
'menu_class' => 'gb-menu',
'fallback_cb' => false
)); ?>

</header>