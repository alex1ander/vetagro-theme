<?php
defined('ABSPATH') || exit; // Защита от прямого доступа.

global $product;

// Вывод заголовка товара

$gallery_image_ids = $product->get_gallery_image_ids();
// Здесь можно добавить другие элементы, такие как описание товара, галерея и т.д.
?>

<div class="product-flex">
    <div class="product-view">

        <div class="category-preview">
            <img src="./icon/category-previe.svg" alt="">
            <img src="./icon/category-previe.svg" alt="">
            <img src="./icon/category-previe.svg" alt="">
            <div class="add-to-favorite mobile">
                <img src="./icon/favorite_card.svg" alt="">
            </div>
        </div>

        <div class="product-image-slider">

            <div class="swiper productImgSwiper2">
                <div class="swiper-wrapper">


                    <?php if ($product) : ?>
                        <div class="swiper-slide">
                            <img src="<?= wp_get_attachment_url($product->get_image_id()); ?>"/>
                        </div>
                    <?php endif; ?>

                    <?php foreach ($gallery_image_ids as $image_id) : ?>
                        <div class="swiper-slide">
                            <img src="<?= wp_get_attachment_url($image_id, 'thumbnail'); ?>"/>
                        </div>
                    <?php endforeach; ?>


                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>

            </div>

            <div thumbsSlider="" class="swiper productImgSwiper">
                <div class="swiper-wrapper">

                    <?php if ($product) : ?>
                        <div class="swiper-slide">
                            <img src="<?= wp_get_attachment_url($product->get_image_id()); ?>"/>
                        </div>
                    <?php endif; ?>

                    <?php foreach ($gallery_image_ids as $image_id) : ?>
                        <div class="swiper-slide">
                            <img src="<?= wp_get_attachment_url($image_id, 'thumbnail'); ?>"/>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>


        </div>
    </div>

    <div class="product-content">

        <div class="product-info-block">
            <div class="product-info">
                <div class="product-title mt-10 fw-700-block product-title-block">
                    <?php the_title('<h1 class="product_title entry-title">', '</h1>'); ?>
                    <div class="add-to-favorite desktop">
                        <img src="./icon/favorite_card.svg" alt="">
                    </div>
                </div>

                <div class="product-part-block">
                    <div class="text-space-between">
                        <div class="in-stock">
                            <span>В наявности</span>
                        </div>

                        <div class="product-code">
                            <span>Код товару: 50256</span>
                        </div>
                    </div>

                    <div class="text-space-between">
                        <div class="about-rating">
                            <div class="rating">
                                <img src="./icon/star.svg" alt="">
                                <img src="./icon/star.svg" alt="">
                                <img src="./icon/star.svg" alt="">
                                <img src="./icon/star.svg" alt="">
                                <img src="./icon/star.svg" alt="">
                            </div>
                            <span>23 відгуки</span>
                            <span class="desktop"><a href="#review-block">Залишити відгук</a></span>
                        </div>

                        <div class="product-code">
                            <span>Артикул: 50256</span>
                        </div>
                    </div>
                </div>

                <?php woocommerce_template_single_add_to_cart(); ?>

            </div>
        </div>


    </div>
</div>
