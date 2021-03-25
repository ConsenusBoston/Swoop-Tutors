<?php 
$special = '';
if(!empty($atts['special'])):
    $special = $atts['special'];
endif;
$skill_bgimage = '';
if(!empty($atts['slider_image']['url'])):
	$skill_bgimage  = $atts['slider_image']['url'];
endif;
$bg_image_url = '';
if(!empty($atts['slider_image'])):
	$bg_image_url = 'background-image:url(' .$skill_bgimage. ');';
endif;
$skill_bgimage_right = '';
if(!empty($atts['slider_image_right']['url'])):
    $skill_bgimage_right  = $atts['slider_image_right']['url'];
endif;
$slider_content = '';
if(!empty($atts['slider_content'])):
	$slider_content = $atts['slider_content'];
endif;
$title = '';
if(!empty($atts['title'])):
	$title = $atts['title'];
endif;
$subtitle = '';
if(!empty($atts['subtitle'])):
	$subtitle = $atts['subtitle'];
endif;
$button_text = '';
if(!empty($atts['button_text'])):
	$button_text = $atts['button_text'];
endif;
$button_link = '';
if(!empty($atts['button_link'])):
	$button_link = $atts['button_link'];
endif;
$play_button_link = '';
if(!empty($atts['play_button_link'])):
	$play_button_link = $atts['play_button_link'];
endif;
$position = '';
if(!empty($atts['position'])):
	$position = $atts['position'];
endif;
$slider_height = '';
if(!empty($atts['slider_height'])):
	$slider_height = $atts['slider_height'];
endif;
$search_course = '';
if(!empty($atts['search_course'])):
	$search_course = $atts['search_course'];
endif;
$search_course_text = '';
if(!empty($atts['search_course_text'])):
	$search_course_text = $atts['search_course_text'];
endif;
$layout = '';
if(!empty($atts['layout'])):
    $layout = $atts['layout'];
endif;
?>

<?php if($layout == 'layout2' || $layout == 'layout3'): ?>
<div class="<?php echo esc_html($layout); ?>  sliderblack special-slider">
    <?php else: ?>
    <div class="special-slider">
        <?php endif; ?>

<?php if($slider_height == false): ?>
<div class="<?php echo esc_html($position); ?> header-content-full header-content " role="banner" style="<?php printf($bg_image_url); ?>">
	<?php else: ?>
	<div class="<?php echo esc_html($position); ?> equal-margin header-content" role="banner" style="<?php printf($bg_image_url); ?>">
		<?php endif; ?>
		<div class="container">
			<div class="row">
                <?php if($layout == 'layout3'): ?>
                    <div class="special-second-layout col-xs-12 col-sm-12 col-md-12 col-lg-6 header-area">
                    <?php else: ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 header-area">
                <?php endif; ?>
					<div class="header-area-inner header-text">
						<?php if(!empty($subtitle)): ?>
							<div><span class="subtitle "><?php printf($subtitle); ?></span></div>
						<?php endif; ?>
						<?php if(!empty($title)): ?>
							<h1 class="title"><?php printf($title); ?></h1>
						<?php endif; ?>

						<?php printf($slider_content); ?>

						<?php if($search_course): ?>
							<div class="slidersearch header-search">
								<form method="get" name="search-course" class="learn-press-search-course-form" action="<?php echo home_url( '/find-a-tutor/' ); ?>">
									<!-- <input type="text" name="s" class="search-course-input" value="" placeholder="<?php printf($search_course_text); ?>">
									<input type="hidden" name="ref" value="course"> 
                                    <button class="lp-button button search-course-button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    -->
                                    <span class="main-span choose-subject">
                                        <!-- <input type="text" id="choose_subject" placeholder="Choose Subject" readonly> -->
                                        <div class="search-wrap" id="choose_subject">
                                            <p><b>Choose</b> Subject</p>
                                            <div id="choosen_subject"></div>
                                        </div>
                                        
                                    </span>
                                    <span class="main-span">
                                        <!-- <input type="text" id="choose_grade_level" placeholder="Select Grade Level" readonly> -->
                                        <div class="search-wrap" id="choose_grade_level">
                                            <p><b>Select</b> Grade Level</p>
                                            <div id="choosen_grade"></div>
                                        </div>
                                        
                                    </span>
                                    <span class="main-span">
                                        <!-- <input type="text" id="choose_week_days" placeholder="Best Days Of The Week" readonly> -->
                                        <div class="search-wrap" id="choose_week_days">
                                            <p><b>Best</b> Days <b>Of The Week</b></p>
                                            <div id="choosen_days"></div>
                                        </div>
                                        
                                    </span>
                                    <?php 
                                    $tutor_fields = acf_get_fields( 6768);
                                    $days=$grade_lavels=array();
                                    if(!empty($tutor_fields))
                                    {
                                        foreach($tutor_fields as $field)
                                        {
                                            if($field['name']=='days_of_week')
                                                $days=$field['choices'];
                                            if($field['name']=='grade_level')
                                                $grade_lavels=$field['choices'];
                                        }
                                    }
                                    $subjects=get_terms( array(
                                            'taxonomy' => 'subjects','hide_empty' => false, 'parent' => 0 
                                        ) );
                                    if(!is_wp_error($subjects) && !empty($subjects))
                                    {
                                        ?>
                                        <div id="subject-dorpdown" class="home-search-suggestion" style="display:none;">
                                            <p>Select all that apply:</p>
                                            <ul>
                                                <?php foreach($subjects as $subject){
                                                    ?>
                                                    <li data-value="<?php echo $subject->slug;?>">
                                                        <input type="checkbox" class="subjects_checkbox" value="<?php echo $subject->slug;?>" id="<?php echo $subject->slug;?>" data-label="<?php echo $subject->name;?>">
                                                        <label for="<?php echo $subject->slug;?>"><?php echo $subject->name;?></label>
                                                    </li>
                                                    <?php 
                                                }?>
                                            </ul>
                                            <input type="hidden" name="_subjects" value="">
                                        </div>
                                        <?php
                                    }
                                    if(empty($days))
                                    $days=array('mon'=>'Mon','tues'=>'Tue','wed'=>'Wed','thurs'=>'Thu','fri'=>'Fri','sat'=>'Sat','sun'=>'Sun');
                                    if(!is_wp_error($days) && !empty($days))
                                    {
                                        ?>
                                        <div id="days-dorpdown" class="home-search-suggestion" style="display:none;">
                                            <p>Select all that apply:</p>
                                            <ul>
                                                <?php foreach($days as $key=>$day){
                                                    ?>
                                                    <li data-value="<?php echo $key;?>">
                                                        <input type="checkbox" class="days_checkbox" value="<?php echo $key;?>" id="<?php echo $key;?>" data-label="<?php echo $day;?>">
                                                        <label for="<?php echo $key;?>"><?php echo $day;?></label>
                                                    </li>
                                                    <?php 
                                                }?>
                                            </ul>
                                            <input type="hidden" name="_days_of_week" value="">
                                        </div>

                                        <?php
                                    }
                                    if(empty($grade_lavels))
                                    $grade_lavels=array('small'=>'K-5','big'=>'6-8');
                                    if(!is_wp_error($grade_lavels) && !empty($grade_lavels))
                                    {
                                        ?>
                                        <div id="grade-dorpdown" class="home-search-suggestion" style="display:none;">
                                            <p>Select all that apply:</p>
                                            <ul>
                                                <?php foreach($grade_lavels as $key=>$grade_lavel){
                                                    ?>
                                                    <li data-value="<?php echo $key;?>">
                                                        <input type="checkbox" class="grade_level_checkbox" value="<?php echo $key;?>" id="<?php echo $key;?>" data-label="<?php echo $grade_lavel;?>">
                                                        <label for="<?php echo $key;?>"><?php echo $grade_lavel;?></label>
                                                    </li>
                                                    <?php 
                                                }?>
                                            </ul>
                                            <input type="hidden" name="_grade_level" value="">
                                        </div>

                                        <?php
                                    }
                                    ?>
                                    <!-- </div> -->
									
                                    <!-- <input type="submit" class="submit-btn"> -->
                                    <button type="submit" class="submit-btn"><i class="fas fa-search"></i></button>
								</form>
							</div>
                            <script type="text/javascript">
                                jQuery(document).ready(function($){
                                    $(document).mouseup(function (e) { 
                                        console.log(e.target.id);
                                        if (e.target.id!='choose_subject' && e.target.id!='choose_grade_level' && e.target.id!='choose_week_days' && $(e.target).closest(".home-search-suggestion").length 
                                                    === 0 &&  $(e.target).closest(".suggest-list").length 
                                                    === 0) { 
                                            $(".home-search-suggestion").hide(); 
                                        } 
                                    });
                                    //Onfocus functionality
                                    $(document).on('click','#choose_subject',function(){
                                        $('.home-search-suggestion').hide();
                                        $('#subject-dorpdown').show();
                                        $('.main-span').removeClass('active');
                                        $(this).parent('span').addClass('active');
                                    });
                                    $(document).on('click','#choose_grade_level',function(){
                                        $('.home-search-suggestion').hide();
                                        $('#grade-dorpdown').show();
                                        $('.main-span').removeClass('active');
                                        $(this).parent('span').addClass('active');
                                    });
                                    $(document).on('click','#choose_week_days',function(){
                                        $('.home-search-suggestion').hide();
                                        $('#days-dorpdown').show();
                                        $('.main-span').removeClass('active');
                                        $(this).parent('span').addClass('active');
                                    });

                                    //Subjects check box handle
                                    $(document).on('click','.subjects_checkbox',function(){
                                        var selectedSubject={};
										selectedSubject.keys=new Array();
										selectedSubject.labels=new Array();
										$('.subjects_checkbox:checked').each(function () {	
                                            selectedSubject.keys.push(this.value);
											selectedSubject.labels.push($(this).attr('data-label'));	
                                        });
                                     
                                        if (selectedSubject.keys.length > 0) {
                                           		 $('input[name="_subjects"]').val(selectedSubject.keys.join(","));
                                        
                                    	}
										var html='';
										if (selectedSubject.labels.length > 0) {
											$.each(selectedSubject.labels, function( index, value ) {
											  html+='<div class="suggest-list">'+value+'<span class="close-suggest close-subject" data-id="'+selectedSubject.keys[index]+'">X</span></div>';
											});                                        
                                    	}
										$('#choosen_subject').html(html);
                                    });
                                    //Subjects check box handle

                                    //Days check box handle
                                    $(document).on('click','.days_checkbox',function(){
                                        var selectedDays ={};
                                        selectedDays.keys=new Array();
										selectedDays.labels=new Array();
                                        $('.days_checkbox:checked').each(function () {
                                            selectedDays.keys.push(this.value);
											selectedDays.labels.push($(this).attr('data-label'));
                                        });
                                       
                                        if (selectedDays.keys.length > 0) {
                                            $('input[name="_days_of_week"]').val(selectedDays.keys.join(","));
                                        
                                    }
										var html='';
										if (selectedDays.labels.length > 0) {
											$.each(selectedDays.labels, function( index, value ) {
											  html+='<div class="suggest-list">'+value+'<span class="close-suggest close-days" data-id="'+selectedDays.keys[index]+'">X</span></div>';
											});                                        
                                    	}
										$('#choosen_days').html(html);
                                    });
                                    //Days check box handle

                                    //Grade Levels check box handle
                                    $(document).on('click','.grade_level_checkbox',function(){
                                        var selectedLevels =new Array();
										selectedLevels.keys=new Array();
										selectedLevels.labels=new Array();
                                        
                                        $('.grade_level_checkbox:checked').each(function () {
                                            selectedLevels.keys.push(this.value);
											selectedLevels.labels.push($(this).attr('data-label'));
                                        });
                                       
                                        if (selectedLevels.keys.length > 0) {
                                            $('input[name="_grade_level"]').val(selectedLevels.keys.join(","));
                                        
                                    }
										
										var html='';
										if (selectedLevels.labels.length > 0) {
											$.each(selectedLevels.labels, function( index, value ) {
											  html+='<div class="suggest-list">'+value+'<span class="close-suggest close-grade" data-id="'+selectedLevels.keys[index]+'">X</span></div>';
											});                                        
                                    	}
										$('#choosen_grade').html(html);
                                    });
                                    //Grade Levels check box handle
                                    
                                    //Close suggest
                                    $(document).on('click','.close-suggest',function(){
										var id=$(this).data('id');
										//$(this).closest('div').remove();
										var elem='';
										if($(this).hasClass('close-subject'))
										elem=$('#subject-dorpdown');
										else if($(this).hasClass('close-days'))
										elem=$('#days-dorpdown');
										else if($(this).hasClass('close-grade'))
										elem=$('#grade-dorpdown');
										elem.find('input[type="checkbox"][id="'+id+'"]').trigger('click');
									});

                                });
                            </script>
						<?php endif; ?>

					</div>
				</div>

                <?php if($layout == 'layout3'): ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <?php else: ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <?php endif; ?>

                <?php if(!empty($skill_bgimage_right)): ?>
                     <img class="slider-image-right" src="<?php echo esc_url($skill_bgimage_right); ?>"  alt="<?php echo esc_attr($values['title']); ?>"/>
                <?php endif; ?>
                <?php if(!empty($special)): ?>
                <div class="float-right-disable">
                    <?php
                    if(!empty($special)):
                        foreach($special as $values):
                            $title = '';
                            if(!empty($values['title'])):
                                $title = $values['title'];
                            endif;
                            $category = '';
                            if(!empty($values['category'])):
                                $category = $values['category'];
                            endif;
                            $lessons = '';
                            if(!empty($values['lessons'])):
                                $lessons = $values['lessons'];
                            endif;
                            $student = '';
                            if(!empty($values['student'])):
                                $student = $values['student'];
                            endif;
                            $price = '';
                            if(!empty($values['price'])):
                                $price = $values['price'];
                            endif;
                            $link1= '';
                            if(!empty($values['link1'])):
                                $link1 = $values['link1'];
                            endif;
                            $link2= '';
                            if(!empty($values['link2'])):
                                $link2= $values['link2'];
                            endif;
                            $special_content = '';
                            if(!empty($values['special_content'])):
                                $special_content = $values['special_content'];
                            endif;
                            $skill_bgimage2 = '';
                            if(!empty($values['course_image']['url'])):
                                $skill_bgimage2  = $values['course_image']['url'];
                            endif;
                            $bg_image_url2 = '';
                            if(!empty($values['course_image'])):
                                $bg_image_url2 = 'background-image:url(' .$skill_bgimage2. ');';
                            endif;
                            ?>
                                <div class="themeioan_course" style="margin-top: 30px;">
                                    <article>
                                        <a href="<?php echo esc_url($link1); ?>" class="course-permalink">
                                        <div class="blog-photo" style="<?php printf($bg_image_url2); ?>">
                                            <?php if($category): ?>
                                            <div class="course_category">
                                                <div class="cat-item">
                                                    <span class="cat-links"><a href="<?php echo esc_url($link1); ?>" rel="tag"><?php printf($category); ?></a></span></div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        </a>
                                        <div class="blog-content">
                                            <?php if($price): ?>
                                            <ul class="course-bottom-list">
                                                <li>
                                                    <div class="course-duration">
                                                        <span>
                                                            <span class="course-price price"><?php printf($price); ?></span>
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <?php endif; ?>
                                            <h5 class="title"><a href="<?php echo esc_url($link1); ?>" class="course-permalink"><?php echo esc_html($values['title']); ?></a></h5>
                                            <div class="vultur-stars">
                                                <div class="review-stars-rated">
                                                    <div class="review-stars empty"></div>
                                                    <div class="review-stars filled" style="width:100%;"></div>
                                                </div>

                                                <div class="vultur_rating_total">
                                                    5.0 (24 rating)
                                                </div>
                                            </div>
                                            <div class="course_excerpt">
                                                <p><?php printf($special_content); ?></p>
                                            </div>
                                            <div class="course_lessons">
                                                <?php if($lessons): ?>
                                                <div class="cat-item">
                                                    <i class="far fa-address-book fa-3x"></i>
                                                    <span class="lp-label label-8"><?php printf($lessons); ?></span>
                                                </div>
                                                <?php endif; ?>
                                                <?php if($student): ?>
                                                <div class="cat-item">
                                                    <i class="far fa-user fa-3x"></i>
                                                    <span class="lp-label label-62"><?php printf($student); ?></span>
                                                </div>
                                                <?php endif; ?>

                                            </div>


                                        </div>
                                    </article>
                                </div>

                        <?php
                        endforeach;
                    endif;
                    ?>
                </div>
                    <?php endif; ?>
                </div>


			</div>
		</div>
	</div>

	</div>
</div>
</div>