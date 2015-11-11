<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

/**
 * Framework page settings
 */
$settings = array(
    'header_title' => __( 'Fullscreen Login', 'pressapps' ),
    'menu_title'   => __( 'Fullscreen Login', 'pressapps' ),
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
    'title'       => __( 'Forms', 'pressapps' ),
    'icon'        => 'si-menu7',
        'sections' => array(
            array(
                'name'      => 'general_options',
                'title'     => __( 'General', 'pressapps' ),
                'icon'      => 'si-cog3',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => __( 'General', 'pressapps' ),
                        ),
                        array(
                            'id'      => 'form_logo',
                            'type'    => 'upload',
                            'title'   => __( 'Form Logo', 'pressapps' ),
                            'help'    => __( 'Upload a site logo for the forms.', 'pressapps' ),
                        ),
                        array(
                            'id'      => 'form_login_link_text',
                            'type'    => 'text',
                            'title'   => __( 'Login Form Link Text', 'pressapps' ),
                            'help'    => __( 'Login Form Link text field for links located under the forms', 'pressapps' ),
                            'default' => 'SIGN IN'
                        ),
                        array(
                            'id'      => 'form_register_link_text',
                            'type'    => 'text',
                            'title'   => __( 'Register Form Link Text', 'pressapps' ),
                            'help'    => __( 'Register Form Link text field for links located under the forms', 'pressapps' ),
                            'default' => 'CREATE AN ACCOUNT'
                        ),
                         array(
                            'id'      => 'form_forgot_link_text',
                            'type'    => 'text',
                            'title'   => __( 'Forgot Form Link Text', 'pressapps' ),
                            'help'    => __( 'Forgot Form Link text field for links located under the forms', 'pressapps' ),
                            'default' => 'I FORGOT MY PASSWORD'
                        ),
                ),
            ),
            array(
                'name'      => 'login_options',
                'title'     => __( 'Login', 'pressapps' ),
                'icon'      => 'si-user',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => __( 'Login', 'pressapps' ),
                        ),
                        array(
                            'id'      => 'login_form_title', 
                            'type'    => 'text',
                            'title'   => __( 'Title', 'pressapps' ),
                            'default' => 'WELCOME BACK',
                        ),
                        array(
                            'id'      => 'login_form_subtitle', 
                            'type'    => 'text',
                            'title'   => __( 'Subtitle', 'pressapps' ),
                            'default' => 'Already a member? Sign in with your username.',
                        ),
                        array(
                            'id'      => 'login_form_username_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Username Placeholder Text', 'pressapps' ),
                            'default' => 'Username',
                        ),
                        array(
                            'id'      => 'login_form_password_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Password Placeholder Text', 'pressapps' ),
                            'default' => 'Password',
                        ),
                        array(
                            'id'      => 'rememberme_visibility', 
                            'type'    => 'switcher',
                            'title'   => __( 'Remember Me', 'pressapps' ),
                            'default' => true,
                        ),
                        array(
                            'id'           => 'rememberme_placeholder_text', 
                            'type'         => 'text',
                            'title'        => __( 'Remember Me Placeholder Text', 'pressapps' ),
                            'default'      => 'Remember Me',
                            'dependency'   => array( 'pafl_rememberme_visibility', '==', 'true' ),
                        ),
                        array(
                            'id'      => 'login_button_text', 
                            'type'    => 'text',
                            'title'   => __( 'Login Button Text', 'pressapps' ),
                            'default' => 'SIGN IN',
                        ),
                ),
            ),
            array(
                'name'      => 'register_options',
                'title'     => __( 'Register', 'pressapps' ),
                'icon'      => 'si-pencil3',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => __( 'Register', 'pressapps' ),
                        ),

                        array(
                            'id'      => 'register_form_title', 
                            'type'    => 'text',
                            'title'   => __( 'Title', 'pressapps' ),
                            'default' => 'CREATE AN ACCOUNT',
                        ),
                        array(
                            'id'      => 'register_form_subtitle', 
                            'type'    => 'text',
                            'title'   => __( 'Subtitle', 'pressapps' ),
                            'default' => 'Password will be emailed to you',
                        ),
                        array(
                            'id'      => 'register_form_username_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Username Placeholder Text', 'pressapps' ),
                            'default' => 'Username',
                        ),
                        array(
                            'id'      => 'register_form_email_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Email Placeholder Text', 'pressapps' ),
                            'default' => 'Email',
                        ),
                        array(
                            'id'      => 'allow_user_set_password', 
                            'type'    => 'switcher',
                            'title'   => __( 'Allow User To Set Password', 'pressapps' ),
                            'default' => true,
                        ),
                        array(
                            'id'      => 'register_form_password_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Password Placeholder Text', 'pressapps' ),
                            'default' => 'Password',
                            'dependency'   => array( 'pafl_allow_user_set_password', '==', 'true' ),
                        ),
                        array(
                            'id'      => 'register_button_text', 
                            'type'    => 'text',
                            'title'   => __( 'Register Button Text', 'pressapps' ),
                            'default' => 'CREATE ACCOUNT',
                        ),

                ),
            ),
            array(
                'name'      => 'forgot_options',
                'title'     => __( 'Forgot', 'pressapps' ),
                'icon'      => 'si-question3',
                'fields'    => array(
                        array(
                            'type'    => 'heading',
                            'content' => __( 'Forgot', 'pressapps' ),
                        ),                      
                        array(
                            'id'      => 'forgot_form_title', 
                            'type'    => 'text',
                            'title'   => __( 'Title', 'pressapps' ),
                            'default' => 'FORGOT PASSWORD',
                        ),
                        array(
                            'id'      => 'forgot_form_subtitle', 
                            'type'    => 'text',
                            'title'   => __( 'Subtitle', 'pressapps' ),
                            'default' => 'Enter your username or email to reset your password.',
                        ),
                        array(
                            'id'      => 'forgot_form_username_placeholder_text', 
                            'type'    => 'text',
                            'title'   => __( 'Username/Email Placeholder Text', 'pressapps' ),
                            'default' => 'Username or Email',
                        ),
                        array(
                            'id'      => 'forgot_button_text', 
                            'type'    => 'text',
                            'title'   => __( 'Forgot Button Text', 'pressapps' ),
                            'default' => 'SEND RESET EMAIL',
                        ),
                ),
            ),
            array(
                'name'      => 'social_login',
                'title'     => __( 'Social Login', 'pressapps' ),
                'icon'      => 'si-share3',
                'fields'    => array(
                    array(
                        'type'    => 'heading',
                        'content' => __( 'Social Login', 'pressapps' ),
                    ),
                    array(
                        'id'      => 'facebook_login',
                        'type'    => 'switcher',
                        'title'   => __( 'Facebook', 'pressapps' ),
                        'default' => false,
                    ),
                    array(
                        'id'      => 'twitter_login',
                        'type'    => 'switcher',
                        'title'   => __( 'Twitter', 'pressapps' ),
                        'default' => false,
                    ),
                    array(
                        'id'      => 'google_login',
                        'type'    => 'switcher',
                        'title'   => __( 'Google', 'pressapps' ),
                        'default' => false,
                    ),
                    // Facebook Option
                    array(
                        'type'    => 'heading',
                        'content' => __( 'Facebook Login', 'pressapps' ),
                        'dependency' => array( 'pafl_facebook_login', '==', 'true' )
                    ),
                    array(
                        'id'      => 'facebook_login_id',
                        'type'    => 'text',
                        'title'   => __( 'App ID', 'pressapps' ),
                        'dependency' => array( 'pafl_facebook_login', '==', 'true' )
                    ),
                    array(
                        'id'      => 'facebook_login_secret',
                        'type'    => 'text',
                        'title'   => __( 'App Secret', 'pressapps' ),
                        'dependency' => array( 'pafl_facebook_login', '==', 'true' )
                    ),
                    array(
                        'id'      => 'facebook_login_text',
                        'type'    => 'text',
                        'title'   => __( 'Facebook Login Button Text', 'pressapps' ),
                        'dependency' => array( 'pafl_facebook_login', '==', 'true' ),
                        'default' => 'Sign in with Facebook'
                    ),
                    array(
                        'type' => 'notice',
                        'class' => 'info',
                        'content' => '
<h2>How to Generate <strong>App ID</strong> and <strong>App Secret</strong>?</h2>
<ol>
<li>Go to <a href="https://developers.facebook.com/" target="_blank">https://developers.facebook.com/</a> ( requires to sign in with facebook account ).</li>
<li>Click on <strong>My Apps</strong>, then under the dropdown select <strong>Add a New App</strong>.</li>
<li>A list of choice will popup through a modal after clicking <strong>Add a New App</strong>, select <strong>Website</strong>.</li>
<li>It will redirect you to <strong>Quick Start for Website</strong>, just type in the <strong>name</strong> for the new App and click <strong>Create New Facebook App ID</strong>.</li>
<li>It will prompt you with a message <strong>Create (name of the app) App?</strong>, select a <strong>Category</strong> then click <strong>Create App ID</strong>.</li>
<li>It will redirect you to a page named <strong>Setup the Facebook SDK for JavaScript</strong>.</li>
<li>Scroll down under <strong>Tell us about your website</strong> there is a text field which is <strong>Site URL</strong>, then type in the url of your website.</li>
<li>After it if you will scroll down you can see a <strong>Finished!</strong> text with a check icon, then your done.</li>
<li>Just <strong>refresh</strong> the page and you will be able to see under <strong>My Apps</strong> the new App that you created.</li>
<li>When you click on your new App you will be able to see <strong>App ID</strong> , <strong>API Version</strong>, <strong>App Secret</strong>.</li>
</ol>
'
                    ),
                    // Twitter Option
                    array(
                        'type'    => 'heading',
                        'content' => __( 'Twitter Login', 'pressapps' ),
                        'dependency' => array( 'pafl_twitter_login', '==', 'true' )
                    ),
                    array(
                        'id'      => 'twitter_login_id',
                        'type'    => 'text',
                        'title'   => __( 'Consumer Key (API Key)', 'pressapps' ),
                        'dependency' => array( 'pafl_twitter_login', '==', 'true' )
                    ),
                    array(
                        'id'      => 'twitter_login_secret',
                        'type'    => 'text',
                        'title'   => __( 'Consumer Secret (API Secret)', 'pressapps' ),
                        'dependency' => array( 'pafl_twitter_login', '==', 'true' )
                    ),
                    array(
                        'id'      => 'twitter_login_text',
                        'type'    => 'text',
                        'title'   => __( 'Twitter Login Button Text', 'pressapps' ),
                        'dependency' => array( 'pafl_twitter_login', '==', 'true' ),
                        'default'  => 'Sign in with Twitter'
                    ),
                    array(
                        'type' => 'notice',
                        'class' => 'info',
                        'content' => '
<h2>How to Generate <strong>Consumer Key (API Key)</strong> and <strong>Consumer Secret (API Secret)</strong>?</h2>
<h3>You must add your mobile phone to your Twitter profile before creating an application.</h3>
<ol>
<li>Go to <a href="https://apps.twitter.com/" target="_blank">https://apps.twitter.com/</a> ( requires to sign in with twitter account ).</li>
<li>Click on <strong>Create New App</strong> button, then fill up the <strong>Application Details</strong> just leave <strong>Callback URL</strong> blank.</li>
<li>You can access your new app, then go to <strong>Keys and Access Tokens</strong> tab.</li>
<li>Under <strong>Application Settings</strong> you can copy your <strong>Consumer Key (API Key)</strong> and <strong>Consumer Secret (API Secret)</strong>.</li>
</ol>
'
                    ),
                    // Google Option
                    array(
                        'type'    => 'heading',
                        'content' => __( 'Google Login', 'pressapps' ),
                        'dependency' => array( 'pafl_google_login', '==', 'true' )
                    ),
                    array(
                        'id'      => 'google_login_id',
                        'type'    => 'text',
                        'title'   => __( 'Client ID', 'pressapps' ),
                        'dependency' => array( 'pafl_google_login', '==', 'true' )
                    ),
                    array(
                        'id'      => 'google_login_secret',
                        'type'    => 'text',
                        'title'   => __( 'Client Secret', 'pressapps' ),
                        'dependency' => array( 'pafl_google_login', '==', 'true' )
                    ),
                    array(
                        'id'      => 'google_login_text',
                        'type'    => 'text',
                        'title'   => __( 'Google Login Button Text', 'pressapps' ),
                        'dependency' => array( 'pafl_google_login', '==', 'true' ),
                        'default'  => 'Sign in with Google'
                    ),
                    array(
                        'type' => 'notice',
                        'class' => 'info',
                        'content' => '
<h2>How to Generate <strong>Client ID</strong> and <strong>Client Secret</strong>?</h2>
<ol>
<li>Go to <a href="https://console.developers.google.com" target="_blank">https://console.developers.google.com</a>.</li>
<li>Click on <strong>Create a project</strong> under the dropdown.</li>
<li>In the Project name field, type in a name for your project then click on <strong>Create</strong> button.</li>
<li>In the sidebar under <strong>API Manager</strong>, select <strong>Credentials</strong>, and click the OAuth consent screen tab. Choose an Email Address, specify a Product Name, and click Save.</li>
<li>Click <strong>Create a new Client ID</strong>, a dialog box appears.</li>
<li>In the Application type section of the dialog, select <strong>Web application</strong>.</li>
<li>In the <strong>Authorized JavaScript origins</strong> field, enter the origin for your app. You can enter multiple origins to allow for your app to run on different protocols, domains, or subdomains. Wildcards are not allowed. ( URL of your website ).</li>
<li>In the <strong>Authorized redirect URI</strong> field, delete the default value and add <strong>' . plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'public/lib/hybridauth/?hauth.done=Google</strong> then click <strong>Save</strong>.</li>
</ol>
'
                    )
                )
            )
        )
);

/*
 * Redirect options tab and fields settings
 */
$options[]      = array(
    'name'        => 'redirect',
    'title'       => __( 'Redirect', 'pressapps' ),
    'icon'        => 'si-redo2',
    'fields'      => array(

        array(
            'id'      => 'redirect_allow_after_login_redirection_url', 
            'type'    => 'text',
            'title'   => __( 'Login Redirect URL', 'pressapps' ),
            'after'   => __( '<br> Enter full URL e.g. http://yoursitename.com/page', 'pressapps' ),
            'help'    => __( 'Set optional login redirect URL, if not set you will be redirected to current page', 'pressapps' ),
        ),

        array(
            'id'      => 'redirect_allow_after_logout_redirection_url', 
            'type'    => 'text',
            'title'   => __( 'Logout Redirect URL', 'pressapps' ),
            'after'   => __( '<br> Enter full URL e.g. http://yoursitename.com/page', 'pressapps' ),
            'help'    => __( 'Set optional logout redirect URL, if not set you will be redirected to home page', 'pressapps' ),
        ),

        array(
            'id'      => 'redirect_allow_after_registration_redirection_url', 
            'type'    => 'text',
            'title'   => __( 'Registration Redirect URL', 'pressapps' ),
            'after'   => __( '<br> Enter full URL e.g. http://yoursitename.com/page', 'pressapps' ),
            'help'    => __( 'Set optional registration redirect URL, if not set you will be redirected to the current page.', 'pressapps' ),
        ),
    )
);


/*
 * Email options tab and fields settings
 */
$options[]      = array(
    'name'             => 'email',
    'title'            => __( 'Email', 'pressapps' ),
    'icon'             => 'si-envelop2',
    'fields'           => array(

        array(
            'id'       => 'custom_email_template', 
            'type'     => 'switcher',
            'title'    => __( 'Custom Email Template', 'pressapps' ),
            'default'  => false,
        ),
       array(
            'id'       => 'custom_email_subject', 
            'type'     => 'text',
            'title'    => __( 'Subject', 'pressapps' ),
            'dependency'   => array( 'pafl_custom_email_template', '==', 'true' ),
                        
        ),
        array(
            'id'       => 'custom_email_body', 
            'type'     => 'wysiwyg',
            'title'    => __( 'Body', 'pressapps' ),
            'dependency'   => array( 'pafl_custom_email_template', '==', 'true' ),
            'after'     => __( 'Add custom registration email template with the following variables for use in subject or body: %username%, %password%, %loginlink%', 'pressapps' ),
                    
        ),
    )
);


/*
 * Captcha options tab and fields settings
 */
$options[]      = array(
    'name'        => 'captcha',
    'title'       => __( 'Captcha', 'pressapps' ),
    'icon'        => 'si-lock2',
    'fields'      => array(
        array(
            'id'      => 'recaptcha_public_key', 
            'type'    => 'text',
            'title'   => __( 'Site Key', 'pressapps' ),
            'default' => '',
        ),
        array(
            'id'      => 'recaptcha_private_key', 
            'type'    => 'text',
            'title'   => __( 'Secret Key', 'pressapps' ),
            'default' => '',
        ),
        array(
            'id'      => 'recaptcha_enable_on', 
            'type'    => 'checkbox',
            'title'   => __( 'Enable On', 'pressapps' ),
            'options' => array(
                'login'     => __( 'Login Form', 'pressapps' ),
                'register'  => __( 'Register Form', 'pressapps' ),
                'forgot'    => __( 'Forgot Form', 'pressapps' ),
            ),
        ),
        array(
            'id'      => 'recaptcha_theme', 
            'type'    => 'select',
            'title'   => __( 'Theme', 'pressapps' ),
            'options' => array(
                'light'     => __( 'Light', 'pressapps' ),
                'dark'      => __( 'Dark', 'pressapps' ),
            ),
        ),
    )
);

/*
 *  Styling options tab and fields settings
 */
$options[]      = array(
    'name'        => 'styling',
    'title'       => __( 'Styling', 'pressapps' ),
    'icon'        => 'si-brush',
    'fields'      => array(
        array(
            'id'      => 'modal_background', 
            'type'    => 'color_picker',
            'title'   => __( 'Background Color', 'pressapps' ),
            'default' => '#03a9f4',
        ),
        array(
            'id'      => 'text_color', 
            'type'    => 'color_picker',
            'title'   => __( 'Text Color', 'pressapps' ),
            'help'    => __( 'Change color for content color, applies to form title, subtitle, remember me label and links under forms', 'pressapps' ),
            'rgba'    => false,
            'default' => '#ffffff',
        ),
        array(
            'id'      => 'input_border_color',
            'type'    => 'color_picker',
            'title'   => __( 'Input Border Color', 'pressapps' ),
            'rgba'    => false
        ),
        array(
            'id'      => 'input_border_radius',
            'type'    => 'number',
            'title'   => __( 'Input Border Radius', 'pressapps' ),
            'after'   => ' <i class="sk-text-muted">(px)</i>',
            'default' => 1,
        ),
        array(
            'id'      => 'input_border_width',
            'type'    => 'number',
            'title'   => __( 'Input Border Width', 'pressapps' ),
            'after'   => ' <i class="sk-text-muted">(px)</i>',
            'default' => 0,
        ),
        array(
            'id'      => 'button_text_color', 
            'type'    => 'color_picker',
            'title'   => __( 'Button Text Color', 'pressapps' ),
            'rgba'    => false,
            'default' => '#ffffff',
        ),
        array(
            'id'      => 'button_background_color', 
            'type'    => 'color_picker',
            'title'   => __( 'Button Background Color', 'pressapps' ),
            'rgba'    => false,
            'default' => '#001017',
        ),
        array(
            'id'      => 'button_background_color_hover',
            'type'    => 'color_picker',
            'title'   => __( 'Button Background Color Hover', 'pressapps' ),
            'rgba'    => false,
            'default' => '#01579b',
        ),
        array(
            'id'      => 'modal_effect',
            'type'    => 'select',
            'title'   => __( 'Effect', 'pressapps' ),
            'options' => array(
                'hugeinc'       => __( 'Huge Inc', 'pressapps' ),
                'corner'        => __( 'Corner', 'pressapps' ),
                'slidedown'     => __( 'Slide Down', 'pressapps' ),
                'scale'         => __( 'Scale', 'pressapps' ),
                'door'          => __( 'Door', 'pressapps' ),
                'contentpush'   => __( 'Content Push', 'pressapps' ),
                'contentscale'  => __( 'Content Scale', 'pressapps' ),
                'simplegenie'   => __( 'Simple Genie', 'pressapps' ),
            ),
            'default'    => 'hugeinc',
        ),
        array(
            'id'      => 'custom_css', 
            'type'    => 'textarea',
            'title'   => __( 'Custom CSS', 'pressapps' ),
        ),
    ),
);

SkeletFramework::instance( $settings, $options );
