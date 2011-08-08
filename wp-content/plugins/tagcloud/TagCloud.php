<?php

/*
Plugin Name: Tagcloud Widget
Plugin URI: http://konscript.com
Description: A widget that displays a cloud of tags.
Version: 1.0
Author URI: http://konscript.com
*/

class TagcloudWidget extends WP_Widget {
	function TagCloudWidget() {
		$this->WP_widget(
			'tagcloud-widget',
			'Tagcloud Widget',
			array(
				'classname'		=> 'Tagcloud Widget',
				'description' => 'A widget that displays a cloud of tags.'
			),
			array(
				'id_base'			=> 'tagcloud-widget'
			)
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		$titleA = apply_filters('widget_title', $instance['titleA']);
		$titleB = apply_filters('widget_title', $instance['titleB']);
		
		?>
		
		<div class="widget widget-tagcloud">
			<div class="header-container">
				<h2 class="first-line"><?php echo $titleA; ?></h2>
				<h2 class="second-line"><?php echo $titleB; ?></h2>
			</div>
			
			<div class="item tagcloud">
				<div class="item-content">
					<?php
				
					$default_colors = array(
						'#a8a6cd',
						'#91b997',
						'#e7cd30',
						'#83a8c2',
						'#d7b590'
					);
				
					$options = array();
				    $options['color_names']     = $default_colors;
					$options['min_size']        = 14;
				    $options['max_size']        = 22;
					$options['use_colors']      = true;
				
					if (function_exists('ilwp_tag_cloud'))
						ilwp_tag_cloud($options);
				
					?>
				</div>
			</div>
		</div>
		
		<?php
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['titleA']			= strip_tags($new_instance['titleA']);
		$instance['titleB']			= strip_tags($new_instance['titleB']);
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '',
			'titleB'			=> '',
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
		
		<?php
	}
}

function load_tagcloud_widget() {
	register_widget('TagcloudWidget');
}

add_action('widgets_init', 'load_tagcloud_widget');