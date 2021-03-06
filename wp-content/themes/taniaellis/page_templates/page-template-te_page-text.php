<?php

function te_page_text_meta() {
  
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
 
 $meta_boxes[] = array(
   'id'        => 'te_page-text-lead-paragraph',
   'title'     => 'Top Options',
   'pages'     => array('page'),
   'context'   => 'normal',
   'priority'  => 'high',
   'fields'    => array(
     array(
      'name'  => 'Title: First line',
      'id'    => 'te_page-text-title-first-line',
      'type'  => 'text',
      'desc'  => 'First line of the page title'
     ),
     array(
       'name'  => 'Title: Second line',
       'id'    => 'te_page-text-title-second-line',
       'type'  => 'text',
       'desc'  => 'Second line of the page title'
      ),
     array(
       'name'  => 'Title Icon',
       'id'    => 'te_page-text-title-icon',
       'type'  => 'image',
       'desc'  => 'The icon that will be displayed beside the title'
      ),
     array(
       'name' => 'Lead Text',
       'id'   => 'te_page-text-lead-paragraph-text',
       'type' => 'textarea',
       'desc' => 'This text will be highlighted in bold right under page headline'
     ),
     array(
        'name' => 'Left Meta Text',
        'id'   => 'te_page-text-meta-left',
        'type' => 'text',
        'desc' => 'This text will shown above the headline to the left'
     ),
     array(
        'name' => 'Right Meta Text',
        'id'   => 'te_page-text-meta-right',
        'type' => 'text',
        'desc' => 'This text will shown above the headline to the right'
     ) 
   )
 );
 
 foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
}

 ?>