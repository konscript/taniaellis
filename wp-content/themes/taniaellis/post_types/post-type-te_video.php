<?php

/**
##########################
# CREATE VIDEO POST TYPE #
##########################
**/
add_action('init', 'video_register');

function video_register() {

  $labels = array(
		'name' => _x('Videos', 'post type general name'),
		'singular_name' => _x('Video', 'post type singular name'),
		'add_new' => _x('Add New', 'video'),
		'add_new_item' => __('Add New Video'),
		'edit_item' => __('Edit Video'),
		'new_item' => __('New Video'),
		'view_item' => __('View Video'),
		'search_items' => __('Search Videos'),
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
		'menu_icon' => get_stylesheet_directory_uri() . '/images/icon_video.png',
		'rewrite' => array('slug' => 'videos', 'with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title')
	  );
	  
	  register_post_type('te_video', $args);
}

add_action('init', 'create_video_taxonomies');
function create_video_taxonomies() {
  $te_video_category_labels = array(
    'name'                => _x('Video Categories', 'taxonomy general name'),
    'singular_name'       => _x('Video Category', 'taxonomy singular name'),
    'search_items'        => __('Search Categories'),
    'popular_items'       => __('Popular Categories'),
    'all_items'           => __('All Categories'),
    'parent_item'         => __('Parent Category'),
    'parent_item_colon'   => __('Parent Category:'),
    'edit_item'           => __('Edit Category'),
    'update_item'         => __('Update Category'),
    'add_new_item'        => __('Add New Category'),
    'new_item_name'       => __('New Category Name')  
  );
  
  $te_video_category_args = array(
    'labels'            => $te_video_category_labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'show_tagcloud'     => true,
    'hierarchical'      => true,
    'rewrite'           => array('slug' => 'video-categories', 'with_front' => false),
    '_builtin'          => false
  );
  
  register_taxonomy('te_video-category', 'te_video', $te_video_category_args);
  
  $te_article_tag_labels = array(
    'name'                  => _x('Video Tags', 'taxonomy general name'),
    'singular_name'         => _x('Video Tag', 'taxonomy singular name'),
    'search_items'          => __('Search Tags'),
    'popular_items'         => __('Popular Tags'),
    'all_items'             => __('All Tags'),
    'parent_item'           => __('Parent Tags'),
    'parent_item_colon'     => __('Parent Tags:'),
    'edit_item'             => __('Edit Tag'),
    'update_item'           => __('Update Tag'),
    'add_new_item'          => __('Add New Tag'),
    'new_item_name'         => __('New Tag Name'),
    'add_or_remove_items'   => __('Add or remove tags'),
    'choose_from_most_used' => __('Choose from most used tags')
  );
  
  $te_video_tag_args = array(
    'labels'            => $te_article_tag_labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'show_tagcloud'     => true,
    'hierarchical'      => false,
    'rewrite'           => array('slug' => 'video-tags', 'with_front' => false),
    '_builtin'          => false
  );
  
  register_taxonomy('te_video-tag', 'te_video', $te_video_tag_args);
}

te_video_meta();

function te_video_meta() {
  $meta_boxes[] = array(
  	'id' => 'te_video-options',
  	'title' => 'Video Options',
  	'pages' => array('te_video'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Vimeo URL',
  			'id' => 'te_video_url',
  			'type' => 'text',					
  		)
  	)
  );
  
  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
  
}

function te_vimeo_video($url, $width, $height) {
  $pattern = "/[0-9]*$/";
  preg_match_all($pattern, $url, $matches);
  $video_id = $matches[0][0];

  return '<iframe src="http://player.vimeo.com/video/'. $video_id .'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0" width="' . $width . '" height="' . $height . '" frameborder="0"></iframe>';
}

?>