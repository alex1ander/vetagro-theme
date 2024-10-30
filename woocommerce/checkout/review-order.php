<div class="shop_table woocommerce-checkout-review-order-table delivery mt-30">

<?php 
		WC()->cart->calculate_shipping();
		WC()->cart->calculate_totals();

if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) {
	$packages = WC()->shipping()->get_packages();
	$first    = true;

	foreach ( $packages as $i => $package ) {
		$chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
		$product_names = array();

		if ( count( $packages ) > 1 ) {
			foreach ( $package['contents'] as $item_id => $values ) {
				$product_names[ $item_id ] = $values['data']->get_name() . ' &times;' . $values['quantity'];
			}
			$product_names = apply_filters( 'woocommerce_shipping_package_details_array', $product_names, $package );
		}
		wc_get_template(
			'cart/cart-shipping.php',
			array(
				'package'                  => $package,
				'available_methods'        => $package['rates'],
				'show_package_details'     => count( $packages ) > 1,
				'show_shipping_calculator' => is_cart() && apply_filters( 'woocommerce_shipping_show_shipping_calculator', $first, $i, $package ),
				'package_details'          => implode( ', ', $product_names ),
				/* translators: %d: shipping package number */
				'package_name'             => apply_filters( 'woocommerce_shipping_package_name', ( ( $i + 1 ) > 1 ) ? sprintf( _x( 'Shipping %d', 'shipping packages', 'woocommerce' ), ( $i + 1 ) ) : _x( 'Shipping', 'shipping packages', 'woocommerce' ), $i, $package ),
				'index'                    => $i,
				'chosen_method'            => $chosen_method,
				'formatted_destination'    => WC()->countries->get_formatted_address( $package['destination'], ', ' ),
				'has_calculated_shipping'  => WC()->customer->has_calculated_shipping(),
			)
		);

		$first = false;
	}
} 
?>

</div>
