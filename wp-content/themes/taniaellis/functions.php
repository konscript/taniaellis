<?php

add_theme_support('post-thumbnails', array('post'));
set_post_thumbnail_size(100, 100, true); // Normal post thumbnails
add_image_size('post-square-small-thumbnail', 50, 50);
add_image_size('post-wide-thumbnail', 240, 100);

if(function_exists( 'register_nav_menus')) {
	register_nav_menus(array(
	    'navigation-top'        => 'Top Menu',
	    'navigation-pages'      => 'Page Menu',
	    'social-business-menu'  => 'Social Business Menu',
	    'club-menu'             => 'Club Menu',
		'blog-menu'				=> 'Blog Menu'
	    )
	);
}

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
/*
******************************
* REGISTER CUSTOM POST TYPES *
******************************
*/

add_action('init', 'article_register');
add_action('admin_head', 'change_custom_post_type_icons');

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

function article_register() {

  $labels = array(
		'name' => _x('Articles', 'post type general name'),
		'singular_name' => _x('Article', 'post type singular name'),
		'add_new' => _x('Add New', 'article'),
		'add_new_item' => __('Add New Article'),
		'edit_item' => __('Edit Article'),
		'new_item' => __('New Article'),
		'view_item' => __('View Article'),
		'search_items' => __('Search Article'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu-position' => 5,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/icon_article.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'author', 'excerpt', 'editor', 'thumbnail', 'comments')
	  );
	  
	  register_post_type('te_article', $args);
}

?>