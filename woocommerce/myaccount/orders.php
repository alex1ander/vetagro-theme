<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="block-titles">
                    <div class="cabinet-titles-mobile">
                        <h1 class="open-menu">Мої замовлення</h1>
                        <div class="mobile">
                            <ul class="cabinet-menu-mobile  mt-10">
                                <li><a href="#">Персональні дані</a></li>
                                <li><a href="#">Обрані товари</a></li>
                                <li><a href="#">Товари в очікуванні</a></li>
                            </ul>
                        </div>
                    </div>
                    <script>
                        document.querySelector('.block-titles h1').addEventListener('click', function() {
                            this.classList.toggle('active');
                        });
                    </script>
                </div>
				<?php

    $args = array(
        'limit' => -1, // Получаем все заказы
    );

    $orders = wc_get_orders($args);

    if (empty($orders)) {
        echo 'Нет заказов.';
        return;
    }

// Обработка добавления товаров в корзину
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['repeat_order_id'])) {
    repeat_order(intval($_POST['repeat_order_id']));
}

function repeat_order($order_id) {
    // Получаем существующий заказ
    $order = wc_get_order($order_id);

    if (!$order) {
        echo 'Заказ не найден.';
        return;
    }

    // Добавляем товары из заказа в корзину
    foreach ($order->get_items() as $item_id => $item) {
        $product_id = $item->get_product_id();
        $quantity = $item->get_quantity();
        // Добавляем товар в корзину
        WC()->cart->add_to_cart($product_id, $quantity);
    }

    echo 'Товары из заказа #' . $order_id . ' были добавлены в корзину.';
}
				 ?>
				<div class="information-block for-table">
                    <table class="yellow-table">
                        <thead>
                            <tr class="order-table-grid">
                                <th>Дата</th>
                                <th>Номер</th>
                                <th>Товари</th>
                                <th>Сума</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
							<?php foreach($orders as $order): ?>
                            
                            <tr class="order-table-grid">
                                <td class="order-date">
                                    <span class="orange-date"><?= $order->get_date_created()->date('d.m.Y'); ?></span>
                                </td>
                                <td class="order-code" data-label="Номер">
                                    <span><?= $order->get_id(); ?></span>
                                </td>
                                <td class="order-count" data-label="Товари">
									<?php 
									$total_quantity = 0;
									foreach ($order->get_items() as $item) {
										$total_quantity += $item->get_quantity(); // Получаем количество товара
									}?>
                                    <span class="current-count"><?= $total_quantity;?> товарів</span>
                                </td>
                                <td class="order-sum" data-label="Сума">
                                    <span><?= $order->get_total();?></span>
                                </td>
                                <td class="order-btns">
                                    <div class="info-order-btns">
                                        <a class="green-btn m-auto" href="#checkout">Переглянути</a>

										<span class="green-btn fill-green m-auto repeat-order-button" data-order-id="<?= $order->get_id(); ?>">Повторить заказ</span>
                                    </div>
                                </td>  
                            </tr>
							<?php endforeach; ?>


                        </tbody>
                    </table>
                </div>

<?


