<?php
// Template Name: My account
get_header(); 
?>

<section id="cart-section" class="section_block">
    <div class="content">
        <div class="grid-personal-cabinet">

            <div class="cabinet-menu desktop">
                <?php wc_get_template('myaccount/navigation.php'); ?>
            </div>

            <div class="cabinet-block">
                <?php 
                // echo do_shortcode('[woocommerce_my_account]');
                // Проверка текущего эндпоинта и отображение соответствующего контента
                if (is_wc_endpoint_url('orders')) {
                    $current_page = empty( $current_page ) ? 1 : absint( $current_page );
                        $customer_orders = wc_get_orders( apply_filters( 'woocommerce_my_account_my_orders_query', array( 'customer' => get_current_user_id(), 'page' => $current_page, 'paginate' => true ) ) );
                        wc_get_template('myaccount/orders.php', array('current_page' => absint( $current_page ),'customer_orders' => $customer_orders,'has_orders' => 0 < $customer_orders->total, ),''); 
                
                } elseif(is_wc_endpoint_url('custom-page')) {
                    echo 'custom';
                } elseif (is_wc_endpoint_url('downloads')) {
                    wc_get_template('myaccount/downloads.php'); // Пример для загрузок
                } elseif (is_wc_endpoint_url('view-order')) {
                    
                    $current_page = empty( $current_page ) ? 1 : absint( $current_page );
                        $customer_orders = wc_get_orders( apply_filters( 'woocommerce_my_account_my_orders_query', array( 'customer' => get_current_user_id(), 'page' => $current_page, 'paginate' => true ) ) );
                        wc_get_template('myaccount/view-order.php', array('current_page' => absint( $current_page ),'customer_orders' => $customer_orders,'has_orders' => 0 < $customer_orders->total, ),''); 
                } else {
                    
                    wc_get_template('myaccount/form-edit-account.php');          
                }
                ?>
            </div>

            <div class="cabinen-settings">
                <div class="account-settins mt-40">
                    <span><img src="./icon/pin.svg" alt=""> Змінити пароль</span>
                    <span><img src="./icon/exit.svg" alt=""> Вийти з акаунта</span>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
get_footer(); 
?>
