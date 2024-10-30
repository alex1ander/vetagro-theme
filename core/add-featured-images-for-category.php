<?php

// Добавляем поле для основной картинки в категорию
add_action('product_cat_add_form_fields', 'add_category_main_image_field', 10, 2);
add_action('product_cat_edit_form_fields', 'edit_category_main_image_field', 10, 2);

// Форма для добавления картинки
function add_category_main_image_field($taxonomy) {
    ?>
    <div class="form-field">
        <label><?php _e('Основная картинка', 'woocommerce'); ?></label>
        <input type="hidden" id="main_image_id" name="main_image_id" value="">
        <div id="main_image_preview"></div>
        <button class="button" id="upload_main_image_button"><?php _e('Загрузить картинку', 'woocommerce'); ?></button>
        <button class="button" id="remove_main_image_button" style="display:none;"><?php _e('Удалить картинку', 'woocommerce'); ?></button>
    </div>
    <?php
}

// Форма для редактирования картинки
function edit_category_main_image_field($term, $taxonomy) {
    $main_image_id = get_term_meta($term->term_id, 'main_image_id', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="main_image_id"><?php _e('Основная картинка', 'woocommerce'); ?></label>
        </th>
        <td>
            <input type="hidden" id="main_image_id" name="main_image_id" value="<?php echo esc_attr($main_image_id); ?>">
            <div id="main_image_preview"><?php if ($main_image_id) { echo wp_get_attachment_image($main_image_id, 'thumbnail'); } ?></div>
            <button class="button" id="upload_main_image_button"><?php _e('Загрузить картинку', 'woocommerce'); ?></button>
            <button class="button" id="remove_main_image_button" style="<?php echo $main_image_id ? '' : 'display:none;'; ?>"><?php _e('Удалить картинку', 'woocommerce'); ?></button>
        </td>
    </tr>
    <?php
}

// Сохранение поля основной картинки
add_action('edited_product_cat', 'save_category_main_image_field', 10, 2);
add_action('created_product_cat', 'save_category_main_image_field', 10, 2);

function save_category_main_image_field($term_id, $tt_id) {
    if (isset($_POST['main_image_id'])) {
        update_term_meta($term_id, 'main_image_id', absint($_POST['main_image_id']));
    }
}

// Скрипты для загрузки изображения через медиабиблиотеку
add_action('admin_footer', 'category_image_field_scripts');

function category_image_field_scripts() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        var frame;
        $('#upload_main_image_button').on('click', function(e) {
            e.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: 'Выберите или загрузите изображение',
                button: {
                    text: 'Использовать это изображение'
                },
                multiple: false
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#main_image_id').val(attachment.id);
                $('#main_image_preview').html('<img src="' + attachment.sizes.thumbnail.url + '">');
                $('#remove_main_image_button').show();
            });
            frame.open();
        });

        $('#remove_main_image_button').on('click', function(e) {
            e.preventDefault();
            $('#main_image_id').val('');
            $('#main_image_preview').html('');
            $(this).hide();
        });
    });
    </script>
    <?php
}
