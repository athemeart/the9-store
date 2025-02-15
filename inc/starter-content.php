<?php
/**
 * The9 Store Starter Content
 *
 * @link https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
 *
 * @package The9 Store
 * @subpackage the9-store
 * @since The9 Store 1.0.0
 */

/**
 * Function to return the array of starter content for the theme.
 *
 * Passes it through the `the9_store_get_starter_content` filter before returning.
 *
 * @since the9-store 1.0.0
 *
 * @return array A filtered array of args for the starter_content.
 */

function the9_store_get_starter_content() {

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets'     => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar'  => array(
				'search',
				'text_about',
				'text_business_info',
			),
			// Add the core-defined business info widget to the footer 1 area.
			'footer-1' => array(
				'text_business_info',
				'text_about',
				'search',
			),
			'slider' => array(
			// Widget ID
			        'my_text' => array(
					// Widget $id -> set when creating a Widget Class
			        	'custom_html' , 
			        	// Widget $instance -> settings 
					array(
					  'title' => '',
					  'content'  => '<div id="static_header_banner" class="header-img" style="background-image: url('.esc_url( get_theme_file_uri( '/assets/image/custom-header.jpg' ) ).'); background-attachment: scroll; background-size: cover; background-position: center center;height: 70vh;"><div class="content-text" bis_skin_checked="1"><div class="container" bis_skin_checked="1"><div class="site-header-text-wrap" bis_skin_checked="1"><h1 class="page-title-text">Create. Reliable. Inspire.</h1><p>Discover the perfect blend of simplicity and functionality with easy eCommerce and blogging theme, designed for your upcoming online store. Elevate your online presence effortlessly!</p></div></div></div></div>'
					)
				),
				'filter' => true,
				'visual' => true,
		     ),
			
			//custom_html
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'       => array(
			'front' => array(
				'post_type'    => 'page',
                'template' => 'page-templates/homepage.php',
				'post_title'   => esc_html_x( 'Homepage', 'Theme starter content', 'the9-store' ),
				'post_content' => '<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="margin-top:0px;margin-bottom:0px"><!-- wp:spacer {"height":"var:preset|spacing|xx-large"} -->
<div style="height:var(--wp--preset--spacing--xx-large)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0px"><!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:cover {"url":"'.esc_url( get_theme_file_uri( '/assets/image/quick-patterns-1.webp' ) ).'","dimRatio":20,"overlayColor":"quaternary","focalPoint":{"x":0.5,"y":0},"minHeight":705,"contentPosition":"bottom left","isDark":false,"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-left" style="min-height:724px"><span aria-hidden="true" class="wp-block-cover__background has-quaternary-background-color has-background-dim-20 has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="'.esc_url( get_theme_file_uri( '/assets/image/quick-patterns-1.webp' ) ).'" style="object-position:50% 0%" data-object-fit="cover" data-object-position="50% 0%"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"0","padding":{"bottom":"var:preset|spacing|x-small","left":"var:preset|spacing|x-small"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--x-small);padding-left:var(--wp--preset--spacing--x-small)"><!-- wp:paragraph {"align":"left","placeholder":"Write title…","fontSize":"small"} -->
<p class="has-text-align-left has-small-font-size">Fresh Designs of Our Spring Collection</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">New Arrivals</h2>
<!-- /wp:heading -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|x-small"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--x-small)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Shop Now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group"><!-- wp:cover {"url":"'.esc_url( get_theme_file_uri( '/assets/image/quick-patterns-2.webp' ) ).'","dimRatio":20,"overlayColor":"quaternary","focalPoint":{"x":0.5,"y":0.5},"minHeight":350,"contentPosition":"bottom left","isDark":false,"style":{"spacing":{"blockGap":"var:preset|spacing|xx-small"},"layout":{"selfStretch":"fit","flexSize":null}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-left" style="min-height:350px"><span aria-hidden="true" class="wp-block-cover__background has-quaternary-background-color has-background-dim-20 has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="'.esc_url( get_theme_file_uri( '/assets/image/quick-patterns-2.webp' ) ).'" style="object-position:50% 50%" data-object-fit="cover" data-object-position="50% 50%"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"0","padding":{"bottom":"var:preset|spacing|x-small","left":"var:preset|spacing|x-small"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--x-small);padding-left:var(--wp--preset--spacing--x-small)"><!-- wp:paragraph {"align":"left","placeholder":"Write title…","fontSize":"small"} -->
<p class="has-text-align-left has-small-font-size">Comfort With Our latest Footwear Collection</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Footwear</h2>
<!-- /wp:heading -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|x-small"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--x-small)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Shop Now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"url":"'.esc_url( get_theme_file_uri( '/assets/image/quick-patterns-3.webp' ) ).'","dimRatio":20,"overlayColor":"quaternary","minHeight":350,"contentPosition":"bottom left","isDark":false,"style":{"spacing":{"blockGap":"var:preset|spacing|xx-small"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-left" style="min-height:350px"><span aria-hidden="true" class="wp-block-cover__background has-quaternary-background-color has-background-dim-20 has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="'.esc_url( get_theme_file_uri( '/assets/image/quick-patterns-3.webp' ) ).'" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"0","padding":{"bottom":"var:preset|spacing|x-small","left":"var:preset|spacing|x-small"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--x-small);padding-left:var(--wp--preset--spacing--x-small)"><!-- wp:paragraph {"align":"left","placeholder":"Write title…","fontSize":"small"} -->
<p class="has-text-align-left has-small-font-size">Exclusive Selection of Imported</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Perfumes</h2>
<!-- /wp:heading -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|x-small"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--x-small)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Shop Now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"var:preset|spacing|xx-large"} -->
<div style="height:var(--wp--preset--spacing--xx-large)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group -->
<!-- wp:columns -->
<div class="wp-block-columns" style="padding:30px; background:#fff; margin:20px"><!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">Get Inspired</h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Can’t creepeth fourth brought open all also gathered subdue likeness. Deep, abundantly, tree every face image sea his. Which god created to gathering the given image.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:image {"id":1910,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full wp-image-1910"><img src="'.esc_url( get_template_directory_uri() . '/assets/image/patterns-1.webp').'" alt="" class="wp-image-1910"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:image {"id":1909,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="'.esc_url( get_template_directory_uri() . '/assets/image/patterns-2.webp').'" alt="" class="wp-image-1909"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --><!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|large"}}},"layout":{"type":"constrained"},"metadata":{"name":"Popular Categories"}} -->
<div class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"spacing":{"blockGap":"8px","margin":{"bottom":"var:preset|spacing|small"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--small)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Explore Popular Categories</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Shop by our popular categories below, loream ipsum dolor amet</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"24px"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-4.webp","id":14,"dimRatio":0,"customOverlayColor":"#f8edda","minHeight":320,"minHeightUnit":"px","contentPosition":"bottom center","isDark":false,"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":{"topLeft":"16px","topRight":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="border-top-left-radius:16px;border-top-right-radius:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:320px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#f8edda"></span><img class="wp-block-cover__image-background wp-image-14" alt="" src="'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-4.webp" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"color":{"background":"#ffffffe3"},"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="background-color:#ffffffe3"><!-- wp:heading {"textAlign":"center","level":5} -->
<h5 class="wp-block-heading has-text-align-center">Men Collection</h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"8px"}}},"fontSize":"14"} -->
<p class="has-text-align-center has-14-font-size" style="padding-top:8px">12 Items</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-5.webp","id":15,"dimRatio":0,"customOverlayColor":"#fae2e8","minHeight":320,"minHeightUnit":"px","contentPosition":"bottom center","isDark":false,"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":{"topLeft":"16px","topRight":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="border-top-left-radius:16px;border-top-right-radius:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:320px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#fae2e8"></span><img class="wp-block-cover__image-background wp-image-15" alt="" src="'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-5.webp" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"color":{"background":"#ffffffe3"},"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="background-color:#ffffffe3"><!-- wp:heading {"textAlign":"center","level":5} -->
<h5 class="wp-block-heading has-text-align-center">For Women</h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"8px"}}},"fontSize":"14"} -->
<p class="has-text-align-center has-14-font-size" style="padding-top:8px">10 Items</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-6.webp","id":12,"dimRatio":0,"customOverlayColor":"#e4f3bb","minHeight":320,"minHeightUnit":"px","contentPosition":"bottom center","isDark":false,"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":{"topLeft":"16px","topRight":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="border-top-left-radius:16px;border-top-right-radius:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:320px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#e4f3bb"></span><img class="wp-block-cover__image-background wp-image-12" alt="" src="'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-6.webp" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"color":{"background":"#ffffffe3"},"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="background-color:#ffffffe3"><!-- wp:heading {"textAlign":"center","level":5} -->
<h5 class="wp-block-heading has-text-align-center">Accessories</h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"8px"}}},"fontSize":"14"} -->
<p class="has-text-align-center has-14-font-size" style="padding-top:8px">20 Items</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-2.webp","id":13,"dimRatio":0,"customOverlayColor":"#d5ecfa","minHeight":320,"minHeightUnit":"px","contentPosition":"bottom center","isDark":false,"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":{"topLeft":"16px","topRight":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="border-top-left-radius:16px;border-top-right-radius:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:320px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#d5ecfa"></span><img class="wp-block-cover__image-background wp-image-13" alt="" src="'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-2.webp" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"color":{"background":"#ffffffe3"},"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="background-color:#ffffffe3"><!-- wp:heading {"textAlign":"center","level":5} -->
<h5 class="wp-block-heading has-text-align-center">Jackets &amp; Coats</h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"8px"}}},"fontSize":"14"} -->
<p class="has-text-align-center has-14-font-size" style="padding-top:8px">16 Items</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
			),
            'about' => array(
                'thumbnail'    => '{{image-about-us}}',
                'post_type'    => 'page',
                'post_title'   => esc_html_x( 'About Us', 'Theme starter content', 'the9-store' ),
                'post_content' => '<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">Get Inspired</h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Can’t creepeth fourth brought open all also gathered subdue likeness. Deep, abundantly, tree every face image sea his. Which god created to gathering the given image.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:image {"id":1910,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full wp-image-1910"><img src="'.esc_url( get_template_directory_uri() . '/assets/image/patterns-1.webp').'" alt="" class="wp-image-1910"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:image {"id":1909,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="'.esc_url( get_template_directory_uri() . '/assets/image/patterns-2.webp').'" alt="" class="wp-image-1909"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
            ),
            'contact' => array(
                'post_type'    => 'page',
                'post_title'   => esc_html_x( 'Contact', 'Theme starter content', 'the9-store' ),
                'post_content' => '<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|large"}}},"layout":{"type":"constrained"},"metadata":{"name":"Popular Categories"}} -->
<div class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"spacing":{"blockGap":"8px","margin":{"bottom":"var:preset|spacing|small"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--small)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Explore Popular Categories</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Shop by our popular categories below, loream ipsum dolor amet</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"24px"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-4.webp","id":14,"dimRatio":0,"customOverlayColor":"#f8edda","minHeight":320,"minHeightUnit":"px","contentPosition":"bottom center","isDark":false,"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":{"topLeft":"16px","topRight":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="border-top-left-radius:16px;border-top-right-radius:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:320px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#f8edda"></span><img class="wp-block-cover__image-background wp-image-14" alt="" src="'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-4.webp" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"color":{"background":"#ffffffe3"},"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="background-color:#ffffffe3"><!-- wp:heading {"textAlign":"center","level":5} -->
<h5 class="wp-block-heading has-text-align-center">Men Collection</h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"8px"}}},"fontSize":"14"} -->
<p class="has-text-align-center has-14-font-size" style="padding-top:8px">12 Items</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-5.webp","id":15,"dimRatio":0,"customOverlayColor":"#fae2e8","minHeight":320,"minHeightUnit":"px","contentPosition":"bottom center","isDark":false,"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":{"topLeft":"16px","topRight":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="border-top-left-radius:16px;border-top-right-radius:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:320px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#fae2e8"></span><img class="wp-block-cover__image-background wp-image-15" alt="" src="'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-5.webp" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"color":{"background":"#ffffffe3"},"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="background-color:#ffffffe3"><!-- wp:heading {"textAlign":"center","level":5} -->
<h5 class="wp-block-heading has-text-align-center">For Women</h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"8px"}}},"fontSize":"14"} -->
<p class="has-text-align-center has-14-font-size" style="padding-top:8px">10 Items</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-6.webp","id":12,"dimRatio":0,"customOverlayColor":"#e4f3bb","minHeight":320,"minHeightUnit":"px","contentPosition":"bottom center","isDark":false,"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":{"topLeft":"16px","topRight":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="border-top-left-radius:16px;border-top-right-radius:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:320px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#e4f3bb"></span><img class="wp-block-cover__image-background wp-image-12" alt="" src="'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-6.webp" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"color":{"background":"#ffffffe3"},"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="background-color:#ffffffe3"><!-- wp:heading {"textAlign":"center","level":5} -->
<h5 class="wp-block-heading has-text-align-center">Accessories</h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"8px"}}},"fontSize":"14"} -->
<p class="has-text-align-center has-14-font-size" style="padding-top:8px">20 Items</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-2.webp","id":13,"dimRatio":0,"customOverlayColor":"#d5ecfa","minHeight":320,"minHeightUnit":"px","contentPosition":"bottom center","isDark":false,"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":{"topLeft":"16px","topRight":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="border-top-left-radius:16px;border-top-right-radius:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:320px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#d5ecfa"></span><img class="wp-block-cover__image-background wp-image-13" alt="" src="'.esc_url( get_template_directory_uri() ).'/assets/image/quick-patterns-2.webp" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"color":{"background":"#ffffffe3"},"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="background-color:#ffffffe3"><!-- wp:heading {"textAlign":"center","level":5} -->
<h5 class="wp-block-heading has-text-align-center">Jackets &amp; Coats</h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"8px"}}},"fontSize":"14"} -->
<p class="has-text-align-center has-14-font-size" style="padding-top:8px">16 Items</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
            ),
		  'blog',
		),
		'theme_mods' => array(
            'custom_logo' => '{{logo}}',
            'blogname'      => '',         // Remove Site Title
            'blogdescription' => '',       // Remove Tagline
        ),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
             'image-about-us' => array(
                    'post_title' => _x( 'About Us', 'Theme starter content', 'the9-store' ),
                    'file'       => 'assets/image/header-image-contact.jpg', // URL relative to the template directory.
             ),
             'logo' => array(
                'post_title'    => _x( 'Logo', 'Theme starter content', 'the9-store' ),
                'post_content'  => '',
                'file'          => 'assets/image/the9-store-logo.png', // Adjust path to your logo
            ),
		),

		
		// Default to a static front page and assign the front and posts pages.
		'options'     => array(
			'custom_logo' => '{{logo}}',
			'header_textcolor' => 'blank',
			'show_on_front'  => 'page',
			'page_on_front'  => '{{front}}',
			'page_for_posts' => '{{blog}}',
			'__dialogue' => 'Your custom dialogue content here', // Set the option value
            '__fb_pro_link' => '#',
            '__tw_pro_link' => '#',
            '__you_pro_link' => '#',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'   => array(
			// Assign a menu to the "primary" location.
			'menu-1' => array(
				'name'  => __( 'Main Menu', 'the9-store' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
	);

	/**
	 * Filters the9-store array of starter content.
	 *
	 * @since the9-store 1.0.0
	 *
	 * @param array $starter_content Array of starter content.
	 */
	return apply_filters( 'the9_store_starter_content', $starter_content );
}

