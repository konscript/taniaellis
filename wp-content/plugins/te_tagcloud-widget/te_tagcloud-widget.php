<?php

/*
Plugin Name: TE Tagcloud Widget
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
						'number'				=> $instance['itemCount'],
						'hierarchical'	=> 0,
						'orderby'				=> 'count',
						'order'					=> 'DESC'
					));
					
					//die(print_r($terms));	
					
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
					
					// Shuffle it around
					shuffle($terms);
					
					foreach($terms as $term) :
						$id = $term->term_id;
						$link = clean_url(get_term_link($term->slug, $instance['postType']));
						//$class_id = ($min_class + (($scores[$id] - $min_score) * $step));
						$class_id = rand($min_class, $max_class);
						?>
						
						<a href="<?php echo $link ?>" class="tag-<?php echo $id; ?> s<?php echo $class_id; ?>"><?php echo $term->name; ?></a>&nbsp;
						
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
		$instance['itemCount']		= strip_tags($new_instance['itemCount']);
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '',
			'titleB'			=> '',
			'postType'		=> 'post_tag',
			'itemCount'		=> '16',
		);
		
		foreach($defaults as $key => $value) {
			$$key = (!empty($instance[$key])) ? $instance[$key] : $value;

			$idn = $key.'_id';
			$nn = $key.'_name';
			
			$$idn = $this->get_field_id($key);			
			$$nn = $this->get_field_name($key);
			
			if(!isset($instance[$key]) && array_key_exists($key, $defaults))
				$instance[$key] = $defaults[$key];
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
		<p>
			<label for="<?php echo $itemCount_id; ?>">Tags to show:</label><br />
			<input 
				type="text"
				id="<?php echo $itemCount_id; ?>"
				name="<?php echo $itemCount_name; ?>"
				value="<?php echo $instance['itemCount']; ?>"
				size="2" />
		</p>
		
		<?php
	}
}

function te_load_TagcloudWidget() {
	register_widget('TE_TagcloudWidget');
}

add_action('widgets_init', 'te_load_TagcloudWidget');

?>