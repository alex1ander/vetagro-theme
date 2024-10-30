<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments" class="review-product-block">
		<?php load_more_comments_on_product() ?>
	</div>



	<!-- вывод формы -->
	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper" class="mt-40">
			<div id="review_form">
				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => have_comments() ? esc_html__( 'Залишити відгук', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__( 'Submit', 'woocommerce' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
					
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$fields              = array(
					'author' => array(
						'label'    => __( 'Name', 'woocommerce' ),
						'type'     => 'text',
						'value'    => $commenter['comment_author'],
						'required' => $name_email_required,
					),
					'email'  => array(
						'label'    => __( 'Email', 'woocommerce' ),
						'type'     => 'email',
						'value'    => $commenter['comment_author_email'],
						'required' => $name_email_required,
					),
				);

				$comment_form['fields'] = array();

				$comment_form['fields']['combined'] = '
					<div class="place-for-input">
						<div class="form-field-block">
							<input type="text" name="author" required="" placeholder="' . esc_attr( __( 'Name', 'woocommerce' ) ) . '">
						</div>
						<div class="form-field-block">
							<input type="email" name="email" required="" placeholder="' . esc_attr( __( 'Email', 'woocommerce' ) ) . '">
						</div>
					</div>';

				if ( wc_review_ratings_enabled() ) {
				$comment_form['comment_field'] = '
				<div class="comment-form-rating mt-20 mb-20">
					<div class="rating-group">
						<label>
							<input type="radio" name="rating" value="5">
							<div class="place-for-star">
								<svg class="opacity-0" width="16" height="16">
									<use xlink:href="#star"></use>
								</svg>
								<svg class="" width="16" height="16">
									<use xlink:href="#star-empty"></use>
								</svg>
							</div>
						</label>
						<label>
							<input type="radio" name="rating" value="4">
							<div class="place-for-star">
								<svg class="opacity-0" width="16" height="16">
									<use xlink:href="#star"></use>
								</svg>
								<svg class="" width="16" height="16">
									<use xlink:href="#star-empty"></use>
								</svg>
							</div>
						</label>
						<label>
							<input type="radio" name="rating" value="3">
							<div class="place-for-star">
								<svg class="opacity-0" width="16" height="16">
									<use xlink:href="#star"></use>
								</svg>
								<svg class="" width="16" height="16">
									<use xlink:href="#star-empty"></use>
								</svg>
							</div>
						</label>
						<label>
							<input type="radio" name="rating" value="2">
							<div class="place-for-star">
								<svg class="opacity-0" width="16" height="16">
									<use xlink:href="#star"></use>
								</svg>
								<svg class="" width="16" height="16">
									<use xlink:href="#star-empty"></use>
								</svg>
							</div>
						</label>
						<label>
							<input type="radio" name="rating" value="1">
							<div class="place-for-star">
								<svg class="opacity-0" width="16" height="16">
									<use xlink:href="#star"></use>
								</svg>
								<svg class="" width="16" height="16">
									<use xlink:href="#star-empty"></use>
								</svg>
							</div>
						</label>
					</div>
					<label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label>
				</div>';
				}

				$comment_form['comment_field'] .= '<textarea class="" name="comment" id="" placeholder="Текст повідомлення"></textarea>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

				
				?>


			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
	<?php endif; ?>

	<div class="clear"></div>
</div>
