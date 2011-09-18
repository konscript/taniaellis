<?php
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
	  create_article_taxonomies();
	  create_attachment_metabox();
}

function create_attachment_metabox() {
  
  $prefix = 'te_article-attachment';
  
  $meta_boxes[] = array(
    
  	'id' => $prefix,
  	'title' => 'Attachment',
  	'pages' => array('te_article'),
  	'context' => 'side',

  	'fields' => array(
  		array(
  			'name' => 'Select file',
  			'id' => $prefix . '-file',
  			'type' => 'file'
  		)
  	)
  );


  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
 
}



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

add_action('init', 'article_register');

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
// function te_get_article_url($post_id) {
//   $args = array(
//    'post_type' => 'attachment',
//    'numberposts' => null,
//    'post_status' => null,
//    'post_parent' => $post_id
//   );
//   
//   $attachments = get_posts($args);
//   
//   $article_url = get_post_meta($post_id, 'te_article_url', true);
//   
//   // If there is no thumbnail but one attatchment, link to that attachment
//   
//   if(isset($article_url) && $article_url != "" ){ // If none of the above, there are no attachments. Get the link set in admin interface
//     $article_url = get_post_meta($post_id, 'te_article_url', true);
//   } else if(!has_post_thumbnail($post_id) && count($attachments) == 1) {
//      $article_url = wp_get_attachment_url($attachments[0]->ID);
//   } else if(has_post_thumbnail($post_id) && count($attachments) > 1) { // If there is a thumbnail and an attachment, link to the attachment
//     foreach ($attachments as $key => $attachment) {
//       if($attachment->ID != get_post_thumbnail_id($post_id)) {
//         $article_url = wp_get_attachment_url($attachment->ID);
//        }
//    }
//  } else { // This is unlikely to happen. If there are no attachments and no link is set, redirect to the permalink
//     $article_url = get_permalink($post_id);
//   }
//   
//   return $article_url;
// }

function te_get_article_url($post_id) {
  
  $article_attachment_url = get_post_meta($post_id, 'te_article-attachment-file', true);
  $article_link_url       = trim(get_post_meta($post_id, 'te_article_url', true)); // Trim this to avoid accidental whitespace in beginning or end of URL
  $article_permalink      = get_permalink($post_id);
  
  if($article_attachment_url) {
    return $article_attachment_url;
  } else if($article_link_url) {
    return $article_link_url;
  } else {
    return $article_permalink;
  }
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

?>