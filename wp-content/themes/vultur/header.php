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
</head> 
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
$vultur_data = '';
if(function_exists('fw_get_db_settings_option')):
   $vultur_data = fw_get_db_settings_option();
endif;
$loader_image = '';
if(!empty($vultur_data['loader_image']['url'])):
  $loader_image = $vultur_data['loader_image']['url'];
else:
  $loader_image = get_template_directory_uri().'/assets/images/loader.gif';
endif;
$loader_switch = '';
if(!empty($vultur_data['loader_switch'])):
  $loader_switch = $vultur_data['loader_switch'];
endif;
if($loader_switch == 'on'):
  if(!empty($loader_image)):
?>
<div id="preloader">
	<div id="status">
	   <img src="<?php echo esc_url($loader_image); ?>" alt="<?php esc_attr_e('loader','vultur'); ?>">
	</div>
</div>
<?php    
 endif;
endif;
get_template_part('vendor/header/vultur-header','main');
?>