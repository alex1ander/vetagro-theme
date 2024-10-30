<?php
/**
 * Шаблон для просмотра заказа в WooCommerce
 */

defined( 'ABSPATH' ) || exit;


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$order_id = basename($path);


$order_id = intval($order_id);

$order = wc_get_order( $order_id ); // Получаем объект заказа

if ( ! $order || $order->get_user_id() !== get_current_user_id() ) {
    echo '<p>' . __( 'Заказ не найден или вы не имеете доступа к нему.', 'woocommerce' ) . '</p>';
    return;
}

// Здесь добавьте код для отображения информации о заказе
?>
<div class="block-titles">
    <h1 class="order-titles">Замовлення № <?= $order->get_order_number();?> <span class="title-small">від <?= $order->get_date_created()->date('d.m.Y'); ?></span></h1>
</div>

<p><?php echo esc_html( 'Статус: ' . wc_get_order_status_name( $order->get_status() ) ); ?></p>

<h3><?php esc_html_e( 'Товары в заказе', 'woocommerce' ); ?></h3>

        <?php
		function getProductImage($product){
			$image_id = $product->get_image_id(); // Получаем ID изображения товара
            
            // Получаем URL изображения или стандартного изображения
            $image_url = $image_id ? wp_get_attachment_url( $image_id ) : wc_placeholder_img_src();
            return $image_url;
            return $image;
		}

        ?>






				<div class="information-block for-table">
                    <table class="yellow-table">
                        <thead>
                            <tr>
                                <th>Товари</th>
                                <th>Ціна</th>
                                <th>Кількість</th>
                                <th>Сума</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php foreach ( $order->get_items() as $item_id => $item ) : ?>
                            <tr class="product-table-grid">
                                <td class="product-name">
									<div class="product-card">
                                        <div class="product-block-box">
                                            <img class="product-main-image" src="<?= getProductImage($item->get_product()) ?>" alt="">
                                        </div>
                                        <span class="product-title"><?= $item->get_product()->get_name(); ?></span>
                                    </div>
                                </td>
                                <td class="product-current-price">
                                    <span><?= wc_price($item->get_product()->get_price()) ?></span>
                                </td>
                                <td class="product-count">
                                    <span class="current-count"><?= $item->get_quantity() . 'од' ?></span>
                                </td>
                                <td class="product-all-price fw-700">
                                        <span><?= wc_price($item->get_product()->get_price() * $item->get_quantity())  ?></span>
                                </td>
                            </tr>
						<?php endforeach; ?>


						<tr class="product-table-sum">
								<?php if ( $order->get_coupon_codes() ) : ?>
									<?php foreach ( $order->get_coupon_codes() as $code ): ?>
										<?php // Получаем сумму скидки по каждому купону
										$discount = $order->get_discount_total(); // Сумма всех скидок
										$discount_tax = $order->get_discount_tax(); // Сумма налогов со скидок
										$tax_discount = $discount + $discount_tax; // Общая скидка
		
										?>
										<td class="checkout-sum" colspan="4">Купон: <?= $code; ?> <span class="fw-800">-<?= wc_price($tax_discount); ?></span></td>
									<?php endforeach; ?>
								<?php endif; ?>
                            </tr>

                            <tr class="product-table-sum">
                                <td class="checkout-sum" colspan="4">Разом: <span class="fw-800"><?= $order->get_formatted_order_total();?></span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>


				<div class="place-for-btn">
					<span class="green-btn fill-green m-auto repeat-order-button" data-order-id="<?= $order_id; ?>">Повторить заказ</span>
				</div>


				<div class="information-block">
                    <div class="grid-personal-tables">

                        <div class="table-block">
                            <h3 class="title-with-flex">Доставка</h3>
                            <table class="personal-table mt-20">
                                <tbody>
                                    <tr>
                                        <td>Спосіб доставки</td>
                                        <td>Нова пошта</td>
                                    </tr>
                                    <tr>
                                        <td>Місто</td>
                                        <td>Київ</td>
                                    </tr>
                                    <tr>
                                        <td>Відділення</td>
                                        <td>№15 (вул. Тараса Шевченка, 143)</td>
                                    </tr>
                                    <tr>
                                        <td>ТТН</td>
                                        <td>6584937586</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-block">
                            <h3 class="title-with-flex">Оплата</h3>
                            <table class="personal-table mt-20">
                                <tbody>
                                    <tr>
                                        <td>Спосіб оплати</td>
                                        <td>Картою Visa чи Mastercard (LiqPay)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



