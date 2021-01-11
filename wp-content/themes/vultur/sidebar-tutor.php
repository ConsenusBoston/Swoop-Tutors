<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vultur
 */

if (!is_active_sidebar('tutor-sidebar')) {
    return;
}
?>
<div class="cat_sidebar">
    <div class="sidebar-logo">
        <a href="/">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/08/swoop_web_logo_3-300x78.png" alt="">
        </a>
        <i class="fas fa-times close-sidebar"></i>
    </div>
    <aside id="secondary" class="widget-area">
        <?php dynamic_sidebar('tutor-sidebar'); ?>
    </aside><!-- #secondary -->
</div>