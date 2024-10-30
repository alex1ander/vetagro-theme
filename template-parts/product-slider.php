<?php

$category_slug = isset($args['categories']) ? $args['categories'][0] : array();

if (!empty($category_slug) && class_exists('WooCommerce')) {
    // Аргументы для запроса товаров
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category_slug,
                'operator' => 'IN',
            ),
        ),
    );
}
$term = get_term_by('slug', $category_slug, 'product_cat');
if ($term && !is_wp_error($term)) {
    $category_name = $term->name;
    $category_link = get_term_link($term);
}



?>

<section id="popular_product_section" class="section_block">
    <div class="content">

        <div class="section-title mt-30 mb-30">
            <h2><?= esc_html($category_name);?></h2>
            <a class="link-to-category small-title-green" href="<?= esc_url($category_link); ?>">Всі <?= mb_strtolower(esc_html($category_name)); ?></a>
        </div>

        <div class="slider-swiper-wrapper">
            <div class="swiper products-swiper <?= $category_slug; ?>">

                <div class="swiper-wrapper">
                    <?php
                    $query = new WP_Query($args);
                    if ($query->have_posts()) {

                        while ($query->have_posts()) {
                            $query->the_post();

                            wc_get_template_part('content', 'product');
                        }

                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <div class="swiper-button-next button-next-<?= $category_slug; ?>"></div>
            <div class="swiper-button-prev button-prev-<?= $category_slug; ?>"></div>
            <div class="swiper-pagination pagination-<?= $category_slug; ?>"></div>
        </div>
    </div>
</section>

<script>
    var swiper = new Swiper(".<?= $category_slug; ?>", {
        slidesPerView: 2,
        spaceBetween: 20,
        freeMode: false,
        pagination: {
            el: ".pagination-<?= $category_slug; ?>",
            clickable: true,
        },
        navigation: {
            enabled: false,
            nextEl: ".button-next-<?= $category_slug; ?>",
            prevEl: ".button-prev-<?= $category_slug; ?>",
        },
        breakpoints: {
            500: {
                slidesPerView: 2,
                spaceBetween: 20,
                navigation: {
                    enabled: false,
                },
                pagination: {
                    enabled: true,
                },
            },
            700: {
                slidesPerView: 3,
                spaceBetween: 20,
                navigation: {
                    enabled: true,
                },
                pagination: {
                    enabled: false,
                },
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 20,
                navigation: {
                    enabled: true,
                },
                pagination: {
                    enabled: false,
                },
            },
        },
    });
</script>

