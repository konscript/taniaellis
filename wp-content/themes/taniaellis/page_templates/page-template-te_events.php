<?php

function te_events_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
    
    $header_prefix = 'te_events-header-text';
    
		// Fetch all testimonials
		$testemonial_posts = get_posts(array('numberposts'	=> -1, 'post_type'		=> 'te_testemonial', 'status' => 'publish'));
		if(count($testemonial_posts) > 0) {
			$testemonials[''] = '';
			foreach($testemonial_posts as $key => $testemonial) {
				$testemonials[$testemonial->ID] = $testemonial->post_title;
			}
		}
        
    $meta_boxes[] = array(
     'id' => $header_prefix,
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
        'name' => 'Testemonial',
        'id' => $header_prefix . '-testemonial',
        'type' => 'select',
        'options' => $testemonials
       )
     )
    );
    
    $box_prefix = 'te_events-box-text';
    
    $meta_boxes[] = array(
     'id' => $box_prefix,
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
  
    foreach($meta_boxes as $meta_box) {
      $my_box = new RW_Meta_Box($meta_box);
    }
}

?>