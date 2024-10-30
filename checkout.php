<?php
// Template Name: Checkout
get_header(); 

?>

<section id="cart-section" class="section_block">
    <div class="content">
    
    <?php get_template_part( '/woocommerce/checkout/form-checkout' );?>
    </div>

</section>


<?php
get_footer(); 
?>

