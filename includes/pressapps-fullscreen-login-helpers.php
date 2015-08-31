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


/**
 * Add login/logout/register link
 * @param Array $atts    
 *
 * @since    1.0.0
 */
if( ! function_exists('pafl_link_text') ){
	function pafl_link_text( $atts ){

		$atts = shortcode_atts(
			array(
				'login_text' 	=> 'Login',
				'logout_text' 	=> __('Logout','pressapps-fullscreen-login'),
				'register'		=> false,
				'register_text' => __('Create an Account','pressapps-fullscreen-login')
			), $atts, 'pafl_link' 
		);

		if( $atts['register'] ){
		    echo "<a href='javascript:;'  data-form='register'  title='pafl-trigger-overlay'>".$atts['register_text']."</a>";
		}else{
			if( is_user_logged_in() ){
			    echo "<a href='".wp_logout_url()."' >".$atts['logout_text']."</a>";
			}else{
			    echo "<a href='javascript:;'  data-form='login'  title='pafl-trigger-overlay'>".$atts['login_text']."</a>";
			}
		}
	}
}
