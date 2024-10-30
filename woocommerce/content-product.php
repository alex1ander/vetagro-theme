<?php global $product;

if ( ! empty( $product ) ) {
    if ( $product->is_type( 'variable' ) ) {
        $min_price = $product->get_variation_price( 'min', true );
        $max_price = $product->get_variation_price( 'max', true );

        if ( $min_price !== $max_price ) {
           $price = '<span class="price">' . wc_price( $min_price ) . ' - ' . wc_price( $max_price ) . '</span>';
        } else {
            $price = '<span class="price">' . wc_price( $min_price ) . '</span>';
        }
    } else {
        $price = '<span class="price">' . wc_price( wc_get_price_to_display( $product ) ) . '</span>';
    }
}

$product_id = $product->get_id();
$product_tags = get_the_terms($product_id, 'product_tag');


?>




<div class="product-card swiper-slide">
    <div class="product-block-box">
        <div class="unusual-offers">


            <?php if ($product_tags && !is_wp_error($product_tags)) : ?>
                <?php foreach ($product_tags as $tag) : ?>
                    <div class="current-offer <?= esc_html($tag->name)?>">
                        <img class="current-offer-img" src="<?= get_stylesheet_directory_uri() ?>/icon/<?= esc_html($tag->name)?>.svg" alt="">
                <?php endforeach;?>
                 <?php foreach ($product_tags as $tag) : ?>
                    </div>
                 <?php endforeach;?>
            <?php endif;?>


        </div>
        <div class="btn-add-to-favorite">
            <svg class="fill-yellow absolute-favorite" width="32" height="32">
                <use xlink:href="#favorite"></use>
            </svg>
            <svg class="fill-transparent absolute-favorite" width="32" height="32">
                <use xlink:href="#favorite-active"></use>
            </svg>
        </div>

        <!-- Динамическое изображение товара -->
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <img class="product-main-image" src="<?php the_post_thumbnail_url( 'medium' ); ?>" alt="<?php the_title(); ?>">
            <?php else : ?>
                <img class="product-main-image" src="<?php echo get_template_directory_uri(); ?>/images/product-card.png" alt="Изображение товара">
            <?php endif; ?>
        </a>
    </div>

    <div class="bottom-text-box">
        <!-- Динамическое название товара -->
        <div class="product-title mt-10 fw-700">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </div>

        <div class="product-block-bottom">
            <!-- Динамическая цена товара -->
            <div class="product-price">
                <span><?= $price;?></span>
            </div>

            <!-- Кнопка "Добавить в корзину" -->
            <a class="btn-add-to-cart" href="<?php the_permalink(); ?>">
                <svg class="fill-white" width="24" height="24">
                    <use xlink:href="#shopping-cart"></use>
                </svg>
            </a>

        </div>
    </div>
</div>
