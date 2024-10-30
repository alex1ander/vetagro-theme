
jQuery(document).ready(function($) {
    $(document).on('click', '.updater', function(e) {
        e.preventDefault();
        var couponCode = $('#coupon_code').val();
        
        $.ajax({
            url: wc_checkout_params.ajax_url,
            type: 'POST',
            data: {
                action: 'apply_coupon_ajax',
                coupon_code: couponCode
            },
            success: function(response) {
                if (response.success) {
                    // Обновляем чекаут и загружаем новый шаблон доставки
                    $('.preorder').html(response.data.shipping_html);
                    $('body').trigger('update_checkout'); // Обновляем чекаут
                } else {
                    alert(response.data.message);
                }
            }
        });
    });


    $(document).on('click', '.woocommerce-remove-couponA', function(e) {
        e.preventDefault();

        var couponCode = $(this).data('coupon');
        $.ajax({
            url: wc_checkout_params.ajax_url,
            type: 'POST',
            data: {
                action: 'remove_coupon_vetagro_ajax',
                coupon: couponCode,
            },
            success: function(response) {

                if (response.success) {
                    // Обновляем чекаут и загружаем новый шаблон доставки
                    $('.preorder').html(response.data.shipping_html);
                    $('body').trigger('update_checkout'); // Обновляем чекаут
                } else {
                    alert(response.data.message);
                }
            }
        });
    });
    
});

