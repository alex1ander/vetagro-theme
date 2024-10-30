<?php

$category_slugs = array('brands');

$parent_category = get_term_by('slug', $category_slugs[0], 'product_cat');

if ($parent_category) {
    $args = array(
        'taxonomy' => 'product_cat',
        'child_of' => $parent_category->term_id,
        'hide_empty' => false,
    );
    $child_categories = get_categories($args);
}
?>

<section id="brands_category_section" class="section_block">
    <div class="content">

        <div class="section-title mt-30 mb-30">
            <h2>Бренди</h2>
            <span class="link-to-category small-title-green">Всі бренди</span>
        </div>

        <div class="swiper category-swiper">
            <!-- slider-infuture -->
            <div class="!swiper-wrapper brands-7">
                <?php if (!empty($child_categories)): ?>
                    <?php foreach ($child_categories as $child_category) :

                        $thumbnail_id = get_term_meta($child_category->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_url($thumbnail_id);
                        $category_link = get_term_link($child_category); ?>

                        <?php if ($image): ?>
                            <div class="brand-category">
                                <a href="<?= esc_url($category_link); ?>">
                                    <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($child_category->name) ?>">
                                </a>
                            </div>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
            <!-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div> -->
        </div>
    </div>
</section>