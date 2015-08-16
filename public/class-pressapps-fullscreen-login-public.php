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

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pressapps_Fullscreen_Login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pressapps_Fullscreen_Login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
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

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pressapps_Fullscreen_Login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pressapps_Fullscreen_Login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'modernizr-custom', 	plugin_dir_url( __FILE__ ) . 'js/modernizr.custom.js', 							array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'classie', 			plugin_dir_url( __FILE__ ) . 'js/classie.js', 									array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'snap-svg', 			plugin_dir_url( __FILE__ ) . 'js/snap.svg-min.js', 								array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name,  plugin_dir_url( __FILE__ ) . 'js/pressapps-fullscreen-login-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 *  Register all shortcodes
	 *
	 * @since  1.0.0
	 */
	public function register_shortcodes(){
		
		add_shortcode("pafl_login_text",	array($this,'add_login_shortcode'));
		add_shortcode("pafl_logout_text",	array($this,'add_logout_shortcode'));
		add_shortcode("pafl_register",		array($this,'add_register_shortcode'));
	
	}

	/**
	 * Add login link
	 * @param Array $atts    
	 * @param String $text 
	 */
	public function add_login_shortcode( $atts, $text){

	    echo "<a href='javascript:;'  data-form='login'  title='pafl-trigger-overlay'>".$text."</a>";
	}

	/**
	 * Add logout link
	 * @param Array $atts    
	 * @param String $text 
	 */
	public function add_logout_shortcode( $atts, $text){

	     echo "<a href='javascript:;'  data-form='logout'>".$text."</a>";

	}

	/**
	 * Add Register 
	 * @param Array $atts    
	 * @param String $content 
	 */
	public function add_register_shortcode( $atts, $content){

	
		$pafl_register_atts = shortcode_atts( array(
			'modal' => false,
			'text'	=> 'Register'
		), $atts, 'pafl_register' );

	    if( $pafl_register_atts['modal'] ){
		    echo "<a href='javascript:;' data-form='register' title='pafl-trigger-overlay'>".$pafl_register_atts['text']."</a>";
		}else{
    		echo "<a href=''>".$pafl_register_atts['text']."</a>";
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

		$custom_css .= ".pafl-overlay{ background: ".$modal_bckd." !important; }";
		$custom_css .= ".pafl-overlay *{ color: ".$modal_text." !important}";
		wp_add_inline_style( 'pafl-'.$modal_class , $custom_css );
	}

	/**
	 * Append modal html to footer in all pages
	 */
	public function append_to_footer(){
		
		$pafl_sk = new Skelet("pafl");
		$modal_class = $pafl_sk->get('modal_effect');

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
										<label class="forgetmenot-label" for="rememberme"><input name="rememberme" type="checkbox" placeholder="<?php echo $pafl_sk->get('rememberme_placeholder_text');?>" id="rememberme" value="forever" /> <?php _e( 'Remember Me', 'pressapps' ); ?></label>
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
											<label class="field-titles" for="reg_user"><?php _e( 'Username', 'pressapps' ); ?></label>
											<input type="text" name="user_login" id="reg_user" class="input" placeholder="<?php echo $pafl_sk->get('register_form_username_placeholder_text'); ?>" value="<?php if ( isset( $user_login ) ) echo esc_attr( stripslashes( $user_login ) ); ?>" size="20" />
										</p>

										<p class="mlemail">
											<label class="field-titles" for="reg_email"><?php _e( 'Email', 'pressapps' ); ?></label>
											<input type="text" name="user_email" id="reg_email" class="input" placeholder="<?php echo $pafl_sk->get('register_form_email_placeholder_text'); ?>" value="<?php if ( isset( $user_email ) ) echo esc_attr( stripslashes( $user_email ) ); ?>" size="20" />
										</p>
		                                <?php
		                                $allow_user_set_password = $pafl_sk->get('allow_user_set_password');
		                                if( $allow_user_set_password ){
		                                ?>
		                                <p class="mlregpsw">
											<label class="field-titles" for="reg_password"><?php _e( 'Password', 'pressapps' ); ?></label>
											<input type="password" name="reg_password" id="reg_password" class="input" placeholder="<?php echo $pafl_sk->get('register_form_password_placeholder_text'); ?>"  />
										</p>
		                               <?php 
		                                }
		                                ?>
		                                                                
										<?php do_action( 'pafl_register_form' ); ?>

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
}



	/**
	 * Add login link
	 * @param Array $atts    
	 * @param String $text 
	 */
	function pafl_login_text( $text ){

	    echo "<a href='#'  data-form='login' title='pafl-trigger-overlay'>".$text."</a>";
	}

	/**
	 * Add logout link
	 * @param Array $atts    
	 * @param String $text 
	 */
	function pafl_logout_text( $text ){

	     echo "<a href=''>".$text."</a>";

	}

	/**
	 * Add Register 
	 * @param Array $atts    
	 * @param String $content 
	 */
	function pafl_register( $text , $modal = false ){

		if( $modal ){
		    echo "<a href='javascript:;' data-form='register' title='pafl-trigger-overlay'>".$text."</a>";
		}else{
    		echo "<a href=''>".$text."</a>";
		}

	}