<?php

class Mobile_Locations_Walker extends Walker_Nav_Menu {

  /**
   * Mobile Locations navwalker
   *
   * @package WordPress
   */

   /*
 * Class Name: Mobile_Locations_Walker
 * Plugin Name: JR Custom Mobile Navwalker
*/
private $curItem;

 public function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
  $object = $item->object;
  $type = $item->type;
  $title = $item->title;
  $description = $item->description;
  $permalink = $item->url;
  $objectID = $item->ID;
  $themeurl = get_template_directory_uri();

  $this->curItem = $item;

  $output .= '<li class="links_wrapper_mm_1">';

  if( $permalink && strpos($permalink, '~') !== false && $depth == 0 ) {
    $output .= '<a href="#men-item-' . $objectID . '" class="collapsed links_mm_1" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="' . $objectID . '" data-parent="#wrapper_mm_1"><div class="title">' . $title . '</div><div class="rght_ions"> <i class="fa-chevron-right fas img_collapsed"></i><i class="fa-chevron-right fas active"></i></div>';
  } else if( $permalink && strpos($permalink, '#') === false && $depth == 0 ) {
    $output .= '<a href="' . $permalink . '" class="links_mm_1" > <div class="title">' . $title . '</div><div class="rght_ions"> <i class="fa-chevron-right fas img_collapsed"></i> <i class="fa-chevron-right fas active"></i> </div>';
  } else {
    $output .= '<a href="' . $permalink . '"> ' . $title . '';
  }

  //$output .= $title;

  if( $description != '' && $depth == 0 ) {
    $output .= '<small class="description">' . $description . '</small>';
  }

  if( $permalink && $permalink != '#' ) {
    $output .= '</a>';
  } else {
    $output .= '</a>';
  }
}

public function start_lvl(&$output, $depth=0, $args=array()) {
  // var_dump($this->curItem );
  $parentID = $this->curItem->ID;
        $output .= '<ul class="collapse sub_mobile" id="men-item-'.$parentID.'" data-parent="#wrapper_mm_1">';
    }

public function end_lvl(&$output, $depth=0, $args=array()) {
    $output .= "</ul>";
}


} //end walker
