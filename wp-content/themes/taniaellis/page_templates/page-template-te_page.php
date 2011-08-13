<?php

/**
###################################
# ADD META BOXES TO PAGE TEMPLATE #
###################################
**/

te_page_template_meta_boxes();

function te_page_template_meta_boxes() {
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	
	$page_template = get_post_meta($post_id, '_wp_page_template', true);
	
  switch ($page_template) {
    case 'readingroom.php':
      te_reading_room_meta();
      break;    
    case 'club.php':
      te_club_meta();
      break;
    case 'consulting.php':
      te_consulting_meta();
      break;
    case 'lectures.php':
      te_lectures_meta();
      break;
    case 'events.php':
      te_events_meta();
      break;
    case 'lab.php':
      te_lab_meta();
      break;
    case 'home.php':
      te_home_meta(); 
    default:
      break;
  }
}

?>