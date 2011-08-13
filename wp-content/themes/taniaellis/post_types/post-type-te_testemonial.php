<?php

/**
################################
# CREATE TESTEMONIAL POST TYPE #
################################
**/
add_action('init', 'testemonial_register');

function testemonial_register() {

  $labels = array(
   'name' => _x('Testemonials', 'post type general name'),
   'singular_name' => _x('Testemonial', 'post type singular name'),
   'add_new' => _x('Add New', 'testemonial'),
   'add_new_item' => __('Add New Testemonial'),
   'edit_item' => __('Edit Testemonial'),
   'new_item' => __('New Testemonial'),
   'view_item' => __('View Testemonial'),
   'search_items' => __('Search Testemonial'),
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
   'menu_icon' => get_stylesheet_directory_uri() . '/images/icon_quotes.png',
   'rewrite' => array('slug' => 'testemonials', 'with_front' => false),
   'capability_type' => 'post',
   'hierarchical' => false,
   'supports' => array('thumbnail', 'title', 'editor')
   );
   
   register_post_type('te_testemonial', $args);
}

/* ADD CUSTOM FIELDS TO TESTEMONIAL POST TYPE */
te_testemonial_add_meta_box();

function te_testemonial_add_meta_box() {
  add_action('init', function() { remove_post_type_support('te_testemonial', 'editor'); });
  
  $video_query = new WP_Query('post_type=te_video');
  if($video_query->have_posts()) {
    $videos[''] = '';
    while($video_query->have_posts()) {
      $video_query->the_post();
      $videos[get_the_ID()] = get_the_title();
    }
  }
  
  wp_reset_query();
  
  $case_query = new WP_Query('post_type=te_case');
  if($case_query->have_posts()) {
    $cases[''] = '';
    while($case_query->have_posts()) {
      $case_query->the_post();
      $cases[get_the_ID()] = get_the_title();
    }
  }
  
  wp_reset_query();
  
  $event_query = new WP_Query('post_type=te_event');
  if($case_query->have_posts()) {
    $events[''] = '';
    while($event_query->have_posts()) {
      $event_query->the_post();
      $events[get_the_ID()] = get_the_title();
    }
  }
  
  $prefix = 'te_testemonial';
  
  $te_testemonial_meta_box = array(
  	'id' => 'te_testemonial-meta',
  	'title' => 'Testemonial Options',
  	'pages' => array('te_testemonial'),

  	'fields' => array(
  		array(
  			'name' => 'Testemonial Author',
  			'id' => $prefix . '-author',
  			'type' => 'text',	
  		),
  		array(
  			'name' => 'Testemonial Date',
  			'id' => $prefix . '-date',
  			'type' => 'date'
  		),
  		array(
  		  'name' => 'Author URL',
  			'id' => $prefix . '-author-url',
  			'type' => 'text',
  			'desc' => 'Author website. Remember http://'
  		),
  		array(
  		  'name' => 'Author URL text',
  			'id' => $prefix . '-author-url-text',
  			'type' => 'text',
  			'desc' => 'Link text'
  		),
  		array(
  		  'name' => 'Vimeo',
  		  'id' => $prefix . '-video-id',
  		  'desc' => 'Select the blank option if no vimeo should be attached',
  		  'type' => 'select',
  		  'options' => $videos
  		),
  		array(
  		  'name' => 'Case',
  		  'id' => $prefix . '-case-id',
  		  'desc' => 'Case to attach. Select blank option if no case should be attached',
  		  'type' => 'select',
  		  'options' => $cases
  		), 
  		array(
  		  'name' => 'Event',
  		  'id' => $prefix . '-event-id',
  		  'desc' => 'Event to attach. Select blank option if no event should be attached',
  		  'type' => 'select',
  		  'options' => $events
  		),
  		array(
  		  'name' => 'Testemonial',
  		  'id' => $prefix . '-testemonial-text',
  		  'type' => 'textarea'
  		)
  	)
  );
  
  $testemonial_box = new RW_Meta_Box($te_testemonial_meta_box);
}

?>