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
		$custom_css .= ".pafl-overlay li a, .pafl-overlay li, .pafl-overlay .pafl-social-links span.pafl-social-title{ color: ".$modal_text." !important}";
		wp_enqueue_style( 'pafl-'.$modal_class , plugin_dir_url( __FILE__ ) . 'css/effects/'.$modal_class.'.css', array(), $this->version, 'all' );
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

	    echo "<a href=''>".$text."</a>";
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
		    echo "<a href='javascript:;' title='pafl-trigger-overlay'>".$text."</a>";
		}else{
    		echo "<a href=''>".$text."</a>";
		}

	}