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
            'name'      => 'shortcode_login_text',
            'title'     => 'Insert Login Text',
            'view'      => 'contents',
    	    'fields'    => array(

		        array(
			         'id'       => 'pafl_login_text',
			         'type'     => 'text',
			         'title'    => 'Link Text',
                     'default'  => 'Login'
		        ),

		    ),

        ),

        array(
            'name'      => 'shortcode_logout_text',
            'title'     => 'Insert Logout Text',
            'view'      => 'contents',
            'fields'    => array(

                array(
                     'id'       => 'pafl_logout_text',
                     'type'     => 'text',
                     'title'    => 'Link Text',
                     'default'  => 'Logout'
                ),

            ),

        ),

        array(
            'name'      => 'register',
            'title'     => 'Insert Register',
            'fields'    => array(

                array(
                     'id'       => 'modal',
                     'type'     => 'switcher',
                     'title'    => 'Allow register form load in a modal',
                     'default'  => false,
                ),
                array(
                     'id'       => 'text',
                     'type'     => 'text',
                     'title'    => 'Link Text',
                ),

            ),

        ),

    ),
    

));