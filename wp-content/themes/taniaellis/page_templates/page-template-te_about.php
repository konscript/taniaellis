<?php

function te_about_meta() {
  add_theme_support('post-thumbnails', array('page'));
  
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
  
  $header_prefix = 'te_about-header-text';
  
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
  		)
  	)
  );
  
  $box_prefix = 'te_about-box-text';
  
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
  
  
  for($i = 1; $i < 5; $i++) { 
    
    $box_prefix = 'te_about-key-service-' . $i;
    
    $meta_boxes[] = array(
     'id' => $box_prefix,
     'title' => 'Key Service ' . $i . ' Options',
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
         'name'     => 'Color',
         'id'       => $box_prefix . '-color',
         'type'     => 'select',
         'options'  => array(
            'green'   => 'Green',
            'purple'  => 'Purple',
            'blue'    => 'Blue',
            'brown'   => 'Brown'
         )
       ),
       array(
         'name' => 'Content',
         'id' => $box_prefix . '-content',
         'type' => 'textarea',
       ),
       array(
         'name'  => 'Bullet 1',
         'id'    => $box_prefix . '-bullet-' . 1,
         'type'  => 'text'
       ),
       array(
         'name'  => 'Bullet 2',
         'id'    => $box_prefix . '-bullet-' . 2,
         'type'  => 'text'
       ),
       array(
         'name'  => 'Bullet 3',
         'id'    => $box_prefix . '-bullet-' . 3,
         'type'  => 'text'
       ),
       array(
         'name'  => 'Bullet 4',
         'id'    => $box_prefix . '-bullet-' . 4,
         'type'  => 'text'
       ),
       array(
         'name'  => 'Bullet 5',
         'id'    => $box_prefix . '-bullet-' . 5,
         'type'  => 'text'
       ),
       array(
         'name' => 'Read More Address',
         'id' => $box_prefix . '-link-address',
         'type' => 'text',
         'desc' => 'Remember http://'
       ),
       array(
         'name' => 'Read More Text',
         'id' => $box_prefix . '-link-text',
         'type' => 'text'
       )
     )
    );
  }

  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
}

?>