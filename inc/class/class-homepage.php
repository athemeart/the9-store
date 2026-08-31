<?php
/** Native Demo 1-style storefront assembled from WordPress/WooCommerce data. */
defined( 'ABSPATH' ) || exit;

final class The9_Store_Homepage {
	public static function render() {
		self::hero_composition();
		if ( ! class_exists( 'WooCommerce' ) ) { return; }
		self::deal_of_the_day();
		self::product_section( __( 'Trending Products', 'the9-store' ), self::popular_products( 8 ), 'trending' );
		self::category_campaign();
		self::popular_selling();
		self::promotion_grid();
	}

	private static function hero_composition() {
		$page_id = get_queried_object_id();
		$image_id = $page_id ? get_post_thumbnail_id( $page_id ) : 0;
		$promotions = class_exists( 'WooCommerce' ) ? self::image_categories( 2 ) : array();
		$image_id = $image_id ?: ( class_exists( 'WooCommerce' ) ? self::catalog_image_id() : 0 );
		$title = $page_id ? get_the_title( $page_id ) : get_bloginfo( 'name' );
		$description = $page_id ? get_post_field( 'post_excerpt', $page_id ) : '';
		$description = $description ?: get_bloginfo( 'description', 'display' );
		$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
		?>
		<section class="the9-home-hero-wrap"><div class="container the9-home-hero-grid">
			<article class="the9-home-hero<?php echo $image_id ? ' has-image' : ''; ?>" aria-labelledby="the9-home-title">
				<?php if ( $image_id ) : echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'the9-home-hero__image', 'fetchpriority' => 'high', 'sizes' => '(min-width: 992px) 68vw, 100vw' ) ); endif; ?>
				<div class="the9-home-hero__content"><p class="the9-home-eyebrow"><?php esc_html_e( 'Explore the latest', 'the9-store' ); ?></p><h1 id="the9-home-title"><?php echo esc_html( $title ); ?></h1><?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?><?php if ( class_exists( 'WooCommerce' ) ) : ?><a class="the9-home-button" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Shop now', 'the9-store' ); ?><i class="bi bi-arrow-right" aria-hidden="true"></i></a><?php endif; ?></div>
			</article>
			<?php if ( $promotions ) : ?><div class="the9-home-hero-promotions"><?php foreach ( $promotions as $term ) { self::category_card( $term, 'hero' ); } ?></div><?php endif; ?>
		</div></section>
		<?php
	}

	private static function deal_of_the_day() {
		$products = self::sale_products( 5 );
		if ( ! $products ) { return; }
		$lead = array_shift( $products );
		?>
		<section class="the9-home-section the9-home-deal" aria-labelledby="the9-deal-title"><div class="container">
			<header class="the9-home-section__header"><div><span><?php esc_html_e( 'Only for today', 'the9-store' ); ?></span><h2 id="the9-deal-title"><?php esc_html_e( 'Deal of the Day', 'the9-store' ); ?></h2></div></header>
			<div class="the9-home-deal__layout"><article class="the9-home-deal__lead"><a class="the9-home-deal__image" href="<?php echo esc_url( $lead->get_permalink() ); ?>"><?php echo $lead->get_image( 'woocommerce_single', array( 'loading' => 'lazy' ) ); ?></a><div class="the9-home-deal__copy"><?php echo wp_kses_post( wc_get_product_category_list( $lead->get_id(), ', ', '<p class="the9-home-product-terms">', '</p>' ) ); ?><h3><a href="<?php echo esc_url( $lead->get_permalink() ); ?>"><?php echo esc_html( $lead->get_name() ); ?></a></h3><div class="price"><?php echo wp_kses_post( $lead->get_price_html() ); ?></div><a class="the9-home-button" href="<?php echo esc_url( $lead->get_permalink() ); ?>"><?php esc_html_e( 'View product', 'the9-store' ); ?></a></div></article><?php if ( $products ) : ?><div class="the9-home-deal__rail"><?php self::product_loop( $products, 2 ); ?></div><?php endif; ?></div>
		</div></section>
		<?php
	}

	private static function category_campaign() {
		$categories = self::image_categories( 3 );
		$term = $categories[2] ?? $categories[0] ?? null;
		if ( ! $term ) { return; }
		$image_id = absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) );
		$url = get_term_link( $term );
		if ( ! $image_id || is_wp_error( $url ) ) { return; }
		?>
		<section class="the9-home-section the9-home-campaign"><div class="container"><a href="<?php echo esc_url( $url ); ?>"><?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'loading' => 'lazy' ) ); ?><span><small><?php esc_html_e( 'Featured collection', 'the9-store' ); ?></small><strong><?php echo esc_html( $term->name ); ?></strong><b><?php esc_html_e( 'Shop now', 'the9-store' ); ?></b></span></a></div></section>
		<?php
	}

	private static function popular_selling() {
		$products = self::popular_products( 8 );
		$categories = self::image_categories( 5 );
		if ( ! $products ) { return; }
		?>
		<section class="the9-home-section the9-home-popular" aria-labelledby="the9-popular-title"><div class="container"><header class="the9-home-section__header the9-home-section__header--center"><div><span><?php esc_html_e( 'Customer favourites', 'the9-store' ); ?></span><h2 id="the9-popular-title"><?php esc_html_e( 'Popular Selling Products', 'the9-store' ); ?></h2></div><?php if ( $categories ) : ?><nav aria-label="<?php esc_attr_e( 'Popular product categories', 'the9-store' ); ?>"><?php foreach ( $categories as $term ) : $url = get_term_link( $term ); if ( ! is_wp_error( $url ) ) : ?><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $term->name ); ?></a><?php endif; endforeach; ?></nav><?php endif; ?></header><?php self::product_loop( $products, 4 ); ?></div></section>
		<?php
	}

	private static function promotion_grid() {
		$categories = array_slice( self::image_categories( 7 ), 3, 4 );
		if ( ! $categories ) { return; }
		?><section class="the9-home-section the9-home-promotions"><div class="container the9-home-promotions__grid"><?php foreach ( $categories as $term ) { self::category_card( $term, 'promo' ); } ?></div></section><?php
	}

	private static function product_section( $title, $products, $slug ) {
		$products = self::visible_products( $products );
		if ( ! $products ) { return; }
		?><section class="the9-home-section the9-home-products the9-home-products--<?php echo esc_attr( $slug ); ?>" aria-labelledby="the9-<?php echo esc_attr( $slug ); ?>-title"><div class="container"><header class="the9-home-section__header the9-home-section__header--center"><div><span><?php esc_html_e( 'Explore what customers choose', 'the9-store' ); ?></span><h2 id="the9-<?php echo esc_attr( $slug ); ?>-title"><?php echo esc_html( $title ); ?></h2></div></header><?php self::product_loop( $products, 4 ); ?></div></section><?php
	}

	private static function product_loop( $products, $columns ) {
		$products = self::visible_products( $products );
		if ( ! $products ) { return; }
		global $product, $post;
		$original_product = $product; $original_post = $post;
		wc_set_loop_prop( 'columns', absint( $columns ) );
		woocommerce_product_loop_start();
		foreach ( $products as $item ) { $product = $item; $post = get_post( $item->get_id() ); if ( $post ) { setup_postdata( $post ); wc_get_template_part( 'content', 'product' ); } }
		woocommerce_product_loop_end();
		$product = $original_product; $post = $original_post;
		if ( $original_post instanceof WP_Post ) { setup_postdata( $original_post ); } else { wp_reset_postdata(); }
		wc_reset_loop();
	}

	private static function category_card( $term, $variant ) {
		$image_id = absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) ); $url = get_term_link( $term );
		if ( ! $image_id || is_wp_error( $url ) ) { return; }
		?><a class="the9-home-category-card the9-home-category-card--<?php echo esc_attr( $variant ); ?>" href="<?php echo esc_url( $url ); ?>"><?php echo wp_get_attachment_image( $image_id, 'woocommerce_thumbnail', false, array( 'loading' => 'lazy' ) ); ?><span><small><?php esc_html_e( 'Explore collection', 'the9-store' ); ?></small><strong><?php echo esc_html( $term->name ); ?></strong><b><?php esc_html_e( 'Shop now', 'the9-store' ); ?></b></span></a><?php
	}

	private static function visible_products( $products ) { return array_values( array_filter( (array) $products, static fn( $item ) => $item instanceof WC_Product && $item->is_visible() ) ); }
	private static function sale_products( $limit = 8 ) { $ids = array_values( array_filter( array_map( 'absint', wc_get_product_ids_on_sale() ) ) ); return $ids ? self::visible_products( wc_get_products( array( 'status' => 'publish', 'limit' => absint( $limit ), 'include' => $ids, 'orderby' => 'date', 'order' => 'DESC' ) ) ) : array(); }
	private static function popular_products( $limit = 8 ) { return self::visible_products( wc_get_products( array( 'status' => 'publish', 'limit' => absint( $limit ), 'orderby' => 'popularity', 'order' => 'DESC' ) ) ); }
	private static function image_categories( $limit ) { $terms = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true, 'parent' => 0, 'number' => 30, 'orderby' => 'count', 'order' => 'DESC' ) ); if ( is_wp_error( $terms ) ) { return array(); } $terms = array_values( array_filter( $terms, static fn( $term ) => absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) ) ) ); return array_slice( $terms, 0, absint( $limit ) ); }
	private static function catalog_image_id() { $categories = self::image_categories( 1 ); if ( $categories ) { return absint( get_term_meta( $categories[0]->term_id, 'thumbnail_id', true ) ); } $products = wc_get_products( array( 'status' => 'publish', 'limit' => 1, 'orderby' => 'date', 'order' => 'DESC' ) ); return $products ? absint( $products[0]->get_image_id() ) : 0; }
}
