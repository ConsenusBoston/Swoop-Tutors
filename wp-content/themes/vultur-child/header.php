<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vultur
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-178538499-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-178538499-1');
    </script>

        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '696087244648367'); 
        fbq('track', 'PageView');
        </script>
        <noscript>
        <img height="1" width="1" 
        src="https://www.facebook.com/tr?id=696087244648367&ev=PageView
        &noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
	
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php
    $vultur_data = '';
    if (function_exists('fw_get_db_settings_option')) :
        $vultur_data = fw_get_db_settings_option();
    endif;
    $loader_image = '';
    if (!empty($vultur_data['loader_image']['url'])) :
        $loader_image = $vultur_data['loader_image']['url'];
    else :
        $loader_image = get_template_directory_uri() . '/assets/images/loader.gif';
    endif;
    $loader_switch = '';
    if (!empty($vultur_data['loader_switch'])) :
        $loader_switch = $vultur_data['loader_switch'];
    endif;
    if ($loader_switch == 'on') :
        if (!empty($loader_image)) :
    ?>
            <div id="preloader">
                <div id="status">
                    <img src="<?php echo esc_url($loader_image); ?>" alt="<?php esc_attr_e('loader', 'vultur'); ?>">
                </div>
            </div>
    <?php
        endif;
    endif;
    get_template_part('vendor/header/vultur-header', 'main');
    ?>