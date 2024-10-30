<?php


defined( 'ABSPATH' ) || exit;

global $comment;
$verified = wc_review_is_from_verified_owner( $comment->comment_ID ); ?>

<?php if ( '0' === $comment->comment_approved ) : ?>

	<p class="meta">
		<em class="woocommerce-review__awaiting-approval">
			<?php esc_html_e( 'Your review is awaiting approval', 'woocommerce' ); ?>
		</em>
	</p>
<?php endif; ?>

    <div class="review-autor"><?php comment_author(); ?></div>
    <div class="review-date"><?php echo esc_html( get_comment_date( wc_date_format() ) ); ?></div>
