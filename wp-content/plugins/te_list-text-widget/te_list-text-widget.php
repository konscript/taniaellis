<?php

/*
Plugin Name: TE List Widget
Plugin URI: http://konscript.com
Description: A widget that displays a bullet list.
Version: 1.0
Author URI: http://konscript.com
*/

class TE_ListTextWidget extends WP_Widget {
	function TE_ListTextWidget() {
		$this->WP_widget(
			'te_list-text-widget',
			'TE List Widget',
			array(
				'classname'		=> 'TE List Widget',
				'description' => 'A widget that displays a bullet list.'
			),
			array(
				'id_base'			=> 'te_list-text-widget'
			)
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		$titleA = apply_filters('widget_title', $instance['titleA']);
		$titleB = apply_filters('widget_title', $instance['titleB']);
		
		$header = apply_filters('widget_title', $instance['header']);
		$text = apply_filters('widget_excerpt', $instance['text']);
		
		$link = $instance['link'];
		$linkText = $instance['linkText'];
		
		$iconURL = $instance['iconURL'];
		
		$i = 1;
		$found = 0;
		$items = array();
		while($found < $instance['itemCount']) {
			if(isset($instance["item_$i"]) and !empty($instance["item_$i"])) {
				$items[] = $instance["item_$i"];
				$found++;
			}
			$i++;
		}
		
		echo $before_widget;
		
		?>
		<div class="widget widget-list" style="background: url('<?php echo $iconURL; ?>') top left no-repeat">
			<div class="header-container">
				<h2 class="first-line"><?php echo $titleA; ?></h2>
				<h2 class="second-line"><?php echo $titleB; ?></h2>
			</div>
				
			<div class="item list">
				<div class="item-content">
					<h2 class="title" href="<?php echo $link; ?>"><?php echo $header; ?></h2>
					<p class="excerpt"><?php echo $text; ?></p>
					
					<ul class="list">
						<?php foreach($items as $item) :?>
						<li><span><span>&nbsp;</span><?php echo $item; ?></span></li>
						<?php endforeach; ?>
					</ul>
					
					<?php if($link != "") : ?>
					<div class="options">
						<a href="<?php echo $link; ?>" class="read-more"><?php echo $linkText; ?></a>
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
		$instance['itemCount']	= strip_tags($new_instance['itemCount']);
		$instance['iconURL']		= strip_tags($new_instance['iconURL']);
		$instance['text']				= strip_tags($new_instance['text']);
		$instance['header']			= strip_tags($new_instance['header']);
		$instance['link']				= strip_tags($new_instance['link']);
		$instance['linkText']		= strip_tags($new_instance['linkText']);
		
		// for($i = 1; $i <= (int) $new_instance['itemCount']; $i++) {
		// 		unset($instance["item_$i"]);
		// 		if(isset($new_instance["item_$i"]))
		// 			$instance["item_$i"] = strip_tags($new_instance["item_$i"]);
		// 	}
		
		$i = 1;
		$found = 0;
		while($found < $instance['itemCount']) {
			if(isset($new_instance["item_$i"])) {
				if(empty($new_instance["item_$i"]))
					unset($instance["item_$i"]);
				else {
					$instance["item_$i"] = strip_tags($new_instance["item_$i"]);
					$found++;
				}
				
			}
			$i++;
		}
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '',
			'titleB'			=> '',
			'itemCount'		=> '1',
			'iconURL'			=> '',
			'header'			=> '',
			'text'				=> '',
			'link'				=> '',
			'linkText'		=> 'Read More',
		);
		
		foreach($defaults as $key => $item) {
			$$key = (isset($instance[$key])) ? $instance[$key] : $defaults[$item];
			// $$key = (isset($instance[$key])) ? $instance[$key]: $defaults[$key];
			// //echo $key . " : " . $instance[$key] . " : " . $defaults[$key] . "<br />";
			// 
			$idn = $key.'_id';
			$nn = $key.'_name';
					
			$$idn = $this->get_field_id($key);			
			$$nn = $this->get_field_name($key);
		}
		
		echo $itemCount;
		
		$i = 1;
		$found = 0;
		$items = array();
		while($found < $itemCount) {
			if(isset($instance["item_$i"]) and !empty($instance["item_$i"])) {
				$items["item_$i"] = $instance["item_$i"];
				$found++;
			}
			$i++;
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
			<input 
				type="hidden"
				id="<?php echo $itemCount_id; ?>" 
				name="<?php echo $itemCount_name; ?>"
				value="<?php echo $itemCount; ?>" />
		</p>
		
		<p>
			<input 
				type="text"
				id="<?php echo $this->get_field_id('item_1'); ?>"
				name="<?php echo $this->get_field_name('item_1'); ?>"
				value="<?php echo $instance['item_1']; ?>" />
		</p>
		
		<ul>
			<?php foreach($items as $key => $item) : 
				if($key == "item_1")
					continue;
					
				$id = 'item_' . $i . '_id';
				$name = 'item_' . $i . '_name';
				$val = 'item_' . $i; ?>

				<li>
					<input 
						type="text"
						id="<?php echo $this->get_field_id($key); ?>"
						name="<?php echo $this->get_field_name($key); ?>"
						value="<?php echo $item; ?>" />
					<a href="javascript:void(0)" class="remove-field">
						<img src="<?php echo WP_PLUGIN_URL . '/te_list-text-widget/remove.gif'; ?>" />
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<a href="javascript:void(0)" class="add_field">Add field</a>

		<?php
	}
}

function te_load_ListTextWidget() {
	register_widget('TE_ListTextWidget');
}

add_action('widgets_init', 'te_load_ListTextWidget');

function te_load_ListTextWidget_scripts() {
	wp_register_script('admin-helper', WP_PLUGIN_URL . '/te_list-text-widget/admin-helper.js');
	
	wp_enqueue_script(array('jquery', 'editor', 'thickbox', 'media-upload'));
	wp_enqueue_script('admin-helper');
}

function te_load_ListTextWidget_styles() {
	wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'te_load_ListTextWidget_scripts');
add_action('admin_print_styles', 'te_load_ListTextWidget_styles');
	
?>