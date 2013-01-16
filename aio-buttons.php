<?php
/*
Plugin Name: All in One Buttons
Plugin URI: http://www.wpgoods.com/products/all-in-one-buttons/
Description: Quickly create amazing CSS3 buttons from the WordPress visual editor.
Version: 1.0
Author: Brandon Bell
Author URI: http://www.wpgoods.com
Author Email: contact@wpgoods.com
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

//global scope constants
define( 'aiobtn_path', plugin_dir_path(__FILE__) );
//declare global variables
$AIO_Buttons_Path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
$AIO_Buttons_Data = get_option('aiobtn_options');
$AIO_Buttons_Slug = basename(dirname(__FILE__));
$AIO_Buttons_Class = array('dialog','shortcode');
//require the admin files
require_once( aiobtn_path . 'admin/class.php' );
require_once( aiobtn_path . 'admin/options.php' );
//require the dialog and shortcode classes
foreach($AIO_Buttons_Class as $class) {
	require_once( aiobtn_path . 'inc/'.$class.'/class.php' );
}

class AIOButtons {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'All In One Buttons';
	const slug = 'aiobtn';
	
	/**
	 * Constructor
	 */
	function __construct() {
		//register an activation hook for the plugin
		register_activation_hook( __FILE__, array( &$this, 'install' ) );

		//Hook up to the init action
		add_action( 'init', array( &$this, 'init' ) );
	}
  
	/**
	 * Runs when the plugin is activated
	 */
	public function install() {
		//save default shortcodes
		if (!get_option('aiobtn_options')) {
			$default = array(
				'shortcode_name' => 'aio_button',
				'default_animation' => 'none',
				'default_color' => 'red',
				'default_size' => 'small',
				'default_text' => 'Download Now'
			);
			update_option('aiobtn_options',$default);
		}
	}
  
	/**
	 * Runs when the plugin is initialized
	 */
	public function init() {
		global $AIO_Buttons_Data;
	
		// Setup localization
		load_plugin_textdomain( 'aiobtn', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
		// Load JavaScript and Stylesheets
		$this->register_scripts_and_styles();
		// Add TinyMCE button
		$this->add_button();
		
		// Add action links in Plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( &$this, 'action_links' ) );
		// Add meta links in Plugins page
		add_filter( 'plugin_row_meta', array( &$this, 'meta_links' ), 10, 2 );
		
		// Create new Dialog instance
		$dialog = new aiobtnDialog();
		//for all users
		add_action('wp_ajax_nopriv_ajax_aiobtn_dialog', array( &$dialog, 'ajax_aiobtn_dialog' ));
		add_action('wp_ajax_nopriv_ajax_aiobtn_nonce', array( &$dialog, 'ajax_aiobtn_nonce' ));
		// for logged in users
		add_action('wp_ajax_ajax_aiobtn_dialog', array( &$dialog, 'ajax_aiobtn_dialog' ));
		add_action('wp_ajax_ajax_aiobtn_nonce', array( &$dialog, 'ajax_aiobtn_nonce' ));
		
		// Register the WordPress shortcode
		$shortcode = new aiobtnShortcode();
		if (is_array($AIO_Buttons_Data) && array_key_exists('shortcode_name',$AIO_Buttons_Data)) {
			add_shortcode($AIO_Buttons_Data['shortcode_name'], array( &$shortcode, 'shortcode'));
		} else {
			add_shortcode('aio_button', array( &$shortcode, 'shortcode'));
		}
	}
	
	// Add action links in Plugins page
	public function action_links( $links ) {
		return array_merge(
			array(
				'settings' => '<a href="' . admin_url('admin.php?page=aiobtn') . '">' . __( 'Settings', 'aiobtn' ) . '</a>'
			),
			$links
		);
	}
	
	// Add meta links in Plugins page
	public function meta_links( $links, $file ) {
		$plugin = plugin_basename(__FILE__);
		// create link
		if ( $file == $plugin ) {
			return array_merge(
				$links,
				array( '<a href="http://twitter.com/wpgoods">'.__('Twitter', 'aiobtn').'</a>' )
			);
		}
		return $links;
	}
	
	// Add All In One Buttons button to TinyMCE
	public function add_button() {
		global $pagenow;
		
		// Don't bother doing this stuff if the current user lacks permissions
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
		
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true' && ( in_array( $pagenow, array( 'post.php', 'post-new.php', 'page-new.php', 'page.php' ) ) ) ) {
			add_filter( 'mce_external_plugins', array( &$this, 'add_tinymce_plugin' ) );
			add_filter( 'mce_buttons', array( &$this, 'register_button' ) );
		}
	}

	// Load the TinyMCE plugin: editor_plugin.js
	public function add_tinymce_plugin($plugin_array) {
		// This plugin file will work the magic of our button
		global $AIO_Buttons_Path;
		$plugin_array["aio_buttons"] = $AIO_Buttons_Path . 'inc/plugin/editor_plugin.js';
		return $plugin_array;
	}
        
	// Register the button
	public function register_button($buttons) {
		// Add a separation before our button, here our button's id is aio_buttons
	   array_push($buttons, "|", "aio_buttons");
	   return $buttons;
	}
  
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {	
		if ( is_admin() ) {
			if (isset($_GET['page']) && $_GET['page'] == 'aiobtn') {
				$this->load_file( self::slug . '-admin-script', '/js/admin.min.js', true );
			}
		} else {
			$this->load_file( self::slug . '-style', '/css/display.css' );
		} // end if/else
	} // end register_scripts_and_styles
	
	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {

		$url = plugins_url($file_path, __FILE__);
		$file = plugin_dir_path(__FILE__) . $file_path;

		if( file_exists( $file ) ) {
			if( $is_script ) {
				wp_register_script( $name, $url, array('jquery') ); //depends on jquery
				wp_enqueue_script( $name );
			} else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
			} // end if
		} // end if

	} // end load_file
  
} // end class
new AIOButtons();
?>