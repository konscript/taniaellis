<?php

/*
Plugin Name: TE Key Services Widget
Plugin URI: http://konscript.com
Description: A widget that displays the key services.
Version: 1.0
Author URI: http://konscript.com
*/

class TE_KeyServicesWidget extends WP_Widget {
	function TE_KeyServicesWidget() {
		$this->WP_widget(
			'te_key-services-widget',
			'TE Key Services Widget',
			array(
				'classname'		=> 'TE Key Services Widget',
				'description' => 'A widget that displays the key services.'
			),
			array(
				'id_base'			=> 'te_key-services-widget'
			)
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		$titleA = apply_filters('widget_title', $instance['titleA']);
		$titleB = apply_filters('widget_title', $instance['titleB']);
		
		echo $before_widget;
		
		?>
		<div class="widget widget-services">
			<div class="header-container">
				<h2 class="first-line"><?php echo $titleA; ?></h2>
				<h2 class="second-line"><?php echo $titleB; ?></h2>
			</div>
				
			<div class="item services">
				<div class="item-content">
					<ul>
						<li class="green"><a href="<?php echo get_permalink(get_page_by_path('club')); ?>"><span class="social">Social</span> Business <br><span class="term">Club</span></a></li>
						<li class="blue"><a href="<?php echo get_permalink(get_page_by_path('consulting')); ?>"><span class="social">Social</span> Business <br><span class="term">Consulting</span></a></li>
						<li class="purple"><a href="<?php echo get_permalink(get_page_by_path('socialbusinesslabs')); ?>"><span class="social">Social</span> Business <br><span class="term">Labs</span></a></li>
						<li class="orange"><a href="<?php echo get_permalink(get_page_by_path('speaking')); ?>"><span class="social">Social</span> Business <br><span class="term">Speaking</span></a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<?php
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['titleA']					= strip_tags($new_instance['titleA']);
		$instance['titleB']					= strip_tags($new_instance['titleB']);
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '4 Key Services',
			'titleB'			=> 'In The Company',
		);
		
		$titleA = (isset($instance['titleA'])) ? $instance['titleA'] : $defaults['titleA'];
		$titleB = (isset($instance['titleB'])) ? $instance['titleB'] : $defaults['titleB'];
		
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('titleA'); ?>">Title (first):</label><br />
			<input 
				type="text"
				id="<?php echo $this->get_field_id('titleA'); ?>"
				name="<?php echo $this->get_field_name('titleA'); ?>"
				value="<?php echo $titleA; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('titleB'); ?>">Title (second):</label><br />
			<input 
				type="text"
				id="<?php echo $this->get_field_id('titleB'); ?>"
				name="<?php echo $this->get_field_name('titleB'); ?>"
				value="<?php echo $titleB; ?>" />
		</p>

		<?php
	}
}

function te_load_KeyServicesWidget() {
	register_widget('TE_KeyServicesWidget');
}

add_action('widgets_init', 'te_load_KeyServicesWidget');
	
?>