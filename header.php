<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title();?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">


    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <?php wp_head();?>
</head>
<body>
<nav class="desktop">
    <div class="content">
        <div class="top-menu-block">
            <ul class="top-menu">
                <li><a href="#">Про нас</a></li>
                <li><a href="#">Новини</a></li>
                <li><a href="#">Контакти</a></li>
                <li><a href="#">Бренди</a></li>
                <li><a href="#">Доставка та оплата</a></li>
                <li><a href="#">Обмін і повернення</a></li>
            </ul>

            <div class="support-block">
                <div class="contact-phone">
                    <a href="tel:+38 (067) 673 16 67">+38 (067) 673 16 67</a>
                </div>
                <div class="language-select">
                    <span>Мова</span>
                    <span class="flag"><img src="./icon/Ukraine (UA).svg" alt=""></span>
                </div>
            </div>
        </div>
    </div>
</nav>
<header>
    <div class="content header-content">
        <div class="header-block desktop">
            <?php the_custom_logo();?>
            <div class="main-menu-block">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'menu_class' => 'main-menu',
                'menu_id' => 'main-menu-desktop',
                'walker' => new Custom_Walker_Nav_Menu(),
            ));
            ?>
            </div>

            <div class="header-shop-panel">
                <div class="header-shop-block">
                    <div class="header-search desktop">
                        <input class="header-search-input" type="text" placeholder="Пошук">
                        <svg class="fill-green seacrh-btn" width="21" height="21">
                                <use xlink:href="#search"></use>
                        </svg>
                    </div>
                    <div class="header-shop-buttons">

                        <span>
                            <svg class="fill-green" width="32" height="32">
                                <use xlink:href="#favorite"></use>
                            </svg>
                        </span>

                        <span>
                            <svg class="fill-green" width="24" height="24">
                                <use xlink:href="#person"></use>
                            </svg>
                        </span>

                        <div class="mini-cart-block">
                            <a href="<?php echo wc_get_cart_url(); ?>" class="cart-link">
                                <svg class="fill-green" width="24" height="24">
                                    <use xlink:href="#shopping-cart"></use>
                                </svg>
                            </a>
                            <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                            <!-- <div class="widget_shopping_cart_content">
                                 woocommerce_mini_cart(); ?>
                            </div> -->
                        </div>





                    </div>
                </div>
            </div>

        </div>


        <div class="header-block mobile">
            <div class="place-for-burget-menu">
                <div class="burger-menu-btn open">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <?php the_custom_logo();?>

            <div class="header-shop-panel">
                <div class="header-shop-block">
                    <div class="header-shop-buttons">
                        <span>
                            <svg class="fill-green" width="24" height="24">
                                <use xlink:href="#shopping-cart"></use>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</header>

<div class="menu__box">

    <div class="header-block mobile  menu-mobile">

        <div class="header-shop-block">
            <div class="header-shop-buttons">
                <span>
                    <svg class="fill-green" width="24" height="24">
                        <use xlink:href="#person"></use>
                    </svg>
                    <span class="person-title">Увійти до кабінету</span>
                </span>
                <span>
                <svg class="fill-green" width="32" height="32">
                    <use xlink:href="#favorite"></use>
                </svg>
                </span>
            </div>
        </div>

        <div class="burger-menu-btn close">
            <span></span>
            <span></span>
        </div>

    </div>

    <div class="header-search mobile">
        <input class="header-search-input" type="text" placeholder="Пошук">
        <svg class="fill-green seacrh-btn" width="21" height="21">
            <use xlink:href="#search"></use>
        </svg>
    </div>
    <div class="mobile-menus-place">
        <div class="place-for-mobile-menu">
            <div class="content">
                <h3>Каталог товарів</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class' => 'main-menu',
                    'menu_id' => 'main-menu-mobile',
                    'walker' => new Custom_Walker_Nav_Menu(),
                ));
                ?>
            </div>
        </div>
        <div class="place-for-mobile-menu">
            <div class="content">
                <h3>Інформація</h3>
                <ul class="support-menu">
                    <li><a href="#">Про нас</a></li>
                    <li><a href="#">Новини</a></li>
                    <li><a href="#">Контакти</a></li>
                    <li><a href="#">Бренди</a></li>
                    <li><a href="#">Доставка та оплата</a></li>
                    <li><a href="#">Обмін і повернення</a></li>
                </ul>
                <div class="language-select">
                    <span>Мова</span>
                    <span class="flag"><img src="./icon/Ukraine (UA).svg" alt=""></span>
                </div>
            </div>
        </div>
    </div>

</div>
                    

<script>
    document.querySelectorAll('.burger-menu-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            document.querySelector('.menu__box').classList.toggle('active');
        });
    });



    document.querySelectorAll('.show-child-category-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            // Находим ближайший родительский элемент, содержащий sub-menu
            const subMenu = this.parentElement.querySelector('.sub-menu');
            
            // Проверяем, существует ли элемент sub-menu
            if (subMenu) {
                // Добавляем/удаляем класс active
                subMenu.classList.toggle('active');
            }
        });
    });
</script>




