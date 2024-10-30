<?php
$category_slug = 'news'; // Задаем слаг категории
$args = array(
    'post_type' => 'post', // Тип записи (если это обычные посты)
    'posts_per_page' => -1, // Выводим все записи
    'tax_query' => array(
        array(
            'taxonomy' => 'category', // Таксономия категорий
            'field'    => 'slug', // Используем слаг
            'terms'    => $category_slug, // Задаем слаг категории
        ),
    ),
);
?>

<section id="news_post_section" class="section_block">
    <div class="content">

        <div class="section-title mt-30 mb-30">
            <h2>Новини</h2>
            <span class="link-to-category small-title-green">Всі новини</span>
        </div>
        <div class="slider-swiper-wrapper">
            <div class="swiper post-swiper">

                <div class="swiper-wrapper">

                    <?php $query = new WP_Query($args);?>

                    <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : ?>
                            <?php
                            $query->the_post();
                            $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            $post_link = get_permalink();
                            $title = get_the_title();
                            $date = get_the_date('d.m.Y');
                            ?>

                            <div class="post-card swiper-slide">
                                <div class="post-block-box">
                                    <a href="<?= $post_link;?>">
                                        <img class="post-main-image" src="<?= esc_url($image); ?>" alt="">
                                    </a>
                                </div>
                                <div class="bottom-text-box">
                                    <a class="post-link" href="<?= $post_link;?>">
                                        <div class="post-title"><?= esc_html($title); ?></div>
                                    </a>
                                    <div class="post-date"><?= esc_html($date); ?></div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>

                </div>

            </div>
            <div class="swiper-button-next button-next-news"></div>
            <div class="swiper-button-prev button-prev-news"></div>
            <div class="swiper-pagination pagination-news"></div>
        </div>
    </div>
</section>

<script>
    var swiper = new Swiper(".post-swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        freeMode: false,
        pagination: {
            el: ".pagination-news",
            clickable: true,
        },
        navigation: {
            enabled: false,
            nextEl: ".button-next-news",
            prevEl: ".button-prev-news",
        },
        breakpoints: {
            500: {
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    enabled: false,
                },
                pagination: {
                    enabled: true,
                },
            },
            700: {
                slidesPerView: 2,
                spaceBetween: 20,
                navigation: {
                    enabled: true,
                },
                pagination: {
                    enabled: false,
                },
            },
            1200: {
                slidesPerView: 3,
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
