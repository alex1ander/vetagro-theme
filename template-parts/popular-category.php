<section id="popular_category_section" class="section_block">
   
    <div class="content">
        <h2 class="mt-30 mb-30">Популярні категорії</h2>
        <div class="grid-area-4-item">
        <?php
            $parent_id = 21; // Замените на ID вашей категории
            $child_categories = get_categories(array(
                'taxonomy' => 'product_cat', // Указываем таксономию для категорий товаров
                'parent' => $parent_id, // Указываем родительскую категорию
                'hide_empty' => false, // Установите true, если хотите скрыть пустые категории
            ));
            
            if (!empty($child_categories)) : ?>
                <?php foreach ($child_categories as $category) :?>
                    <?php
                        esc_html($category->term_id);
                        $category_id = esc_html($category->term_id);

                        // get icon-photo-category
                        $thumbnail_id = get_woocommerce_term_meta($category_id, 'thumbnail_id', true);
                        $thumbnail_url = wp_get_attachment_url($thumbnail_id);

                        // get main-photo-category                   
                        $main_image_id = get_term_meta($category_id, 'main_image_id', true);
                        if ($main_image_id) {
                            $main_image_url = wp_get_attachment_url($main_image_id);
                        }
                    ?>



                    <div class="category-orange">
                        <a href="<?= get_term_link($category);?>">
                            <div class="top-part-catergory-orange">
                                <div class="animal-photo">
                                    <img class="icon-photo-category" src="<?= esc_url($thumbnail_url);?>" alt="">
                                    <img class="main-photo-category" src="<?= esc_url($main_image_url);?>" alt="">
                                </div>
                                <div class="category-name"><span class="title"><?= esc_html($category->name);?></span></div>
                                <div class="category-arrow"><img src="./icon/arrow small.svg" alt=""></div>
                            </div>
                        </a>
                    </div>

                <?php endforeach;
            endif;       
        ?>
                        

        </div>
    </div> 
</section>