<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vultur
 */

if ( ! is_active_sidebar( 'woocommerce-sidebar-1' ) ) {
	return;
}
?>
<div class="cat_sidebar">
<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'woocommerce-sidebar-1' ); ?>
</aside><!-- #secondary -->
</div> 