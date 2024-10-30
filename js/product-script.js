
        document.querySelector('.btn-expand-text-about').addEventListener('click', function () {
            const textBlock = document.querySelector('.text-about-product-block');
            const button = this;

            // Toggle класса 'expended' для блока с текстом
            textBlock.classList.toggle('expended');

            // Toggle класса 'active' для кнопки
            button.classList.toggle('active');

            // Меняем текст на кнопке в зависимости от состояния
            if (textBlock.classList.contains('expended')) {
                button.textContent = 'Показати менше';
            } else {
                button.textContent = 'Показати все';
            }
        });

        var swiper = new Swiper(".productImgSwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });

        var swiper2 = new Swiper(".productImgSwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
                enabled: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: false,
                enabled: true
            },
            thumbs: {
                swiper: swiper,
            },
            breakpoints: {
                1000: {
                    slidesPerView: 1,
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

        var swiper = new Swiper(".products-swiper", {
            slidesPerView: 2,
            spaceBetween: 20,
            freeMode: false,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                enabled: false,
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
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






jQuery(document).ready(function ($) {
    let page = 1;

    // Используем делегирование событий для привязки обработчика
    $(document).on('click', '#load-more-comments', function () {
        // AJAX-запрос для загрузки дополнительных комментариев
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'GET',
            data: {
                action: 'load_more_comments',
                post_id: '<?php echo get_the_ID(); ?>',
                page: page
            },
            success: function (data) {
                // Добавляем загруженные комментарии
                if (data) {
                    $('#load-more-comments').remove(); // Удаляем кнопку
                    $('#comments').append(data); // Добавляем комментарии
                }
            }
        });
        page++;
    });
});


jQuery( function( $ ) {
    $('.product-info-block button[type="submit"]').on( 'click', function() {
        if ($(this).hasClass('disabled')) {
            return false;
        }else{
            $('.pop-up-added-to-cart').addClass('show');
            setTimeout(() => {
                $('.pop-up-added-to-cart').removeClass('show');
            }, 5000);
        }
    });
} );






jQuery(document).ready(function ($) {
    // Обработчик события нажатия на кнопку добавления в корзину
    $('.single_add_to_cart_button').on('click', function (e) {
        e.preventDefault(); // Предотвращаем переход по ссылке

        // AJAX-запрос
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
    });
});












