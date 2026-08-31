<?php
/**
 * Native storefront homepage assembled from WordPress and WooCommerce data.
 *
 * @package the9-store
 */

defined( 'ABSPATH' ) || exit;

final class The9_Store_Homepage {
	/** Render the whole theme-owned storefront. */
	public static function render() {
		self::hero();
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		self::categories();
		self::product_section( __( 'Featured Products', 'the9-store' ), self::featured_products(), 'featured' );
		self::product_section( __( 'Today’s Deals', 'the9-store' ), self::sale_products(), 'sale' );
		self::product_section( __( 'New Arrivals', 'the9-store' ), self::latest_products(), 'latest' );
	}

	/** Use the front-page media and copy, with existing catalog media as a safe fallback. */
	private static function hero() {
		$page_id  = get_queried_object_id();
		$image_id = $page_id ? get_post_thumbnail_id( $page_id ) : 0;
		if ( ! $image_id && class_exists( 'WooCommerce' ) ) {
			$image_id = self::catalog_image_id();
		}
		$title       = $page_id ? get_the_title( $page_id ) : get_bloginfo( 'name' );
		$description = $page_id ? get_post_field( 'post_excerpt', $page_id ) : '';
		$description = $description ?: get_bloginfo( 'description', 'display' );
		$shop_url    = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
		?>
		<section class="the9-home-hero<?php echo $image_id ? ' has-image' : ''; ?>" aria-labelledby="the9-home-title">
			<?php if ( $image_id ) : ?>
				<?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'the9-home-hero__image', 'fetchpriority' => 'high', 'sizes' => '100vw' ) ); ?>
			<?php endif; ?>
			<div class="container the9-home-hero__content">
				<div class="the9-home-hero__copy">
					<h1 id="the9-home-title"><?php echo esc_html( $title ); ?></h1>
					<?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?>
					<?php if ( class_exists( 'WooCommerce' ) ) : ?><a class="the9-home-button" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Shop now', 'the9-store' ); ?><i class="bi bi-arrow-right" aria-hidden="true"></i></a><?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}

	/** Resolve one existing catalog image without inventing demo media. */
	private static function catalog_image_id() {
		$categories = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true, 'number' => 1, 'meta_key' => 'thumbnail_id', 'orderby' => 'count', 'order' => 'DESC' ) );
		if ( ! is_wp_error( $categories ) && $categories ) {
			$image_id = absint( get_term_meta( $categories[0]->term_id, 'thumbnail_id', true ) );
			if ( $image_id ) {
				return $image_id;
			}
		}
		$products = wc_get_products( array( 'status' => 'publish', 'limit' => 1, 'orderby' => 'date', 'order' => 'DESC', 'return' => 'objects' ) );
		return $products ? absint( $products[0]->get_image_id() ) : 0;
	}

	/** Show non-empty top-level categories only when they own real media. */
	private static function categories() {
		$terms = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true, 'parent' => 0, 'number' => 8, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
		if ( is_wp_error( $terms ) || ! $terms ) {
			return;
		}
		$terms = array_values( array_filter( $terms, static fn( $term ) => absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) ) ) );
		if ( ! $terms ) {
			return;
		}
		?>
		<section class="the9-home-section the9-home-categories" aria-labelledby="the9-categories-title">
			<div class="container">
				<header class="the9-home-section__header"><div><span><?php esc_html_e( 'Browse the store', 'the9-store' ); ?></span><h2 id="the9-categories-title"><?php esc_html_e( 'Shop by Category', 'the9-store' ); ?></h2></div></header>
				<div class="the9-home-categories__grid">
					<?php foreach ( $terms as $term ) : $image_id = absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) ); $term_url = get_term_link( $term ); ?>
						<?php if ( is_wp_error( $term_url ) ) { continue; } ?>
						<a class="the9-home-category" href="<?php echo esc_url( $term_url ); ?>">
							<?php echo wp_get_attachment_image( $image_id, 'woocommerce_thumbnail', false, array( 'loading' => 'lazy' ) ); ?>
							<span><strong><?php echo esc_html( $term->name ); ?></strong><small><?php echo esc_html( sprintf( _n( '%s product', '%s products', $term->count, 'the9-store' ), number_format_i18n( $term->count ) ) ); ?></small></span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
	}

	/** Render products through the active The9/WooCommerce card hooks. */
	private static function product_section( $title, $products, $slug ) {
		$products = array_values( array_filter( $products, static fn( $item ) => $item instanceof WC_Product && $item->is_visible() ) );
		if ( ! $products ) {
			return;
		}
		global $product, $post;
		$original_product = $product;
		$original_post    = $post;
		?>
		<section class="the9-home-section the9-home-products the9-home-products--<?php echo esc_attr( $slug ); ?>" aria-labelledby="the9-<?php echo esc_attr( $slug ); ?>-title">
			<div class="container">
				<header class="the9-home-section__header"><h2 id="the9-<?php echo esc_attr( $slug ); ?>-title"><?php echo esc_html( $title ); ?></h2></header>
				<?php wc_set_loop_prop( 'columns', 4 ); woocommerce_product_loop_start(); ?>
				<?php foreach ( $products as $item ) : ?>
					<?php $product = $item; $post = get_post( $item->get_id() ); if ( $post ) { setup_postdata( $post ); wc_get_template_part( 'content', 'product' ); } ?>
				<?php endforeach; ?>
				<?php woocommerce_product_loop_end(); ?>
			</div>
		</section>
		<?php
		$product = $original_product;
		$post    = $original_post;
		if ( $original_post instanceof WP_Post ) {
			setup_postdata( $original_post );
		} else {
			wp_reset_postdata();
		}
		wc_reset_loop();
	}

	private static function featured_products() {
		return wc_get_products( array( 'status' => 'publish', 'limit' => 8, 'featured' => true, 'orderby' => 'date', 'order' => 'DESC' ) );
	}

	private static function sale_products() {
		$ids = array_values( array_filter( array_map( 'absint', wc_get_product_ids_on_sale() ) ) );
		return $ids ? wc_get_products( array( 'status' => 'publish', 'limit' => 8, 'include' => $ids, 'orderby' => 'date', 'order' => 'DESC' ) ) : array();
	}

	private static function latest_products() {
		return wc_get_products( array( 'status' => 'publish', 'limit' => 8, 'orderby' => 'date', 'order' => 'DESC' ) );
	}

}
