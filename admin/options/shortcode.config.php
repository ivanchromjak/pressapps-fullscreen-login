<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

/**
 * Global skelet shortcodes variable
 */
  global $skelet_shortcodes;

/**
 * Fullscreen navigation     Shortcode options and settings
 */
$skelet_shortcodes[]     = sk_shortcode_apply_prefix( array(
    'title'      => __( 'Fullscreen Login', 'pressapps' ),
    'shortcodes' => array(
        array(
          'name'      => 'login_link',
          'title'     => __( 'Insert Login Link', 'pressapps' ),
          'fields'    => array(
              array(
                  'id'       => 'login_text',
                  'type'     => 'text',
                  'title'    => __( 'Login Link Text', 'pressapps' ),
                  'default'  => ''
              ),
              array(
                  'id'       => 'logout_text',
                  'type'     => 'text',
                  'title'    => __( 'Logout Link Text', 'pressapps' ),
                  'default'  => ''
              ),
          ),
        ),
        array(
            'name'      => 'register_link',
            'title'     => __( 'Insert Register Link', 'pressapps' ),
            'fields'    => array(
                array(
                    'id'       => 'register_text',
                    'type'     => 'text',
                    'title'    => __( 'Register Text', 'pressapps' ),
                    'default'  => ''
                )
            ),
        ),
      
    ),
    

));