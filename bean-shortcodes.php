<?php
/**
 * Plugin Name: Bean Shortcodes
 * Plugin URI: http://themebeans.com/plugin/bean-shortcodes-plugin
 * Description: Enables shortcodes to be used in Bean WordPress Themes
 * Version: 2.1.1
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
/* PLUGIN FEATURES SETUP
/*
/*===================================================================*/
$bean_plugin_features[ plugin_basename( __FILE__ ) ] = array(
        "updates"       => false // Whether to utilize plugin updates feature or not
    );


if ( ! function_exists( 'bean_plugin_supports' ) ) 
{
    function bean_plugin_supports( $plugin_basename, $feature ) 
    {
        global $bean_plugin_features;

        $setup = $bean_plugin_features;

        if( isset( $setup[$plugin_basename][$feature] ) && $setup[$plugin_basename][$feature] )
            return true;
        else
            return false;
    }
}


/*===================================================================*/
/*
/* PLUGIN UPDATER FUNCTIONALITY
/*
/*===================================================================*/
define( 'EDD_BEANSHORTCODES_TB_URL', 'http://themebeans.com' );
define( 'EDD_BEANSHORTCODES_NAME', 'Bean Shortcodes' );

if ( bean_plugin_supports ( plugin_basename( __FILE__ ), 'updates' ) ) : // check to see if updates are allowed; only import if so

//LOAD UPDATER CLASS
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) 
{
	include( dirname( __FILE__ ) . '/updates/EDD_SL_Plugin_Updater.php' );
}
//INCLUDE UPDATER SETUP
include( dirname( __FILE__ ) . '/updates/EDD_SL_Activation.php' );


endif; // END if ( bean_plugin_supports ( plugin_basename( __FILE__ ), 'updates' ) )


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
    // check to see if updates are allowed; don't do anything if not
    if ( ! bean_plugin_supports ( plugin_basename( __FILE__ ), 'updates' ) ) return;

	//RETRIEVE LICENSE KEY
	$license_key = trim( get_option( 'edd_beanshortcodes_activate_license' ) );

	$edd_updater = new EDD_SL_Plugin_Updater( EDD_BEANSHORTCODES_TB_URL, __FILE__, array( 
			'version' 	=> '2.2',
			'license' 	=> $license_key,
			'item_name'    => EDD_BEANSHORTCODES_NAME,
			'author' 	     => 'Rich Tabor / ThemeBeans'
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
        private $all_shortcodes = array(
                "toggle",
                "tabs",
                "tab",
                "alert",
                "highlight",
                "tooltip",
                "button",
                "quote",
                "note",
                "list",
                "one_third",
                "one_third_last",
                "two_third",
                "two_third_last",
                "one_half",
                "one_half_last",
                "one_fourth",
                "one_fourth_last",
                "three_fourth",
                "three_fourth_last",
                "one_fifth",
                "one_fifth_last",
                "two_fifth",
                "two_fifth_last",
                "three_fifth",
                "three_fifth_last",
                "four_fifth",
                "four_fifth_last",
                "one_sixth",
                "one_sixth_last",
                "five_sixth",
                "five_sixth_last",
                "clear",
                "clearfix"
            );

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

            global $post;
	
			/*
             * Conditionally check if the post content contains any of the shortcodes in which case load enqueue the scripts/styles
             * 
             * A much much better way could have been to keep a flag that defaults to 0. Whenever any of the shortcode callback 
             * functions is called, it sets the flag to 1. Then, in the wp_footer, we can decide whether to load the scripts or not.
             *
             * The reason why that method is not used is to avoid loading css in body.
             *
             */ 

            foreach($this->all_shortcodes as $shortcode) {
                if (strpos($post->post_content, $shortcode) !== FALSE) {
        			wp_enqueue_script('bean-shortcodes', $js_url, 'jquery', '1.0', true);
        			wp_enqueue_style( 'bean-shortcodes', $css_url, false, '1.0', 'all' );

                    break;
                }
            }
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