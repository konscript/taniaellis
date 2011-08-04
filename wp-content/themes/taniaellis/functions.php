<?php
include('meta-box.php');

add_theme_support('post-thumbnails', array('post', 'te_event', 'te_article'));
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

// Show Scheduled Posts
 
function show_scheduled_posts($posts) {
   global $wp_query, $wpdb;
   if(is_single() && $wp_query->post_count == 0) {
      $posts = $wpdb->get_results($wp_query->request);
   }
   return $posts;
}
 
add_filter('the_posts', 'show_scheduled_posts');

// Add the Events Meta Boxes
 
function add_events_metaboxes() {
    add_meta_box('devinsays_events_date', 'End Date', 'devinsays_events_date', 'te_event', 'side', 'default');
}
 
// The Event Date Metabox
 
function devinsays_events_date() {
    global $post, $wp_locale;
 
    // Use nonce for verification ... ONLY USE ONCE!
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
    $time_adj = current_time('timestamp');
 
    $month = get_post_meta($post->ID, '_month', true);
 
    if ( empty($month) ) {
        $month = gmdate( 'm', $time_adj );
    }
 
    $day = get_post_meta($post->ID, '_day', true);
 
    if ( empty($day) ) {
        $day = gmdate( 'd', $time_adj );
    }
 
    $year = get_post_meta($post->ID, '_year', true);
 
    if ( empty($year) ) {
        $year = gmdate( 'Y', $time_adj );
    }
 
    $hour = get_post_meta($post->ID, '_hour', true);
 
    if ( empty($hour) ) {
        $hour = gmdate( 'H', $time_adj );
    }
 
    $min = get_post_meta($post->ID, '_minute', true);
 
    if ( empty($min) ) {
        $min = '00';
    }
 
    $month_s = "<select name=\"_month\">\n";
    for ( $i = 1; $i < 13; $i = $i +1 ) {
        $month_s .= "\t\t\t" . '<option value="' . zeroise($i, 2) . '"';
        if ( $i == $month )
            $month_s .= ' selected="selected"';
        $month_s .= '>' . $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) ) . "</option>\n";
    }
    $month_s .= '</select>';
 
    echo $month_s;
 
    echo '<input type="text" name="_day" value="' . $day  . '" size="2" maxlength="2" />';
    echo '<input type="text" name="_year" value="' . $year . '" size="4" maxlength="4" /> @ ';
    echo '<input type="text" name="_hour" value="' . $hour . '" size="2" maxlength="2"/>:';
    echo '<input type="text" name="_minute" value="' . $min . '" size="2" maxlength="2" />';
 
}

// Save the Metabox Data
 
function devinsays_save_events_meta($post_id, $post) {
 
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
        return $post->ID;
    }
 
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;
 
    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.
 
    $events_meta['_month'] = $_POST['_month'];
    $events_meta['_day'] = $_POST['_day'];
        if($_POST['_hour']<10){
             $events_meta['_hour'] = '0'.$_POST['_hour'];
         } else {
               $events_meta['_hour'] = $_POST['_hour'];
         }
    $events_meta['_year'] = $_POST['_year'];
    $events_meta['_hour'] = $_POST['_hour'];
    $events_meta['_minute'] = $_POST['_minute'];
    $events_meta['_eventtimestamp'] = $events_meta['_year'] . $events_meta['_month'] . $events_meta['_day'] . $events_meta['_hour'] . $events_meta['_minute'];
 
    // Add values of $events_meta as custom fields
 
    foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
 
}
 
add_action('save_post', 'devinsays_save_events_meta', 1, 2); // save the custom fields

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
		'rewrite'				=> array('slug' => 'event', 'with_front' => false),
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

/* ADD CUSTOM FIELDS TO VIDEO POST TYPE */

add_action("admin_init", "te_video_add_meta_box");
add_action('save_post', 'save_te_video_details');
 
function te_video_add_meta_box() {
  add_meta_box("te_video-url", "Video Options", "te_video_options", "te_video", "advanced", "high");
}
 
function te_video_options() {
  global $post;
  $custom = get_post_custom($post->ID);
  $te_video_url = $custom["te_video_url"][0];
  ?>
  <label for="te_video_url">Vimeo URL:</label>
  <input id="te_video_url" name="te_video_url" value="<?php echo $te_video_url; ?>" />
  <br /><br />
  <?php
  te_vimeo_video($te_video_url);
}


/* Save meta data. Should probably have some security options added. (Nonce authentication) */ 
function save_te_video_details() {
  global $post;
  
  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
    return;
  
  update_post_meta($post->ID, "te_video_url", $_POST["te_video_url"]);
}

function te_vimeo_video($url) {
  $pattern = "/[0-9]*$/";
  preg_match_all($pattern, $url, $matches);
  //print_r($matches[0][0]);
  $video_id = $matches[0][0];
  ?>
  <iframe src="http://player.vimeo.com/video/<?php echo $video_id ?>?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0" width="534" height="300" frameborder="0"></iframe>
  <?php
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
   'supports' => array('title', 'editor')
   );
   
   register_post_type('te_testemonial', $args);
}

/* ADD CUSTOM FIELDS TO TESTEMONIAL POST TYPE */
add_action('admin-init', 'te_testemonial_add_meta_box');

function te_testemonial_add_meta_box() {
  $te_testemonial_meta_box = array(
  	'id' => 'te_testemonial-meta',
  	'title' => 'Testemonial Options',
  	'pages' => array('te_testemonial'),

  	'fields' => array(
  		array(
  			'name' => 'Testemonial Author',
  			'id' => $prefix . '-author',
  			'type' => 'text',					
  			//'std' => '<b>It\'s great!</b>',
  			//'desc' => ''
  		),
  		array(
  			'name' => 'Testemonial Date',
  			'id' => $prefix . '-date',
  			'type' => 'date'						// file upload
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
    default:
      break;
  }
}

function te_reading_room_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
  
  $prefix = 'te_reading-room-header-text';
  
  $meta_boxes[] = array(
  	'id' => 'te_reading-room-header-text',
  	'title' => 'Header Text Options',
  	'pages' => array('page'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Title',
  			'id' => 'din_mor_er_syg',
  			'type' => 'text',					
  		),
  		array(
  			'name' => 'Content',
  			'id' => $prefix . '-content',
  			'type' => 'textarea'
  		),
  		array(
  		  'name' => 'Link Address',
  		  'id' => $prefix . '-link-address',
  		  'type' => 'text',
  		  'desc' => 'Remember http://'
  		),
  		array(
  		  'name' => 'Link Text',
  		  'id' => $prefix . '-link-text',
  		  'type' => 'text',
  		)
  	)
  );
  
  $meta_boxes[] = array(
  	'id' => 'te_reading-room-box-text',
  	'title' => 'Box Text Options',
  	'pages' => array('page'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Title Line 1',
  			'id' => $prefix . '-title-line-1',
  			'type' => 'text',					
  		),
  		array(
  			'name' => 'Title Line 2',
  			'id' => $prefix . '-title-line-2',
  			'type' => 'text'
  		),
  		array(
  		  'name' => 'Content',
  		  'id' => $prefix . '-content',
  		  'type' => 'textarea',
  		),
  		array(
  		  'name' => 'Link Address',
  		  'id' => $prefix . '-link-address',
  		  'type' => 'text',
  		  'desc' => 'Remember http://'
  		),
  		array(
  		  'name' => 'Link Text',
  		  'id' => $prefix . '-link-text',
  		  'type' => 'text'
  		)
  	)
  );

  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
}



 





















?>