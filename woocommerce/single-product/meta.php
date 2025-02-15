<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     11.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'the9-store' ); ?> <span class="sku"><?php echo !empty($product->get_sku()) ? esc_html( $product->get_sku() ) : esc_html__( 'N/A', 'the9-store' ); ?></span></span>

	<?php endif; ?>

	<?php 
	echo wp_kses( wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'the9-store' ) . ' ', '</span>' ), the9_store_alowed_tags()); 
	
	?>

	<?php 
	
	echo wp_kses( wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'the9-store' ) . ' ', '</span>' ),the9_store_alowed_tags());
	
	 ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
