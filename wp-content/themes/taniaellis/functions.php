<?php

if(function_exists( 'register_nav_menus')) {
	register_nav_menus(
		array("navigation-top" => "Top Menu"),
		array("navigation-pages" => "Page Menu");
	);
}

function get_navigation_for_menu_location($location) {
	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object($locations[$location]);
	$term_id = $menu->term_id;
	
	$s = "";
	foreach((array) wp_get_nav_menu_items($term_id) as $key => $item) {
		$s .= '<a href="'.$item->url.'">'.$item->title.'</a>';
	}
	
	return $s;
}

?>