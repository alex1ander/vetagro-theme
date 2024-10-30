<?php

function logo_set() {
    add_theme_support('custom-logo', array(
        'height'      => 100, // высота логотипа
        'width'       => 400, // ширина логотипа
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'logo_set');


function woocommerce_setup() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'woocommerce_setup' );


//svg-sprites
function enqueue_svg_sprite() {
    // Укажите путь к вашему файлу sprite.svg
    $sprite_url = get_template_directory_uri() . '/icon/sprite.svg'; // Замените путь на ваш
    echo file_get_contents($sprite_url);
}
add_action('wp_footer', 'enqueue_svg_sprite');