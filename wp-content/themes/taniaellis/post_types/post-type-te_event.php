<?php

function regsiter_te_event() {
	$args = array(
		'labels'				=> array(
			'name'					=> _x('Events', 'post type general name'),
			'singular_name'			=> _x('Event', 'post type singular name'),
			'add_new'				=> _x('Add New', 'event'),
			'add_new_item'			=> __('Add New Event'),
			'edit_item'				=> __('Edit Event'),
			'new_item'				=> __('New Event'),
			'view_item'				=> __('View Event'),
			'search_items'			=> __('Search Event'),
			'not_found'				=> __('Nothing found'),
			'not_found_in_trash'	=> __('Nothing found in Trash'),
			'parent_item_colon'		=> ''
		),
		'public'				=> true,
		'publicly_queryable'	=> true,
		'show_ui'				=> true,
		'query_var'				=> true,
		'menu_position'			=> 5,
		'menu_icon'				=> get_stylesheet_directory_uri() . '/images/icon_event.gif',
		'rewrite'				=> array('slug' => 'events/event', 'with_front' => false),
		'capability_type'		=> 'post',
		'herarchical'			=> false,
		'supports'				=> array(
			'title',
			'excerpt',
			'editor',
			'thumbnail',
			'comments'
		)
	);
	
	register_post_type('te_event', $args);
}

add_action('init', 'regsiter_te_event');

te_event_meta();

function te_event_meta() {
  
  $video_query = new WP_Query('post_type=te_video');
  if($video_query->have_posts()) {
    $videos[''] = '';
    while($video_query->have_posts()) {
      $video_query->the_post();
      $videos[get_the_ID()] = get_the_title();
    }
  }
  
  wp_reset_query();
  
  $prefix = 'te_event-options';
  
  $meta_boxes[] = array(
    'id' => $prefix,
  	'title' => 'Event Options',
  	'pages' => array('te_event'),
  	'context' => 'side',
  	'priority' => 'low',

  	'fields' => array(
  		array(
  			'name'	=> 'Start Date',
  			'id' 		=> $prefix . '-start-date',
  			'type'	=> 'text',
				'desc'	=> 'Format: yyyy/mm/dd'
  		),
  		array(
  			'name' 	=> 'Start Time',
  			'id' 		=> $prefix . '-start-time',
  			'type'	=> 'text',
  			'desc'	=> 'Format: hh:mm'					
  		),
  		array(
  			'name' 	=> 'End Date',
  			'id' 		=> $prefix . '-end-date',
  			'type' 	=> 'text'			,
				'desc'	=> 'Format: yyyy/mm/dd'	
  		),
  		array(
  			'name' 	=> 'End Time',
  			'id' 		=> $prefix . '-end-time',
  			'type' 	=> 'text',
  			'desc' 	=> 'Format: hh:mm'					
  		)
  	)
  );
  
  $video_prefix = 'te_event-video-options';
  
  $meta_boxes[] = array(
    'id' => $video_prefix,
   'title' => 'Video Options',
   'pages' => array('te_event'),
   'context' => 'side',
   'priority' => 'low',
  
   'fields' => array(
     array(
       'name' => 'Vimeo',
       'id' => $video_prefix . '-video',
       'type' => 'select',
       'options' => $videos,
       'desc' => 'Select blank option if no vimeo should be attached'         
     )
   )
  );
  
  $attachments_prefix = 'te_event-attachments';
  
  $meta_boxes[] = array(
   'id' => $attachments_prefix,
   'title' => 'Attachments',
   'pages' => array('te_event'),
   'context' => 'side',
   'priority' => 'low',
  
   'fields' => array(
     array(
       'name' => 'Attachment',
       'id' => $attachments_prefix . '-id',
       'type' => 'file',
       'desc' => 'Can be used to upload eg. an <br> event programme'
     )
   )
  );
  
  
  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }

	function load_te_event_admin_scripts() {
		// wp_register_script('datepicker-support', get_bloginfo('template_url') . '/datepicker-support.js');
		// 	wp_enqueue_script('datepicker-support');
	}

	//add_action('admin_print_scripts', 'load_te_event_admin_scripts');

}



?>