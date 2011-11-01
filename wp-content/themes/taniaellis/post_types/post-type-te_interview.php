<?php

/**
################################
# CREATE INTERVIEW POST TYPE #
################################
**/
add_action('init', 'interview_register');

function interview_register() {

  $labels = array(
   'name' => _x('TV Interviews', 'post type general name'),
   'singular_name' => _x('TV Interview', 'post type singular name'),
   'add_new' => _x('Add New', 'TV Interview'),
   'add_new_item' => __('Add New TV Interview'),
   'edit_item' => __('Edit TV Interview'),
   'new_item' => __('New TV Interview'),
   'view_item' => __('View TV Interview'),
   'search_items' => __('Search TV Interviews'),
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
   'menu_position' => 5,
   '_builtin' => false, // It's a custom post type, not built in!
   'menu_icon' => get_stylesheet_directory_uri() . '/images/icon_tv.gif',
   'rewrite' => array('slug' => 'interviews', 'with_front' => false),
   'capability_type' => 'post',
   'hierarchical' => false,
   'supports' => array('thumbnail', 'title', 'editor', 'excerpt', 'comments')
   );
   
   register_post_type('te_interview', $args);
	 create_interview_taxonomies();
}

/* ADD CUSTOM FIELDS TO INTERVIEW POST TYPE */
te_interview_add_meta_box();

function te_interview_add_meta_box() {
  //add_action('init', function() { remove_post_type_support('te_interview', 'editor'); });
  
  $video_query = new WP_Query('post_type=te_video');
  if($video_query->have_posts()) {
    $videos[''] = '';
    while($video_query->have_posts()) {
      $video_query->the_post();
      $videos[get_the_ID()] = get_the_title();
    }
  }
  
  wp_reset_query();
  
  $prefix = 'te_interview';
  
  $te_interview_meta_box = array(
  	'id' => 'te_interview-meta',
  	'title' => 'TV Interview Options',
  	'pages' => array('te_interview'),

  	'fields' => array(
  		array(
  			'name' => 'Interview Meta',
  			'id' => $prefix . '-meta',
  			'type' => 'text',	
  		),
  		array(
  			'name' => 'Interview Date',
  			'id' => $prefix . '-date',
  			'type' => 'date'
  		),
  		array(
  		  'name' => 'Vimeo',
  		  'id' => $prefix . '-video-id',
  		  'desc' => 'Select the blank option if no vimeo should be attached',
  		  'type' => 'select',
  		  'options' => $videos
  		)
  	)
  );
  
  $interview_box = new RW_Meta_Box($te_interview_meta_box);
}

function create_interview_taxonomies() {
  $te_interview_category_labels = array(
    'name'                => _x('TV Interview Categories', 'taxonomy general name'),
    'singular_name'       => _x('TV Interview Category', 'taxonomy singular name'),
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
  
  $te_interview_category_args = array(
    'labels'            => $te_interview_category_labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'show_tagcloud'     => true,
    'hierarchical'      => true,
    'rewrite'           => array('slug' => 'interview-categories', 'with_front' => false),
    '_builtin'          => false
  );
  
  register_taxonomy('te_interview-category', 'te_interview', $te_interview_category_args);
  
  $te_interview_tag_labels = array(
    'name'                  => _x('TV Interview Tags', 'taxonomy general name'),
    'singular_name'         => _x('TV Interview Tag', 'taxonomy singular name'),
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
  
  $te_interview_tag_args = array(
    'labels'            => $te_interview_tag_labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'show_tagcloud'     => true,
    'hierarchical'      => false,
    'rewrite'           => array('slug' => 'interview-tags', 'with_front' => false),
    '_builtin'          => false
  );
  
  register_taxonomy('te_interview-tag', 'te_interview', $te_interview_tag_args);
}


?>