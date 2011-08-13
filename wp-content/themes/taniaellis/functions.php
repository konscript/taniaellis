<?php
include('meta-box.php');

add_theme_support('post-thumbnails', array('post', 'te_event', 'te_article', 'te_testemonial'));
set_post_thumbnail_size(100, 100, true); // Normal post thumbnails
add_image_size('post-square-thumbnail', 100, 100, true);
add_image_size('post-tall-thumbnail', 62, 116, true);
add_image_size('post-wide-thumbnail', 240, 100, true);
add_image_size('post-wide-image', 524, 218, true);

if(function_exists( 'register_nav_menus')) {
	register_nav_menus(array(
	    'navigation-top'        => 'Top Menu',
	    'navigation-pages'      => 'Page Menu',
	    'social-business-menu'  => 'Social Business Menu',
	    'club-menu'             => 'Club Menu',
		  'blog-menu'				      => 'Blog Menu',
		  'reading-room-menu'     => 'Reading Room Menu'
	    )
	);
}

if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'				=> 'Right Sidebar',
		'before_widget'		=> '',
		'after_widget'		=> '',
		'before_title'		=> '',
		'after´_title'		=> '',
	));
	register_sidebar(array(
		'name'				=> 'Left Sidebar',
		'before_widget'		=> '',
		'after_widget'		=> '',
		'before_title'		=> '',
		'after´_title'		=> '',
	));
}
/*
******************************
* REGISTER CUSTOM POST TYPES *
******************************
*/

add_action('init', 'article_register');
add_action('init', 'event_register');
add_action('admin_head', 'change_custom_post_type_icons');

function change_custom_post_type_icons() {
  ?>
  <style type="text/css" media="screen">
    #menu-posts-portfolio .wp-menu-image {
        background: url(<?php bloginfo('template_url') ?>/images/portfolio-icon.png) no-repeat 6px 6px !important;
      }
      #menu-posts-portfolio:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
        background-position:6px -16px !important;
      }
      #icon-edit.icon32-posts-te_article {
        background: url(<?php bloginfo('template_url') ?>/images/post_type_icon_books.png) no-repeat;
      }
  </style>
  <?php
}

// Change the "Scheduled for" text on Event post types changing the translation
// http://blog.ftwr.co.uk/archives/2010/01/02/mangling-strings-for-fun-and-profit/
function translation_mangler($translation, $text, $domain) {
        global $post;
    if ($post->post_type == 'te_event') {
 
        $translations = &get_translations_for_domain( $domain);
        if ( $text == 'Scheduled for: <b>%1$s</b>') {
            return $translations->translate( 'Event Date: <b>%1$s</b>' );
        }
        if ( $text == 'Published on: <b>%1$s</b>') {
            return $translations->translate( 'Event Date: <b>%1$s</b>' );
        }
        if ( $text == 'Publish <b>immediately</b>') {
            return $translations->translate( 'Event Date: <b>%1$s</b>' );
        }
    }
 
    return $translation;
}
 
add_filter('gettext', 'translation_mangler', 10, 4);

function event_register() {
	$args = array(
		'labels'				=> array(
			'name'					=> _x('Events', 'post type general name'),
			'singular_name'			=> _x('Event', 'post type singular name'),
			'add_new'				=> _x('Add New', 'event'),
			'add_new_item'			=> __('Add New Event'),
			'edit_item'				=> __('Edit Event'),
			'new_item'				=> __('New Event'),
			'view_item'				=> __('View Event'),
			'search_items'			=> __('Search Event'),
			'not_found'				=> __('Nothing found'),
			'not_found_in_trash'	=> __('Nothing found in Trash'),
			'parent_item_colon'		=> ''
		),
		'public'				=> true,
		'publicly_queryable'	=> true,
		'show_ui'				=> true,
		'query_var'				=> true,
		'menu_position'			=> 5,
		'menu_icon'				=> get_stylesheet_directory_uri() . '/images/icon_event.gif',
		'rewrite'				=> array('slug' => 'events', 'with_front' => false),
		'capability_type'		=> 'post',
		'herarchical'			=> false,
		'supports'				=> array(
			'title',
			'excerpt',
			'editor',
			'thumbnail',
			'comments'
		),
		'register_meta_box_cb'	=> 'add_events_metaboxes'
	);
	
	register_post_type('te_event', $args);
}

te_event_meta();

function te_event_meta() {
  
  $video_query = new WP_Query('post_type=te_video');
  if($video_query->have_posts()) {
    $videos[''] = '';
    while($video_query->have_posts()) {
      $video_query->the_post();
      $videos[get_the_ID()] = get_the_title();
    }
  }
  
  wp_reset_query();
  
  $prefix = 'te_event-options';
  
  $meta_boxes[] = array(
    'id' => $prefix,
  	'title' => 'Event Options',
  	'pages' => array('te_event'),
  	'context' => 'side',
  	'priority' => 'low',

  	'fields' => array(
  		array(
  			'name' => 'Start Date',
  			'id' => $prefix . '-start-date',
  			'type' => 'date',					
  		),
  		array(
  			'name' => 'Start Time',
  			'id' => $prefix . '-start-time',
  			'type' => 'text',
  			'desc' => 'Format: hh:mm'					
  		),
  		array(
  			'name' => 'End Date',
  			'id' => $prefix . '-end-date',
  			'type' => 'date',					
  		),
  		array(
  			'name' => 'End Time',
  			'id' => $prefix . '-end-time',
  			'type' => 'text',
  			'desc' => 'Format: hh:mm'					
  		)
  	)
  );
  
  $video_prefix = 'te_event-video-options';
  
  $meta_boxes[] = array(
    'id' => $video_prefix,
   'title' => 'Video Options',
   'pages' => array('te_event'),
   'context' => 'side',
   'priority' => 'low',
  
   'fields' => array(
     array(
       'name' => 'Vimeo',
       'id' => $video_prefix . '-video',
       'type' => 'select',
       'options' => $videos,
       'desc' => 'Select blank option if no vimeo should be attached'         
     )
   )
  );
  
  $attachments_prefix = 'te_event-attachments';
  
  $meta_boxes[] = array(
   'id' => $attachments_prefix,
   'title' => 'Attachments',
   'pages' => array('te_event'),
   'context' => 'side',
   'priority' => 'low',
  
   'fields' => array(
     array(
       'name' => 'Attachment',
       'id' => $attachments_prefix . '-id',
       'type' => 'file',
       'desc' => 'Can be used to upload eg. an <br> event programme'
     )
   )
  );
  
  
  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }

}

function article_register() {

  $labels = array(
		'name' => _x('Articles', 'post type general name'),
		'singular_name' => _x('Article', 'post type singular name'),
		'add_new' => _x('Add New', 'article'),
		'add_new_item' => __('Add New Article'),
		'edit_item' => __('Edit Article'),
		'new_item' => __('New Article'),
		'view_item' => __('View Article'),
		'search_items' => __('Search Article'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
	
	$args = array(
	  '_builtin' => false,
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 5,
		'_builtin' => false, // It's a custom post type, not built in!
		'menu_icon' => get_stylesheet_directory_uri() . '/images/icon_article.png',
		'rewrite' => array('slug' => 'articles', 'with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title', 'editor', 'thumbnail', 'comments')
	  );
	  
	  register_post_type('te_article', $args);
}

add_action('init', 'create_article_taxonomies');

function create_article_taxonomies() {
  $te_article_category_labels = array(
    'name'                => _x('Article Categories', 'taxonomy general name'),
    'singular_name'       => _x('Article Category', 'taxonomy singular name'),
    'search_items'        => __('Search Categories'),
    'popular_items'       => __('Popular Categories'),
    'all_items'           => __('All Categories'),
    'parent_item'         => __('Parent Category'),
    'parent_item_colon'   => __('Parent Category:'),
    'edit_item'           => __('Edit Category'),
    'update_item'         => __('Update Category'),
    'add_new_item'        => __('Add New Category'),
    'new_item_name'       => __('New Category Name')  
  );
  
  $te_article_category_args = array(
    'labels'            => $te_article_category_labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'show_tagcloud'     => true,
    'hierarchical'      => true,
    'rewrite'           => array('slug' => 'article-categories', 'with_front' => false),
    '_builtin'          => false
  );
  
  register_taxonomy('te_article-category', 'te_article', $te_article_category_args);
  
  $te_article_tag_labels = array(
    'name'                  => _x('Article Tags', 'taxonomy general name'),
    'singular_name'         => _x('Article Tag', 'taxonomy singular name'),
    'search_items'          => __('Search Tags'),
    'popular_items'         => __('Popular Tags'),
    'all_items'             => __('All Tags'),
    'parent_item'           => __('Parent Tags'),
    'parent_item_colon'     => __('Parent Tags:'),
    'edit_item'             => __('Edit Tag'),
    'update_item'           => __('Update Tag'),
    'add_new_item'          => __('Add New Tag'),
    'new_item_name'         => __('New Tag Name'),
    'add_or_remove_items'   => __('Add or remove tags'),
    'choose_from_most_used' => __('Choose from most used tags')
  );
  
  $te_article_tag_args = array(
    'labels'            => $te_article_tag_labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'show_tagcloud'     => true,
    'hierarchical'      => false,
    'rewrite'           => array('slug' => 'article-tags', 'with_front' => false),
    '_builtin'          => false
  );
  
  register_taxonomy('te_article-tag', 'te_article', $te_article_tag_args);
  
}

/* ADD CUSTOM FIELDS TO ARTICLE POST TYPE */

add_action("admin_init", "admin_init");
add_action('save_post', 'save_te_article_details');
 
function admin_init() {
  add_meta_box("te_article-url", "Article Options", "te_article_options", "te_article", "side", "low");
}
 
function te_article_options() {
  global $post;
  $custom = get_post_custom($post->ID);
  $te_article_url = $custom["te_article_url"][0];
  $te_article_date = $custom["te_article_date"][0];
  $te_article_author = $custom["te_article_author"][0];
  ?>
  <label for="te_article_author">Article Author:</label>
  <input id="te_article_author" name="te_article_author" value="<?php echo $te_article_author; ?>" />
  <label for="te_article_url">Article URL:</label>
  <input id="te_article_url" name="te_article_url" value="<?php echo $te_article_url; ?>" />
  <label for="te_article_date">Article date:</label>
  <input id="te_article_date" name="te_article_date" value="<?php echo $te_article_date; ?>" />
  <?php
}


/* Save meta data. Should probably have some security options added.*/ 
function save_te_article_details() {
  global $post;
  
  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
    return;
  
  update_post_meta($post->ID, "te_article_author", $_POST["te_article_author"]);  
  update_post_meta($post->ID, "te_article_url", $_POST["te_article_url"]);
  update_post_meta($post->ID, "te_article_date", $_POST["te_article_date"]);
}

/** 
  Returns the link to an article. If there is no article
  directly attached to the given post, the link set in
  the admin interface will be returned. If there is no
  attachment and no link set, returns the permalink
**/
function te_get_article_url($post_id) {
  $args = array(
   'post_type' => 'attachment',
   'numberposts' => null,
   'post_status' => null,
   'post_parent' => $post_id
  );
  
  $attachments = get_posts($args);
  
  $article_url = get_post_meta($post_id, 'te_article_url', true);
  
  // If there is no thumbnail but one attatchment, link to that attachment
  if(!has_post_thumbnail($post_id) && count($attachments) == 1) {
    $article_url = wp_get_attachment_url($attachments[0]->ID);
  } else if(has_post_thumbnail($post_id) && count($attachments) > 1) { // If there is a thumbnail and an attachment, link to the attachment
    foreach ($attachments as $key => $attachment) {
      if($attachment->ID != get_post_thumbnail_id($post_id)) {
        $article_url = wp_get_attachment_url($attachment->ID);
      }
    }
  } else if(isset($article_url) && $article_url != "" ){ // If none of the above, there are no attachments. Get the link set in admin interface
    $article_url = get_post_meta($post_id, 'te_article_url', true);
  } else { // This is unlikely to happen. If there are no attachments and no link is set, redirect to the permalink
    $article_url = get_permalink($post_id);
  }
  
  return $article_url;
}

/**  
  Gets the article author, as set from the 
  admin interface. Returns the_author if
  none has been set.
**/
function te_get_article_author($post_id) {
  $article_author = get_post_meta($post_id, 'te_article_author', true);
  
  // Check if the author is null. Not likely. The is_null function for some reason does not provide an answer to this.
  if($article_author == null) {
    return 'By ' . get_the_author($post_id);
  }
  
  // Determine whether an author has been set. Return current user if not.
  if(isset($article_author) && $article_author != "") {
    return $article_author;
  } else {
    return 'By ' . get_the_author($post_id);
  }
}


/**
  Gets the article date, as set from the
  admin interface. Returns get_the_time(F j, Y)
  if none has been set.
**/
function te_get_article_date($post_id) {
  $article_date = get_post_meta($post_id, 'te_article_date', true);
  
  if($article_date == null) {
    return get_the_time('F j, Y', $post_id);
  }
  
  // Determine whether a date has been set. Echo publish date if not.
  if(isset($article_date) && $article_date != "") {
    return $article_date;
  } else {
    return get_the_time('F j, Y', $post_id);
  }
}

/**
##########################
# CREATE VIDEO POST TYPE #
##########################
**/
add_action('init', 'video_register');

function video_register() {

  $labels = array(
		'name' => _x('Videos', 'post type general name'),
		'singular_name' => _x('Video', 'post type singular name'),
		'add_new' => _x('Add New', 'video'),
		'add_new_item' => __('Add New Video'),
		'edit_item' => __('Edit Video'),
		'new_item' => __('New Video'),
		'view_item' => __('View Video'),
		'search_items' => __('Search Videos'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
	
	$args = array(
	  '_builtin' => false,
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 5,
		'_builtin' => false, // It's a custom post type, not built in!
		'menu_icon' => get_stylesheet_directory_uri() . '/images/icon_video.png',
		'rewrite' => array('slug' => 'videos', 'with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title')
	  );
	  
	  register_post_type('te_video', $args);
}

add_action('init', 'create_video_taxonomies');
function create_video_taxonomies() {
  $te_video_category_labels = array(
    'name'                => _x('Video Categories', 'taxonomy general name'),
    'singular_name'       => _x('Video Category', 'taxonomy singular name'),
    'search_items'        => __('Search Categories'),
    'popular_items'       => __('Popular Categories'),
    'all_items'           => __('All Categories'),
    'parent_item'         => __('Parent Category'),
    'parent_item_colon'   => __('Parent Category:'),
    'edit_item'           => __('Edit Category'),
    'update_item'         => __('Update Category'),
    'add_new_item'        => __('Add New Category'),
    'new_item_name'       => __('New Category Name')  
  );
  
  $te_video_category_args = array(
    'labels'            => $te_video_category_labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'show_tagcloud'     => true,
    'hierarchical'      => true,
    'rewrite'           => array('slug' => 'video-categories', 'with_front' => false),
    '_builtin'          => false
  );
  
  register_taxonomy('te_video-category', 'te_video', $te_video_category_args);
  
  $te_article_tag_labels = array(
    'name'                  => _x('Video Tags', 'taxonomy general name'),
    'singular_name'         => _x('Video Tag', 'taxonomy singular name'),
    'search_items'          => __('Search Tags'),
    'popular_items'         => __('Popular Tags'),
    'all_items'             => __('All Tags'),
    'parent_item'           => __('Parent Tags'),
    'parent_item_colon'     => __('Parent Tags:'),
    'edit_item'             => __('Edit Tag'),
    'update_item'           => __('Update Tag'),
    'add_new_item'          => __('Add New Tag'),
    'new_item_name'         => __('New Tag Name'),
    'add_or_remove_items'   => __('Add or remove tags'),
    'choose_from_most_used' => __('Choose from most used tags')
  );
  
  $te_video_tag_args = array(
    'labels'            => $te_article_tag_labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_ui'           => true,
    'show_tagcloud'     => true,
    'hierarchical'      => false,
    'rewrite'           => array('slug' => 'video-tags', 'with_front' => false),
    '_builtin'          => false
  );
  
  register_taxonomy('te_video-tag', 'te_video', $te_video_tag_args);
}

te_video_meta();

function te_video_meta() {
  $meta_boxes[] = array(
  	'id' => 'te_video-options',
  	'title' => 'Video Options',
  	'pages' => array('te_video'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Vimeo URL',
  			'id' => 'te_video_url',
  			'type' => 'text',					
  		)
  	)
  );
  
  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
  
}

function te_vimeo_video($url, $width, $height) {
  $pattern = "/[0-9]*$/";
  preg_match_all($pattern, $url, $matches);
  //print_r($matches[0][0]);
  $video_id = $matches[0][0];

  return '<iframe src="http://player.vimeo.com/video/'. $video_id .'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0" width="' . $width . '" height="' . $height . '" frameborder="0"></iframe>';
}

/**
#########################
# CREATE CASE POST TYPE #
#########################
**/
add_action('init', 'case_register');

function case_register() {

  $labels = array(
		'name' => _x('Cases', 'post type general name'),
		'singular_name' => _x('Case', 'post type singular name'),
		'add_new' => _x('Add New', 'case'),
		'add_new_item' => __('Add New Case'),
		'edit_item' => __('Edit Case'),
		'new_item' => __('New Case'),
		'view_item' => __('View Case'),
		'search_items' => __('Search Case'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
	
	$args = array(
	  '_builtin' => false,
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 5,
		'_builtin' => false, // It's a custom post type, not built in!
	  'menu_icon' => get_stylesheet_directory_uri() . '/images/icon_article.png',
		'rewrite' => array('slug' => 'cases', 'with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title', 'editor', 'thumbnail')
	  );
	  
	  register_post_type('te_case', $args);
}


/**
################################
# CREATE TESTEMONIAL POST TYPE #
################################
**/
add_action('init', 'testemonial_register');

function testemonial_register() {

  $labels = array(
   'name' => _x('Testemonials', 'post type general name'),
   'singular_name' => _x('Testemonial', 'post type singular name'),
   'add_new' => _x('Add New', 'testemonial'),
   'add_new_item' => __('Add New Testemonial'),
   'edit_item' => __('Edit Testemonial'),
   'new_item' => __('New Testemonial'),
   'view_item' => __('View Testemonial'),
   'search_items' => __('Search Testemonial'),
   'not_found' =>  __('Nothing found'),
   'not_found_in_trash' => __('Nothing found in Trash'),
   'parent_item_colon' => ''
 );
 
 $args = array(
   'labels' => $labels,
   'public' => true,
   'publicly_queryable' => true,
   'show_ui' => true,
   'query_var' => true,
   'menu_position' => 5,
   '_builtin' => false, // It's a custom post type, not built in!
   'menu_icon' => get_stylesheet_directory_uri() . '/images/icon_quotes.png',
   'rewrite' => array('slug' => 'testemonials', 'with_front' => false),
   'capability_type' => 'post',
   'hierarchical' => false,
   'supports' => array('thumbnail', 'title', 'editor')
   );
   
   register_post_type('te_testemonial', $args);
}

/* ADD CUSTOM FIELDS TO TESTEMONIAL POST TYPE */
te_testemonial_add_meta_box();

function te_testemonial_add_meta_box() {
  add_action('init', function() { remove_post_type_support('te_testemonial', 'editor'); });
  
  $video_query = new WP_Query('post_type=te_video');
  if($video_query->have_posts()) {
    $videos[''] = '';
    while($video_query->have_posts()) {
      $video_query->the_post();
      $videos[get_the_ID()] = get_the_title();
    }
  }
  
  wp_reset_query();
  
  $case_query = new WP_Query('post_type=te_case');
  if($case_query->have_posts()) {
    $cases[''] = '';
    while($case_query->have_posts()) {
      $case_query->the_post();
      $cases[get_the_ID()] = get_the_title();
    }
  }
  
  wp_reset_query();
  
  $event_query = new WP_Query('post_type=te_event');
  if($case_query->have_posts()) {
    $events[''] = '';
    while($event_query->have_posts()) {
      $event_query->the_post();
      $events[get_the_ID()] = get_the_title();
    }
  }
  
  $prefix = 'te_testemonial';
  
  $te_testemonial_meta_box = array(
  	'id' => 'te_testemonial-meta',
  	'title' => 'Testemonial Options',
  	'pages' => array('te_testemonial'),

  	'fields' => array(
  		array(
  			'name' => 'Testemonial Author',
  			'id' => $prefix . '-author',
  			'type' => 'text',	
  		),
  		array(
  			'name' => 'Testemonial Date',
  			'id' => $prefix . '-date',
  			'type' => 'date'
  		),
  		array(
  		  'name' => 'Author URL',
  			'id' => $prefix . '-author-url',
  			'type' => 'text',
  			'desc' => 'Author website. Remember http://'
  		),
  		array(
  		  'name' => 'Author URL text',
  			'id' => $prefix . '-author-url-text',
  			'type' => 'text',
  			'desc' => 'Link text'
  		),
  		array(
  		  'name' => 'Vimeo',
  		  'id' => $prefix . '-video-id',
  		  'desc' => 'Select the blank option if no vimeo should be attached',
  		  'type' => 'select',
  		  'options' => $videos
  		),
  		array(
  		  'name' => 'Case',
  		  'id' => $prefix . '-case-id',
  		  'desc' => 'Case to attach. Select blank option if no case should be attached',
  		  'type' => 'select',
  		  'options' => $cases
  		), 
  		array(
  		  'name' => 'Event',
  		  'id' => $prefix . '-event-id',
  		  'desc' => 'Event to attach. Select blank option if no event should be attached',
  		  'type' => 'select',
  		  'options' => $events
  		),
  		array(
  		  'name' => 'Testemonial',
  		  'id' => $prefix . '-testemonial-text',
  		  'type' => 'textarea'
  		)
  	)
  );
  
  $testemonial_box = new RW_Meta_Box($te_testemonial_meta_box);
}

/**
###################################
# ADD META BOXES TO PAGE TEMPLATE #
###################################
**/

te_page_template_meta_boxes();

function te_page_template_meta_boxes() {
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	
	$page_template = get_post_meta($post_id, '_wp_page_template', true);
	
  switch ($page_template) {
    case 'readingroom.php':
      te_reading_room_meta();
      break;    
    case 'club.php':
      te_club_meta();
      break;
    case 'consulting.php':
      te_consulting_meta();
      break;
    case 'lectures.php':
      te_lectures_meta();
      break;
    case 'events.php':
      te_events_meta();
      break;
    case 'lab.php':
      te_lab_meta();
      break;
    case 'home.php':
      te_home_meta(); 
    default:
      break;
  }
}



function te_reading_room_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
  
  $header_prefix = 'te_reading-room-header-text';
  
  $meta_boxes[] = array(
  	'id' => 'te_reading-room-header-text',
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
  
  $box_prefix = 'te_reading-room-box-text';
  
  $meta_boxes[] = array(
  	'id' => 'te_reading-room-box-text',
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

  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
}


function te_home_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
  
  $video_query = new WP_Query('post_type=te_video');
  if($video_query->have_posts()) {
    $videos[''] = '';
    while($video_query->have_posts()) {
      $video_query->the_post();
      $videos[get_the_ID()] = get_the_title();
    }
  }
  
  $header_prefix = 'te_home-header-text';
  
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
  		  'name' => 'Header Vimeo',
  		  'id' => $header_prefix . '-video',
  		  'type' => 'select',
  		  'options' => $videos
  		)
  	)
  );
  
  $box_prefix = 'te_home-box-text';
  
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

  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
}

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


function te_events_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
    
    $header_prefix = 'te_events-header-text';
    
    $testemonial_query = new WP_Query('post_type=te_testemonial');
    if($testemonial_query->have_posts()) {
      while($testemonial_query->have_posts()) {
        $testemonial_query->the_post();
        $testemonials[get_the_ID()] = get_the_title();
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
       )
     )
    );
  
    foreach($meta_boxes as $meta_box) {
      $my_box = new RW_Meta_Box($meta_box);
    }
}

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


function te_lab_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
  
  $header_prefix = 'te_lab-header-text';
  
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
  
  $box_prefix = 'te_lab-box-text';
  
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
  
  $roller_1_prefix = 'te_lab-roller-1';
  
  $meta_boxes[] = array(
  	'id' => $roller_1_prefix,
  	'title' => 'Fading Boxes: 1',
  	'pages' => array('page'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Title Line 1',
  			'id' => $roller_1_prefix . '-title-line-1',
  			'type' => 'text',					
  		),
  		array(
  			'name' => 'Title Line 2',
  			'id' => $roller_1_prefix . '-title-line-2',
  			'type' => 'text'
  		),
  		array(
  		  'name' => 'Content',
  		  'id' => $roller_1_prefix . '-content',
  		  'type' => 'textarea',
  		),
  		array(
  		  'name' => 'Link Address',
  		  'id' => $roller_1_prefix . '-link-address',
  		  'type' => 'text',
  		  'desc' => 'Remember http://'
  		),
  		array(
  		  'name' => 'Link Text',
  		  'id' => $roller_1_prefix . '-link-text',
  		  'type' => 'text'
  		)
  	)
  );
  
  $roller_2_prefix = 'te_lab-roller-2';
  
  $meta_boxes[] = array(
  	'id' => $roller_2_prefix,
  	'title' => 'Fading Boxes: 2',
  	'pages' => array('page'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Title Line 1',
  			'id' => $roller_2_prefix . '-title-line-1',
  			'type' => 'text',					
  		),
  		array(
  			'name' => 'Title Line 2',
  			'id' => $roller_2_prefix . '-title-line-2',
  			'type' => 'text'
  		),
  		array(
  		  'name' => 'Content',
  		  'id' => $roller_2_prefix . '-content',
  		  'type' => 'textarea',
  		),
  		array(
  		  'name' => 'Link Address',
  		  'id' => $roller_2_prefix . '-link-address',
  		  'type' => 'text',
  		  'desc' => 'Remember http://'
  		),
  		array(
  		  'name' => 'Link Text',
  		  'id' => $roller_2_prefix . '-link-text',
  		  'type' => 'text'
  		)
  	)
  );
  
  $roller_3_prefix = 'te_lab-roller-3';  
  
  $meta_boxes[] = array(
  	'id' => $roller_3_prefix,
  	'title' => 'Fading Boxes: 3',
  	'pages' => array('page'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Title Line 1',
  			'id' => $roller_3_prefix . '-title-line-1',
  			'type' => 'text',					
  		),
  		array(
  			'name' => 'Title Line 2',
  			'id' => $roller_3_prefix . '-title-line-2',
  			'type' => 'text'
  		),
  		array(
  		  'name' => 'Content',
  		  'id' => $roller_3_prefix . '-content',
  		  'type' => 'textarea',
  		),
  		array(
  		  'name' => 'Link Address',
  		  'id' => $roller_3_prefix . '-link-address',
  		  'type' => 'text',
  		  'desc' => 'Remember http://'
  		),
  		array(
  		  'name' => 'Link Text',
  		  'id' => $roller_3_prefix . '-link-text',
  		  'type' => 'text'
  		)
  	)
  );

  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
}

// Hide some of the unused wp widgets
function hide_wp_widgets() {
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Archives');
}

add_action('widgets_init','hide_wp_widgets', 1);
?>