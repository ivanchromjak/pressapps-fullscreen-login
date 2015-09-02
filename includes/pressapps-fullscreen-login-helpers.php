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


if ( ! function_exists( 'pafl_login_link' ) ) {

    /**
     * Login link shortcode
     *
     * @param Array $atts
     */
    function pafl_login_link( $atts ) {
        $atts = shortcode_atts(
            array(
                'login_text' 	=> __( 'Login', 'pressapps-fullscreen-login' ),
                'logout_text' 	=> __('Logout','pressapps-fullscreen-login')
            ), $atts, 'pafl_login_link'
        );

        if ( is_user_logged_in() ){
            echo '<a href="' . wp_logout_url() . '" >' . $atts['logout_text'] . '</a>';
        } else {
            echo '<a href="#" onclick="return false" data-form="login"  title="pafl-trigger-overlay">' . $atts['login_text'] . '</a>';
        }
    }

}

if ( ! function_exists( 'pafl_register_link' ) ) {

    /**
     * Register link shortcode
     *
     * @param Array $atts
     */
    function pafl_register_link( $atts ) {
        $atts = shortcode_atts(
            array(
                'register' 	=> false,
                'register_text' => __('Create an Account','pressapps-fullscreen-login')
            ), $atts, 'pafl_register_link'
        );

        echo '<a href="#" onclick="return false" data-form="register"  title="pafl-trigger-overlay">' . $atts['register_text'] . '</a>';
    }

}