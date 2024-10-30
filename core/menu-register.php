<?php

function register_menus() {
    register_nav_menu('main-menu', __('Main Menu'));
    register_nav_menu('top-menu', __('Top Menu'));
}
add_action('init', 'register_menus');
