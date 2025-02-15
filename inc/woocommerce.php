<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package the9-store
 */
/**
 *  Hook remove from WooCommerce archive
 */
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb',20 );
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );

remove_action( 'woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10 );
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5 );
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );


remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10 );


remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5 );
remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10 );

//

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display',5 );
add_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_rating', 20 );
add_filter( 'woocommerce_product_description_heading', '__return_false' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );


remove_action( 'woocommerce_archive_description','woocommerce_taxonomy_archive_description',10 );
remove_action( 'woocommerce_archive_description','woocommerce_taxonomy_archive_description',10 );	

add_action( 'the9_store_archive_description','woocommerce_taxonomy_archive_description',10 );
add_action( 'the9_store_archive_description','woocommerce_taxonomy_archive_description',10 );	

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function the9_store_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 300,
			'single_image_width'    => 600,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'the9_store_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */

function the9_store_woocommerce_scripts() {
	
	wp_enqueue_style( 'the9-store-woocommerce-core', get_template_directory_uri() . '/assets/css/woocommerce-core.css', array(), _SOPER_VERSION );
	wp_enqueue_style( 'the9-store-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _SOPER_VERSION );

	$font_path   = esc_url( WC()->plugin_url() . '/assets/fonts/' );
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . esc_url( $font_path ) . 'star.eot");
			src: url("' . esc_url( $font_path ) . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . esc_url( $font_path ) . 'star.woff") format("woff"),
				url("' . esc_url( $font_path ) . 'star.ttf") format("truetype"),
				url("' . esc_url( $font_path ) . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'the9-store-woocommerce-style', $inline_font );

	wp_enqueue_script( 'the9-store-woocommerce', get_theme_file_uri( '/assets/js/the9-store-woocommerce.js' ) , 0, '1.1', true );
}
add_action( 'wp_enqueue_scripts', 'the9_store_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function the9_store_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'the9_store_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function the9_store_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'the9_store_woocommerce_related_products_args' );
add_filter( 'woocommerce_upsell_display_args', 'the9_store_woocommerce_related_products_args' );

add_filter( 'woocommerce_cross_sells_columns', 'the9_store_change_cross_sells_columns' );
 
function the9_store_change_cross_sells_columns( $columns ) {
	return 4;
}
/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'the9_store_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function the9_store_woocommerce_wrapper_before() {
		/**
		* Hook - the9_store_container_wrap_start 	
		*
		* @hooked the9_store_container_wrap_start	- 5
		*/
		if( is_product() ){
			 do_action( 'the9_store_container_wrap_start', 'no-sidebar');
		}else{
		 do_action( 'the9_store_container_wrap_start', 'full-container');
		}
	}
}
add_action( 'woocommerce_before_main_content', 'the9_store_woocommerce_wrapper_before' );

if ( ! function_exists( 'the9_store_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function the9_store_woocommerce_wrapper_after() {
		/**
		* Hook - the9_store_container_wrap_end	
		*
		* @hooked container_wrap_end - 999
		*/
		do_action( 'the9_store_container_wrap_end', 'full-container');
	}
}
add_action( 'woocommerce_after_main_content', 'the9_store_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'the9_store_woocommerce_header_cart' ) ) {
			the9_store_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'the9_store_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function the9_store_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		the9_store_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'the9_store_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'the9_store_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function the9_store_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'the9-store' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'the9-store' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> 
			<span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'the9_store_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function the9_store_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php the9_store_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

/*------------------------------------*/
	//TOOL BAR
/*------------------------------------*/
remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);

if ( ! function_exists( 'the9_store_toolbar_start' ) ) {
	/**
	 * Insert the opening anchor tag for products in the loop.
	 */
	function the9_store_toolbar_start() {
		echo '<div class="the9-store-toolbar clearfix" data-aos="fade-up">';
	}
	
	add_action('woocommerce_before_shop_loop','the9_store_toolbar_start',20);
}

/**
* Add Custom Result Counter.
*/
function the9_store_result_count() {
	get_template_part( 'woocommerce/result-count' );
}
add_action('woocommerce_before_shop_loop','the9_store_result_count',30);


if ( ! function_exists( 'the9_store_header_toolbar_end' ) ) {
	/**
	 * Insert the opening anchor tag for products in the loop.
	 */
	function the9_store_header_toolbar_end() {
		echo '<div class="clearfix"></div></div>';
	}
	
	add_action('woocommerce_before_shop_loop','the9_store_header_toolbar_end',30);
}


if ( ! function_exists( 'the9_store_loop_shop_per_page' ) ) :
	/**
	 * Returns correct posts per page for the shop
	 *
	 * @since 1.0.0
	 */
	function the9_store_loop_shop_per_page() {
		
		$posts_per_page = ( isset( $_GET['products-per-page'] ) ) ? sanitize_text_field( wp_unslash( $_GET['products-per-page'] ) ) : get_theme_mod( 'shopstore_woo_shop_posts_per_page',12 );

		if ( $posts_per_page == 'all' ) {
			$posts_per_page = wp_count_posts( 'product' )->publish;
		}
		
		return $posts_per_page;
	}
	add_filter( 'loop_shop_per_page', 'the9_store_loop_shop_per_page', 20 );
endif;

/*------------------------------------*/
	//PRODUCT LOOP
/*------------------------------------*/


/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function the9_store_woocommerce_loop_columns() {
	return 4;
}
add_filter( 'loop_shop_columns', 'the9_store_woocommerce_loop_columns' );



if ( ! function_exists( 'the9_store_loop_product_thumbnail' ) ) {
	
	/**
	 * Get the product thumbnail for the loop.
	 */
	function the9_store_loop_product_thumbnail() {
		global $product;
		$attachment_ids   = $product->get_gallery_image_ids();
		
		
		echo '<div class="product-image">';

		
			if( isset( $attachment_ids[0] ) && $attachment_ids[0] != "" ) {
			
				$img_tag = array(
				'class'         => 'woo-entry-image-secondary',
				'alt'           => get_the_title(),
				);
				
				echo '<figure class="hover_hide">'. wp_kses_post(woocommerce_get_product_thumbnail()) . wp_get_attachment_image( $attachment_ids[0], 'shop_catalog', '', $img_tag ) .'</figure>';

			}else{
				echo '<figure>'.wp_kses_post(woocommerce_get_product_thumbnail()).'</figure>';	
			}
		echo '</div>';	
	}
	
	add_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_link_open',10 );

	add_action( 'woocommerce_before_shop_loop_item_title','the9_store_loop_product_thumbnail',30 );
	add_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_link_close',99 );
	
	

	
}

if ( ! function_exists( 'the9_store_shop_loop_content_before' ) ) {

	/**
	 * end the product content wrap
	 */
	function the9_store_shop_loop_content_before() {
		echo '<div class="product_wrap">';
	}
	add_action( 'woocommerce_shop_loop_item_title', 'the9_store_shop_loop_content_before', 5 );
}

if ( ! function_exists( 'the9_store_shop_loop_item_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an h4.
	 */
	function the9_store_shop_loop_item_title() {
		echo '<h4 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . esc_html( get_the_title() ) . '</h4>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	add_action( 'woocommerce_shop_loop_item_title', 'the9_store_shop_loop_item_title', 15 );
}


if ( ! function_exists( 'the9_store_shop_loop_content_after' ) ) {

	/**
	 * end the product content wrap
	 */
	function the9_store_shop_loop_content_after() {
		echo '</div>';
	}
	add_action( 'woocommerce_after_shop_loop_item', 'the9_store_shop_loop_content_after', 999);
}



if ( ! function_exists( 'the9_store_before_quantity_input_field' ) ) {
	/**
	 * before quantity.
	 *
	 *
	 * @return $html
	 */
	function the9_store_before_quantity_input_field() {
		echo '<button type="button" class="plus"><i class="icofont-plus"></i></button>';
	}
	add_action( 'woocommerce_before_quantity_input_field','the9_store_before_quantity_input_field',10);
	
	
}

if ( ! function_exists( 'the9_store_after_quantity_input_field' ) ) {
	/**
	 * after quantity.
	 *
	 *
	 * @return $html
	 */
	function the9_store_after_quantity_input_field() {
		echo '<button type="button" class="minus"><i class="icofont-minus"></i></button>';
	}
	add_action( 'woocommerce_after_quantity_input_field','the9_store_after_quantity_input_field',10);
	
	
}


if ( ! function_exists( 'the9_store_template_loop_add_to_cart_before' ) ) {
	
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart',10 );
	/**
	 * After loop Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return $html
	 */
	function the9_store_template_loop_add_to_cart_before() {
		echo '<ul class="button-group clearfix d-flex">';
	}
	add_action( 'woocommerce_after_shop_loop_item','the9_store_template_loop_add_to_cart_before',5);
	add_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_price',10);
}

if ( ! function_exists( 'the9_store_template_loop_add_to_cart_after' ) ) {
	/**
	 * After loop Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return $html
	 */
	function the9_store_template_loop_add_to_cart_after() {
		echo '</ul>';
	}
	add_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',20);
	add_action( 'woocommerce_after_shop_loop_item','the9_store_template_loop_add_to_cart_after',30);
	
}


add_filter('woocommerce_sale_flash', 'the9_store_change_sale_text');
function the9_store_change_sale_text() {
    global $product;
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();
    if ( $regular_price && $sale_price && $regular_price > $sale_price ) {
        	 $discount_percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
        	$saved_amount = $regular_price - $sale_price;
        return '<span class="onsale">'. esc_html__( 'Save', 'the9-store') .' '. absint( $discount_percentage ) . '%</span>';
    } 

}


if ( ! function_exists( 'the9_store_item_box_content_categories' ) ) {
	/**
	 * Product Loop categorie.
	 *
	 * @return  void
	 */
	function the9_store_item_box_content_categories() {
	    global $product;
	    echo '<div class="cat-name">';
	    echo wp_kses( wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">', '</span>' ), the9_store_alowed_tags() );
	    echo '</div>';
	}
}
add_action( 'woocommerce_shop_loop_item_title', 'the9_store_item_box_content_categories',10);
