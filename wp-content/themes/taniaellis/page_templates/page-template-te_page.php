<?php

function te_page_meta() {
  
	$meta_boxes[] = array(
		'id'			=> 'te_page-menu',
		'title'		=> 'Page Menu',
		'pages'		=> array('page'),
		'context'	=> 'normal',
		'low'  => 'high',
		'fields'	=> array(
			array(
				'name'		=> 'Menu',
				'id'			=> 'te_page-menu-id',
				'type'		=> 'select',
				'options'	=> get_menus()
			)
		)
	);
	
	$meta_boxes[] = array(
		'id'			  => 'te_page-lead-paragraph',
		'title'	  	=> 'Lead Paragraph',
		'pages'		  => array('page'),
		'context'	  => 'normal',
		'priority'  => 'high',
		'fields'	  => array(
  			array(
  				'name'		=> 'Text',
  				'id'			=> 'te_page-lead-paragraph-text',
  				'type'		=> 'textarea',
  				'desc'    => 'This text will be highlighted in bold right under page headline'
  			)
		)
	);
	
	foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
}

?>