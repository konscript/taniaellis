<?php

/**
#########################
# CREATE NEWS POST TYPE #
#########################
**/
add_action('init', 'news_register');

function news_register() {

  $labels = array(
		'name'                => _x('News', 'post type general name'),
		'singular_name'       => _x('News', 'post type singular name'),
		'add_new'             => _x('Add', 'news'),
		'add_new_item'        => __('Add News'),
		'edit_item'           => __('Edit News'),
		'new_item'            => __('New News'),
		'view_item'           => __('View News'),
		'search_items'        => __('Search News'),
		'not_found'           => __('Nothing found'),
		'not_found_in_trash'  => __('Nothing found in Trash'),
		'parent_item_colon'   => ''
	);
	
	$args = array(
	  '_builtin'            => false,
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'query_var'           => true,
		'menu_position'       => 5,
		'_builtin'            => false, // It's a custom post type, not built in!
	  'menu_icon'           => get_stylesheet_directory_uri() . '/images/icon_news.png',
		'rewrite'             => array('slug' => 'news', 'with_front' => false),
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'supports'            => array('title', 'editor', 'thumbnail')
	  );
	  
	  register_post_type('te_news', $args);
}

te_news_meta();

function te_news_meta() {
  
  $news_prefix = 'te_news-options';
  
  $meta_boxes[] = array(
   'id' => $news_prefix,
   'title' => 'News Options',
   'pages' => array('te_news'),
   'context' => 'side',
   'priority' => 'low',
  
   'fields' => array(
     array(
       'name' => 'Byline',
       'id' => $news_prefix . '-id',
       'type' => 'text',
     )
   )
  );
  
  
  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
}

?>