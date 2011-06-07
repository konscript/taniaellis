<?php

/*
Plugin Name: Page Resume Widget
Plugin URI: http://konscript.com
Description A widget that displays a resume of a page with a link to the page.
Version: 0.1
Author URI: http://konscript.com
*/

class PageResumeWidget extends WP_Widget {
	function PageResumeWidget() {
		$widget_ops = array(
			'classname'		=> 'Page Resume',
			'description'	=> 'A widget that displays a resume of a page with a link to the page'
		);

		$control_ops = array(
			'id_base'		=> 'page-resume-widget'
		);

		$this->WP_Widget(false, 'Page Resume');
	}
	
	function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		
		echo $before_widget;
		
		if($title);
			echo $before_title . $title . $after_title;
			
		echo "<p>" . $instance['text'] . "</p>";
			
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'title'			=>	'Widget title',
			'text'			=>	''
		);
		
		$instance = wp_parse_args((array) $instance, $defaults);
		
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text'); ?>">Text:</label>
			<textarea id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
		</p>
		
		
		<?php
	}
}

function load_page_resume_widget() {
   register_widget('PageResumeWidget');
}

add_action('widgets_init', 'load_page_resume_widget');

?>