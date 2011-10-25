<?php

/**
###########################
# CREATE CLIENT POST TYPE #
###########################
**/
add_action('init', 'client_register');

function client_register() {

  $labels = array(
		'name'                => _x('Clients', 'post type general name'),
		'singular_name'       => _x('Client', 'post type singular name'),
		'add_new'             => _x('Add New', 'client'),
		'add_new_item'        => __('Add New Client'),
		'edit_item'           => __('Edit Client'),
		'new_item'            => __('New Client'),
		'view_item'           => __('View Client'),
		'search_items'        => __('Search Client'),
		'not_found'           => __('Nothing found'),
		'not_found_in_trash'  => __('Nothing found in Trash'),
		'parent_item_colon'   => ''
	);
	
	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'query_var'           => true,
		'menu_position'       => 5,
		'_builtin'            => false, // It's a custom post type, not built in!
	  'menu_icon'           => get_stylesheet_directory_uri() . '/images/icon_clients.png',
		'rewrite'             => array('slug' => 'cases', 'with_front' => false),
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'supports'            => array('title', 'editor', 'thumbnail')
	);
	  
	register_post_type('te_client', $args);
	
  
  /**
  ###############################
  # Register Clients Meta Boxes #
  ###############################
  **/
  $prefix = 'te_client-meta';
  $meta_boxes[] = array(
   'id'       => $prefix,
   'title'    => 'Client Info',
   'pages'    => array('te_client'),
   'context'  => 'side',
   'priority' => 'low',
   'fields' => array(
     array(
       'name' => 'Client Website',
       'id'   => $prefix . '-url',
       'type' => 'text',
       'desc' => 'Remember <code>http://</code>'
     ),
     array(
      'name'  => 'Contact Person Name',
      'id'    => $prefix . '-contact-name',
      'type'  => 'text',
     ),
     array(
      'name'  => 'Contact Person Name',
      'id'    => $prefix . '-contact-title',
      'type'  => 'text',
     ),
   )
  );
  
  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
  
	  
}

?>