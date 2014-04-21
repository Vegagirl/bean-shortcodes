<?php
/**
 * This file sets up the shortcodes.
 *
 *
 * @package Bean Plugins
 * @subpackage BeanShortcodes
 * @author ThemeBeans
 * @since BeanShortcodes 2.0
 */
 
 
/*=================================*/
/* TEXT WIDGET FILTERS
/*=================================*/
add_filter('widget_text', 'shortcode_unautop', 10);
add_filter('widget_text', 'do_shortcode', 10);


/*=================================*/
/* COLUMNS 
/*=================================*/
if (!function_exists('bean_one_third')) {
	function bean_one_third( $atts, $content = null ) {
	   return '<div class="bean-one-third">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('one_third', 'bean_one_third');
}

if (!function_exists('bean_one_third_last')) {
	function bean_one_third_last( $atts, $content = null ) {
	   return '<div class="bean-one-third bean-column-last">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('one_third_last', 'bean_one_third_last');
}

if (!function_exists('bean_two_third')) {
	function bean_two_third( $atts, $content = null ) {
	   return '<div class="bean-two-third">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('two_third', 'bean_two_third');
}

if (!function_exists('bean_two_third_last')) {
	function bean_two_third_last( $atts, $content = null ) {
	   return '<div class="bean-two-third bean-column-last">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('two_third_last', 'bean_two_third_last');
}

if (!function_exists('bean_one_half')) {
	function bean_one_half( $atts, $content = null ) {
	   return '<div class="bean-one-half">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('one_half', 'bean_one_half');
}

if (!function_exists('bean_one_half_last')) {
	function bean_one_half_last( $atts, $content = null ) {
	   return '<div class="bean-one-half bean-column-last">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('one_half_last', 'bean_one_half_last');
}

if (!function_exists('bean_one_fourth')) {
	function bean_one_fourth( $atts, $content = null ) {
	   return '<div class="bean-one-fourth">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('one_fourth', 'bean_one_fourth');
}

if (!function_exists('bean_one_fourth_last')) {
	function bean_one_fourth_last( $atts, $content = null ) {
	   return '<div class="bean-one-fourth bean-column-last">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('one_fourth_last', 'bean_one_fourth_last');
}

if (!function_exists('bean_three_fourth')) {
	function bean_three_fourth( $atts, $content = null ) {
	   return '<div class="bean-three-fourth">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('three_fourth', 'bean_three_fourth');
}

if (!function_exists('bean_three_fourth_last')) {
	function bean_three_fourth_last( $atts, $content = null ) {
	   return '<div class="bean-three-fourth bean-column-last">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('three_fourth_last', 'bean_three_fourth_last');
}

if (!function_exists('one_fifth')) {
	function bean_one_fifth( $atts, $content = null ) {
	   return '<div class="bean-one-fifth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fifth', 'bean_one_fifth');
}

if (!function_exists('bean_one_fifth_last')) {
	function bean_one_fifth_last( $atts, $content = null ) {
	   return '<div class="bean-one-fifth bean-column-last">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('one_fifth_last', 'bean_one_fifth_last');
}

if (!function_exists('bean_two_fifth')) {
	function bean_two_fifth( $atts, $content = null ) {
	   return '<div class="bean-two-fifth">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('two_fifth', 'bean_two_fifth');
}

if (!function_exists('bean_two_fifth_last')) {
	function bean_two_fifth_last( $atts, $content = null ) {
	   return '<div class="bean-two-fifth bean-column-last">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('two_fifth_last', 'bean_two_fifth_last');
}

if (!function_exists('bean_three_fifth')) {
	function bean_three_fifth( $atts, $content = null ) {
	   return '<div class="bean-three-fifth">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('three_fifth', 'bean_three_fifth');
}

if (!function_exists('bean_three_fifth_last')) {
	function bean_three_fifth_last( $atts, $content = null ) {
	   return '<div class="bean-three-fifth bean-column-last">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('three_fifth_last', 'bean_three_fifth_last');
}

if (!function_exists('bean_four_fifth')) {
	function bean_four_fifth( $atts, $content = null ) {
	   return '<div class="bean-four-fifth">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('four_fifth', 'bean_four_fifth');
}

if (!function_exists('bean_four_fifth_last')) {
	function bean_four_fifth_last( $atts, $content = null ) {
	   return '<div class="bean-four-fifth bean-column-last">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('four_fifth_last', 'bean_four_fifth_last');
}

if (!function_exists('bean_one_sixth')) {
	function bean_one_sixth( $atts, $content = null ) {
	   return '<div class="bean-one-sixth">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_sixth', 'bean_one_sixth');
}

if (!function_exists('bean_one_sixth_last')) {
	function bean_one_sixth_last( $atts, $content = null ) {
	   return '<div class="bean-one-sixth bean-column-last">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('one_sixth_last', 'bean_one_sixth_last');
}

if (!function_exists('bean_five_sixth')) {
	function bean_five_sixth( $atts, $content = null ) {
	   return '<div class="bean-five-sixth">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('five_sixth', 'bean_five_sixth');
}

if (!function_exists('bean_sixth_last')) {
	function bean_five_sixth_last( $atts, $content = null ) {
	   return '<div class="bean-five-sixth bean-column-last">' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode('five_sixth_last', 'bean_five_sixth_last');
}


/*=================================*/
/* CLEAR 
/*=================================*/
if(!function_exists('bean_clear')) {
	function bean_clear( $atts ) {
	   return '<div class="clearfix"></div>';
	}
	add_shortcode('clear', 'bean_clear');
	add_shortcode('clearfix', 'bean_clear');
}


/*=================================*/
/* TOGGLES 
/*=================================*/
if (!function_exists('bean_toggle')) {
	function bean_toggle( $atts, $content = null ) {
	    extract(shortcode_atts(array(
			'title'    	 => 'Collapsibile Toggle Title',
			'state'		 => 'in'
	    ), $atts));
	    
	     //$id = str_replace(‘ ‘, ‘’, $title);
		$id = preg_replace('/[^a-zA-Z]+/', '', $title);
	    
		return "
		<div class='bean-panel'>
			<div class='bean-panel-heading'>
			<p class='bean-panel-title'><a data-toggle='collapse' data-parent='#accordion' href='#".$id."'>". $title ."</a></p>
			</div>
			<div id='".$id."' class='bean-panel-collapse collapse ".$state."'>
				<div class='bean-panel-body'>". do_shortcode( $content ) ."</div>
			</div>
		</div>";
	}
	add_shortcode('toggle', 'bean_toggle');
}


/*=================================*/
/* TABS 
/*=================================*/
if (!function_exists('bean_tabs')) {
	function bean_tabs( $atts, $content = null ) {
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );

		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );

		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }

		$output = '';

		if( count($tab_titles) ){
			
			$output .= '<ul class="nav bean-tabs">';

			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#tab-'. sanitize_title( $tab[0] ) .'" data-toggle="tab">' . $tab[0] . '</a></li>';
			}
		    $output .= '</ul>';
		    
		    $output .= '<div class="bean-tab-content">';
		    $output .= do_shortcode( $content);
		    $output .= '</div>';
		    
			$output .= '<script type="text/javascript">';
			$output .= 'jQuery(document).ready(function($) {';
			$output .= '$(".bean-tab-content .bean-tab-pane:first-of-type").addClass("active");';
			$output .= '$(".nav.bean-tabs li:first-child").addClass("active");';
			$output .= '});';
			$output .= '</script>';
			
		} else {
			$output .= do_shortcode( $content );
		}

		return $output;
	}
	add_shortcode( 'tabs', 'bean_tabs' );

}

if (!function_exists('bean_tab')) {

	function bean_tab( $atts, $content = null ) {

		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );

		return '<div id="tab-'. sanitize_title( $title ) .'" class="bean-tab-pane fade in">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'tab', 'bean_tab' );
}


/*=================================*/
/* ALERTS 
/*=================================*/
if (!function_exists('bean_alert')) {

	function bean_alert( $atts, $content = null ) {

	   extract(shortcode_atts(array(
	   		'style' => '',
	       ), $atts));

	   	$class = 'bean-alert';
	   	$icon = null;

	   	if ($style == 'inset') {
	   		$class = 'insetBox';
	   	} elseif ($style) {
	   		$class .= ' '. $style;
	   	}
	   	if ($icon) $class .= ' icon';

	   	$box = '<div class="'.$class.'">';
	   	$box .= do_shortcode( $content );
	   	$box .= '</div>';

	      return $box;
	}

	add_shortcode('alert', 'bean_alert');
}


/*=================================*/
/* HIGHLIGHT 
/*=================================*/
if(!function_exists('bean_highlight_sc')) {
	function bean_highlight_sc ( $atts, $content = null ) {
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		return '<span class="highlight">' . $content . '</span>';
	}
	add_shortcode( 'highlight', 'bean_highlight_sc' );
}


/*=================================*/
/* TOOLTIP 
/*=================================*/
if (!function_exists('bean_tooltip_sc')) {
	function bean_tooltip_sc( $atts, $content = null ) {
	    extract(shortcode_atts(array(
			'title'    	 => 'Collapsibile Toggle Title',
			'placement'		 => 'top',
			'link'		 => '#'
	    ), $atts));
		
		if ($placement) $placement = 'data-placement="'.$placement.'"';
	    
		return '<a href="'.$link.'" data-toggle="tooltip" title="" '.$placement.' data-original-title="'.$content.'">'.$title.'</a>';
	}
	add_shortcode('tooltip', 'bean_tooltip_sc');
}


/*=================================*/
/* BUTTONS 
/*=================================*/
if (!function_exists('bean_button_sc')) {
	function bean_button_sc( $atts, $content = null ) {
	    extract(shortcode_atts(array(
			'url'		=> '#',
 			'target'	=> '',
			'color'		=> '',
			'type'      => '',
			'size'      => '',
			'icon'	    => '',
	    ), $atts));

		// VARIABLES
 		if ($color) $color = $color;
 		if ($type)  $type = $type;
 		if ($size)  $size = $size;

		// TARGET SETUP
		if		($target == 'blank' || $target == '_blank' || $target == 'new' ) { $target = ' target="_blank"'; }
		elseif	($target == 'parent')	{ $target = ' target="_parent"'; }
		elseif	($target == 'self')		{ $target = ' target="_self"'; }
		elseif	($target == 'top')		{ $target = ' target="_top"'; }
		else	{$target = '';}

		// ICONS
		if ($icon !="") { $icon_type = ( $icon ) ? '<i class="icon-'.$icon.'"></i>': '' ; }
		else { $icon_type = ''; }
		// BUTTON OUTPUT
		$button = '<a href=" '.$url.' " class="bean-btn '.$color.' '.$size.' '.$type.' " '.$target.'> '.$icon_type.' '.do_shortcode($content).' </a>';

	    return $button;
	}
	add_shortcode('button', 'bean_button_sc');
}


/*=================================*/
/* PULL QUOTE 
/*=================================*/
if(!function_exists('bean_quote_sc')) {
	function bean_quote_sc ( $atts, $content = null ) {
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		return '<div class="bean-quote">' . $content . '</div>';
	}
	add_shortcode( 'quote', 'bean_quote_sc' );
}


/*=================================*/
/* NOTE 
/*=================================*/
if(!function_exists('bean_note_sc')) {
	function bean_note_sc ( $atts, $content = null ) {
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		return '<div class="bean-note">' . $content . '</div>';
	}
	add_shortcode( 'note', 'bean_note_sc' );
}


/*=================================*/
/* LISTS 
/*=================================*/
if (!function_exists('bean_lists_sc')) {
	function bean_lists_sc($atts, $content = null) {
		extract( shortcode_atts( array(
			'style' => ''
		), $atts ) );
	     $content = do_shortcode( $content );
		return '<div class="shortcode-list">'.$content.'</div>';
	}
	add_shortcode("list", "bean_lists_sc");
}
?>