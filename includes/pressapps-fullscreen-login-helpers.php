<?php
/**
 *
 * Helpers functions
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

if ( ! function_exists( 'pafl_is_captcha_enabled' ) ) {
	/**
     * Helper function that checks if captcha is enabled
     * @return bool
     */
    function pafl_is_captcha_enabled() {
        $pafl_sk              = new Skelet( 'pafl' );
        $recaptcha_enabled_on = $pafl_sk->get( 'recaptcha_enable_on' );
        if ( is_array( $recaptcha_enabled_on ) ) {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists( 'pafl_is_captcha_field' ) ) {
	/**
     * Check specific field if captcha is enabled.
     * @param $field
     *
     * @return bool
     */
    function pafl_is_captcha_field( $field ) {
        $pafl_sk         = new Skelet( 'pafl' );
        $recaptcha_array = $pafl_sk->get( 'recaptcha_enable_on' );

        if ( pafl_is_captcha_enabled() && in_array( $field, $recaptcha_array ) ) {
            return true;
        } else {
            return false;
        }
    }
}