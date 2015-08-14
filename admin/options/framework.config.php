<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

/**
 * Framework page settings
 */
$settings = array(
    'header_title' => 'Fullscreen Login',
    'menu_title'   => 'Fullscreen Login',
    'menu_type'    => 'add_submenu_page',
    'menu_slug'    => 'pressapps-fullscreen-login',
    'ajax_save'    => false,
);


/**
 * sections and fields option
 * @var array
 */
$options        = array();

/*
 * General options tab and fields settings
 */
$options[]      = array(
    'name'        => 'forms',
    'title'       => 'Forms',
    'icon'        => 'fa fa-list-alt',
        'sections' => array(
            array(
                'name'      => 'general_options',
                'title'     => 'General',
                'icon'      => 'fa fa-gear',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => 'General',
                        ),
                        array(
                            'id'      => 'form_logo',
                            'type'    => 'upload',
                            'title'   => 'Form Logo',
                            'help'    => 'Upload a site logo for the forms.',
                        ),
                        array(
                            'id'      => 'form_login_link_text',
                            'type'    => 'text',
                            'title'   => 'Login Form Link Text',
                            'help'    => 'Login Form Link text field for links located under the forms',
                            'default' => 'Sign In'
                        ),
                        array(
                            'id'      => 'form_register_link_text',
                            'type'    => 'text',
                            'title'   => 'Register Form Link Text',
                            'help'    => 'Register Form Link text field for links located under the forms',
                            'default' => 'Create an account'
                        ),
                         array(
                            'id'      => 'form_forgot_link_text',
                            'type'    => 'text',
                            'title'   => 'Forgot Form Link Text',
                            'help'    => 'Forgot Form Link text field for links located under the forms',
                            'default' => 'I forgot my password'
                        ),
                ),
            ),
            array(
                'name'      => 'login_options',
                'title'     => 'Login',
                'icon'      => 'fa fa-gear',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => 'Login',
                        ),
                        array(
                            'id'      => 'login_form_title', 
                            'type'    => 'text',
                            'title'   => 'Title',
                            'default' => 'Welcome Back',
                        ),
                        array(
                            'id'      => 'login_form_subtitle', 
                            'type'    => 'text',
                            'title'   => 'Subtitle',
                            'default' => 'Already a member? Sign in with your username.',
                        ),
                        array(
                            'id'      => 'login_form_username_placeholder_text', 
                            'type'    => 'text',
                            'title'   => 'Username Placeholder Text',
                            'default' => 'Username',
                        ),
                        array(
                            'id'      => 'login_form_password_placeholder_text', 
                            'type'    => 'text',
                            'title'   => 'Password Placeholder Text',
                            'default' => 'Password',
                        ),
                        array(
                            'id'      => 'rememberme_visibility', 
                            'type'    => 'switcher',
                            'title'   => 'Remember Me',
                            'default' => true,
                        ),
                        array(
                            'id'           => 'rememberme_placeholder_text', 
                            'type'         => 'text',
                            'title'        => 'Remember Me Placeholder Text',
                            'default'      => 'Remember Me',
                            'dependency'   => array( 'pafl_rememberme_visibility', '==', 'true' ),
                        ),
                        array(
                            'id'      => 'login_button_text', 
                            'type'    => 'text',
                            'title'   => 'Login Button Text',
                            'default' => 'Sign in',
                        ),
                ),
            ),
            array(
                'name'      => 'register_options',
                'title'     => 'Register',
                'icon'      => 'fa fa-gear',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => 'Register',
                        ),

                        array(
                            'id'      => 'register_form_title', 
                            'type'    => 'text',
                            'title'   => 'Title',
                            'default' => 'Create an Account',
                        ),
                        array(
                            'id'      => 'register_form_subtitle', 
                            'type'    => 'text',
                            'title'   => 'Subtitle',
                            'default' => 'A password will be emailed to you',
                        ),
                        array(
                            'id'      => 'register_form_username_placeholder_text', 
                            'type'    => 'text',
                            'title'   => 'Username Placeholder Text',
                            'default' => 'Username',
                        ),
                        array(
                            'id'      => 'register_form_email_placeholder_text', 
                            'type'    => 'text',
                            'title'   => 'Email Placeholder Text',
                            'default' => 'Email',
                        ),
                        array(
                            'id'      => 'allow_user_set_password', 
                            'type'    => 'switcher',
                            'title'   => 'Allow User To Set Password',
                            'default' => true,
                        ),
                        array(
                            'id'      => 'password_placeholder_text', 
                            'type'    => 'text',
                            'title'   => 'Password Placeholder Text',
                            'default' => 'Password',
                            'dependency'   => array( 'pafl_allow_user_set_password', '==', 'true' ),
                        ),
                        array(
                            'id'      => 'register_button_text', 
                            'type'    => 'text',
                            'title'   => 'Register Button Text',
                            'default' => 'Create Account',
                        ),

                ),
            ),
            array(
                'name'      => 'forgot_options',
                'title'     => 'Forgot',
                'icon'      => 'fa fa-gear',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => 'Forgot',
                        ),                      
                        array(
                            'id'      => 'forgot_form_title', 
                            'type'    => 'text',
                            'title'   => 'Title',
                            'default' => 'Forgot Password',
                        ),
                        array(
                            'id'      => 'forgot_form_subtitle', 
                            'type'    => 'text',
                            'title'   => 'Subtitle',
                            'default' => 'Enter your username or email to reset your password.',
                        ),
                        array(
                            'id'      => 'forgot_form_username_placeholder_text', 
                            'type'    => 'text',
                            'title'   => 'Username/Email Placeholder Text',
                            'default' => 'Username or Email',
                        ),
                        array(
                            'id'      => 'forgot_button_text', 
                            'type'    => 'text',
                            'title'   => 'Forgot Button Text',
                            'default' => 'Send Reset Email',
                        ),
                ),
            ),
        )
);

/*
 * Redirect options tab and fields settings
 */
$options[]      = array(
    'name'        => 'redirect',
    'title'       => 'Redirect',
    'icon'        => 'fa fa-external-link-square',
    'fields'      => array(
        array(
            'id'      => 'text', 
            'type'    => 'text',
            'title'   => 'Title',
            'default' => 'Hello World',
        ),
    )
);


/*
 * Email options tab and fields settings
 */
$options[]      = array(
    'name'        => 'email',
    'title'       => 'Email',
    'icon'        => 'fa fa-envelope-o ',
    'fields'      => array(
        array(
            'id'      => 'text', 
            'type'    => 'text',
            'title'   => 'Title',
            'default' => 'Hello World',
        ),
    )
);


/*
 * Captcha options tab and fields settings
 */
$options[]      = array(
    'name'        => 'captcha',
    'title'       => 'Captcha',
    'icon'        => 'fa fa-shield',
    'fields'      => array(
        array(
            'id'      => 'text', 
            'type'    => 'text',
            'title'   => 'Title',
            'default' => 'Hello World',
        ),
    )
);

/*
 *  Styling options tab and fields settings
 */
$options[]      = array(
    'name'        => 'styling',
    'title'       => 'Styling',
    'icon'        => 'fa fa-paint-brush',
    'fields'      => array(
        array(
            'id'      => 'text', 
            'type'    => 'text',
            'title'   => 'Title',
            'default' => 'Hello World',
        ),
    ),
);

SkeletFramework::instance( $settings, $options );
