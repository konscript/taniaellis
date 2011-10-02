<?php
include('meta-box.php');

/**
##################
# THEME SETTINGS #
##################
**/
add_filter( 'show_admin_bar', '__return_false' ); // Don't render admin-bar
remove_action('wp_head', 'wp_generator'); // Don't output generator tag (prevent formposting)
remove_action('wp_head', 'wlwmanifest_link'); // Don't output manifest link/tag

add_theme_support('post-thumbnails', array('post', 'te_event', 'te_article', 'te_testemonial', 'page'));
/**
#######################################
# REGISTER ADDITIONAL THUMBNAIL SIZES #
#######################################
**/

set_post_thumbnail_size(100, 100, true); // Normal post thumbnails
add_image_size('post-square-small-thumbnail', 62, 62, true);
add_image_size('post-square-thumbnail', 100, 100, true);
add_image_size('post-big-square-thumbnail', 240, 240, false);
add_image_size('post-tall-thumbnail', 62, 116, true);
add_image_size('post-wide-thumbnail', 240, 100, true);
add_image_size('post-wide-image', 524, 218, true);

/**
#############################
# UNREGISTER UNUSED WIDGETS #
#############################
**/

// Hide some of the unused wp widgets
function hide_wp_widgets() {
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Archives');
}

add_action('widgets_init','hide_wp_widgets', 1);


/**
#############################
# REGISTER NAVIGATION AREAS #
#############################
**/

if(function_exists( 'register_nav_menus')) {
	register_nav_menus(array(
	    'navigation-top'        => 'Top Menu',
	    'navigation-pages'      => 'Page Menu',
	    'social-business-menu'  => 'Social Business Menu',
	    'club-menu'             => 'Club Menu',
		  'blog-menu'				      => 'Blog Menu',
		  'lab-menu'				      => 'Lab Menu',
		  'consulting-menu'				=> 'Consulting Menu',
		  'lectures-menu'				  => 'Lectures Menu',
		  'events-menu'				 		=> 'Events Menu',
		  'reading-room-menu'     => 'Reading Room Menu',
		  'about-menu'            => 'About Menu',
		  'footer-menu'           => 'Footer Menu'
	    )
	);
}

/**
 * Get all menus created from the menu manager
 * in the admin interface.
 *
 * @return Array og WP Menu Objects
 * @author Kristian Andersen
 **/
function get_menus(){
    $r = array(-1 => "");
    $menus = wp_get_nav_menus();
		if(is_array($menus) && count($menus) > 0) {
			foreach($menus as $key => $menu) {
				$o = wp_get_nav_menu_object($menu->term_id);
				$r[$menu->term_id] = $o->name;
			}
		}
    return $r;
}

/**
 * Returns the ID of the current category (if within one).
 *
 * @return int
 * @author Kristian Andersen
 **/
function getCurrentCatID(){
  global $wp_query;
  
	if(is_category() || is_single()){
		$cat_ID = get_query_var('cat');
  }

	return $cat_ID;
}

/**
 * Returns the start DateTime object of a event
 * from it's ID.
 *
 * @return DateTime object
 * @author Kristian Andersen
 **/
function get_event_start($post_id) {
	$date = get_post_meta($post_id, 'te_event-options-start-date', true);
	$time = get_post_meta($post_id, 'te_event-options-start-time', true);	
	
	return DateTime::createFromFormat('Y/m/d H:i', $date . ' ' . $time);
}


/**
 * Returns the end DateTime object of a event
 * from it's ID.
 *
 * @return DateTime object
 * @author Kristian Andersen
 **/
function get_event_end($post_id) {
	$date = get_post_meta($post_id, 'te_event-options-end-date', true);
	$time = get_post_meta($post_id, 'te_event-options-end-time', true);	
	
	return DateTime::createFromFormat('Y/m/d H:i', $date . ' ' . $time);
}


/**
######################
# REGEISTER SIDEBARS #
######################
**/

if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'				=> 'Right Sidebar',
		'before_widget'		=> '',
		'after_widget'		=> '',
		'before_title'		=> '',
		'after´_title'		=> '',
	));
	register_sidebar(array(
		'name'				=> 'Left Sidebar',
		'before_widget'		=> '',
		'after_widget'		=> '',
		'before_title'		=> '',
		'after´_title'		=> '',
	));
}

/**
##########################################
# INCLUDE AND REGISTER CUSTOM POST TYPES #
##########################################
**/

// Include custom post type scripts.
require_once('post_types/post-type-te_event.php');
require_once('post_types/post-type-te_article.php');
require_once('post_types/post-type-te_video.php');
require_once('post_types/post-type-te_case.php');
require_once('post_types/post-type-te_testemonial.php');

/**
 * Changes the default post type icons
 * for custom post types in admin interface.
 *
 * @return void
 * @author Tomas Lieberkind
 **/
function change_custom_post_type_icons() {
  ?>
  <style type="text/css" media="screen">
    #menu-posts-portfolio .wp-menu-image {
        background: url(<?php bloginfo('template_url') ?>/images/portfolio-icon.png) no-repeat 6px 6px !important;
      }
      #menu-posts-portfolio:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
        background-position:6px -16px !important;
      }
      #icon-edit.icon32-posts-te_article {
        background: url(<?php bloginfo('template_url') ?>/images/post_type_icon_books.png) no-repeat;
      }
  </style>
  <?php
}

// Add hook for including custom post type icons
add_action('admin_head', 'change_custom_post_type_icons');

/**
#######################################
# INCLUDE PAGE TEMPLATE SPECIFIC CODE #
#######################################
**/

require_once('page_templates/page-template-te_club.php');
require_once('page_templates/page-template-te_consulting.php');
require_once('page_templates/page-template-te_events.php');
require_once('page_templates/page-template-te_home.php');
require_once('page_templates/page-template-te_blog.php');
require_once('page_templates/page-template-te_lab.php');
require_once('page_templates/page-template-te_lectures.php');
require_once('page_templates/page-template-te_reading-room.php');
require_once('page_templates/page-template-te_about.php');
require_once('page_templates/page-template-te_page.php');
require_once('page_templates/page-template-te_page-text.php');


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
      break;
		case 'blog.php':
	    te_blog_meta(); 
	    break;
    case 'about.php':
      te_about_meta();
      break;
    case 'page-text.php':
      te_page_text_meta();
      break;
    case 'blog.php':
		case 'page.php':
    default:
      te_page_meta();
      break;
  }
}
  


?>