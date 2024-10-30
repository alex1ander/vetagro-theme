<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>


	<?php if ( wc_coupons_enabled() ) : ?>
		<div class="information-block coupon-block">
			<a href="#" class="showcoupon use-coupon-btn">Застосувати купон</a>
		</div>

		<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

			<?php if(!WC()->cart->get_coupons()): ?>
				<p class="form-row form-row-first">
					<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
					<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
				</p>
				<button class="updater" type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
			<?php else: ?>

				<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
					<?php 
					wc_cart_totals_coupon_html_custom( $coupon );
					?>
			
				<?php endforeach; ?>


			<?php endif; ?>
			<div class="clear"></div>
		</form>
	<?php endif;?>



				<div class="information-block shop_table woocommerce-checkout-review-order-table2">
                    <div class="order-confrim">

                        <div class="short-info">

                            <div class="row">
                                <span class="service-name"><?= count(WC()->cart->get_cart()) ;?> товари на суму</span>
                                <span class="service-value fw-700"><?php wc_cart_totals_subtotal_html(); ?></span>
                            </div>
							<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                            <div class="row">
                                <span class="service-name">Сума знижки</span>
                                <span class="service-value fw-700">
									<?php 
									if ( is_string( $coupon ) ) {
										$coupon = new WC_Coupon( $coupon );
									}
								
									$amount               = WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax );
									echo $discount_amount_html = '-' . wc_price( $amount );
									?>
								</span>
                            </div>
							<?php endforeach; ?>

                            <div class="row">
                                <span class="service-name">Доставка</span>
                                <span class="service-value fw-700">за тарифами перевізника</span>
                            </div>

                        </div>

                        <div class="to-pay-info mt-30">
                            <div class="row">
                                <span class="pay-info  fw-700">До сплати</span>
                                <span class="pay-info  fw-700"><?php wc_cart_totals_order_total_html(); ?></span>
                            </div>
                        </div>




						<?php 
						if ( WC()->cart->needs_payment() ) {
							$available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
							WC()->payment_gateways()->set_current_gateway( $available_gateways );
						} else {
							$available_gateways = array();
						}
					
						wc_get_template(
							'checkout/payment-confirm.php',
							array(
								'checkout'           => WC()->checkout(),
								'available_gateways' => $available_gateways,
								'order_button_text'  => apply_filters( 'woocommerce_order_button_text', __( 'Place order', 'woocommerce' ) ),
							)
						);
						?>


                        <div class="confirm-order mt-30">
                            <label class="check-box">Оформлюючи замовлення, я даю згоду на обробку моїх персональних даних
                                <input type="checkbox" required>
                                <span class="checkmark-checkbox"></span>
                            </label>
                        </div>

                    </div>
                </div>
