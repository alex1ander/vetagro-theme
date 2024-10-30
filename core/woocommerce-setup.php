<?php

add_filter('woocommerce_currency_symbol', 'change_uah_currency_symbol', 10, 2);

function change_uah_currency_symbol($currency_symbol, $currency) {
    if ($currency === 'UAH') {
        $currency_symbol = 'грн';
    }
    return $currency_symbol;
}



add_filter('woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_text');

function custom_add_to_cart_text() {
    return 'Купити';
}


remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );









add_action('woocommerce_after_order_notes', 'add_custom_delivery_fields');

function add_custom_delivery_fields($checkout) {
    echo '<div id="custom_delivery_fields"><h3>' . __('Информация для курьерской доставки') . '</h3>';
    
    // Поле для ввода адреса доставки
    woocommerce_form_field('delivery_address', [
        'type' => 'text',
        'class' => ['form-row-wide'],
        'label' => __('Адрес доставки'),
        'placeholder' => __('Введите ваш адрес'),
        'required' => true,
    ], $checkout->get_value('delivery_address'));

    // Поле для выбора времени доставки
    woocommerce_form_field('delivery_time', [
        'type' => 'select',
        'class' => ['form-row-wide'],
        'label' => __('Желаемое время доставки'),
        'options' => [
            '' => __('Выберите время'),
            'morning' => __('Утро (9:00 - 12:00)'),
            'afternoon' => __('День (12:00 - 18:00)'),
            'evening' => __('Вечер (18:00 - 21:00)')
        ],
        'required' => true,
    ], $checkout->get_value('delivery_time'));

    echo '</div>';
}



// ajax extend
require_once get_template_directory() . '/core/class-my-custom-wc-ajax.php';


function wc_cart_totals_coupon_html_custom( $coupon ) {
    if ( is_string( $coupon ) ) {
        $coupon = new WC_Coupon( $coupon );
    }

    $amount               = WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax );
    $discount_amount_html = '-' . wc_price( $amount );

    if ( $coupon->get_free_shipping() && empty( $amount ) ) {
        $discount_amount_html = __( 'Free shipping coupon', 'woocommerce' );
    }

    $discount_amount_html = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_amount_html, $coupon );

    // Проверяем, находимся ли мы на странице чекаута или корзины
    if ( is_checkout() ) {
        $url = wc_get_checkout_url();
    } else {
        $url = wc_get_cart_url();
    }?>
    <a href="<?= esc_url( add_query_arg( 'remove_coupon', rawurlencode( $coupon->get_code() ), $url ) );?>" class="woocommerce-remove-couponA" data-coupon="<?= esc_attr( $coupon->get_code() );?>">Відмінити</a>
    <p class="form-row form-row-first">
		<label for="coupon_code_selected" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
		<input type="text" name="coupon_code_selected" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code_selected" value="<?= esc_attr( $coupon->get_code() );?>" disabled/>
    </p>
    <?php
}









