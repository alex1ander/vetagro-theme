<?php
// Подключаем файл header.php
get_header(); 
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Начинаем основной цикл WordPress
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                the_content(); // Отображаем контент поста
            endwhile;

        else :
            // Если постов нет, загружаем шаблон для отображения 404
            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
// Подключаем файл footer.php
get_footer(); 
?>
