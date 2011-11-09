<?php

/*
Plugin Name: TE Video Widget
Plugin URI: http://konscript.com
Description: A widget that displays a fixed set of videos.
Version: 1.0
Author URI: http://konscript.com
*/

class TE_VideoWidget extends WP_Widget {
	function TE_VideoWidget() {
		$this->WP_Widget(
			'te_video-widget',
			'TE Video Widget',
			array(
				'classname'		=> 'TE Video Widget',
				'description'	=> 'A widget that displays a fixed set of videos.'
			),
			array(
				'id_base'		=> 'te_video-widget'
			)
		);
	}
	
	function items($instance) {
		$items = array();
		
		for($i = 1; $i <= $instance['items']; $i++) {
			if(isset($instance["item_$i"]) and !empty($instance["item_$i"]))
				$items[] = $instance["item_$i"];
		}
		
		return $items;
	}
	
	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		$titleA = apply_filters('widget_title', $instance['titleA']);
		$titleB = apply_filters('widget_title', $instance['titleB']);
	
		?>
		
		<div class="widget widget-video no-addthis">
			<div class="header-container">
				<h2 class="first-line"><?php echo $titleA; ?><h2>
				<h2 class="second-line"><?php echo $titleB; ?></h2>
			</div>
			
			<div class="item video">
				<div class="item-content">
			
				<?php
		
				query_posts(array(
					'post_type'		=> 'te_video',
					'post__in' 		=> $this->items($instance)
				));
		
		
				$count = 1;
				while(have_posts() && $count <= $instance['items']) : the_post();
					$post_id = get_the_ID();
					$video_url = get_post_meta($post_id, 'te_video_url', true);
			
					?>
					
					<div class="video-item">
						<div class="featured-video">
							<?php echo te_vimeo_video($video_url, 161, 91); ?>
						</div>
						<p class="first-line"><?php echo $instance["item_text1_$count"]; ?></p>
						<?php if(isset($instance["item_link2_$count"]) and !empty($instance["item_link2_$count"])) : ?>
							<a class="second-line" href="<?php echo $instance["item_link2_$count"]; ?>"><?php echo $instance["item_text2_$count"]; ?></a>
						<?php else : ?>
							<p class="second-line"><?php echo $instance["item_text2_$count"]; ?></p>
						<?php endif; ?>
					</div>
			
					<?php
				
					$count++;
				endwhile;
		
				wp_reset_query();
		
				?>
				
				<?php if($instance['viewAllButton']) : ?>
				<div class="viewall">
					<a href="<?php echo trailingslashit($instance['viewAllLink']); ?>"><?php echo $instance['viewAllText']; ?></a>
				</div>
				<?php endif; ?>
				
			</div>
		</div>
		
		<?php
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['titleA'] 				= strip_tags($new_instance['titleA']);
		$instance['titleB'] 				= strip_tags($new_instance['titleB']);
		$instance['type']						= strip_tags($new_instance['type']);
		$instance['items']					= strip_tags($new_instance['items']);
		$instance['viewAllButton'] 	= strip_tags($new_instance['viewAllButton']);
		$instance['viewAllText'] 		= strip_tags($new_instance['viewAllText']);
		$instance['viewAllLink'] 		= strip_tags($new_instance['viewAllLink']);
		
		for($i = 1; $i <= $instance['items']; $i++) {
			unset($instance['item_$i']);
			if(isset($new_instance["item_$i"]) and !empty($new_instance["item_$i"]))
				$instance["item_$i"] = strip_tags($new_instance["item_$i"]);
				
			unset($instance["item_text1_$i"]);
			if(isset($new_instance["item_text1_$i"]) and !empty($new_instance["item_text1_$i"]))
				$instance["item_text1_$i"] = strip_tags($new_instance["item_text1_$i"]);
			
			unset($instance["item_text2_$i"]);	
			if(isset($new_instance["item_text2_$i"]) and !empty($new_instance["item_text2_$i"]))
				$instance["item_text2_$i"] = strip_tags($new_instance["item_text2_$i"]);
				
			unset($instance["item_link2_$i"]);
			if(isset($new_instance["item_link2_$i"]) and !empty($new_instance["item_link2_$i"]))
				$instance["item_link2_$i"] = strip_tags($new_instance["item_link2_$i"]);
		}
		
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'				=> '',
			'titleB'				=> '',
			'type'					=> 'post',
			'items'					=> '3',
			'viewAllButton'	=> false,
		);
		
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('titleA'); ?>">Title (first):</label>
			<input 
				type="text" 
				id="<?php echo $this->get_field_id('titleA'); ?>" 
				name="<?php echo $this->get_field_name('titleA'); ?>" 
				value="<?php echo $instance['titleA']; ?>">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('titleB'); ?>">Title (second):</label>
			<input 
				type="text" 
				id="<?php echo $this->get_field_id('titleB'); ?>" 
				name="<?php echo $this->get_field_name('titleB'); ?>" 
				value="<?php echo $instance['titleB']; ?>">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('items'); ?>">Items to show:</label><br />
			<select 
				id="<?php echo $this->get_field_id('items'); ?>" 
				name="<?php echo $this->get_field_name('items'); ?>">
				<?php for($i = 1; $i <= 10; $i++) : ?>
				<option value="<?php echo $i; ?>"<?php if($instance['items'] == $i) : ?> selected="selected"<?php endif; ?>><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('viewAllText'); ?>">View All Text:</label>
			<input 
				type="text" 
				id="<?php echo $this->get_field_id('viewAllText'); ?>" 
				name="<?php echo $this->get_field_name('viewAllText'); ?>" 
				value="<?php echo $instance['viewAllText']; ?>">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('viewAllLink'); ?>">View All URL:</label>
			<input 
				type="text" 
				id="<?php echo $this->get_field_id('viewAllLink'); ?>" 
				name="<?php echo $this->get_field_name('viewAllLink'); ?>" 
				value="<?php echo $instance['viewAllLink']; ?>">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('viewAllButton'); ?>">Show View All Button:</label>
			<input 
				type="checkbox" 
				id="<?php echo $this->get_field_id('viewAllButton'); ?>" 
				name="<?php echo $this->get_field_name('viewAllButton'); ?>" 
				<?php if($instance['viewAllButton']) : ?> checked="checked"<?php endif; ?>>
		</p>
		
		<?php
		
			$args = array(
				'post_type'		=> 'te_video',
				'numberposts'	=> -1,
				'post_status'	=> array('publish', 'future'),
				'order_by'		=> 'title',
			);
		
			$posts = get_posts($args);

			for($i = 1; $i <= (int)$instance['items']; $i++) {
				?>
				
				<p><h3>Video <?php echo $i; ?></h3></p>
				
				<p>
					<label for="<?php echo $this->get_field_id("item_$i"); ?>">Video</label><br />
					<select id="<?php echo $this->get_field_id("item_$i"); ?>" name="<?php echo $this->get_field_name("item_$i"); ?>">
						<?php

						foreach($posts as $key => $value) {
							$item = "item_$i";
							$post = (array) $value;
							$selected = ($instance[$item] == $post['ID']) ? ' selected="selected"' : '';
							echo "<option value=\"".$post['ID']."\"$selected>" . $post['post_title']. "</option>";
						}

						?>
					</select>
				</p>
				
				<p>
					<label for="<?php echo $this->get_field_id("item_text1_$i"); ?>">Text (first line):</label>
					<input 
						type="text" 
						id="<?php echo $this->get_field_id("item_text1_$i"); ?>" 
						name="<?php echo $this->get_field_name("item_text1_$i"); ?>" 
						value="<?php echo $instance["item_text1_$i"]; ?>">
				</p>
				
				<p>
					<label for="<?php echo $this->get_field_id("item_text2_$i"); ?>">Text (second line):</label>
					<input 
						type="text" 
						id="<?php echo $this->get_field_id("item_text2_$i"); ?>" 
						name="<?php echo $this->get_field_name("item_text2_$i"); ?>" 
						value="<?php echo $instance["item_text2_$i"]; ?>">
				</p>
			
				<p>
					<label for="<?php echo $this->get_field_id("item_link2_$i"); ?>">Link (second line):</label>
					<input 
						type="text" 
						id="<?php echo $this->get_field_id("item_link2_$i"); ?>" 
						name="<?php echo $this->get_field_name("item_link2_$i"); ?>" 
						value="<?php echo $instance["item_link2_$i"]; ?>">
				</p>
				<?
			}
	}
}

function te_load_VideoWidget() {
	register_widget('TE_VideoWidget');
}

add_action('widgets_init', 'te_load_VideoWidget');

?>