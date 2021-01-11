<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Vultur
 */
get_header();
if (function_exists( 'fw_get_db_settings_option' )):	
	$vultur_data = fw_get_db_settings_option();
endif; 
$error_404_heading = '';
if(!empty($vultur_data['error_404_heading'])):
    $error_404_heading = $vultur_data['error_404_heading'];
endif;  
$error_404_desc = '';
if(!empty($vultur_data['error_404_desc'])):
    $error_404_desc = $vultur_data['error_404_desc'];
endif;
$bread_image = '';
if(!empty($vultur_data['breadcrumbs_image']['url'])):
    $bread_image = $vultur_data['breadcrumbs_image']['url'];
endif;
$bread_color = '';
if(!empty($vultur_data['breadcrumbs_color'])):
    $bread_color = $vultur_data['breadcrumbs_color'];
endif;
$breadcrumbs_switch = '';
if(!empty($vultur_data['breadcrumbs_switch'])):
    $breadcrumbs_switch = $vultur_data['breadcrumbs_switch'];
else:
    $breadcrumbs_switch = 'on';
endif;
if($breadcrumbs_switch == 'on'):
    vultur_breadcrumb_funcation($bread_color,$bread_image);
endif;
?>
<div class="vultur_404">
    <div class="container">
		 <?php 
		  if(!empty($error_404_heading)):
		     echo '<div><h1>'.esc_html($error_404_heading).'</h1></div>';
		  else:
             echo '<div><h1>'.esc_html__('404','vultur').'</h1></div>';
          endif;
		  if(!empty($error_404_heading)):
		    echo '<div><p>'.esc_html($error_404_desc).'</p></div>';
		  else:
		    echo '<div><p>'.esc_html__('Sorry, This Page Is Not Available','vultur').'</p></div>';
		  endif;
            echo '<a href="'.esc_url(home_url('/')).'" class="vultur_btn">'.esc_html__('Go To Homepage','vultur').'</a>';
		 ?>
    </div>    
</div> 
<?php
get_footer();