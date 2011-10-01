<?php

function te_consulting_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
    
    $header_prefix = 'te_consulting-header-text';
    
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
    
    $box_prefix = 'te_consulting-box-text';
    
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
    
    $links_prefix = 'te_consulting-links';
  
  
  $meta_boxes[] = array(
     'id' => $links_prefix,
     'title' => 'Link Options: Four Corners of Social Business Consulting',
     'pages' => array('page'),
     'context' => 'normal',
  
     'fields' => array(
       array(
         'name' => 'Middle Text',
         'id' => $links_prefix . '-center-text',
         'type' => 'text',
         'desc' => 'This text will appear in the middle of the four links'
       ),
       array(
         'name' => 'Top Link Text',
         'id' => $links_prefix . '-top-link-text',
         'type' => 'text'
       ),
       array(
         'name' => 'Top Link URL',
         'id' => $links_prefix . '-top-link-url',
         'type' => 'text',
         'desc' => 'Remember http://'          
       ),

       array(
         'name' => 'Right Link Text',
         'id' => $links_prefix . '-right-link-text',
         'type' => 'text'
       ),
       array(
         'name' => 'Right Link URL',
         'id' => $links_prefix . '-right-link-url',
         'type' => 'text',
         'desc' => 'Remember http://'          
       ),

       array(
         'name' => 'Bottom Link Text',
         'id' => $links_prefix . '-bottom-link-text',
         'type' => 'text'
       ),
       array(
         'name' => 'Bottom Link URL',
         'id' => $links_prefix . '-bottom-link-url',
         'type' => 'text',
         'desc' => 'Remember http://'          
       ),
       
       array(
         'name' => 'Left Link Text',
         'id' => $links_prefix . '-left-link-text',
         'type' => 'text'
       ),
       array(
         'name' => 'Left Link URL',
         'id' => $links_prefix . '-left-link-url',
         'type' => 'text',
         'desc' => 'Remember http://'    
       )

     )
    );
  
  foreach($meta_boxes as $meta_box) {
      $my_box = new RW_Meta_Box($meta_box);
    }
}

?>