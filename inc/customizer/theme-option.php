<?php 

/**
 * Theme Options Panel.
 *
 * @package the9-store
 */

$default = the9_store_get_default_theme_options();
global $wp_customize;



// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'the9-store' ),
		'priority'   => 2,
		'capability' => 'edit_theme_options',
	)
);


$wp_customize->add_section( 'topbar_section_settings',
	array(
		'title'      => esc_html__( 'General settings', 'the9-store' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

/*Social Profile*/
$wp_customize->add_setting( '__dialogue',
	array(
		'default'           => $default['__dialogue'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( '__dialogue',
	array(
		'label'    => esc_html__( 'Dialogue', 'the9-store' ),
		'section'  => 'topbar_section_settings',
		'type'     => 'text',
		
	)
);

/*Social Profile*/
$wp_customize->add_setting( '__fb_pro_link',
	array(
		'default'           => $default['__fb_pro_link'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( '__fb_pro_link',
	array(
		'label'    => esc_html__( 'Facebook', 'the9-store' ),
		'description' => esc_html__( 'Leave empty to hide', 'the9-store' ),
		'section'  => 'topbar_section_settings',
		'type'     => 'text',
		
	)
);	



$wp_customize->add_setting( '__tw_pro_link',
	array(
		'default'           => $default['__tw_pro_link'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( '__tw_pro_link',
	array(
		'label'    => esc_html__( 'Twitter', 'the9-store' ),
		'description' => esc_html__( 'Leave empty to hide', 'the9-store' ),
		'section'  => 'topbar_section_settings',
		'type'     => 'text',
		
	)
);


$wp_customize->add_setting( '__you_pro_link',
	array(
		'default'           => $default['__you_pro_link'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( '__you_pro_link',
	array(
		'label'    => esc_html__( 'Youtube', 'the9-store' ),
		'description' => esc_html__( 'Leave empty to hide', 'the9-store' ),
		'section'  => 'topbar_section_settings',
		'type'     => 'text',
		
	)
);	


// Styling Options.*/

// Styling Options.*/

$wp_customize->add_section( 'styling_section_settings',
	array(
		'title'      => esc_html__( 'Styling Options', 'the9-store' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Primary Color.
$wp_customize->add_setting( '__primary_color',
	array(
	'default'           => $default['__primary_color'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( '__primary_color',
	array(
	'label'    	   => esc_html__( 'Primary Color Scheme:', 'the9-store' ),
	'section'  	   => 'styling_section_settings',
	'description'  => esc_html__( 'The theme comes with unlimited color schemes for your theme\'s styling. upgrade pro for color options & features', 'the9-store' ),
	'type'     => 'color',
	'priority' => 120,
	)
);

$wp_customize->add_setting( '__secondary_color',
	array(
	'default'           => $default['__secondary_color'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( '__secondary_color',
	array(
	'label'    	   => esc_html__( 'Secondary Color Scheme:', 'the9-store' ),
	'section'  	   => 'styling_section_settings',
	'description'  => esc_html__( 'The theme comes with unlimited color schemes for your theme\'s styling. upgrade pro for color options & features', 'the9-store' ),
	'type'     => 'color',
	'priority' => 120,
	)
);
	
/*Posts management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Blog Management', 'the9-store' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		/*Posts Layout*/
		$wp_customize->add_setting( 'blog_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'the9_store_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_layout',
			array(
				'label'    => esc_html__( 'Blog layout', 'the9-store' ),
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'the9-store' ),
				'section'  => 'theme_option_section_settings',
				'choices'   => array(
					'sidebar-content'  => esc_html__( 'Primary Sidebar - Content', 'the9-store' ),
					'content-sidebar' => esc_html__( 'Content - Primary Sidebar', 'the9-store' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'the9-store' ),
					'full-container'    => esc_html__( 'Full Container', 'the9-store' ),
					),
				'type'     => 'select',
				
			)
		);
		
		
		$wp_customize->add_setting( 'single_post_layout',
			array(
				'default'           => $default['single_post_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'the9_store_sanitize_select',
			)
		);
		$wp_customize->add_control( 'single_post_layout',
			array(
				'label'    => esc_html__( 'Single post layout', 'the9-store' ),
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'the9-store' ),
				'section'  => 'theme_option_section_settings',
				'choices'   => array(
					'sidebar-content'  => esc_html__( 'Primary Sidebar - Content', 'the9-store' ),
					'content-sidebar' => esc_html__( 'Content - Primary Sidebar', 'the9-store' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'the9-store' ),
					'full-container'    => esc_html__( 'Full Container', 'the9-store' ),
					),
				'type'     => 'select',
				
			)
		);
		
		
		/*Blog Loop Content*/
		$wp_customize->add_setting( 'blog_loop_content_type',
			array(
				'default'           => $default['blog_loop_content_type'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'the9_store_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_loop_content_type',
			array(
				'label'    => esc_html__( 'Archive content type', 'the9-store' ),
				'description' => esc_html__( 'Choose archive, blog page content type as default', 'the9-store' ),
				'section'  => 'theme_option_section_settings',
				'choices'               => array(
					'excerpt' => __( 'Excerpt', 'the9-store' ),
					'content' => __( 'Content', 'the9-store' ),
					),
				'type'     => 'select',
				
			)
		);
		
		/*Social Profile*/
		$wp_customize->add_setting( 'read_more_text',
			array(
				'default'           => $default['read_more_text'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'read_more_text',
			array(
				'label'    => esc_html__( 'Read more text', 'the9-store' ),
				'description' => esc_html__( 'Leave empty to hide', 'the9-store' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'text',
				
			)
		);
		
		
		$wp_customize->add_setting( 'blog_meta_hide',
			array(
				'default'           => $default['blog_meta_hide'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'the9_store_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'blog_meta_hide',
			array(
				'label'    => esc_html__( 'Hide Blog Archive Meta Info?', 'the9-store' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
		$wp_customize->add_setting( 'signle_meta_hide',
			array(
				'default'           => $default['signle_meta_hide'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'the9_store_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'signle_meta_hide',
			array(
				'label'    => esc_html__( 'Hide Single post Meta Info ?', 'the9-store' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
/*Posts management section start */
$wp_customize->add_section( 'page_option_section_settings',
	array(
		'title'      => esc_html__( 'Page Management', 'the9-store' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

	
		/*Home Page Layout*/
		$wp_customize->add_setting( 'page_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'the9_store_sanitize_select',
			)
		);
		$wp_customize->add_control( 'page_layout',
			array(
				'label'    => esc_html__( 'Page Layout Options', 'the9-store' ),
				'section'  => 'page_option_section_settings',
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'the9-store' ),
				'choices'   => array(
					'sidebar-content'  => esc_html__( 'Primary Sidebar - Content', 'the9-store' ),
					'content-sidebar' => esc_html__( 'Content - Primary Sidebar', 'the9-store' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'the9-store' ),
					'full-container'    => esc_html__( 'Full Container', 'the9-store' ),
					),
				'type'     => 'select',
				'priority' => 170,
			)
		);


		// Footer Section.
		$wp_customize->add_section( 'footer_section',
			array(
			'title'      => esc_html__( 'Copyright', 'the9-store' ),
			'priority'   => 130,
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
			)
		);
		
		// Setting copyright_text.
		$wp_customize->add_setting( 'copyright_text',
			array(
			'default'           => $default['copyright_text'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'copyright_text',
			array(
			'label'    => esc_html__( 'Footer Copyright Text', 'the9-store' ),
			'section'  => 'footer_section',
			'type'     => 'textarea',
			'priority' => 120,
			)
		);
		


					
		
		
		
	


		