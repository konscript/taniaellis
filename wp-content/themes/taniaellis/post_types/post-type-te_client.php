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
   'rewrite'             => array('slug' => 'client', 'with_front' => false),
   'capability_type'     => 'post',
   'hierarchical'        => false,
   'supports'            => array('title', 'editor', 'thumbnail')
 );
   
 register_post_type('te_client', $args);
 create_client_taxonomies();
 create_client_metaboxes();
}

function create_client_taxonomies() {
  $te_client_category_labels = array(
    'name'                => _x('Client Categories', 'taxonomy general name'),
    'singular_name'       => _x('Client Category', 'taxonomy singular name'),
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

  $te_client_category_args = array(
    'labels'            => $te_client_category_labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'hierarchical'      => true,
    'rewrite'           => array('slug' => 'client-categories', 'with_front' => false),
    '_builtin'          => false
  );

  register_taxonomy('te_client-category', 'te_client', $te_client_category_args);
}

function create_client_metaboxes() {

  $client_prefix = 'te_client-options';

  $client_meta = array(
   'id' => $client_prefix,
   'title' => 'Client Options',
   'pages' => array('te_client'),
   'context' => 'side',
   'priority' => 'low',

   'fields' => array(
     array(
       'name' => 'Website',
       'id' => $client_prefix . '-website',
       'type' => 'text',
       'desc' => 'Remember <code>http://</code>'
     )
   )
  );
  
  $client_box = new RW_Meta_Box($client_meta);
}

?>