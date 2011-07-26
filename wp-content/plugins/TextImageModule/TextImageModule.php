<?php

/*
Plugin Name: Text Image Module
Plugin URI: http://konscript.com
Description: A widget that displays a text and a headline with an image and a icon
Version: 1.0
Author URI: http://konscript.com
*/

class TextImageModule extends WP_Widget {
	function TextImageModule() {
		$this->WP_widget(
			'text-image-widget',
			'Text Image Module',
			array(
				'classname'		=> 'Text Image Module',
				'description' => 'A widget that displays a text and a headline with an image and a icon'
			),
			array(
				'id_base'			=> 'text-image-widget'
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
		$imageURL = $instance['imageURL'];
		$metadata = $instance['metadata'];
		$byline = $instance['byline'];
		
		?>
		
		<div class="widget widget-image-text">
			<div class="header-container">
				<h2 class="first-line"><?php echo $titleA; ?></h2>
				<h2 class="second-line"><?php echo $titleB; ?></h2>
			</div>
			
			<div class="item image-text">
				<div class="item-content">
					
					<?php 
					
					if($imageURL != "") :
						if($link != "") echo "<a href=\"$link\">";
							echo "<img src=\"$imageURL\" class=\"featured-image\" />";
						if($link != "") echo "</a>";
					endif;
					
					?>
					
					<p class="meta-data"><?php echo $metadata; ?></p>
					<span class="by-line"><?php echo $byline; ?></span>
					
					<a class="title" href="<?php echo $link; ?>"><?php echo $header; ?></a>
					<p class="excerpt"><?php echo $text; ?></p>
					
					<?php if($link != "") : ?>
					<div class="options">
						<a href="<?php echo $link; ?>"><?php echo $linkText; ?></a>
					</div>
					<?php endif; ?>
					
				</div>
			</div>
		</div>
		
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
		$instance['imageURL']		= strip_tags($new_instance['imageURL']);
		$instance['metadata']		= strip_tags($new_instance['metadata']);
		$instance['byline']			= strip_tags($new_instance['byline']);
		$instance['text']			= strip_tags($new_instance['text']);
		
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
			'metadata'		=> '',
			'byline'			=> '',
			'text'			=> '',
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
				value="<?php echo $titleA; ?>">
		</p>
		
		<p>
			<label for="<?php echo $titleB_id; ?>">Title (second):</label><br />
			<input 
				type="text"
				id="<?php echo $titleB_id; ?>"
				name="<?php echo $titleB_name; ?>"
				value="<?php echo $titleB; ?>">
		</p>
		
		<p>
			<label for="<?php echo $header_id; ?>">Header:</label><br />
			<input 
				type="text"
				id="<?php echo $header_id; ?>"
				name="<?php echo $header_name; ?>"
				value="<?php echo $header; ?>">
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
				name="<?php echo $imageURL_name; ?>"
				value="<?php echo $imageURL; ?>">
		</p>
		
		<p>
			<label for="<?php echo $link_id; ?>">Link:</label><br />
			<input 
				type="text"
				id="<?php echo $link_id; ?>"
				name="<?php echo $link_name; ?>"
				value="<?php echo $link; ?>">
		</p>
		
		<p>
			<label for="<?php echo $linkText_id; ?>">Link text:</label><br />
			<input 
				type="text"
				id="<?php echo $linkText_id; ?>"
				name="<?php echo $linkText_name; ?>"
				value="<?php echo $linkText; ?>">
		</p>
		
		<?php
	}
}

function load_text_image_widget() {
	register_widget('TextImageModule');
}

add_action('widgets_init', 'load_text_image_widget');

?>