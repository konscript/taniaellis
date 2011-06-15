<?php

if(function_exists( 'register_nav_menus')) {
	register_nav_menus(array(
	    'navigation-top'        => 'Top Menu',
	    'navigation-pages'      => 'Page Menu',
	    'social-business-menu'  => 'Social Business Menu',
	    'club-menu'             => 'Club Menu'
	    )
	);
}

if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'				=> 'Right Sidebar',
		'before_widget'		=> '<div class="widget">',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h2>',
		'after´_title'		=> '</h2>',
	));
	register_sidebar(array(
		'name'				=> 'Left Sidebar',
		'before_widget'		=> '<div class="widget>"',
		'after_widget'		=> '</div>',
		'before_title'		=> '<h2>',
		'after´_title'		=> '</h2>',
	));
}

?>