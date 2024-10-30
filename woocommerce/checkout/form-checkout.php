<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>



<?php
$checkout = WC()->checkout;


// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<div class="checkout-grid">
		<div class="checkout-form-block">
		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col2-set" id="customer_details">
				<div class="col-1">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>


				<div class="information-block for-table">
                    <table class="yellow-table">
                        <thead>
                            <tr>
                                <th>Товари</th>
                                <th>Ціна</th>
                                <th>Кількість</th>
                                <th>Сума</th>
                            </tr>
                        </thead>
                        <tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="product-table-grid woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-name">
							<div class="product-card">
								<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo $thumbnail; // PHPCS: XSS ok.
								} else {
									printf( '<div class="product-block-box">%s</div>', $thumbnail ); 
								}
								?>
								
								<?php
								if ( ! $product_permalink ) {
									echo wp_kses_post( $product_name . '&nbsp;' );
								} else {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<span class="product-title">%s</span>', $_product->get_name() ), $cart_item, $cart_item_key ) );
								}

								do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

								// Meta data.
								echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

								// Backorder notification.
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
								}
								?>	
							</div>
						</td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
							<?= sprintf( '<span class="current-count">%d од</span>', $cart_item['quantity']);?>
						</td>

						<td class="product-subtotal fw-700" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?= sprintf( '<span>%s</span>',  WC()->cart->get_product_subtotal( $_product, $cart_item['quantity']));?>

	
						</td>
					</tr>
					<?php
				}
			}
			?>

	
		</tbody>
                    </table>
                </div>


				<div id="order_review" class="woocommerce-checkout-review-order information-block">
					<div class="yellow-figure-rounded"></div>
					<h3>Спосіб доставки</h3>
					<?php
					wc_get_template(
						'checkout/review-order.php',
						array(
							'checkout' => WC()->checkout(),
						)
					);
					?>
				</div>









			<div class="information-block">
				<div class="yellow-figure-rounded"></div>
				<h3>Спосіб оплати</h3>

				<div class="delivery mt-30">
				<?php 
				if ( WC()->cart->needs_payment() ) {
					$available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
					WC()->payment_gateways()->set_current_gateway( $available_gateways );
				} else {
					$available_gateways = array();
				}
			
				wc_get_template(
					'checkout/payment.php',
					array(
						'checkout'           => WC()->checkout(),
						'available_gateways' => $available_gateways,
						'order_button_text'  => apply_filters( 'woocommerce_order_button_text', __( 'Place order', 'woocommerce' ) ),
					)
				);
				?>
				</div>
    
            </div>			
		
		
		
	
		
		</div>
		<div class="checkout-sidebar">
			
			<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
			
			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
			<div class="preorder">
				<?php
				wc_get_template(
					'checkout/shipping.php',
					array(
						'checkout' => WC()->checkout(),
					)
				);
				?>
			</div>


			
		</div>


		
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
