<?php
get_header();


get_template_part('template-parts/main-banner');

get_template_part('template-parts/popular-category');



$category_slugs = array( 'popular-products' );
get_template_part( 'template-parts/product-slider', false, array( 'categories' => $category_slugs ) );



$category_slugs = array( 'promotion-products' );
get_template_part( 'template-parts/product-slider', false, array( 'categories' => $category_slugs ) );

$category_slugs = array( 'new-products' );
get_template_part( 'template-parts/product-slider', false, array( 'categories' => $category_slugs ) );



get_template_part( 'template-parts/category-brands');

get_template_part( 'template-parts/category-news');

?>









<section id="questions_section" class="section_block">
    <div class="content grid-content">

        <div class="section-title mt-30 mb-30">
            <h2>Часті запитання</h2>
        </div>

        <div class="accrodion_block">



            <div class="faq-drawer">
                <input class="faq-drawer__trigger" id="faq-drawer-1" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-1">Які послуги ви пропонуєте для оздоровлення господарства?</label>
                <div class="faq-drawer__content-wrapper">
                  <div class="faq-drawer__content">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                    </p>
                  </div>
                </div>
            </div>

            <div class="faq-drawer">
                <input class="faq-drawer__trigger" id="faq-drawer-2" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-2">Які послуги ви пропонуєте для оздоровлення господарства?</label>
                <div class="faq-drawer__content-wrapper">
                  <div class="faq-drawer__content">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                    </p>
                  </div>
                </div>
            </div>

            <div class="faq-drawer">
                <input class="faq-drawer__trigger" id="faq-drawer-3" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-3">Які послуги ви пропонуєте для оздоровлення господарства?</label>
                <div class="faq-drawer__content-wrapper">
                  <div class="faq-drawer__content">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                    </p>
                  </div>
                </div>
            </div>

        </div>
    </div> 
</section>






<section id="about-vetagro-section" class="section_block">
    <div class="content">
        <h6 class="gray-color">Про ВетАгро</h6>
        <div class="grid-about-vetagro">
            <div class="about-vetagro-text gray-color">Компанія «ВетАгро» – є ветеринарною компанією, яка надає спектр послуг по оздоровленню господарства. Ми пропонуємо індивідуальні програми оптимізації вирощування сільськогосподарських тварин та птиці. Ми забезпечуємо наших клієнтів високоякісними ветеринарними препаратами, а також надаємо кваліфіковану консультацію щодо їх використання.
                Компанія «ВетАгро» заснована  у 2005р. і з того часу  ми постійно розвиваємось та вдосконалюємось.
                НАША МІСІЯ:
                постійно покращувати здоров’я людей через піклування про здоров’я тварин.
                МИ ПРАГНЕМО:
                –  будувати довгострокові відносини з нашими клієнтами
                –  задовольнити потреби кожного клієнта
                –  допомогти вирішити їх проблеми і тим самим покращити прибуток
                На сьогоднішній день «ВетАгро» працює в двох напрямках – сільськогосподарському та напрямку дрібних тварин .
            </div>
            <div class="about-more-block">
                <span class="title">Повний спектр продуктів по оздоровленню господарства</span>
                <span class="sub-title">Більше про нас</span>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>

</body>
</html>