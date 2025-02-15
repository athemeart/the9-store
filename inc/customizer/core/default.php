<?php
/**
 * Default theme options.
 *
 * @package the9-store
 */

if ( ! function_exists( 'the9_store_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function the9_store_get_default_theme_options() {

		$defaults = array();
		
		
		/*Posts Layout*/
		$defaults['blog_layout']     				= 'sidebar-content';
		$defaults['single_post_layout']     		= 'sidebar-content';
		
		$defaults['blog_loop_content_type']     	= 'excerpt';
		
		$defaults['blog_meta_hide']     			= false;
		$defaults['signle_meta_hide']     			= false;
		
		/*Posts Layout*/
		$defaults['page_layout']     				= 'full-container';
		
		/*layout*/
		$defaults['copyright_text']					= esc_html__( 'Copyright All right reserved', 'the9-store' );
		$defaults['read_more_text']					= esc_html__( 'Continue Reading', 'the9-store' );
		$defaults['index_hide_thumb']     			= false;
		
		
		/*Posts Layout*/
		$defaults['__fb_pro_link']     				= '';
		$defaults['__tw_pro_link']     				= '';
		$defaults['__you_pro_link']     		    = '';
		$defaults['__pr_pro_link']     				= '';
		
		$defaults['__primary_color']     			= '#6c757d';
		$defaults['__secondary_color']     			= '#4E53C8';
		$defaults['__dialogue']					    = '';

		// Pass through filter.
		$defaults = apply_filters( 'the9_store_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
