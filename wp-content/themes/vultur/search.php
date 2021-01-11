<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Vultur
 */
get_header();
$theme_sidebar = $vultur_data = '';
if (function_exists( 'fw_get_db_settings_option' )):	
	$vultur_data = fw_get_db_settings_option();
endif; 
if(!empty($vultur_data['search_sidebar'])):
   $theme_sidebar = $vultur_data['search_sidebar'];
else:
   $theme_sidebar = 'right';
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
<div id="primary" class="content-area">
		<main id="main" class="site-main">
		    <div class="container">
		        <div class="row">

			        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

				        <?php
				        if($theme_sidebar == 'full'):
					        echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
				        else:
					        if($theme_sidebar == 'left'):
						        echo '<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 order-lg-4 order-md-4">';
					        else:
						        echo '<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">';
					        endif;
				        endif;
			        else:
				        echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
				        ?>

			        <?php endif; ?>

			        <?php
		    if(have_posts()):

            /* Start the Loop */
			 while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;
               vultur_pagination();
           else :
              get_template_part( 'template-parts/content', 'none' );
           endif;
		 ?>
         </div>

			    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

				    <?php if($theme_sidebar == 'left'):  ?>
					    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
						    <?php get_sidebar(); ?>
					    </div>
				    <?php endif; ?>
				    <?php if($theme_sidebar == 'right'):  ?>
					    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
						    <?php get_sidebar(); ?>
					    </div>
				    <?php endif; ?>

			    <?php endif; ?>

       </div>
     </div>
	</main><!-- #main -->
 </div><!-- #primary -->
<?php
get_footer(); 