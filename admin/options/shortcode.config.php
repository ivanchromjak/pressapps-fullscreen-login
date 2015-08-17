<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

/**
 * Global skelet shortcodes variable
 */
  global $skelet_shortcodes;

/**
 * Fullscreen navigation     Shortcode options and settings
 */
$skelet_shortcodes[]     = sk_shortcode_apply_prefix(array(
    'title'      => 'Fullscreen Login',
    'shortcodes' => array(

        array(
            'name'      => 'link',
            'title'     => 'Insert Fullscreen Login Link',
            'fields'    => array(

		        array(
			         'id'       => 'login_text',
			         'type'     => 'text',
			         'title'    => 'Login Link Text',
                     'default'  => '',
		        ),
                array(
                     'id'       => 'logout_text',
                     'type'     => 'text',
                     'title'    => 'Logout Link Text',
                     'default'  => '',
                ),
                array(
                     'id'       => 'register',
                     'type'     => 'switcher',
                     'title'    => 'Register',
                     'default'  => false,
                ),

		    ),

        ),

      
    ),
    

));