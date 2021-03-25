<?php
$teams_logo = '';
if(!empty($atts['teams_slider'])):
    $teams_logo = $atts['teams_slider'];
endif;
$teams_title = '';
if(!empty($atts['teams_title'])):
    $teams_title = $atts['teams_title'];
endif;
$teams_sub_title = '';
if(!empty($atts['teams_sub_title'])):
    $teams_sub_title = $atts['teams_sub_title'];
endif;
$teams_desc = '';
if(!empty($atts['teams_desc'])):
    $teams_desc = $atts['teams_desc'];
endif;
$position = '';
if(!empty($atts['position'])):
    $position = $atts['position'];
endif;
$color = '';
if(!empty($atts['color'])):
    $color = $atts['color'];
endif;
$layout = '';
if(!empty($atts['layout'])):
    $layout = $atts['layout'];
endif;
?>
<div id="teachers" class="wrap-bg">
    <div class="container">
        <div class="row <?php echo esc_html($position); ?>">
            <div class="col-lg-12">
                <div class="section-title with-p <?php echo esc_html($color); ?>">
                    <?php if(!empty($teams_sub_title)): ?>
                        <div class="intro-title"><?php echo esc_html($teams_sub_title); ?></div>
                    <?php endif; ?>
                    <h2><?php echo esc_html($teams_title); ?></h2>
                    <?php printf($teams_desc); ?>
                </div>
            </div>
        </div>

        <?php if($layout == 'layout1'): ?>
        <div class="row carousel-slider gallery-slider">

            <?php endif; ?>
            <?php if($layout == 'layout2'): ?>
            <div class="row">
            <?php endif; ?>
         <?php
          if(!empty($teams_logo)):
           foreach($teams_logo as $values):
                if(!empty($values['title'])):
                    if(!empty($values['team_image']['url'])):
                    $attachment_id = $values['team_image']['attachment_id'];
                       $vultur_logoimage = wp_get_attachment_url($attachment_id, 'full');
                       $logoimage = vultur_resize($vultur_logoimage, 350, 350 , false);
                 endif;
                $team_position = '';
                if(!empty($values['team_position'])):
                    $team_position = $values['team_position'];
                endif;
                    $team_content = '';
                if(!empty($values['team_content'])):
                    $team_content = $values['team_content'];
                endif;
                $team_url = '';
                if(!empty($values['team_url'])):
                    $team_url = $values['team_url'];
                endif;
                $social_facebook = '';
                if(!empty($values['social_facebook'])):
                    $social_facebook = $values['social_facebook'];
                endif;
                $social_twitter = '';
                if(!empty($values['social_twitter'])):
                    $social_twitter = $values['social_twitter'];
                endif;
                $social_linkedin = '';
                if(!empty($values['social_linkedin'])):
                    $social_linkedin = $values['social_linkedin'];
                endif;
                $social_instagram = '';
                if(!empty($values['social_instagram'])):
                    $social_instagram = $values['social_instagram'];
                endif;
                 ?>
                    <div class="col-md-6 col-lg-4 col-xl-3 <?php echo esc_html($layout);?>">
                        <article class="item">
                            <a href="<?php echo esc_url($team_url); ?>"
                             ><img src="<?php echo esc_url($logoimage); ?>"  alt="<?php echo esc_attr($values['title']); ?>"/></a>

                            <div class="teacher-content">
                            <div class="teacher-social">
                                    <i class="teacher-icon fa fa-share-alt social-first"></i>
                                <?php if(!empty($social_facebook)): ?>
                                    <a href="<?php echo esc_url($social_facebook); ?>" class="teacher-icon social-link">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if(!empty($social_twitter)): ?>
                                    <a href="<?php echo esc_url($social_twitter); ?>" class="teacher-icon social-link">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if(!empty($social_linkedin)): ?>
                                    <a href="<?php echo esc_url($social_linkedin); ?>" class="teacher-icon social-link">
                                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if(!empty($social_instagram)): ?>
                                    <a href="<?php echo esc_url($social_instagram); ?>" class="teacher-icon social-link">
                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <h5><a href="<?php echo esc_url($team_url);?>"><?php echo esc_html($values['title']); ?></a></h5>
                            <span><?php printf($team_position); ?></span>
                            <?php printf($team_content); ?>
                            </div>
                        </article>
                    </div>
                <?php
                  endif;
                 endforeach;
                endif;
                ?>
        </div>
    </div>
</div>