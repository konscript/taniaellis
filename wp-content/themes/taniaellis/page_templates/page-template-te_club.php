<?php

function te_club_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
  
  $header_prefix = 'te_club-header-text';
  
  $meta_boxes[] = array(
  	'id' => 'te_club-header-text',
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
  		  'name' => 'Left Pane First Line',
  		  'id' => $header_prefix . '-left-pane-first-line',
  		  'type' => 'text',
  		),
  		array(
  		  'name' => 'Left Pane Second Line',
  		  'id' => $header_prefix . '-left-pane-second-line',
  		  'type' => 'text',
  		)
  	)
  );
  
  $box_prefix = 'te_club-box-text';
  
  $meta_boxes[] = array(
  	'id' => 'te_club-box-text',
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
  
  $testemonial_query = new WP_Query('post_type=te_testemonial');
  if($testemonial_query->have_posts()) {
    while($testemonial_query->have_posts()) {
      $testemonial_query->the_post();
      
      //echo get_post_meta(get_the_ID(), 'te_testemonial-video-id', true);
      
      if(get_post_meta(get_the_ID(), 'te_testemonial-video-id', true)) {
        $testemonials[get_the_ID()] = get_the_title();
      }
    
    }
  }
  
  $testemonials_prefix = 'te_club-testemonials';
  
  // This should be extended so any number of testemonials can be selected
  $meta_boxes[] = array(
   'id' => 'te_club-videos',
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