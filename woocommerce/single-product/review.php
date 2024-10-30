<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

        <div class="review">
            <div class="review-part-top">
                <?php do_action( 'woocommerce_review_before_comment_meta', $comment );?>

                <?php do_action( 'woocommerce_review_meta', $comment ); ?>
            </div>
            <div class="review-part-bottom">
                <p class="review-text">
                    <?= $comment_text = wp_strip_all_tags( $comment->comment_content );?>
                </p>
            </div>
		</div>
