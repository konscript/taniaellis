<?php

function te_lectures_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
    
    $header_prefix = 'te_lectures-header-text';
    
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
       )
     )
    );
    
  $bullets_prefix = 'te_lectures-bullets';
  
  $meta_boxes[] = array(
     'id' => $bullets_prefix,
     'title' => 'Link Options: Four Corners of Social Business Consulting',
     'pages' => array('page'),
     'context' => 'normal',
  
     'fields' => array(
       array(
         'name' => 'Bullet 1',
         'id' => $bullets_prefix . '-bullet-1',
         'type' => 'text',
       ),
       array(
         'name' => 'Bullet 2',
         'id' => $bullets_prefix . '-bullet-2',
         'type' => 'text'
       ),
       array(
         'name' => 'Bullet 3',
         'id' => $bullets_prefix . '-bullet-3',
         'type' => 'text',
       ),

       array(
         'name' => 'Bullet 4',
         'id' => $bullets_prefix . '-bullet-4',
         'type' => 'text'
       ),
       array(
         'name' => 'Bullet 5',
         'id' => $bullets_prefix . '-bullet-5',
         'type' => 'text',
       )
      )
    );
  
  foreach($meta_boxes as $meta_box) {
      $my_box = new RW_Meta_Box($meta_box);
    }
}

?>