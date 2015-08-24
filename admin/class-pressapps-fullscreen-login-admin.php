<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://pressapps.co/
 * @since      1.0.0
 *
 * @package    Pressapps_Fullscreen_Login
 * @subpackage Pressapps_Fullscreen_Login/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pressapps_Fullscreen_Login
 * @subpackage Pressapps_Fullscreen_Login/admin
 * @author     PressApps Team <support@pressapps.co>
 */
class Pressapps_Fullscreen_Login_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pressapps-fullscreen-login-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pressapps-fullscreen-login-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register Modal link metabox
	 */
	public function register_wp_menu_links(){
		add_meta_box('metabox_modal_link', __('Fullscreen Login Link', 'pressapps' ), array( $this, 'callback_metabox_modal_link' ), 'nav-menus', 'side', 'high');
	}

	/**
	 * Add modal link
	 */
	public function callback_metabox_modal_link() {
		?>
		<div id="posttype-pafl-modal-link" class="posttypediv">
			<div id="tabs-panel-pafl-modal-link" class="tabs-panel tabs-panel-active">
				<ul id ="pafl-modal-link-checklist" class="categorychecklist form-no-clear">
					<li>
						<label class="menu-item-title">
						<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> <?php _e('Login', 'pressapps' ); ?> / <?php _e('Logout', 'pressapps' ); ?>
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="<?php _e('Login', 'pressapps' ); ?> // <?php _e('Logout', 'pressapps' ); ?>">
						<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="#pafl_modal_login">
						<input type="hidden" class="menu-item-attr-title" name="menu-item[-1][menu-item-attr-title]" value="pafl-trigger-overlay">
					</li>
					<li>
						<label class="menu-item-title">
						<input type="checkbox" class="menu-item-checkbox" name="menu-item[-2][menu-item-object-id]" value="-2"> <?php _e('Register', 'pressapps' ); ?>
						</label>
						<input type="hidden" class="menu-item-type" name="menu-item[-2][menu-item-type]" value="custom">
						<input type="hidden" class="menu-item-title" name="menu-item[-2][menu-item-title]" value="<?php _e('Register', 'pressapps' ); ?>">
						<input type="hidden" class="menu-item-url" name="menu-item[-2][menu-item-url]" value="#pafl_modal_register">
						<input type="hidden" class="menu-item-attr-title" name="menu-item[-2][menu-item-attr-title]" value="pafl-trigger-overlay">
					</li>
				</ul>
			</div>
			<p class="button-controls">
				<span class="add-to-menu">
					<input type="submit" class="button-secondary submit-add-to-menu right" value="<?php _e( 'Add to Menu' ); ?>" name="add-post-type-menu-item" id="submit-posttype-pafl-modal-link">
					<span class="spinner"></span>
				</span>
			</p>
		</div>
		<?php
	}


}
