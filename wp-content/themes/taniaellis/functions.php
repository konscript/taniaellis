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

add_theme_support('post-thumbnails', array('post', 'te_event', 'te_article', 'te_testemonial'));

/**
#######################################
# REGISTER ADDITIONAL THUMBNAIL SIZES #
#######################################
**/

set_post_thumbnail_size(100, 100, true); // Normal post thumbnails
add_image_size('post-square-thumbnail', 100, 100, true);
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
		  'reading-room-menu'     => 'Reading Room Menu'
	    )
	);
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

require_once('post_types/post-type-te_event.php');
require_once('post_types/post-type-te_article.php');
require_once('post_types/post-type-te_video.php');
require_once('post_types/post-type-te_case.php');
require_once('post_types/post-type-te_testemonial.php');


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

add_action('admin_head', 'change_custom_post_type_icons');

/**
#######################################
# INCLUDE PAGE TEMPLATE SPECIFIC CODE #
#######################################
**/

require_once('page_templates/page-template-te_page.php');
require_once('page_templates/page-template-te_club.php');
require_once('page_templates/page-template-te_consulting.php');
require_once('page_templates/page-template-te_events.php');
require_once('page_templates/page-template-te_home.php');
require_once('page_templates/page-template-te_lab.php');
require_once('page_templates/page-template-te_lectures.php');
require_once('page_templates/page-template-te_reading-room.php');

?>