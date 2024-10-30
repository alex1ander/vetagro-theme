<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_in_stock() ) {
    return; // Если товар отсутствует на складе, не показывать форму
}
?>


<?php
if ( comments_open() ) {
    comments_template();
}
?>
