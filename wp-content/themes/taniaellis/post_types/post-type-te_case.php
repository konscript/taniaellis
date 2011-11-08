<?php

/**
#########################
# CREATE CASE POST TYPE #
#########################
**/
add_action('init', 'case_register');

function case_register() {

  $labels = array(
		'name'                => _x('Cases', 'post type general name'),
		'singular_name'       => _x('Case', 'post type singular name'),
		'add_new'             => _x('Add New', 'case'),
		'add_new_item'        => __('Add New Case'),
		'edit_item'           => __('Edit Case'),
		'new_item'            => __('New Case'),
		'view_item'           => __('View Case'),
		'search_items'        => __('Search Case'),
		'not_found'           =>  __('Nothing found'),
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
	  'menu_icon'           => get_stylesheet_directory_uri() . '/images/icon_case.png',
		'rewrite'             => array('slug' => 'cases', 'with_front' => false),
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'supports'				=> array(
			'title',
			'excerpt',
			'editor',
			'thumbnail',
			'comments'
		)
	);
	  
	  
	  register_post_type('te_case', $args);
	  create_case_taxonomies();
	  create_case_metaboxes();
}

function create_case_taxonomies() {
  $te_case_category_labels = array(
    'name'                => _x('Case Categories', 'taxonomy general name'),
    'singular_name'       => _x('Case Category', 'taxonomy singular name'),
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

  $te_case_category_args = array(
    'labels'            => $te_case_category_labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'hierarchical'      => true,
    'rewrite'           => array('slug' => 'case-categories', 'with_front' => false),
    '_builtin'          => false
  );

  register_taxonomy('te_case-category', 'te_case', $te_case_category_args);
}

function create_case_metaboxes() {
  
  $client_query = new WP_Query('post_type=te_client');
  if($client_query->have_posts()) {
    $clients[''] = '';
    while($client_query->have_posts()) {
      $client_query->the_post();
      $clients[get_the_ID()] = get_the_title();
    }
  }
  
  wp_reset_query();
  
  $case_prefix = 'te_case-options';

  $case_meta = array(
   'id' => $case_prefix,
   'title' => 'Client Options',
   'pages' => array('te_case'),
   'context' => 'side',
   'priority' => 'low',

   'fields' => array(
     array(
 		  'name' => 'Client',
 		  'id' => $case_prefix . '-client-id',
 		  'desc' => 'Client to case',
 		  'type' => 'select',
 		  'options' => $clients
 		),
     array(
       'name' => 'Material',
       'id' => $case_prefix . '-document',
       'type' => 'file',
       'desc' => 'Upload case material'
     )
   )
  );

  $case_box = new RW_Meta_Box($case_meta);

}

?>