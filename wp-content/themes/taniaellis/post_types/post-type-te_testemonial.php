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

	// Fetch all videos
	$video_posts = get_posts(array('numberposts'	=> -1, 'post_type'		=> 'te_video', 'status' => 'publish'));
	if(count($video_posts) > 0) {
		$videos[''] = '';
		foreach($video_posts as $key => $video) {
			$videos[$video->ID] = $video->post_title;
		}
	}
  
	// Fetch all cases
	$case_posts = get_posts(array('numberposts'	=> -1, 'post_type'		=> 'te_case', 'status' => 'publish'));
	if(count($case_posts) > 0) {
		$cases[''] = '';
		foreach($case_posts as $key => $case) {
			$cases[$case->ID] = $case->post_title;
		}
	}

	// Fetch all events
	$event_posts = get_posts(array('numberposts'	=> -1, 'post_type'		=> 'te_event', 'status' => 'publish'));
	if(count($event_posts) > 0) {
		$events[''] = '';
		foreach($event_posts as $key => $event) {
			$events[$event->ID] = $event->post_title;
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