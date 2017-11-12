<?php
/**
 * Plugin Name: Bean Shortcodes
 * Plugin URI: http://themebeans.com/plugins/bean-shortcodes
 * Description: Enables shortcodes to be used in your WordPress theme.
 * Version: 2.2.1
 * Author: ThemeBeans
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
          $font_awesome_css_url = plugin_dir_url(__FILE__) . 'assets/font-awesome.css';

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

          wp_enqueue_script('bean-shortcodes', $js_url, 'jquery', '1.0', true);
          wp_enqueue_style( 'bean-shortcodes', $css_url, false, '1.0', 'all' );
          wp_enqueue_style( 'font-awesome', $font_awesome_css_url, false, '1.0', 'all' );

          // foreach($this->all_shortcodes as $shortcode)
          // {
          //      if (strpos($post->post_content, $shortcode) !== FALSE)
          //      {
          //      	wp_enqueue_script('bean-shortcodes', $js_url, 'jquery', '1.0', true);
          //      	wp_enqueue_style( 'bean-shortcodes', $css_url, false, '1.0', 'all' );
          //      break;
          //      }
          // }
          }




		/*===================================================================*/
		/* ENQUEUE SCRIPTS & STYLES
		/*===================================================================*/
		function action_admin_scripts_init()
		{
			//CSS
            wp_enqueue_style( 'bean-shortcodes-admin', BEAN_SC_ADMIN_URI . '/css/bean-shortcodes-admin.css', false, '1.0', 'all' );
			wp_enqueue_style( 'font-awesome', plugin_dir_url(__FILE__) . 'assets/font-awesome.css', false, '1.0', 'all' );

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
            if ( version_compare( get_bloginfo('version'), '3.9', '>=' ) ) {
    			$plugin_array['BeanShortcodes'] = BEAN_SC_ADMIN_URI . '/plugin.js';
            } else {
                $plugin_array['BeanShortcodes'] = BEAN_SC_ADMIN_URI . '/plugin-pre3.9.js';
            }

			return $plugin_array;
		}




		/*===================================================================*/
		/* ADDS TINYMCE RICH EDITOR BUTTON
		/*===================================================================*/
		function register_rich_buttons( $buttons ) {

			array_push( $buttons, "|", 'bean_shortcodes_button' );

			return $buttons;
		}
	} //END class Bean_BeanShortcodes

	new Bean_BeanShortcodes;

} //END if ( !class_exists( 'Bean_BeanShortcodes' ) )
?>