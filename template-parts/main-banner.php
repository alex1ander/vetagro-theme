<section id="main-banner">

    <div class="swiper main-banner-swiper">

        <div class="swiper-wrapper">
            <div class="full-bg-image  swiper-slide">
                <div class="content">
                    <span class="sub-title">Повний спектр продуктів по оздоровленню господарства</span>
                    <h1>Здорова ферма - запорука успіху</h1>
                    <div class="btn-to-catalog">
                        <span class="green-place">Вакцини, кормові добавки, препарати та засоби для птиці, свиней і ВРХ</span>
                        <span class="white-round">Перейти в каталог</span>
                    </div>
                </div>
            </div>
            <div class="full-bg-image  swiper-slide">
                <div class="content">
                    <span class="sub-title">Повний спектр продуктів по оздоровленню господарства</span>
                    <h1>Здорова ферма - запорука успіху</h1>
                    <div class="btn-to-catalog">
                        <span class="green-place">Вакцини, кормові добавки, препарати та засоби для птиці, свиней і ВРХ</span>
                        <span class="white-round">Перейти в каталог</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>    
</section>


<script>

    var swiper = new Swiper(".main-banner-swiper", {
        slidesPerView: 1,
        spaceBetween: 0,
        freeMode: false,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            enabled: false,
        },
    });
</script>