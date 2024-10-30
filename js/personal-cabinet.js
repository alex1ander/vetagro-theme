jQuery(document).ready(function($) {
    $('#update-name-form').on('submit', function(event) {
        event.preventDefault(); // Отменяем стандартное поведение формы

        var formData = $(this).serialize(); // Сериализуем данные формы

        $.ajax({
            url: 'https://vetagro.local/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'update_user_details',
                formData: formData
            },
            success: function(response) {
                $('#update-message').html(response); // Отображаем сообщение
            },
            error: function() {
                $('#update-message').html('<div class="woocommerce-error"><?php 123; ?></div>');
            }
        });
    });
});



jQuery(document).ready(function($) {
    $('.repeat-order-button').on('click', function(e) {
        e.preventDefault();

        var orderId = $(this).data('order-id');

        $.ajax({
            url: 'https://vetagro.local/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'repeat_order',
                order_id: orderId,
            },
            success: function(response) {
                    $.ajax({
                        url: wc_add_to_cart_params.ajax_url, // URL для AJAX-запроса
                        type: 'POST',
                        data: {
                            action: 'update_cart_count' // Имя действия
                        },
                        success: function (response) {
                            console.log(response); // Выводим 123 в консоль
                            $('.cart-count').text(response); // Обновляем элемент .cart-count
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Ошибка AJAX:', textStatus, errorThrown);
                        }
                    });
                
            },
            error: function(xhr, status, error) {
                alert('Ошибка: ' + error);
            }
        });
    });
});





