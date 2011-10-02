<?php

/*
Plugin Name: TE Text Widget
Plugin URI: http://konscript.com
Description: A widget for displaying a widget with editable text, image, icon and link.
Version: 1.0
Author URI: http://konscript.com
*/

class TE_FreeTextWidget extends WP_Widget {
	function TE_FreeTextWidget() {
		$this->WP_widget(
			'te_free-text-widget',
			'TE Text Widget',
			array(
				'classname'		=> 'TE Text Widget',
				'description' => 'A widget for displaying a widget with editable text, image, icon and link.'
			),
			array(
				'id_base'			=> 'te_free-text-widget'
			)
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		$titleA = apply_filters('widget_title', $instance['titleA']);
		$titleB = apply_filters('widget_title', $instance['titleB']);
		$header = apply_filters('widget_title', $instance['header']);
		$text = apply_filters('widget_excerpt', $instance['text']);
		
		$link = $instance['link'];
		$linkText = $instance['linkText'];
		$viewAllURL = $instance['viewAllURL'];
		$viewAllText = $instance['viewAllText'];
		$imageURL = $instance['imageURL'];
		$iconURL = $instance['iconURL'];
		$metadata = $instance['metadata'];
		$byline = $instance['byline'];
		$layout = $instance['layout'];
		
		?>

		<div class="widget widget-image-text layout-<?php echo $layout; ?>" style="background: url('<?php echo $iconURL; ?>') top left no-repeat">
			<?php if(!empty($titleA)) : ?>
				<div class="header-container">
					<h2 class="first-line"><?php echo $titleA; ?></h2>
					<h2 class="second-line"><?php echo $titleB; ?></h2>
				</div>
			<?php endif; ?>
			
			<div class="item image-text">
				<div class="item-content">
					
					<?php if($imageURL != "") : ?>
			      <div class="thumb-wrapper">
			        <div class="thumb-container">
								<a href="<?php the_permalink(); ?>">
									
									<?php 
									
									$aid = get_attachment_id_from_src($imageURL);
									$size = ($layout == "square") ? "square-small" : $layout;
									echo wp_get_attachment_image($aid, "post-$size-thumbnail", false, array('class' => 'featured-image'));
									?>
								</a>
			        </div>
			      </div>
			    <?php endif; ?>
						
					<?php if($metadata != "" || $byline != "")	: ?>
						<p class="meta-data"><?php echo $metadata; ?></p>
					<?php endif; ?>
					<?php if($byline != "" || $metadata != "") : ?>
						<span class="by-line"><?php echo $byline; ?></span>
					<?php endif; ?>
					
					<?php if(!empty($header)) : ?>
						<a class="title" href="<?php echo $link; ?>"><?php echo $header; ?></a>
					<?php endif; ?>
					
					<p class="excerpt"><?php echo nl2br($text); ?></p>
					
					<?php if($link != "") : ?>
					<div class="options">
						<a href="<?php echo $link; ?>" class="read-more"><?php echo $linkText; ?></a>
					</div>
					<?php endif; ?>
					
				</div>
				
			</div>
			
			
		</div>
		
		<?php if(!empty($viewAllText) && !empty($viewAllURL)) : ?>
		<div class="widget-view-all">
			<a href="<?php echo $viewAllURL; ?>"><?php echo $viewAllText; ?></a>
		</div>

		<?php endif; ?>
		
		<?php
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['titleA']			= strip_tags($new_instance['titleA']);
		$instance['titleB']			= strip_tags($new_instance['titleB']);
		$instance['header']			= strip_tags($new_instance['header']);
		$instance['link']				= strip_tags($new_instance['link']);
		$instance['linkText']		= strip_tags($new_instance['linkText']);
		$instance['viewAllURL']	= strip_tags($new_instance['viewAllURL']);
		$instance['viewAllText']		= strip_tags($new_instance['viewAllText']);
		$instance['imageURL']		= strip_tags($new_instance['imageURL']);
		$instance['iconURL']		= strip_tags($new_instance['iconURL']);
		$instance['metadata']		= strip_tags($new_instance['metadata']);
		$instance['byline']			= strip_tags($new_instance['byline']);
		$instance['text']				= strip_tags($new_instance['text']);
		$instance['layout']			= strip_tags($new_instance['layout']);
		$instance['byline']			= strip_tags($new_instance['byline']);
		$instance['metadata']			= strip_tags($new_instance['metadata']);
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '',
			'titleB'			=> '',
			'header'			=> '',
			'link'				=> '',
			'linkText'		=> 'Read More',
			'imageURL'		=> '',
			'iconURL'			=> '',
			'metadata'		=> '',
			'byline'			=> '',
			'text'				=> '',
			'layout'			=> 'tall',
			'byline'			=> '',
			'metadata'		=> '',
			'viewAllText' => 'View All',
			'viewAllURL'	=> ''
		);
		
		foreach($defaults as $key => $value) {
			$$key = (!empty($instance[$key])) ? $instance[$key] : $value;

			$idn = $key.'_id';
			$nn = $key.'_name';
			
			$$idn = $this->get_field_id($key);			
			$$nn = $this->get_field_name($key);
		}
		
		?>
		
		<p>
			<label for="<?php echo $titleA_id; ?>">Title (first):</label><br />
			<input 
				type="text"
				id="<?php echo $titleA_id; ?>"
				name="<?php echo $titleA_name; ?>"
				value="<?php echo $titleA; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $titleB_id; ?>">Title (second):</label><br />
			<input 
				type="text"
				id="<?php echo $titleB_id; ?>"
				name="<?php echo $titleB_name; ?>"
				value="<?php echo $titleB; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $header_id; ?>">Header:</label><br />
			<input 
				type="text"
				id="<?php echo $header_id; ?>"
				name="<?php echo $header_name; ?>"
				value="<?php echo $header; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $text_id; ?>">Text:</label><br />
			<textarea
				id="<?php echo $text_id; ?>"
				name="<?php echo $text_name; ?>"
				style="width:100%;"
				rows="6"><?php echo $text; ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $imageURL_id; ?>">Image:</label><br />
			<input 
				type="text"
				id="<?php echo $imageURL_id; ?>"
				class="image-upload-field"
				name="<?php echo $imageURL_name; ?>"
				value="<?php echo $imageURL; ?>" />
			<input
				type="button"
				id="<?php echo $imageURL_id ?>_button"
				class="image-upload image"
				value="Upload / Select Image"
				onClick="start_upload(this)" />
		</p>
		
		<p>
			<label for="<?php echo $iconRL_id; ?>">Icon:</label><br />
			<input 
				type="text"
				id="<?php echo $iconURL_id; ?>"
				class="icon-upload-field"
				name="<?php echo $iconURL_name; ?>"
				value="<?php echo $iconURL; ?>" />
			<input
				type="button"
				id="<?php echo $iconURL_id ?>_button"
				class="icon-upload icon"
				value="Upload / Select Image"
				onClick="start_upload(this)" />
		</p>
		
		<p>
			<label for="<?php echo $link_id; ?>">Link:</label><br />
			<input 
				type="text"
				id="<?php echo $link_id; ?>"
				name="<?php echo $link_name; ?>"
				value="<?php echo $link; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $linkText_id; ?>">Link text:</label><br />
			<input 
				type="text"
				id="<?php echo $linkText_id; ?>"
				name="<?php echo $linkText_name; ?>"
				value="<?php echo $linkText; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $byline_id; ?>">By line:</label><br />
			<input 
				type="text"
				id="<?php echo $byline_id; ?>"
				name="<?php echo $byline_name; ?>"
				value="<?php echo $byline; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $metadata_id; ?>">Metadata:</label><br />
			<input 
				type="text"
				id="<?php echo $metadata_id; ?>"
				name="<?php echo $metadata_name; ?>"
				value="<?php echo $metadata; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $viewAllURL_id; ?>">View All URL:</label><br />
			<input 
				type="text"
				id="<?php echo $viewAllURL_id; ?>"
				name="<?php echo $viewAllURL_name; ?>"
				value="<?php echo $viewAllURL; ?>" />
		</p>

		<p>
			<label for="<?php echo $linkText_id; ?>">View All Text:</label><br />
			<input 
				type="text"
				id="<?php echo $viewAllText_id; ?>"
				name="<?php echo $viewAllText_name; ?>"
				value="<?php echo $viewAllText; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $layout_id; ?>">Layout:</label><br />
			<select id="<?php echo $layout_id; ?>" name="<?php echo $layout_name; ?>">
				<option value="tall"<?php if($layout == "tall") echo " selected=\"selected\""; ?>>Tall</option>
				<option value="wide"<?php if($layout == "wide") echo " selected=\"selected\""; ?>>Wide</option>
				<option value="square"<?php if($layout == "square") echo " selected=\"selected\""; ?>>Square</option>
			</select>
		</p>
		
		<?php
	}
}

function load_admin_scripts() {
	wp_enqueue_script(array('jquery', 'editor', 'thickbox', 'media-upload'));
	wp_register_script('imagewidget-upload', WP_PLUGIN_URL . '/te_free-text-widget/imagewidget-upload.js');
	wp_enqueue_script('imagewidget-upload');
}

function load_admin_styles() {
	wp_enqueue_style('thickbox');
}

function load_tiny_mce() {
	wp_tiny_mce( false );
}

global $pagenow;

if(is_admin() && $pagenow == "widgets.php") {
	add_action('admin_print_scripts', 'load_admin_scripts');
	add_action('admin_print_styles', 'load_admin_styles');
	add_action('admin_head', 'load_tiny_mce');
}

function te_load_FreeTextWidget() {
	register_widget('TE_FreeTextWidget');
}
add_action('widgets_init', 'te_load_FreeTextWidget');

?>