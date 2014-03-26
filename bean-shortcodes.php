<?php
/**
 * Plugin Name: Bean Shortcodes
 * Plugin URI: http://themebeans.com/plugin/bean-shortcodes-plugin
 * Description: Enables shortcodes to be used in Bean WordPress Themes
 * Version: 2.1
 * Author: Rich Tabor / ThemeBeans
 * Author URI: http://themebeans.com
 *
 *
 * @package Bean Plugins
 * @subpackage BeanShortcodes
 * @author ThemeBeans
 * @since BeanShortcodes 1.0
 */


/*===================================================================*/
/* MAKE SURE WE DO NOT EXPOSE ANY INFO IF CALLED DIRECTLY
/*===================================================================*/
if ( !function_exists( 'add_action' ) ) 
{
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}




/*===================================================================*/
/*
/* PLUGIN UPDATER FUNCTIONALITY
/*
/*===================================================================*/
define( 'EDD_BEANSHORTCODES_TB_URL', 'http://themebeans.com' );
define( 'EDD_BEANSHORTCODES_NAME', 'Bean Shortcodes' );

//LOAD UPDATER CLASS
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) 
{
	include( dirname( __FILE__ ) . '/updates/EDD_SL_Plugin_Updater.php' );
}
//INCLUDE UPDATER SETUP
include( dirname( __FILE__ ) . '/updates/EDD_SL_Activation.php' );


/*===================================================================*/
/* UPDATER SETUP
/*===================================================================*/
function beanshortcodes_license_setup() 
{
	add_option( 'edd_beanshortcodes_activate_license', 'BEANSHORTCODES' );
	add_option( 'edd_beanshortcodes_license_status' );
}
add_action( 'init', 'beanshortcodes_license_setup' );

function edd_beanshortcodes_plugin_updater() 
{
	//RETRIEVE LICENSE KEY
	$license_key = trim( get_option( 'edd_beanshortcodes_activate_license' ) );

	$edd_updater = new EDD_SL_Plugin_Updater( EDD_BEANSHORTCODES_TB_URL, __FILE__, array( 
			'version' 	=> '2.1',
			'license' 	=> $license_key,
			'item_name' => EDD_BEANSHORTCODES_NAME,
			'author' 	=> 'Rich Tabor / ThemeBeans'
		)
	);
}
add_action( 'admin_init', 'edd_beanshortcodes_plugin_updater' );


/*===================================================================*/
/* DEACTIVATION HOOK - REMOVE OPTION
/*===================================================================*/
function beanshortcodes_deactivate() 
{
	delete_option( 'edd_beanshortcodes_activate_license' );
	delete_option( 'edd_beanshortcodes_license_status' );
}
register_deactivation_hook( __FILE__, 'beanshortcodes_deactivate' );








/*===================================================================*/
/*
/* BEGIN BEAN SHORTCODES PLUGIN
/*
/*===================================================================*/
/*===================================================================*/
/* BEGIN CLASS
/*===================================================================*/	 
if ( !class_exists( 'Bean_BeanShortcodes' ) ) {

	class Bean_BeanShortcodes 
	{
	    function __construct() 
	    {
	    	require_once( DIRNAME(__FILE__) . '/bean-theme-shortcodes.php' );
	
	    	define('BEAN_SC_ADMIN_URI', plugin_dir_url(__FILE__) .'admin');
			define('BEAN_TINYMCE_DIR', DIRNAME(__FILE__) .'/admin');
	
	        add_action('init', array(&$this, 'action_admin_init'));
	        add_action('admin_enqueue_scripts', array(&$this, 'action_admin_scripts_init'));
	        add_action('wp_enqueue_scripts', array(&$this, 'action_frontend_scripts'));
		}
	
	
	
	
		/*===================================================================*/
		/* REGISTER SCRIPTS & STYLES
		/*===================================================================*/	 
		function action_frontend_scripts() 
		{
			//VARIABLES
			$js_url = plugin_dir_url(__FILE__) . 'assets/js/bean-shortcodes.min.js';
			$css_url = plugin_dir_url(__FILE__) . 'assets/bean-shortcodes.css';
	
			//ENQUEUE
			wp_enqueue_script('bean-shortcodes', $js_url, 'jquery', '1.0', true);
			wp_enqueue_style( 'bean-shortcodes', $css_url, false, '1.0', 'all' );
		}
	
	
	
	
		/*===================================================================*/
		/* ENQUEUE SCRIPTS & STYLES
		/*===================================================================*/  
		function action_admin_scripts_init() 
		{
			//CSS
			wp_enqueue_style( 'bean-shortcodes-admin', BEAN_SC_ADMIN_URI . '/css/bean-shortcodes-admin.css', false, '1.0', 'all' );
		
			//JS
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'bean-shortcodes-admin', BEAN_SC_ADMIN_URI . '/js/bean-shortcodes-admin.js', false, '1.0', false );
			wp_enqueue_script( 'bean-shortcodes-popup', BEAN_SC_ADMIN_URI . '/js/bean-shortcodes-popup.js', false, '1.0', false );
			wp_localize_script( 'jquery', 'BeanShortcodes', array('plugin_folder' => plugin_dir_url(__FILE__)) );
		}
	
	
	
	
		/*===================================================================*/
		/* REGISTERS TINYMCE RICH EDITOR BUTTONS
		/*===================================================================*/	 
		function action_admin_init() 
		{
			if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )
				return;
	
			if ( get_user_option('rich_editing') == 'true' && is_admin() ) {
				add_filter( 'mce_external_plugins', array(&$this, 'add_rich_plugins') );
				add_filter( 'mce_buttons', array(&$this, 'register_rich_buttons') );
			}
		}
	
	
	
	
		/*===================================================================*/
		/* DEFINES TINYNCE RICH EDITOR PLUGIN JS
		/*===================================================================*/	 
		function add_rich_plugins( $plugin_array ) 
		{
			$plugin_array['BeanShortcodes'] = BEAN_SC_ADMIN_URI . '/plugin.js';
			return $plugin_array;
		}
	
	
	
	
		/*===================================================================*/
		/* ADDS TINYMCE RICH EDITOR BUTTON
		/*===================================================================*/	 
		function register_rich_buttons( $buttons ) {
	
			array_push( $buttons, "|", 'bean_button' );
	
			return $buttons;
		}
	} //END class Bean_BeanShortcodes 
	
	new Bean_BeanShortcodes;

} //END if ( !class_exists( 'Bean_BeanShortcodes' ) )
?>