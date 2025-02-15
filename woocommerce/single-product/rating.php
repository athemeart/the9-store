<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 11.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

 $average_rating = $product->get_average_rating(); // Get average rating.
 

if ( $rating_count > 0 ) : ?>

<div class="woocommerce-product-rating">
			<?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo wp_kses( wc_get_rating_html( $average, $rating_count ), the9_store_allowed_tags() ); ?>
			<?php

			if ( $review_count > 0 ) {
        // Format and display the rating and reviews.
        echo '<div class="custom-product-rating">';
        printf(/* translators: 1: average rating, 2: review count */
            esc_html__( 'Rated %1$s out of 5 (%1$s) %2$d Review(s)', 'the9-store' ),
            number_format( $average_rating, 2 ),
            absint( $review_count )
        );
        echo '</div>';
    }
        ?>


			<div class="clearfix"></div>
		</div>

<?php endif; ?>
