<?php

/**
#########################
# CREATE CASE POST TYPE #
#########################
**/
add_action('init', 'case_register');

function case_register() {

  $labels = array(
		'name' => _x('Cases', 'post type general name'),
		'singular_name' => _x('Case', 'post type singular name'),
		'add_new' => _x('Add New', 'case'),
		'add_new_item' => __('Add New Case'),
		'edit_item' => __('Edit Case'),
		'new_item' => __('New Case'),
		'view_item' => __('View Case'),
		'search_items' => __('Search Case'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
	
	$args = array(
	  '_builtin' => false,
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 5,
		'_builtin' => false, // It's a custom post type, not built in!
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/icon_article.png',
		'rewrite' => array('slug' => 'cases', 'with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title', 'editor', 'thumbnail')
	  );
	  
	  register_post_type('te_case', $args);
}

?>