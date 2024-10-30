<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="information-block">
                    <div class="yellow-figure-rounded"></div>
                    <h3>Контактні дані</h3>


                    <div class="form-checkout-tabs mt-30">
                        <input type="radio" name="select-form" id="new-checkout" class="checkout-radio" checked="checked">
                        <input type="radio" name="select-form" id="login-checkout" class="checkout-radio">
                        <div class="select-form-checkout mb-40">
                            <label for="new-checkout" id="label-new-checkout" class="select-form"><h5>Новий покупець</h5></label>
                            <label for="login-checkout" id="label-login-checkout" class="select-form"><h5>Увійти в кабінет</h5><h5>
                        </h5></label></div>
                        


                        <div class="select-form-block-d-none" id="form-new-checkout">
                            <div class="place-form-main">
                                <form class="form-main two-col" action="">

									<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

									<div class="woocommerce-billing-fields__field-wrapper">
										<?php
										$fields = $checkout->get_checkout_fields( 'billing' );

										foreach ( $fields as $key => $field ) {
											woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
										}
										?>
									</div>
                                   

                                </form>
                            </div>
                        </div>

                        <div class="select-form-block-d-none" id="form-login-checkout">
                            <div class="place-form-main">
                                <form class="form-main two-col" action="">
                                    <div class="place-for-input">
                                        <div class="form-field-block">
                                            <label for="email">Адреса електронної пошти</label>
                                            <input type="text" name="email" id="email" required="">
                                        </div>

                                        <div class="form-field-block">
                                            <label for="password">Пароль</label>
                                            <input type="password" name="password" id="password" required="">
                                        </div>
                                    </div>
                                
                                <button class="green-btn fill-green text-center m-auto" href="#checkout">Оформити замовлення</button>

                                </form>
                            </div>
                        </div>

                        <div class="login-with-service-block mt-40">
                            <div class="line-with-support-text">
                                <span class="support-text">AБО</span>
                            </div>

                            <div class="service-to-login">
                                <a href="#" class="gray-btn text-center service-btn w-100"><img src="./icon/google.svg" alt=""> Увійти через Google</a>
                                <a href="#" class="gray-btn text-center service-btn w-100"><img src="./icon/facebook.svg" alt="">Увійти через Facebook</a>
                            </div>
                        </div>

                    </div>
                </div>


<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
