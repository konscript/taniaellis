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
		'rewrite'             => array('slug' => 'case', 'with_front' => false),
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

	// Fetch all clients
	$client_posts = get_posts(array('numberposts'	=> -1, 'post_type'		=> 'te_client', 'status' => 'publish'));
	if(count($client_posts) > 0) {
		$clients[''] = '';
		foreach($client_posts as $key => $client) {
			$clients[$client->ID] = $client->post_title;
		}
	}
  
  $case_prefix = 'te_case-options';

  $meta_boxes[] = array(
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
  
  $case_meta_prefix = 'te_case-meta';
  
  $meta_boxes[] = array(
   'id' => $case_top_prefix,
   'title' => 'Top Options',
   'pages' => array('te_case'),
   'context' => 'normal',
   'priority' => 'high',

   'fields' => array(
     array(
 		  'name'  => 'Title: First Line',
 		  'id'    => $case_meta_prefix . '-first-line',
 		  'desc'  => 'First line of page title',
      'type'  => 'text',
 		),
     array(
       'name' => 'Title: Second Line',
       'id'   => $case_meta_prefix . '-second-line',
       'type' => 'text',
       'desc' => 'Second line of page title',
     ),
     array(
  	  'name'  => 'Left Meta',
  		'id'    => $case_meta_prefix . '-left',
  		'desc'  => 'Will appear to the left under the featured image',
      'type'  => 'text',
  	 ),
     array(
        'name' => 'Right Meta',
        'id'   => $case_meta_prefix . '-right',
        'desc' => 'Will appear to the right under the featured image',
        'type' => 'text',
     )
   )
  );
  
  foreach($meta_boxes as $meta_box) {
     $my_box = new RW_Meta_Box($meta_box);
   }

  //$case_box = new RW_Meta_Box($case_meta);
  //$case_box_2 = new RW_Mate_Box($case_top_meta);

}

?>