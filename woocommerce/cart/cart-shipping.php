<?php

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
?>
<div class="woocommerce-shipping-totals shipping">
	
			<div id="shipping_method" class="woocommerce-shipping-methods form-checkout-radio">
				<?php foreach ( $available_methods as $method ) : ?>

					<div class="place-for-radio">
						<?php printf( '<label class="radio-button-container" for="shipping_method_%1$s_%2$s">%3$s', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) ); ?>
						<?php
						if ( 1 < count( $available_methods ) ) {
							printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
						} else {
							printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
						}
						do_action( 'woocommerce_after_shipping_rate', $method, $index );
						?>
						<span class="checkmark-radio"></span>
						</label>
						<span class="sub-title price-delivery-d-none">Безкоштовно</span>
					</div>
				<?php endforeach; ?>
			</div>


			
</div>
