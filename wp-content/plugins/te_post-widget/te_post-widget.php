<?php

/*
Plugin Name: TE Post Widget
Plugin URI: http://konscript.com
Description: A widget that displays a fixed set of posts.
Version: 1.0
Author URI: http://konscript.com
*/

class TE_PostWidget extends WP_Widget {
	function TE_PostWidget() {
		$this->WP_Widget(
			'te_post-widget',
			'TE Post Widget',
			array(
				'classname'		=> 'TE Post Widget',
				'description'	=> 'A widget that displays a fixed set of posts.'
			),
			array(
				'id_base'		=> 'te_post-widget'
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
		
		$wclass = array(
			'post'									=> 'blog',
			'te_event'							=> 'event',
			'te_article'						=> 'reading-room',
			'te_testemonial'				=> 'testemonial',
			'te_testemonial_video'	=> 'video-testemonial'
		);
		
		$tsize = array(
			'wide'		=> 'post-wide-thumbnail',
			'square'	=> 'post-square-thumbnail',
			'tall'		=> 'post-tall-thumbnail'
		);
		
		$type = array(
			'post'									=> 'blog posts',
			'te_article'						=> 'articles',
			'te_event'							=> 'events',
			'te_testemonial'				=> 'testemonials',
			'te_testemonial_video'	=> 'testemonials'
		);
		
		$url = array(
			'post'									=> 'blog',
			'te_article'						=> 'reading-room/articles',
			'te_event'							=> 'events',
			'te_testemonail'				=> 'cases',
			'te_testemonail_video'	=> 'cases'
		);
		
		?>
		
		<div class="widget widget-<?php echo $wclass[$instance['type']]; ?>">
			<div class="header-container">
				<h2 class="first-line"><?php echo $titleA; ?><h2>
				<h2 class="second-line"><?php echo $titleB; ?></h2>
			</div>
			
		<?php
		
		query_posts(array(
			'post_type'		=> (($instance['type'] == 'te_testemonial_video') ? 'te_testemonial' : $instance['type']),
			'post__in' 		=> $this->items($instance)
		));
		
	
		$count = 0;
		while(have_posts() && $count < $instance['items']) : the_post();
			$post_id = get_the_ID();
			
			include("templates/" . $instance['type'] . ".php");
			
			$count++;
		endwhile;
		
		wp_reset_query();
		
		?>
		</div>
		
		<?php if($instance['viewAllButton']) : ?>
		<div class="widget-view-all">
			<a href="<?php echo get_permalink(get_page_by_path($url[$instance['type']])); ?>/all/">View all <?php echo $type[$instance['type']]; ?></a>
		</div>
		<?php endif; ?>
		
		<?php
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['titleA'] 				= strip_tags($new_instance['titleA']);
		$instance['titleB'] 				= strip_tags($new_instance['titleB']);
		$instance['type']						= strip_tags($new_instance['type']);
		$instance['size']						= strip_tags($new_instance['size']);
		$instance['items']					= strip_tags($new_instance['items']);
		$instance['thumbnails'] 		= strip_tags($new_instance['thumbnails']);
		$instance['viewAllButton'] 	= strip_tags($new_instance['viewAllButton']);
		
		for($i = 1; $i <= $instance['items']; $i++) {
			unset($instance['item_$i']);
			if(isset($new_instance["item_$i"]) and !empty($new_instance["item_$i"]))
				$instance["item_$i"] = strip_tags($new_instance["item_$i"]);
		}
		
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'				=> '',
			'titleB'				=> '',
			'type'					=> 'post',
			'size'					=> 'wide',
			'items'					=> '3',
			'thumbnails'		=> true,
			'viewAllButton'	=> false
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
			<label for="<?php echo $this->get_field_id('type'); ?>">Post Type:</label><br />
			<select 
				id="<?php echo $this->get_field_id('type'); ?>" 
				name="<?php echo $this->get_field_name('type'); ?>">
				<option value="post"<?php if($instance['type'] == 'post') : ?> selected="selected"<?php endif; ?>>Blog Post</option>
				<option value="te_event"<?php if($instance['type'] == 'te_event') : ?> selected="selected"<?php endif; ?>>Event</option>
				<option value="te_article"<?php if($instance['type'] == 'te_article') : ?> selected="selected"<?php endif; ?>>Article</option>
				<option value="te_testemonial"<?php if($instance['type'] == 'te_testemonial') : ?> selected="selected"<?php endif; ?>>Testimonial</option>	
				<option value="te_testemonial_video"<?php if($instance['type'] == 'te_testemonial_video') : ?> selected="selected"<?php endif; ?>>Video Testimonial</option>	
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('size'); ?>">Thumbnail Dimensions:</label><br />
			<select 
				id="<?php echo $this->get_field_id('size'); ?>" 
				name="<?php echo $this->get_field_name('size'); ?>">
				<option value="wide"<?php if($instance['size'] == 'wide') : ?> selected="selected"<?php endif; ?>>Wide</option>
				<option value="square"<?php if($instance['size'] == 'square') : ?> selected="selected"<?php endif; ?>>Square</option>
				<option value="tall"<?php if($instance['size'] == 'tall') : ?> selected="selected"<?php endif; ?>>Tall</option>
					
			</select>
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
			<label for="<?php echo $this->get_field_id('thumbnails'); ?>">Show Thumbnails:</label>
			<input 
				type="checkbox" 
				id="<?php echo $this->get_field_id('thumbnails'); ?>" 
				name="<?php echo $this->get_field_name('thumbnails'); ?>" 
				<?php if($instance['thumbnails']) : ?> checked="checked"<?php endif; ?>>
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
				'post_type'		=> $instance['type'],
				'numberposts'	=> -1,
				'post_status'	=> array('publish', 'future')
			);
		
			$posts = get_posts($args);

			for($i = 1; $i <= (int)$instance['items']; $i++) {
				?>
			
				<p>
					<label for="<?php echo $this->get_field_id("item_$i"); ?>">Post #<?php echo $i; ?>:</label>
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
			
				<?
			}
	}
}

function te_load_PostWidget() {
	register_widget('TE_PostWidget');
}

add_action('widgets_init', 'te_load_PostWidget');

?>