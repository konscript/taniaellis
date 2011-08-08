<?php

/*
Plugin Name: Related Posts Widget
Plugin URI: http://konscript.com
Description: A widget that displays related posts
Version: 1.0
Author URI: http://konscript.com
*/

class TE_RelatedPostsWidget extends WP_Widget {
	function TE_RelatedPostsWidget	() {
		$this->WP_widget(
			'te_related-posts-widget',
			'TE Related Posts Widget',
			array(
				'classname'		=> 'TE Related Posts Widget',
				'description' => 'A widget that displays related posts.'
			),
			array(
				'id_base'			=> 'te_related-posts-widget'
			)
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		global $post;
    if (!is_singular())
      return;

		$type = ($post->post_type == 'page' ? array('page') : array('post'));
		if (yarpp_get_option('cross_relate'))
			$type = array('post','page');
		
		?>
		
		<div class="widget widget-blog related">
			<div class="header-container">
				<h2 class="first-line"><?php echo $titleA; ?></h2>
				<h2 class="second-line"><?php echo $titleB; ?></h2>
			</div>
			
			<?php print_r (yarpp_related($type,$instance,false,false,'widget')); ?>
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

function load_related_posts_widget() {
	register_widget('TE_RelatedPostsWidget');
}

add_action('widgets_init', 'load_related_posts_widget');
	
?>