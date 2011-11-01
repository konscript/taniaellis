<?php

function te_tv_interviews_meta() {
  
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
  
  $meta_boxes[] = array(
    'id'      => 'te_page-text-menu',
    'title'   => 'Page Menu',
    'pages'   => array('page'),
    'context' => 'normal',
    'low'  => 'high',
    'fields'  => array(
      array(
        'name'    => 'Menu',
        'id'      => 'te_page-text-menu-id',
        'type'    => 'select',
        'options' => get_menus()
      )
    )
  );
 
 $prefix = 'te_page-tv-interviews';
 
 $meta_boxes[] = array(
   'id'        => $prefix,
   'title'     => 'Top Options',
   'pages'     => array('page'),
   'context'   => 'normal',
   'priority'  => 'high',
   'fields'    => array(
     array(
      'name'  => 'Title: First line',
      'id'    => $prefix . '-first-line',
      'type'  => 'text',
      'desc'  => 'First line of the page title'
     ),
     array(
       'name'  => 'Title: Second line',
       'id'    => $prefix . '-second-line',
       'type'  => 'text',
       'desc'  => 'Second line of the page title'
      ),
     array(
       'name' => 'Lead Text',
       'id'   => $prefix . '-lead-paragraph-text',
       'type' => 'textarea',
       'desc' => 'This text will be highlighted in bold right under page headline'
     )
   )
 );
 
  foreach($meta_boxes as $meta_box) {
      $my_box = new RW_Meta_Box($meta_box);
    }
}

?>