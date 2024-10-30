<?php

defined( 'ABSPATH' ) || exit;

?>
<div>
	<?php if ( WC()->cart->needs_payment() ) : ?>
		<ul class="wc_payment_methods payment_methods methods form-checkout-radio">
			<?php
			if ( ! empty( $available_gateways ) ) {
				foreach ( $available_gateways as $gateway ): ?>
			
					

					<div class="place-for-radio">
                        <label class="radio-button-container" disabled=""><?= $gateway->get_title();?>
						<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
                            <span class="checkmark-radio"></span>
                        </label>
                    </div>


				<?php endforeach;
			} else {
				echo '<li>';
				wc_print_notice( apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ), 'notice' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment
				echo '</li>';
			}
			?>
		</ul>
	<?php endif; ?>
</div>

