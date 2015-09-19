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
    'icon'        => 'si-menu7',
        'sections' => array(
            array(
                'name'      => 'general_options',
                'title'     => 'General',
                'icon'      => 'si-cog3',
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
                            'default' => 'SIGN IN'
                        ),
                        array(
                            'id'      => 'form_register_link_text',
                            'type'    => 'text',
                            'title'   => 'Register Form Link Text',
                            'help'    => 'Register Form Link text field for links located under the forms',
                            'default' => 'CREATE AN ACCOUNT'
                        ),
                         array(
                            'id'      => 'form_forgot_link_text',
                            'type'    => 'text',
                            'title'   => 'Forgot Form Link Text',
                            'help'    => 'Forgot Form Link text field for links located under the forms',
                            'default' => 'I FORGOT MY PASSWORD'
                        ),
                ),
            ),
            array(
                'name'      => 'login_options',
                'title'     => 'Login',
                'icon'      => 'si-user',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => 'Login',
                        ),
                        array(
                            'id'      => 'login_form_title', 
                            'type'    => 'text',
                            'title'   => 'Title',
                            'default' => 'WELCOME BACK',
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
                            'default' => 'SIGN IN',
                        ),
                ),
            ),
            array(
                'name'      => 'register_options',
                'title'     => 'Register',
                'icon'      => 'si-pencil3',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => 'Register',
                        ),

                        array(
                            'id'      => 'register_form_title', 
                            'type'    => 'text',
                            'title'   => 'Title',
                            'default' => 'CREATE AN ACCOUNT',
                        ),
                        array(
                            'id'      => 'register_form_subtitle', 
                            'type'    => 'text',
                            'title'   => 'Subtitle',
                            'default' => 'Password will be emailed to you',
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
                            'id'      => 'register_form_password_placeholder_text', 
                            'type'    => 'text',
                            'title'   => 'Password Placeholder Text',
                            'default' => 'Password',
                            'dependency'   => array( 'pafl_allow_user_set_password', '==', 'true' ),
                        ),
                        array(
                            'id'      => 'register_button_text', 
                            'type'    => 'text',
                            'title'   => 'Register Button Text',
                            'default' => 'CREATE ACCOUNT',
                        ),

                ),
            ),
            array(
                'name'      => 'forgot_options',
                'title'     => 'Forgot',
                'icon'      => 'si-question3',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => 'Forgot',
                        ),                      
                        array(
                            'id'      => 'forgot_form_title', 
                            'type'    => 'text',
                            'title'   => 'Title',
                            'default' => 'FORGOT PASSWORD',
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
                            'default' => 'SEND RESET EMAIL',
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
    'icon'        => 'si-redo2',
    'fields'      => array(

        array(
            'id'      => 'redirect_allow_after_login_redirection_url', 
            'type'    => 'text',
            'title'   => 'Login Redirect URL',
            'after'   => '<br> Enter full URL e.g. http://yoursitename.com/page',
            'help'    => 'Set optional login redirect URL, if not set you will be redirected to current page',
        ),

        array(
            'id'      => 'redirect_allow_after_logout_redirection_url', 
            'type'    => 'text',
            'title'   => 'Logout Redirect URL',
            'after'   => '<br> Enter full URL e.g. http://yoursitename.com/page',
            'help'    => 'Set optional logout redirect URL, if not set you will be redirected to home page',
        ),

        array(
            'id'      => 'redirect_allow_after_registration_redirection_url', 
            'type'    => 'text',
            'title'   => 'Registration Redirect URL',
            'after'   => '<br> Enter full URL e.g. http://yoursitename.com/page',
            'help'    => 'Set optional registration redirect URL, if not set you will be redirected to the current page.',
        ),
    )
);


/*
 * Email options tab and fields settings
 */
$options[]      = array(
    'name'             => 'email',
    'title'            => 'Email',
    'icon'             => 'si-envelop2',
    'fields'           => array(

        array(
            'id'       => 'custom_email_template', 
            'type'     => 'switcher',
            'title'    => 'Custom Email Template',
            'default'  => false,
        ),
       array(
            'id'       => 'custom_email_subject', 
            'type'     => 'text',
            'title'    => 'Subject',
            'dependency'   => array( 'pafl_custom_email_template', '==', 'true' ),
                        
        ),
        array(
            'id'       => 'custom_email_body', 
            'type'     => 'wysiwyg',
            'title'    => 'Body',
            'dependency'   => array( 'pafl_custom_email_template', '==', 'true' ),
            'after'     => 'Add custom registration email template with the following variables for use in subject or body: %username%, %password%, %loginlink%',
                    
        ),
    )
);


/*
 * Captcha options tab and fields settings
 */
$options[]      = array(
    'name'        => 'captcha',
    'title'       => 'Captcha',
    'icon'        => 'si-lock2',
    'fields'      => array(
        array(
            'id'      => 'recaptcha_public_key', 
            'type'    => 'text',
            'title'   => 'Site Key',
            'default' => '',
        ),
        array(
            'id'      => 'recaptcha_private_key', 
            'type'    => 'text',
            'title'   => 'Secret Key',
            'default' => '',
        ),
        array(
            'id'      => 'recaptcha_enable_on', 
            'type'    => 'checkbox',
            'title'   => 'Enable On',
            'options' => array(
                'login'     => 'Login Form',
                'register'  => 'Register Form',
                'forgot'    => 'Forgot Form',
            ),
        ),
        array(
            'id'      => 'recaptcha_theme', 
            'type'    => 'select',
            'title'   => 'Theme',
            'options' => array(
                'light'     => 'Light',
                'dark'      => 'Dark',
            ),
        ),
    )
);

/*
 *  Styling options tab and fields settings
 */
$options[]      = array(
    'name'        => 'styling',
    'title'       => 'Styling',
    'icon'        => 'si-brush',
    'fields'      => array(
        array(
            'id'      => 'modal_background', 
            'type'    => 'color_picker',
            'title'   => 'Background Color',
            'default' => '#03a9f4',
        ),
        array(
            'id'      => 'text_color', 
            'type'    => 'color_picker',
            'title'   => 'Text Color',
            'help'    => 'Change color for content color, applies to form title, subtitle, remember me label and links under forms',
            'rgba'    => false,
            'default' => '#ffffff',
        ),
        array(
            'id'      => 'input_border_color',
            'type'    => 'color_picker',
            'title'   => 'Input Border Color',
            'rgba'    => false
        ),
        array(
            'id'      => 'input_border_radius',
            'type'    => 'number',
            'title'   => 'Input Border Radius',
            'after'   => ' <i class="sk-text-muted">(px)</i>',
            'default' => 1,
        ),
        array(
            'id'      => 'input_border_width',
            'type'    => 'number',
            'title'   => 'Input Border Width',
            'after'   => ' <i class="sk-text-muted">(px)</i>',
            'default' => 0,
        ),
        array(
            'id'      => 'button_text_color', 
            'type'    => 'color_picker',
            'title'   => 'Button Text Color',
            'rgba'    => false,
            'default' => '#ffffff',
        ),
        array(
            'id'      => 'button_background_color', 
            'type'    => 'color_picker',
            'title'   => 'Button Background Color',
            'rgba'    => false,
            'default' => '#001017',
        ),
        array(
            'id'      => 'button_background_color_hover',
            'type'    => 'color_picker',
            'title'   => 'Button Background Color Hover',
            'rgba'    => false,
            'default' => '#01579b',
        ),
        array(
            'id'      => 'modal_effect',
            'type'    => 'select',
            'title'   => 'Effect',
            'options' => array(
                'hugeinc'       => 'Huge Inc',
                'corner'        => 'Corner',
                'slidedown'     => 'Slide Down',
                'scale'         => 'Scale',
                'door'          => 'Door',
                'contentpush'   => 'Content Push',
                'contentscale'  => 'Content Scale',
                'simplegenie'   => 'Simple Genie',
            ),
            'default'    => 'hugeinc',
        ),
        array(
            'id'      => 'custom_css', 
            'type'    => 'textarea',
            'title'   => 'Custom CSS',
        ),
    ),
);

SkeletFramework::instance( $settings, $options );
