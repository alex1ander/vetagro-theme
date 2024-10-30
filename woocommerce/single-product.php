<?php
defined( 'ABSPATH' ) || exit; // Защита от прямого доступа.

get_header(); ?>






    <section class="the-product section_block">
        <div class="content">
            <?php
            // Начинаем основной цикл WooCommerce
            while ( have_posts() ) :
                the_post();
                wc_get_template_part( 'content', 'single-product' ); // Подключаем шаблон товара
            endwhile; // Конец цикла.
            ?>

            <div class="product-flex">
                <div class="void"></div>
                <div class="product-content">
                    <div class="product-service-benefits">
                        <div class="benefit-current">
                            <img src="./icon/delivery.svg" alt="">
                            <span>Доставка</span>
                        </div>

                        <div class="benefit-current">
                            <img src="./icon/payment.svg" alt="">
                            <span>Оплата</span>
                        </div>

                        <div class="benefit-current">
                            <img src="./icon/return.svg" alt="">
                            <span>Обмін та повернення</span>
                        </div>
                    </div>

                    <div class="warning-text-block  bg-blue">
                        <div class="warning-text-content bg-white border-radius-top">
                            <p class="title">Товар з розділу ВАКЦИНИ поставляється тільки при 100% передоплаті і замовленням термоупакування з холодогеном для транспортування!</p>
                            <p class="text">Гарантія від виробника на вакцини не поширюється, якщо покупець не забрав замовлення протягом 48 годин з моменту відправлення.</p>
                        </div>
                        <div class="warning-text-content">
                            <p class="sub-title"><strong>Вартість термоупакування — 100 грн.</strong> При замовленні вакцин на суму більше
                                10 тис грн., термоупакування  БЕЗКОШТОВНО!</p>
                        </div>
                    </div>

                    <div class="warning-text-block bg-yellow">
                        <div class="warning-text-content warning-titles">
                            <img src="./icon/discount-orange.svg" alt="">
                            <span class="product-block-title">Вигідна пропозиція</span>
                        </div>
                        <div class="warning-text-content bg-white  border-radius-bottom">


                            <div class="grid-group-discount-product">


                                <div class="product-card">
                                    <div class="product-block-box">
                                        <img class="product-main-image" src="./images/product-card.png" alt="">
                                    </div>
                                    <div class="bottom-text-box">
                                        <div class="product-title mt-10 fw-700">Метрікюр® (коробка 10 шт), шт</div>
                                        <div class="product-block-bottom">
                                            <div class="product-price">
                                                <span>4 900.90 грн.</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <img src="./icon/orange-plus.svg" alt="">

                                <div class="product-card">
                                    <div class="product-block-box">
                                        <img class="product-main-image" src="./images/product-card.png" alt="">
                                    </div>
                                    <div class="bottom-text-box">
                                        <div class="product-title mt-10 fw-700">Метрікюр® (коробка 10 шт), шт</div>
                                        <div class="product-block-bottom">
                                            <div class="product-price">
                                                <span>4 900.90 грн.</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <img src="./icon/orange-plus.svg" alt="">

                                <div class="product-card">
                                    <div class="product-block-box">
                                        <img class="product-main-image" src="./images/product-card.png" alt="">
                                    </div>
                                    <div class="bottom-text-box">
                                        <div class="product-title mt-10 fw-700">Метрікюр® (коробка 10 шт), шт</div>
                                        <div class="product-block-bottom">
                                            <div class="product-price">
                                                <span>4 900.90 грн.</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="group-discount-product-sum">

                                <div class="product-part-block flex-column">
                                    <img src="./icon/orange-sum.svg" alt="">

                                    <div class="price-block">
                                        <span class="product-part-title full-price">5 562.90 грн.</span>
                                        <span class="current-price">4 900.90 грн.</span>
                                    </div>

                                    <button class="add-to-cart collect-btn"><span>Купити набором</span></button>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="information-block">
                        <div class="yellow-figure-rounded"></div>
                        <span class="product-block-title">Характеристики</span>
                        <div class="product-characteristics-table">


                            <?php
                            $field = get_field_object('virobnyk');
                            if (!empty($field['value'])) : ?>
                                <div class="row-characteristics">
                                    <span class="characteristics-title"><?= $field['label'];?></span>
                                    <span class="dotted-top-mg-12 void"></span>
                                    <span  class="characteristics-value green fw-700"><?= str_replace(',', '<br>', $field['value']);?></span>
                                </div>
                            <?php endif; ?>

                            <?php
                            $field = get_field_object('krayina');

                            if (!empty($field['value'])) : ?>
                                <div class="row-characteristics">
                                    <span class="characteristics-title"><?= $field['label'];?></span>
                                    <span class="dotted-top-mg-12 void"></span>
                                    <span class="characteristics-value green fw-700"><?= str_replace(',', '<br>', $field['value']);?></span>
                                </div>
                            <?php endif; ?>

                            <?php
                            $field = get_field_object('kategoriya');
                            if (!empty($field['value'])) : ?>
                                <div class="row-characteristics">
                                    <span class="characteristics-title"><?= $field['label'];?></span>
                                    <span class="dotted-top-mg-12 void"></span>
                                    <span class="characteristics-value green fw-700"><?= str_replace(',', '<br>', $field['value']);?></span>
                                </div>
                            <?php endif; ?>

                            <?php
                            $field = get_field_object('pidhodyt_dlya');
                            if (!empty($field['value'])) : ?>
                                <div class="row-characteristics">
                                    <span class="characteristics-title"><?= $field['label'];?></span>
                                    <span class="dotted-top-mg-12 void"></span>
                                    <span class="characteristics-value green fw-700"><?= str_replace(',', '<br>', $field['value']);?></span>
                                </div>
                            <?php endif; ?>

                            <?php
                            $field = get_field_object('kilkist_v_upakovczi');
                            if (!empty($field['value'])) : ?>
                                <div class="row-characteristics">
                                    <span class="characteristics-title"><?= $field['label'];?></span>
                                    <span class="dotted-top-mg-12 void"></span>
                                    <span class="characteristics-value green fw-700"><?= str_replace(',', '<br>', $field['value']);?></span>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>


                    <div class="information-block">
                        <div class="yellow-figure-rounded"></div>
                        <span class="product-block-title">Про товар</span>

                        <div class="text-about-product-block">
                            <?php the_content();?>
                        </div>

                        <div class="place-for-btn-expand">
                            <div class="btn-expand-text-about text-btn-green green fw-700">Показати все</div>
                        </div>

                    </div>


                    <div  id="review-block" class="information-block">
                        <div class="yellow-figure-rounded"></div>
                        <span class="product-block-title">Відгуки покупців</span>

                        <?php get_template_part( '/woocommerce/single-product/custom-review-form' ); // Имя файла формы?>

                        <div class="add-review-block">
                            <div class="rating-select">
                                <img src="./icon/star-empty.svg" alt="">
                                <img src="./icon/star-empty.svg" alt="">
                                <img src="./icon/star-empty.svg" alt="">
                                <img src="./icon/star-empty.svg" alt="">
                                <img src="./icon/star-empty.svg" alt="">
                            </div>
                            <h5>Залиште оцінку та відгук про товар</h5>
                            <div class="btn-add-review">Написати відгук</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>








                        <div class="pop-up-added-to-cart">
                             <svg class="fill-green" viewBox="0 0 20 20" height="20" width="20">
                                <use xlink:href="#added-to-cart"></use>
                            </svg>
                            <span>Товар додано в <a class="fw-700 green" href="/cart">кошик!</a></span>
                        </div>
<?php
get_footer();
