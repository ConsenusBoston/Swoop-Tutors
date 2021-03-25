<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
      'teams_slider' =>array(
		      'type' => 'addable-popup',
		      'value' => array(
			   array(
				   'teams_slider' => 'Students Slider',
			       ),
	     	   ),
		     'label' => esc_html__('Add Students Slider', 'vultur'),
             'template' => '{{=title}}',
		     'popup-title' => null,
		     'size' => 'small', // small, medium, large
		     'limit' => 0, // limit the number of popup`s that can be added
	      	 'add-button-text' => esc_html__('Add', 'vultur'),
		     'sortable' => true,
		     'popup-options' => array(
		           'title' => array(
		           'label' => esc_html__('Title', 'vultur'),
		           'type' => 'text', 
	                    ),
	               'team_image'  => array(
			         'label' => esc_html__('Student Images', 'vultur'),
			         'desc' => esc_html__('Upload Student images Here.', 'vultur'),
			         'type' => 'upload', 
			          ),
                 'team_position'  => array(
                     'teams_label' => esc_html__('Students Sub Heading', 'vultur'),
                     'type' => 'text',
                     'value' => '',
                     'desc' => esc_html__('', 'vultur'),
                 ),
                 'team_content'  => array(
                     'label' => esc_html__('Student Description', 'vultur'),
                     'type' => 'wp-editor',
                     'value' => '',
                     'desc' => esc_html__('', 'vultur'),
                     'media_buttons' => false,
                     'wpautop' => true,
                 ),
                 'team_url'  => array(
                     'team_url_label' => esc_html__('URL', 'vultur'),
                     'type' => 'text',
                     'value' => '#',
                     'desc' => esc_html__('', 'vultur'),
                 ),
                 'social_facebook'  => array(
                     'social_facebook_label' => esc_html__('Social Facebook', 'vultur'),
                     'type' => 'text',
                     'value' => '#',
                     'desc' => esc_html__('', 'vultur'),
                 ),
                 'social_twitter'  => array(
                     'social_twitter_label' => esc_html__('Social Twitter', 'vultur'),
                     'type' => 'text',
                     'value' => '#',
                     'desc' => esc_html__('', 'vultur'),
                 ),
                 'social_linkedin'  => array(
                     'social_linkedin_label' => esc_html__('Social LinkedIn', 'vultur'),
                     'type' => 'text',
                     'value' => '#',
                     'desc' => esc_html__('', 'vultur'),
                 ),
                 'social_instagram'  => array(
                     'social_instagram_label' => esc_html__('Social Instagram', 'vultur'),
                     'type' => 'text',
                     'value' => '#',
                     'desc' => esc_html__('', 'vultur'),
                 ),
			        ), 
	               ),
    'position'  => array(
        'type'  => 'select',
        'value' => 'position-left',
        'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
        'label' => __('Position', '{vultur}'),
        'desc'  => __('Description', '{vultur}'),
        'choices' => array(
            'position-left' => __('Left', '{vultur}'),
            'position-center' => __('Center', '{vultur}'),
            'position-right' => __('Right', '{vultur}'),
        ),
        'no-validate' => false,
    ),
    'color'  => array(
        'type'  => 'select',
        'value' => 'color-dark',
        'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
        'label' => __('Color', '{vultur}'),
        'desc'  => __('Description', '{vultur}'),
        'choices' => array(
            'color-white' => __('Color White', '{vultur}'),
            'color-dark' => __('Color Dark', '{vultur}'),
        ),
        'no-validate' => false,
    ),
    'layout'  => array(
        'type'  => 'select',
        'value' => 'layout1',
        'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
        'label' => __('Layout', '{vultur}'),
        'desc'  => __('Description', '{vultur}'),
        'choices' => array(
            'layout1' => __('Layout 1 (Carousel)', '{vultur}'),
            'layout2' => __('Layout 2', '{vultur}'),
        ),
        'no-validate' => false,
    ),
		'teams_title'  => array(
			    'teams_label' => esc_html__('Students Heading', 'vultur'),
		 	    'type' => 'text',
			    'value' => '',
			    'desc' => esc_html__('', 'vultur'),
			   ), 
	    'teams_sub_title'  => array(
			    'teams_label' => esc_html__('Students Sub Heading', 'vultur'),
		 	    'type' => 'text',
			    'value' => '',
			    'desc' => esc_html__('', 'vultur'),
			   ), 
	    'teams_desc'  => array(
				'label' => esc_html__('Students Description', 'vultur'),
				'type' => 'wp-editor',
				'value' => '',
				'desc' => esc_html__('', 'vultur'),
				'media_buttons' => false,
				'wpautop' => true,
			),
				
);