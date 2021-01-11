<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Vultur
 */
get_header();
$vultur_post_data = $bread_image = $comment_switch = '';
if (function_exists('fw_get_db_post_option')) :
    $vultur_post_data = fw_get_db_post_option(get_the_ID());
endif;
if (!empty($vultur_post_data['blog_single_sidebar'])) :
    $post_sidebar_position = $vultur_post_data['blog_single_sidebar'];
else :
    $post_sidebar_position = 'right';
endif;
$comment_switch = '';
if (!empty($vultur_post_data['comment_switch'])) :
    $comment_switch = $vultur_post_data['comment_switch'];
else :
    $comment_switch = 'yes';
endif;
$breadcrumbs_switch = '';
if (!empty($vultur_post_data['breadcrumbs_switch'])) :
    $breadcrumbs_switch = $vultur_post_data['breadcrumbs_switch'];
else :
    $breadcrumbs_switch = 'yes';
endif;
$bread_image = '';
if (!empty($vultur_post_data['breadcrumbs_post_image']['url'])) :
    $bread_image = $vultur_post_data['breadcrumbs_post_image']['url'];
endif;
$bread_color = '';
if (!empty($vultur_post_data['breadcrumbs_post_color'])) :
    $bread_color = $vultur_post_data['breadcrumbs_post_color'];
endif;
if ($breadcrumbs_switch == 'yes') :
    vultur_breadcrumb_funcation($bread_color, $bread_image);
endif;
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="row">

                <?php if (is_active_sidebar('sidebar-1')) : ?>

                    <?php
                    if ($post_sidebar_position == 'full') :
                        echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
                    else :
                        if ($post_sidebar_position == 'left') :
                            echo '<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 order-lg-4 order-md-4">';
                        else :
                            echo '<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">';
                        endif;
                    endif;
                else :
                    echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
                    ?>

                <?php endif; ?>

                <?php

                while (have_posts()) : the_post();
                    get_template_part('template-parts/content', 'tutor');
                    //Get post author
                    get_template_part('template-parts/template-author');

                    // If comments are open or we have at least one comment, load up the comment template.
                    // if ($comment_switch == 'yes') :
                        // if (comments_open() || get_comments_number()) :
                        //     comments_template();
                        // endif;
                    // endif;
                endwhile; // End of the loop.
                ?>
            </div>
            <?php if (is_active_sidebar('tutor-interior')) : ?>

                <?php if ($post_sidebar_position == 'left') :  ?>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <?php get_sidebar('tutor-interior'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($post_sidebar_position == 'right') :  ?>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
                        <?php get_sidebar('tutor-interior'); ?>
                    </div>
                    <div class="col-sm-12 about-me-narrative-only-mobile">
                        <?php get_template_part('template-parts/content', 'tutor'); ?>
                    </div>
                <?php endif; ?>

            <?php endif; ?>
        </div>
</div>
</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
