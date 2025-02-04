<?php

class JR_Standard_Walker extends Walker_Nav_Menu {

  /**
   * Standard navwalker
   *
   * @package WordPress
   */

   /*
 * Class Name: JR_Standard_Walker
 * Plugin Name: JR Custom Standard Navigation Navwalker
*/

 public function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {

   // Atts for the link itself.
		$atts = array();
		$atts['title']  = esc_attr( $item -> attr_title );
		$atts['target'] = esc_attr( $item -> target );
		$atts['rel']    = esc_attr( $item -> xfn );
		$atts['href']   = esc_url(  $item -> url );

		// Expose the atts to filtering.
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		// Combine the atts into a string for inserting into the link tag.
		$atts_str = '';
		foreach ( $atts as $k => $v ) {
			if ( empty( $v ) ) { continue; }
			$atts_str .= " $k='$v' ";
		}


   $output .= "<li class='" .  implode(" ", $item->classes) . "'>";

 		if ($item->url && strpos($item->url, '//#') === false) {
 			$output .= '<a '. $atts_str .' >';
 		} else {
 			$output .= '<span>';
 		}

 		$output .= $item->title;

    if ($args->walker->has_children) {
 			$output .= '<i class="caret fa fa-angle-down"></i>';
 		}

 		if ($item->url && strpos($item->url, '//#') === false) {
 			$output .= '</a>';
 		} else {
 			$output .= '</span>';
 		}

}

public function start_lvl(&$output, $depth=0, $args=array()) {

      $output .= '<ul class="sub-menu green_none">';
    }

public function end_lvl(&$output, $depth=0, $args=array()) {
      $output .= "</ul>";
    }

} //end walker
