<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form cart-grid" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

	<div class="cart-info-block">
        <h1>Кошик</h1>
                
        <div class="for-table-block mt-10">


	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents cart-table" cellspacing="0">
		<thead>
			<tr>
								<th>Товари</th>
                                <th>Ціна</th>
                                <th>Кількість</th>
                                <th>Сума</th>
                                <th></th>
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


						<td  class="product-name">
                            <div class="product-card">
                                <div class="product-block-box">
									<?=$thumbnail = apply_filters(
    'woocommerce_cart_item_thumbnail',
    $_product->get_image('thumbnail', ['width' => 60, 'height' => 60], ['class' => 'custom-thumbnail']),
    $cart_item,
    $cart_item_key
);?>
                                </div>
                                <span class="product-title">
								<?php
									if ( ! $product_permalink ) {
										echo wp_kses_post( $product_name . '&nbsp;' );
									} else {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
									}
									do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
									?>
								</span>
                            </div>
                        </td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$min_quantity = 1;
							$max_quantity = 1;
						} else {
							$min_quantity = 1;
							$max_quantity = $_product->get_max_purchase_quantity();
						}

						$product_quantity = woocommerce_quantity_input(
							array(
								'input_name'   => "cart[{$cart_item_key}][qty]",
								'input_value'  => $cart_item['quantity'],
								'max_value'    => $max_quantity,
								'min_value'    => $min_quantity,
								'product_name' => $product_name,
							),
							$_product,
							false
						);

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
						</td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>


						<td class="product-remove">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
										<svg class="fill-red" width="16" height="16" viewBox="0 0 16 16">
											<use xlink:href="#remove"></use>
										</svg>
										</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										/* translators: %s is the product name */
										esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

				<button type="submit" class="hidden button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
				<?php do_action( 'woocommerce_cart_actions' ); ?>
				<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
		</tbody>
	</table>


	</div>

</div>


<?php
	$cart = WC()->cart;
    $total_quantity = $cart->get_cart_contents_count();
    $total_amount = $cart->get_total();
?>
<div class="cart-sidebar">
	<h3>Всього</h3>
	<div class="cart-short-info mt-10">
		<span class="products-count-qnt"><?= $total_quantity;?> товари на суму</span>
		<span class="products-count-price"><?= $total_amount;?></span>
	</div>
	<div class="free-deliver-block">
		<span class="delivery-sub-title">Для замовлень на суму від 2 000 грн</span>
		<span class="delivery-title">безкоштовна доставка</span>



		<?php
		$minDelivery = 0;
		$maxDelivery = 2000;
		$cartTotal = intval(WC()->cart->total);
		
		$progressDelivery = 100;
		if($cartTotal < $maxDelivery){
			$progressDelivery = $cartTotal / $maxDelivery * 100;
		}
		?>
		<div class="progressDelivery">
			<div class="progressDeliveryLine" style="width:<?= $progressDelivery;?>%"></div>
			<div class="progressDeliveryButton" style="left:<?= $progressDelivery;?>%"></div>
		</div>
		<span class="remainder-counter">Додайте товарів <strong>на 1 578 грн</strong></span>
	</div>

		<a class="green-btn fill-green" href="#checkout">Оформити замовлення</a>
		<a class="green-btn" href="#checkout">Купити в один клік</a>
		<a class="small-title-green fw-700 text-center mt-10" href="#link-to-shop">Продовжити покупки</a>
</div>

</form>

