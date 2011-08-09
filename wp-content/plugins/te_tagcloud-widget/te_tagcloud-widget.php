<?php

/*
Plugin Name: Tagcloud Widget
Plugin URI: http://konscript.com
Description: A widget that displays a cloud of tags.
Version: 1.0
Author URI: http://konscript.com
*/

class TE_TagcloudWidget extends WP_Widget {
	function TE_TagcloudWidget() {
		$this->WP_widget(
			'te_tagcloud-widget',
			'TE Tagcloud Widget',
			array(
				'classname'		=> 'TE Tagcloud Widget',
				'description' => 'A widget that displays a cloud of tags.'
			),
			array(
				'id_base'			=> 'te_tagcloud-widget'
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
					
					$terms = get_terms($instance['postType'], array(
						'number'				=> 45,
						'hierarchical'	=> 0,
						
					));
					
					$scores = array();
					foreach($terms as $term) {
						$scores[$term->term_id] = $term->count;
					}
					
					$max_score = max($scores);
					$min_score = min($scores);
					
					$score_spread = $max_score - $min_score;
					if($score_spread <= 0)
						$score_spread = 1;
					
					$max_class = 5;
					$min_class = 1;
					
					$class_spread = $max_class - $min_class;
					if($class_spread <= 0)
						$class_spread = 1;
						
					$step = $class_spread / $score_spread;
					
					foreach($terms as $term) :
						$id = $term->term_id;
						$link = clean_url(get_tag_link($id));
						$class_id = ($min_class + (($scores[$id] - $min_score) * $step));
						
						?>
						
						<a href="<?php echo $link ?>" class="tag-<?php echo $id; ?> s<?php echo $class_id; ?>"><?php echo $term->name; ?></a>
						
						<?php
					endforeach;

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
		$instance['postType']		= strip_tags($new_instance['postType']);
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '',
			'titleB'			=> '',
			'postType'		=> 'post_tag',
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
				<label for="<?php echo $postType_id; ?>">Type:</label><br />
				<select 
					id="<?php echo $postType_id; ?>"
					name="<?php echo $postType_name; ?>">

					<option value="post_tag"<?php if($instance['postType'] == 'post_tag') echo " selected=\"selected\""; ?>>Blog Post</option>
					<option value="te_article-tag"<?php if($instance['postType'] == 'te_article-tag') echo " selected=\"selected\""; ?>>Article</option>
				</select>
			</p>
		
		<?php
	}
}

function load_tagcloud_widget() {
	register_widget('TE_TagcloudWidget');
}

add_action('widgets_init', 'load_tagcloud_widget');

?>