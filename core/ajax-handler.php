<?php

add_action('wp_ajax_update_cart_count', 'update_cart_count');
add_action('wp_ajax_nopriv_update_cart_count', 'update_cart_count');

function update_cart_count() {
    echo WC()->cart->get_cart_contents_count();
    wp_die();
}





///////////////ajax load commetns
define('COMMENT_TO_SHOW', 5);
add_action('wp_ajax_load_more_comments', 'load_more_comments_on_product');
add_action('wp_ajax_nopriv_load_more_comments', 'load_more_comments_on_product');

function load_more_comments_on_product() {
    $isDie = false;
    $post_id = get_the_ID();
    $page = 0;

    if (!empty($_GET['post_id']) && !empty($_GET['page'])) {

        $isDie = true;
        $post_id = intval($_GET['post_id']);
        $page = intval($_GET['page']);
        
    }

    // Получаем комментарии
    $comments = get_comments(array(
        'post_id' => $post_id,
        'number'  => COMMENT_TO_SHOW,
        'offset'  => $page * COMMENT_TO_SHOW, //не учитыаем первые 5
    ));
    $all_comments_count = get_comments( array( 'post_id' => get_the_ID(), 'count' => true ) );
    if ($comments) : ?>
        
        <!-- вывод коментариев -->
        <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ), $comments ); ?>

        <!-- вывод кнопки -->
        <?php if( $all_comments_count - COMMENT_TO_SHOW * ($page + 1) > 0): ?>
            <div id="load-more-comments" class="btn-expand-review text-btn-green green fw-700">Показати ще <?= min(5, $all_comments_count - COMMENT_TO_SHOW * ($page + 1))?> відгуків</div>
        <?php endif;?>  

    <?php endif;


    if ($isDie) {
        wp_die(); 
    }
}




add_action('wp_ajax_update_user_details', 'handle_update_user_details');
function handle_update_user_details() {
    if (isset($_POST['formData'])) {
        parse_str($_POST['formData'], $form_data); // Парсим данные формы

        echo $user_id = get_current_user_id();
        $first_name = sanitize_text_field($form_data['first_name']);
        $last_name = sanitize_text_field($form_data['last_name']);
        $phone_number = sanitize_text_field($form_data['billing_phone']);

        // Обновляем имя, фамилию и номер телефона
        wp_update_user([
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
        ]);

        // Обновляем мета-данные для номерbilling_last_nameа телефона
        update_user_meta($user_id, 'billing_first_name', $first_name);
        update_user_meta($user_id, 'billing_last_name', $last_name);
        update_user_meta($user_id, 'billing_phone', $phone_number);

        echo '<div class="woocommerce-message">' . __('Ваши данные были обновлены.', 'your-textdomain') . '</div>';
    }

    wp_die(); // Завершаем выполнение
}


add_action('wp_ajax_repeat_order', 'ajax_repeat_order');
add_action('wp_ajax_nopriv_repeat_order', 'ajax_repeat_order'); // Для неавторизованных пользователей

function ajax_repeat_order() {
    // Проверяем, установлен ли order_id
    if (!isset($_POST['order_id'])) {
        wp_send_json_error(['message' => 'Не указан ID заказа.']);
    }

    $order_id = intval($_POST['order_id']);
    $order = wc_get_order($order_id);

    if (!$order) {
        wp_send_json_error(['message' => 'Заказ не найден.']);
    }

    // Добавляем товары из заказа в корзину
    foreach ($order->get_items() as $item) {
        $product_id = $item->get_product_id();
        $quantity = $item->get_quantity();
        WC()->cart->add_to_cart($product_id, $quantity);
    }

    wp_send_json_success(['message' => 'Товары из заказа #' . $order_id . ' были добавлены в корзину.']);
}
