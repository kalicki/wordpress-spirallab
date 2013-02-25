<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>> 
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); echo ' - '; bloginfo('description'); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- Mobile Viewport -->
    <meta name="viewport" content="width=device-width" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/favicon.png">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/foundation.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" type="text/css" media="all">

    <!-- CSS3 Media Queries -->
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>           
    <![endif]-->

    <!-- HTML5 JS -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
   
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="row">
        <hgroup class="site-title twelve columns">
            <a href="<?php bloginfo('url'); ?>"><h1>Cinema Fictício</h1></a>
            <h4 class="subheader"><?php bloginfo('description'); ?></h4>       
        </hgroup>
    </div>
    
    <div class="row">        
        <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'nav-bar', 'fallback_cb' => 'grau_page_menu', 'container' => 'nav', 'container_class' => 'twelve columns', 'walker' => new spirallab_walker())); ?>
    </div>
</header>