<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://pressapps.co/
 * @since      1.0.0
 *
 * @package    Pressapps_Fullscreen_Login
 * @subpackage Pressapps_Fullscreen_Login/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pressapps_Fullscreen_Login
 * @subpackage Pressapps_Fullscreen_Login/public
 * @author     PressApps Team <support@pressapps.co>
 */
class Pressapps_Fullscreen_Login_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		$pafl_sk = new Skelet("pafl");
		$modal_class = $pafl_sk->get('modal_effect');

		wp_enqueue_style( 'pafl-'.$modal_class , plugin_dir_url( __FILE__ ) . 'css/effects/'.$modal_class.'.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pressapps-fullscreen-login-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name,  plugin_dir_url( __FILE__ ) . 'js/pressapps-fullscreen-login-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 *  Register all shortcodes
	 *
	 * @since  1.0.0
	 */
	public function register_shortcodes(){
		
		add_shortcode("pafl_link",	array($this,'add_link_shortcode'));
	
	}

	/**
	 * Add login/logout & register link
	 * @param Array $atts    
	 * @param String $text 
	 */
	public function add_link_shortcode( $atts ){
		$atts = shortcode_atts(
			array(
				'login_text' 	=> 'Login',
				'logout_text' 	=> 'Logout',
				'register'		=> false,
				'register_text' => 'Create an Accout'
			), $atts, 'pafl_link' 
		);

		if( $atts['register'] && ! is_user_logged_in() ){
			    echo "<a href='javascript:;'  data-form='register'  title='pafl-trigger-overlay'>".$atts['register_text']."</a>";
		}else{
			if( is_user_logged_in() ){
			    echo "<a href='".wp_logout_url()."' >".$atts['logout_text']."</a>";
			}else{
			    echo "<a href='javascript:;'  data-form='login'  title='pafl-trigger-overlay'>".$atts['login_text']."</a>";
			}
		}
	}



	/**
	 * Add modal inline styles in header
	 * @return [type] [description]
	 */
	public function modal_styles(){


		 $pafl_sk = new Skelet("pafl");
		 $custom_css = "";
		 $custom_css .= $pafl_sk->get('modal_form_custom_css');
		 $modal_class = $pafl_sk->get('modal_effect');
		 $modal_bckd = $pafl_sk->get('form_modal_background');
		 $modal_text = $pafl_sk->get('text_color');
		 $modal_form_border_color = $pafl_sk->get('modal_form_border_color');
		 $modal_form_border_thickness = $pafl_sk->get('modal_form_border_thickness');
		 $modal_form_button_text_color = $pafl_sk->get('modal_form_button_text_color');
		 $modal_form_button_background_color = $pafl_sk->get('modal_form_button_background_color');

		if( ! empty( $modal_bckd ) ){
			$custom_css .= ".pafl-overlay{ background: ".$modal_bckd." !important; }";
		}
		if( ! empty( $modal_text ) ){
			$custom_css .= ".pafl-overlay *:not(input){ color: ".$modal_text." !important}";
		}

		if( ! empty( $modal_form_border_color ) ){
			$custom_css .= ".pafl-modal-content{  border-color: ".$modal_form_border_color." !important }";
		}

		if( ! empty( $modal_form_border_thickness ) ){
				$custom_css .= ".pafl-modal-content{ border: ".$modal_form_border_thickness."px solid !important }";
		}

		if( ! empty( $modal_form_button_background_color ) ){
				$custom_css .= ".pafl-modal-content input[type=submit]{ background: ".$modal_form_button_background_color."; }";
		}

		if( ! empty( $modal_form_button_text_color ) ){
				$custom_css .= ".pafl-modal-content input[type=submit]{ color: ".$modal_form_button_text_color."; }";
		}

		wp_add_inline_style( 'pafl-'.$modal_class , $custom_css );


	}
	/**
	 * Add inline header scripts
	 */
	public function add_inline_script(){
		$pafl_sk = new Skelet("pafl");
		$modal_class = $pafl_sk->get('modal_effect');
		
		// Only run our ajax stuff when the user isn't logged in.
		if ( ! is_user_logged_in() ) {
			echo "<script type='text/javascript'>\n";
			echo 'var pafl_modal_login_script = '.json_encode( 
				array(
					'ajax' 		     => admin_url( 'admin-ajax.php' ),
					'redirecturl' 	 => '',
					'loadingmessage' => __( 'Checking Credentials...', 'pressapps' ),
				)
			);
			echo ";";
			echo "\n";
			echo "</script>\n";

		}
	}
	/**
	 * Append modal html to footer in all pages
	 */
	public function append_to_footer(){
					  $pafl_sk = new Skelet("pafl");
				  $modal_class = $pafl_sk->get('modal_effect');
		 $recaptcha_public_key = $pafl_sk->get('recaptcha_public_key');
		$recaptcha_private_key = $pafl_sk->get('recaptcha_private_key');

		include_once plugin_dir_path( dirname( __FILE__ ) )."public/lib/recaptcha/Captcha.php";
		$captcha = new Captcha\Captcha();
		$captcha->setPublicKey( $recaptcha_public_key );
		$captcha->setPrivateKey(  $recaptcha_public_key );

/*		if (!isset($_SERVER['REMOTE_ADDR'])) {
		    $captcha->setRemoteIp('192.168.1.1');
		}
*/
		
		echo "<div class=\"pafl-overlay pafl-overlay-".$modal_class."\">\n";
			echo "<button type=\"button\" class=\"pafl-overlay-close\">Close</button>\n";
			echo "<nav>\n";
				echo "<ul>\n";
				echo "<li>\n";
				// Form Logo
				$form_logo = $pafl_sk->get('form_logo');
				if( ! empty( $form_logo ) ){
					echo "<img src='".$form_logo."'/>";
				}
				
				?>
				<?php do_action( 'pafl_before_modal_title' ); ?>

				<?php if( ! is_user_logged_in() ) { ?>
					<div class="section-container">

						<?php // Login Form ?>
							<div id="login" class="modal-login-content pafl-modal-content">

								<h2><?php echo $pafl_sk->get('login_form_title'); ?></h2>
								<p class="pafl-subtitle"><?php echo $pafl_sk->get('login_form_subtitle'); ?></p>

								<?php do_action( 'pafl_before_modal_login' ); ?>

								<form action="login" method="post" id="form" class="group" name="loginform">

									<?php do_action( 'pafl_inside_modal_login_first' ); ?>

									<p class="mluser">
										<!-- <label class="field-titles" for="login_user"><?php _e( 'Username', 'pressapps' ); ?></label>
										 -->
										 <input type="text" name="log" id="login_user" class="input" placeholder="<?php echo $pafl_sk->get('login_form_username_placeholder_text');?>" value="<?php if ( isset( $user_login ) ) echo esc_attr( $user_login ); ?>" size="20" />
									</p>

									<p class="mlpsw">
										<!-- <label class="field-titles" for="login_pass"><?php _e( 'Password', 'pressapps' ); ?></label>
										 -->
										 <input type="password" name="pwd" id="login_pass" class="input" placeholder="<?php echo $pafl_sk->get('login_form_password_placeholder_text');?>" value="" size="20" />
									</p>

									<?php do_action( 'pafl_login_form' ); ?>
									<?php $show_rememberme = $pafl_sk->get('rememberme_visibility'); ?>
									<?php if( $show_rememberme ){ ?>
									<p id="forgetmenot">
										<label class="forgetmenot-label" for="rememberme"><input name="rememberme" type="checkbox" placeholder="<?php echo $pafl_sk->get('rememberme_placeholder_text');?>" id="rememberme" value="forever" /> <?php echo $pafl_sk->get('rememberme_placeholder_text');?></label>
									</p>
									<?php } ?>
									
									<?php if( in_array('login', $pafl_sk->get('recaptcha_enable_on') ) ){ ?>
									<p class="recaptcha">
										 <?php echo $captcha->html(); ?>
									</p>
									<?php } ?>
									
									<p class="submit">
									   <?php do_action( 'pafl_inside_modal_login_submit' ); ?>

										<input type="submit" name="wp-sumbit" id="wp-submit" class="button button-primary button-large" value="<?php echo $pafl_sk->get('login_button_text');?>" />
										<input type="hidden" name="login" value="true" />
										<?php wp_nonce_field( 'ajax-form-nonce', 'security' ); ?>

									</p><!--[END .submit]-->

									<p class="form-links">
									<?php $label_forgot   = $pafl_sk->get('form_forgot_link_text'); ?>
									<?php if( empty( $label_forgot ) ){
										$label_forgot = __("Forgot password?",'pressapps');
									}	
									?>
									<?php $label_register = $pafl_sk->get('form_register_link_text'); ?>
									<?php if( empty( $label_register ) ){
										$label_register = __("Register",'pressapps');
									}	
									?>
										<a href="#" data-form="forgot" class='forgot-password'><?php echo $label_forgot;	?></a>
										<a href="#" data-form="register" class='create-account'> <?php echo $label_register;	?></a>
									</p><!--[END .form-links]-->
									
									<?php do_action( 'pafl_inside_modal_login_last' ); ?>

								</form><!--[END #loginform]-->
							</div><!--[END #login]-->
						<?php // Registration form ?>
							<?php if ( ( get_option( 'users_can_register' ) && ! is_multisite() ) || ( $multisite_reg == 'all' || $multisite_reg == 'blog' || $multisite_reg == 'user' ) ) : ?>
								<div id="register" class="modal-login-content pafl-modal-content" style="display:none;">

									<h2><?php echo $pafl_sk->get('register_form_title'); ?></h2>
									<p class="pafl-register-form-subtitle"><?php echo $pafl_sk->get('register_form_subtitle'); ?></p>

									<?php do_action( 'pafl_before_modal_register' ); ?>

									<form action="register" method="post" id="form" class="group" name="loginform">

										<?php do_action( 'pafl_inside_modal_register_first' ); ?>

										<p class="mluser">
											<input type="text" name="user_login" id="reg_user" class="input" placeholder="<?php echo $pafl_sk->get('register_form_username_placeholder_text'); ?>" value="<?php if ( isset( $user_login ) ) echo esc_attr( stripslashes( $user_login ) ); ?>" size="20" />
										</p>

										<p class="mlemail">
											<input type="text" name="user_email" id="reg_email" class="input" placeholder="<?php echo $pafl_sk->get('register_form_email_placeholder_text'); ?>" value="<?php if ( isset( $user_email ) ) echo esc_attr( stripslashes( $user_email ) ); ?>" size="20" />
										</p>
		                                <?php
		                                $allow_user_set_password = $pafl_sk->get('allow_user_set_password');
		                                if( $allow_user_set_password ){
		                                ?>
		                                <p class="mlregpsw">
											<input type="password" name="reg_password" id="reg_password" class="input" placeholder="<?php echo $pafl_sk->get('register_form_password_placeholder_text'); ?>"  />
										</p>
		                               <?php 
		                                }
		                                ?>
		                                                                
										<?php do_action( 'pafl_register_form' ); ?>
										<?php if( in_array('register', $pafl_sk->get('recaptcha_enable_on') ) ){ ?>
										<p class="recaptcha">
											 <?php echo $captcha->html(); ?>
										</p>
										<?php } ?>
										<p class="submit">

											<?php do_action( 'pafl_inside_modal_register_submit' ); ?>

											<input type="submit" name="user-sumbit" id="user-submit" class="button button-primary button-large" value="<?php echo $pafl_sk->get('register_button_text'); ?>" />
											<input type="hidden" name="register" value="true" />
											<?php wp_nonce_field( 'ajax-form-nonce', 'security' ); ?>

										</p><!--[END .submit]-->

										<p class="form-links">
										<?php $label_login   = $pafl_sk->get('form_login_link_text'); ?>
										<?php if( empty( $label_login ) ){
											$label_login = __("Login",'pressapps');
										}	
										?>
										<?php $label_forgot = $pafl_sk->get('form_forgot_link_text'); ?>
										<?php if( empty( $label_forgot ) ){
											$label_forgot = __("Forgot password?",'pressapps');
										}	
										?>
											<a href="#" data-form="login" class='btn-login'>	<?php echo $label_login;	?></a>
											<a href="#" data-form="forgot" class='forgot-password'>		<?php echo $label_forgot;	?></a>
										</p><!--[END .form-links]-->
										
										<?php do_action( 'pafl_inside_modal_register_last' ); ?>

									</form>
								</div><!--[END #register]-->
							<?php endif; ?>
						<?php // Forgotten Password ?>
							<div id="forgotten" class="modal-login-content pafl-modal-content" style="display:none;">

								<h2><?php echo $pafl_sk->get('forgot_form_title'); ?></h2>
								<p class="pafl-forgot-form-subtitle"><?php echo $pafl_sk->get('forgot_form_subtitle'); ?></p>


								<?php do_action( 'pafl_before_modal_forgotten' ); ?>

								<form action="forgotten" method="post" id="form" class="group" name="loginform">

									<?php do_action( 'pafl_inside_modal_forgotton_first' ); ?>

									<p class="mlforgt">
										<input type="text" name="forgot_login" id="forgot_login" class="input" placeholder="<?php echo $pafl_sk->get('forgot_form_username_placeholder_text'); ?>" value="<?php if ( isset( $user_login ) ) echo esc_attr( stripslashes( $user_login ) ); ?>" size="20" />
									</p>

									<?php do_action( 'pafl_login_form', 'resetpass' ); ?>
									<?php if( in_array('forgot', $pafl_sk->get('recaptcha_enable_on') ) ){ ?>
										<p class="recaptcha">
											 <?php echo $captcha->html(); ?>
										</p>
									<?php } ?>
									<p class="submit">

										<?php do_action( 'pafl_inside_modal_forgotten_submit' ); ?>

										<input type="submit" name="user-submit" id="user-submit" class="button button-primary button-large" value="<?php echo $pafl_sk->get('forgot_button_text'); ?>">
										<input type="hidden" name="forgotten" value="true" />
										<?php wp_nonce_field( 'ajax-form-nonce', 'security' ); ?>

									</p>

									<p class="form-links">
										<?php $label_login   = $pafl_sk->get('form_login_link_text'); ?>
										<?php if( empty( $label_login ) ){
											$label_login = __("Login",'pressapps');
										}	
										?>
											<a href="#" data-form="login" class='btn-login'>	<?php echo $label_login;	?></a>
										</p><!--[END .form-links]-->
										
									<?php do_action( 'pafl_inside_modal_forgotten_last' ); ?>

								</form>
							</div><!--[END #forgotten]-->
	
					<?php }else{ ?>
					<div id="already-logged-in" class="modal-login-content">
						<?php echo __("You're already logged in.","pressapps"); ?>
					</div>
					<?php } ?>
	
					</div><!--[END .section-container]-->
				
				<?php do_action( 'pafl_after_modal_form' ); ?>

				<?php
				echo "</li>\n";	
				echo "</ul>\n";
			echo "</nav>\n";
		echo "</div>\n";
	}	
    
    /**
	 * The main Ajax function
	 * @return Json 
	 */
	public function ajax_login() {
		global $paml_options;
		// Check our nonce and make sure it's correct.
                if(is_user_logged_in()){
                    echo json_encode( array(
                            'loggedin' => false,
                            'message'  => __( 'You are already logged in', 'pressapps' ),
                    ) );
                    die();
                }
		check_ajax_referer( 'ajax-form-nonce', 'security' );

		// Get our form data.
		$data = array();

		// Check that we are submitting the login form
		if ( isset( $_REQUEST['login'] ) )  {
                        
			$data['user_login']         = sanitize_user( $_REQUEST['username'] );
			$data['user_password']      = sanitize_text_field( $_REQUEST['password'] );
			$data['remember']           = (sanitize_text_field( $_REQUEST['rememberme'] )=='TRUE')?TRUE:FALSE;
			$user_login                 = wp_signon( $data, is_ssl() );

			// Check the results of our login and provide the needed feedback
			if ( is_wp_error( $user_login ) ) {
				echo json_encode( array(
					'loggedin' => false,
					'message'  => __( 'Wrong Username or Password!', 'pressapps' ),
				) );
			} else {
				echo json_encode( array(
					'loggedin' => true,
					'message'  => __( 'Login Successful!', 'pressapps' ),
				) );
			}
		}

		// Check if we are submitting the register form
		elseif ( isset( $_REQUEST['register'] ) ) {
			$user_data = array(
				'user_login' => sanitize_user( $_REQUEST['username'] ),
				'user_email' => sanitize_email( $_REQUEST['email'] ),
			);
			$user_register = $this->register_new_user( $user_data['user_login'], $user_data['user_email'] );

			// Check if there were any issues with creating the new user
			if ( is_wp_error( $user_register ) ) {
				echo json_encode( array(
					'registerd' => false,
					'message'   => $user_register->get_error_message(),
				) );
			} else {
                if( $allow_user_set_password ){
                    $success_message = __( 'Registration complete.', 'pressapps' );
                }else{
                    $success_message = __( 'Registration complete. Check your email.', 'pressapps' );
                }
				echo json_encode( array(
					'registerd'     => true,
                                        'redirect'      => ( $allow_user_set_password ?TRUE:FALSE),
					'message'	=> $success_message,
				) );
			}
		}

		// Check if we are submitting the forgotten pwd form
		elseif ( isset( $_REQUEST['forgotten'] ) ) {

			// Check if we are sending an email or username and sanitize it appropriately
			if ( is_email( $_REQUEST['username'] ) ) {
				$username = sanitize_email( $_REQUEST['username'] );
			} else {
				$username = sanitize_user( $_REQUEST['username'] );
			}

			// Send our information
			$user_forgotten = $this->retrieve_password( $username );

			// Check if there were any errors when requesting a new password
			if ( is_wp_error( $user_forgotten ) ) {
				echo json_encode( array(
					'reset' 	 => false,
					'message' => $user_forgotten->get_error_message(),
				) );
			} else {
				echo json_encode( array(
					'reset'   => true,
					'message' => __( 'Password Reset. Please check your email.', 'pressapps' ),
				) );
			}
		}

		die();
	}
	
	/**
	 * Sanitize user entered information
	 * @param  String $user_login 
	 * @param  String $user_email 
	 */
	public function register_new_user( $user_login, $user_email ) {
		

		$sk = new Skelet("pafl");

		$errors = new WP_Error();
		$sanitized_user_login = sanitize_user( $user_login );
		$user_email = apply_filters( 'user_registration_email', $user_email );

		// Check the username was sanitized
		if ( $sanitized_user_login == '' ) {
			$errors->add( 'empty_username', __( 'Please enter a username.', 'pressapps' ) );
		} elseif ( ! validate_username( $user_login ) ) {
			$errors->add( 'invalid_username', __( 'This username is invalid because it uses illegal characters. Please enter a valid username.', 'pressapps' ) );
			$sanitized_user_login = '';
		} elseif ( username_exists( $sanitized_user_login ) ) {
			$errors->add( 'username_exists', __( 'This username is already registered. Please choose another one.', 'pressapps' ) );
		}

		// Check the email address
		if ( $user_email == '' ) {
			$errors->add( 'empty_email', __( 'Please type your email address.', 'pressapps' ) );
		} elseif ( ! is_email( $user_email ) ) {
			$errors->add( 'invalid_email', __( 'The email address isn\'t correct.', 'pressapps' ) );
			$user_email = '';
		} elseif ( email_exists( $user_email ) ) {
			$errors->add( 'email_exists', __( 'This email is already registered, please choose another one.', 'pressapps' ) );
		}
        /**
         * password Validation if the User Defined Password Is Allowed
         */
        $allow_user_set_password = $sk->get('allow_user_set_password');

        if( $allow_user_set_password ){
            if(empty($_REQUEST['password'])){
                $errors->add( 'empty_password', __( 'Please type your password.', 'pressapps' ) );
            }elseif (strlen($_REQUEST['password'])<6) {
                $errors->add( 'minlength_password', __( 'Password must be 6 character long.', 'pressapps' ) );
            }
        }
                
		$errors = apply_filters( 'registration_errors', $errors, $sanitized_user_login, $user_email );

		if ( $errors->get_error_code() )
			return $errors;
                $user_pass = ( $allow_user_set_password )?$_REQUEST['password']:wp_generate_password( 12, false );
		$user_id = wp_create_user( $sanitized_user_login, $user_pass, $user_email );

		if ( ! $user_id ) {
			$errors->add( 'registerfail', __( 'Couldn\'t register you... please contact the site administrator', 'pressapps' ) );

			return $errors;
		}

		update_user_option( $user_id, 'default_password_nag', true, true ); // Set up the Password change nag.
                
                if( $allow_user_set_password ){
                    $data['user_login']             = $user_login;
                    $data['user_password']          = $user_pass;
                    $user_login                     = wp_signon( $data, false );
                }
                
                $user = get_userdata( $user_id );
                // The blogname option is escaped with esc_html on the way into the database in sanitize_option
                // we want to reverse this for the plain text arena of emails.
                $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

                $message  = sprintf(__('New user registration on your site %s:', 'pressapps'), $blogname) . "\r\n\r\n";
                $message .= sprintf(__('Username: %s', 'pressapps'), $user->user_login) . "\r\n\r\n";
                $message .= sprintf(__('Email: %s', 'pressapps'), $user->user_email) . "\r\n";

                @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration', 'pressapps'), $blogname), $message);

                if ( empty($user_pass) )
                        return;

                $message  = sprintf(__('Username: %s', 'pressapps'), $user->user_login) . "\r\n";
                $message .= sprintf(__('Password: %s', 'pressapps'), $user_pass) . "\r\n";
                $message .= wp_login_url() . "\r\n";

                
                
                $email_detail   = array(
                    'subject'   => sprintf(__('[%s] Your username and password', 'pressapps'), $blogname),
                    'body'      => $message,
                );
                
                
                $pattern        = array('#\%username\%#','#\%password\%#','#\%loginlink\%#');
                $replacement    = array($user->user_login,$user_pass,wp_login_url());
                $subject        = trim( $sk->get('custom_email_subject') );
                $body           = trim( $sk->get('custom_email_body') );
                $enable_custom_template = $sk->get('custom_email_template');

                if( $enable_custom_template ){
	                if( ! empty( $subject ) ){
	                    $email_detail['subject'] = @preg_replace($pattern,$replacement, $subject);
	                }
	                
	                if( ! empty( $body ) ){
	                    $email_detail['body']    = @html_entity_decode(@preg_replace($pattern,$replacement, $body));
	                }
	                
	                $headers = array('Content-Type: text/html; charset=UTF-8');
	             }
                @wp_mail($user->user_email,$email_detail['subject'] , $email_detail['body'], $headers);
                
                //@todo
		//wp_new_user_notification( $user_id, $user_pass );

		return $user_id;
	}


	/**
	 * Setup password retrieve function
	 * @param  Array $user_data 
	 */
	public function  retrieve_password( $user_data ) {
		global $wpdb, $current_site;

		$errors = new WP_Error();

		if ( empty( $user_data ) ) {
			$errors->add( 'empty_username', __( 'Please enter a username or e-mail address.', 'pressapps' ) );
		} else if ( strpos( $user_data, '@' ) ) {
			$user_data = get_user_by( 'email', trim( $user_data ) );
			if ( empty( $user_data ) )
				$errors->add( 'invalid_email', __( 'There is no user registered with that email address.', 'pressapps'  ) );
		} else {
			$login = trim( $user_data );
			$user_data = get_user_by( 'login', $login );
		}

		do_action( 'lostpassword_post' );

		if ( $errors->get_error_code() )
			return $errors;

		if ( ! $user_data ) {
			$errors->add( 'invalidcombo', __( 'Invalid username or e-mail.', 'pressapps' ) );
			return $errors;
		}

		// redefining user_login ensures we return the right case in the email
		$user_login = $user_data->user_login;
		$user_email = $user_data->user_email;

		do_action( 'retreive_password', $user_login );  // Misspelled and deprecated
		do_action( 'retrieve_password', $user_login );

		$allow = apply_filters( 'allow_password_reset', true, $user_data->ID );

		if ( ! $allow )
			return new WP_Error( 'no_password_reset', __( 'Password reset is not allowed for this user', 'pressapps' ) );
		else if ( is_wp_error( $allow ) )
			return $allow;

        $key = wp_generate_password( 20, false );
        
        do_action( 'retrieve_password_key', $user_login, $key );
        
        require_once ABSPATH . 'wp-includes/class-phpass.php';
        $wp_hasher = new PasswordHash( 8, true );
        
        $hashed = $wp_hasher->HashPassword( $key );
        
        // Now insert the new md5 key into the db
        $wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user_login ) );
     
     	$message = __( 'Someone requested that the password be reset for the following account:', 'pressapps' ) . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf( __( 'Username: %s', 'pressapps' ), $user_login ) . "\r\n\r\n";
		$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.', 'pressapps' ) . "\r\n\r\n";
		$message .= __( 'To reset your password, visit the following address:', 'pressapps' ) . "\r\n\r\n";
		$message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";

		if ( is_multisite() ) {
			$blogname = $GLOBALS['current_site']->site_name;
		} else {
			// The blogname option is escaped with esc_html on the way into the database in sanitize_option
			// we want to reverse this for the plain text arena of emails.
			$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		}

		$title   = sprintf( __( '[%s] Password Reset', 'pressapps' ), $blogname );
		$title   = apply_filters( 'retrieve_password_title', $title );
		$message = apply_filters( 'retrieve_password_message', $message, $key );

		if ( $message && ! wp_mail( $user_email, $title, $message ) ) {
			$errors->add( 'noemail', __( 'The e-mail could not be sent. Possible reason: your host may have disabled the mail() function.', 'pressapps' ) );

			return $errors;

			wp_die();
		}

		return true;
	}

}

