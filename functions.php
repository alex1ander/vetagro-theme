<?php
//add-featured-images-for-category
include 'core/add-featured-images-for-category.php';
include 'core/theme-setup.php';
include 'core/menu-register.php';
include 'core/custom_Walker_Nav_Menu.php';
include 'core/woocommerce-setup.php';
include 'core/ajax-handler.php';

function main_styles() {
    
    wp_enqueue_style('style-css', get_stylesheet_uri());
    wp_enqueue_style('woocommerce-custom', get_template_directory_uri() . '/css/woocommerce.css');
    wp_enqueue_style('form-css', get_template_directory_uri() . '/css/form.css');
    wp_enqueue_style('table-css', get_template_directory_uri() . '/css/table.css');
    wp_enqueue_style('input-css', get_template_directory_uri() . '/css/input.css');

    wp_enqueue_script('product-script', get_template_directory_uri() . '/js/product-script.js', array('jquery'), null, true);


    if (is_product()) {
        wp_enqueue_style('product', get_template_directory_uri() . '/css/product.css');
    }

    if (is_cart()) {
        wp_enqueue_style('cart', get_template_directory_uri() . '/css/cart.css');
    }
    if (is_checkout()) {


        wp_enqueue_script( 'my-ajax-script', get_template_directory_uri() . '/js/my-ajax-script.js', array('jquery'), null, true );
        wp_localize_script( 'my-ajax-script', 'my_ajax_object', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'security' => wp_create_nonce( 'update-order-review' )
        ) );
        wp_enqueue_style('checkout', get_template_directory_uri() . '/css/checkout.css');
    }
    if (is_account_page()) {

        wp_enqueue_script('personal-lk', get_template_directory_uri() . '/js/personal-cabinet.js', array('jquery'), null, true);
        wp_enqueue_style('lk', get_template_directory_uri() . '/css/lk.css');
    }
}
add_action('wp_enqueue_scripts', 'main_styles');





function disable_wqpmb_style() {
    wp_dequeue_style('wqpmb-style');
    wp_deregister_style('wqpmb-style');
}
add_action('wp_enqueue_scripts', 'disable_wqpmb_style', 100);





// новые пункты в меню
add_filter('woocommerce_account_menu_items', 'custom_account_menu_items');
function custom_account_menu_items($items) {
    // Добавляем новый пункт меню
    $items['custom-page'] = __('Моя Новая Страница', 'woocommerce');
    return $items;
}

add_action('init', 'add_custom_endpoints');
function add_custom_endpoints() {
    // Регистрация нового эндпоинта
    add_rewrite_endpoint('custom-page', EP_ROOT | EP_PAGES);
}

add_action('woocommerce_account_custom-page_endpoint', 'custom_page_content');
function custom_page_content() {
    // Здесь загружаем шаблон для новой страницы
    wc_get_template('myaccount/custom-page-template.php'); // Замените на ваш путь к шаблону
}

add_filter("woocommerce_get_query_vars", function ($vars) {

    foreach (["custom-page"] as $e) {
        $vars[$e] = $e;
    }

    return $vars;
});



add_action( 'init', 'add_view_order_endpoint' );

function add_view_order_endpoint() {
    add_rewrite_endpoint( 'view-order', EP_ROOT | EP_PAGES );
}





