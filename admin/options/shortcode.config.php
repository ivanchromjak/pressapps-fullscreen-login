<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

/**
 * Global skelet shortcodes variable
 */
  global $skelet_shortcodes;

/**
 * Fullscreen navigation     Shortcode options and settings
 */
$skelet_shortcodes[]     = sk_shortcode_apply_prefix( array(
    'title'      => 'Fullscreen Login',
    'shortcodes' => array(
        array(
          'name'      => 'login_link',
          'title'     => 'Insert Login Link',
          'fields'    => array(
              array(
                  'id'       => 'login_text',
                  'type'     => 'text',
                  'title'    => 'Login Link Text',
                  'default'  => ''
              ),
              array(
                  'id'       => 'logout_text',
                  'type'     => 'text',
                  'title'    => 'Logout Link Text',
                  'default'  => ''
              ),
          ),
        ),
        array(
            'name'      => 'register_link',
            'title'     => 'Insert Register Link',
            'fields'    => array(
                array(
                    'id'       => 'register_text',
                    'type'     => 'text',
                    'title'    => 'Register Text',
                    'default'  => ''
                )
            ),
        ),
      
    ),
    

));