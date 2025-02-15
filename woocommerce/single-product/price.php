<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 11.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="d-flex align-items-center price-wrap">
<p class="price"><?php echo $product->get_price_html(); ?></p>

<?php
   // Check if the product is variable.
    if ( $product->is_type( 'variable' ) ) {
        // Add a container to dynamically update stock status.
        echo '<div id="variable-stock-status" class="stock-status-container"></div>';
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                // Listen for changes on the variation dropdown.
                $('form.variations_form').on('show_variation', function(event, variation) {
                    let stockStatus = '';

                    if (variation.is_in_stock) {
                        if (variation.max_qty > 0) {
                            stockStatus = '<span class="stock-status in-stock">' + variation.max_qty + ''.esc_html__( 'In Stock', 'the9-store' ).'</span>';
                        }
                    } else {
                        stockStatus = '<span class="stock-status out-of-stock">'.esc_html__( 'Out of Stock', 'the9-store' ).'</span>';
                    }

                    $('#variable-stock-status').html(stockStatus);
                });

                // Clear stock status when no variation is selected.
                $('form.variations_form').on('reset_data', function() {
                    $('#variable-stock-status').html('');
                });
            });
        </script>
        <?php
    } else {
        // For simple products, show static stock status.
        if ( $product->is_in_stock() ) {
            $stock_quantity = $product->get_stock_quantity();
            if ( $stock_quantity !== null ) {
                /* translators: %d represents the number of items in stock */
                echo '<span class="stock-status in-stock">' . sprintf( esc_html__( '%d In Stock', 'the9-store' ), absint($stock_quantity)) . '</span>';
            } 
        } else {
            echo '<span class="stock-status out-of-stock">' . esc_html__( 'Out of Stock', 'the9-store' ) . '</span>';
        }
    }
?>
</div>

