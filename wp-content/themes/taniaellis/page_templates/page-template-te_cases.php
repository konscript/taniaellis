<?php

function te_cases_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
  
  $header_prefix = 'te_cases-header-text';
  
  $meta_boxes[] = array(
  	'id' => 'te_cases-header-text',
  	'title' => 'Header Text Options',
  	'pages' => array('page'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Title',
  			'id' => $header_prefix . '-title',
  			'type' => 'text',					
  		),
  		array(
  			'name' => 'Content',
  			'id' => $header_prefix . '-content',
  			'type' => 'textarea'
  		),
  		array(
  		  'name' => 'Link Address',
  		  'id' => $header_prefix . '-link-address',
  		  'type' => 'text',
  		  'desc' => 'Remember http://'
  		),
  		array(
  		  'name' => 'Link Text',
  		  'id' => $header_prefix . '-link-text',
  		  'type' => 'text',
  		),
  		array(
  		  'name' => 'Video Headline',
  		  'id' => $header_prefix . '-video-headline',
  		  'type' => 'text',
  		)
  	)
  );
  
  $box_prefix = 'te_cases-box-text';
  
  $meta_boxes[] = array(
  	'id' => 'te_cases-box-text',
  	'title' => 'Box Text Options',
  	'pages' => array('page'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Title Line 1',
  			'id' => $box_prefix . '-title-line-1',
  			'type' => 'text',					
  		),
  		array(
  			'name' => 'Title Line 2',
  			'id' => $box_prefix . '-title-line-2',
  			'type' => 'text'
  		),
  		array(
  		  'name' => 'Content',
  		  'id' => $box_prefix . '-content',
  		  'type' => 'textarea',
  		),
  		array(
  		  'name' => 'Link Address',
  		  'id' => $box_prefix . '-link-address',
  		  'type' => 'text',
  		  'desc' => 'Remember http://'
  		),
  		array(
  		  'name' => 'Link Text',
  		  'id' => $box_prefix . '-link-text',
  		  'type' => 'text'
  		),
  		array(
  		  'name' => 'Bonus Sticker On/Off',
  		  'id' => $box_prefix . '-bonus-sticker',
  		  'type' => 'checkbox'
  		),
  		array(
  		  'name'  => 'Bonus Sticker Image',
  		  'id'    => $box_prefix . '-bonus-sticker-image',
  		  'type'  => 'image'
  		)
  	)
  );
  
	// Fetch all testimonials that has a video. This is handled by the meta_key parameter.
	$testemonial_posts = get_posts(array('numberposts'	=> -1, 'post_type'		=> 'te_testemonial', 'status' => 'publish', 'meta_key' => 'te_testemonial-video-id'));
	if(count($testemonial_posts) > 0) {
		$testemonials[''] = '';
		foreach($testemonial_posts as $key => $testemonial) {
			$testemonials[$testemonial->ID] = $testemonial->post_title;
		}
	}
  
  $testemonials_prefix = 'te_cases-testemonials';
  
  // This should be extended so any number of testemonials can be selected
  $meta_boxes[] = array(
   'id' => 'te_cases-videos',
   'title' => 'Video Testemonials',
   'pages' => array('page'),
   'context' => 'normal',
  
   'fields' => array(
     array(
       'name' => 'Testemonial 1',
       'id' => $testemonials_prefix . '-testemonial-1-id',
       'type' => 'select',
       'options' => $testemonials      
     ),
     array(
       'name' => 'Testemonial 2',
       'id' => $testemonials_prefix . '-testemonial-2-id',
       'type' => 'select',
       'options' => $testemonials      
     )
   )
  );

  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
}

?>