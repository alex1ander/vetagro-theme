<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $comment;
$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

if ( $rating && wc_review_ratings_enabled() ) {
    ?>
    <div class="rating">
            <?php for($i = 1; $i <= 5; $i++):?>
            <div class="place-for-star">
                <?php if($i <= $rating):?>
                <svg class="fill-yellow" width="16" height="16">
                    <use xlink:href="#star"></use>
                </svg>
                <?php endif;?>
                <svg class="fill-yellow" width="16" height="16">
                    <use xlink:href="#star-empty"></use>
                </svg>
            </div>
            <?php endfor;?>
    </div>
    <?php

}
