<?php

add_action('wp_ajax_apply_coupon_ajax', 'apply_coupon_ajax');
add_action('wp_ajax_nopriv_apply_coupon_ajax', 'apply_coupon_ajax');

function apply_coupon_ajax() {
    $coupon_code = sanitize_text_field($_POST['coupon_code']);
    
    if (WC()->cart->apply_coupon($coupon_code)) {
        // Загружаем шаблон доставки
        ob_start(); // Начинаем буферизацию вывода
        wc_get_template(
            'checkout/shipping.php',
            array(
                'checkout' => WC()->checkout(),
            )
        );
        $shipping_html = ob_get_clean(); // Получаем содержимое буфера

        wp_send_json_success(array('shipping_html' => $shipping_html));
    } else {
        wp_send_json_error(array('message' => 'Coupon is not valid.'));
    }
    wp_die();
}


    add_action('wp_ajax_remove_coupon_vetagro_ajax', 'remove_coupon_vetagro_ajax');
    add_action('wp_ajax_nopriv_remove_coupon_vetagro_ajax', 'remove_coupon_vetagro_ajax');

function remove_coupon_vetagro_ajax() {

	if (isset($_POST['coupon'])) {
		$coupon_code_to_remove = $_POST['coupon'];
	}

    // Получите активные купоны
    $active_coupons = WC()->cart->get_applied_coupons();

    // Проверьте, есть ли указанный купон в списке активных
    if (in_array($coupon_code_to_remove, $active_coupons)) {
        // Удалите купон из корзины
        WC()->cart->remove_coupons([$coupon_code_to_remove]);
        
        // Отобразите сообщение об удалении купона
        wc_add_notice(__('Купон ' . $coupon_code_to_remove . ' был удален.'), 'notice');
    }

        // Загружаем шаблон доставки
        ob_start(); // Начинаем буферизацию вывода
        wc_get_template(
            'checkout/shipping.php',
            array(
                'checkout' => WC()->checkout(),
            )
        );
        $shipping_html = ob_get_clean(); // Получаем содержимое буфера

        wp_send_json_success(array('shipping_html' => $shipping_html));

    wp_die();
}
