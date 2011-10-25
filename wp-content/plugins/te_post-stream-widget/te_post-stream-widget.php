<?php

/*
Plugin Name: TE Post Stream Widget
Plugin URI: http://konscript.com
Description: A widget that pulls a stream of posts and displays them.
Version: 1.0
Author URI: http://konscript.com
*/

class TE_PostStreamWidget extends WP_Widget {
	function TE_PostStreamWidget() {
		$this->WP_Widget(
			'te_post-stream-widget',
			'TE Post Stream Widget',
			array(
				'classname'		=> 'TE Post Stream Widget',
				'description'	=> 'A widget that displays a stream of posts.'
			),
			array(
				'id_base'		=> 'te_post-stream-widget'
			)
		);
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
		
		$type = array(
			'post'									=> 'blog posts',
			'te_article'						=> 'articles',
			'te_event'							=> 'events',
			'te_testemonial'				=> 'testemonials',
			'te_testemonial_video'	=> 'testemonials'
		);
		
		$url = array(
			'post'									=> 'blog/all',
			'te_article'						=> 'reading-room/articles',
			'te_event'							=> 'events',
			'te_testemonail'				=> 'cases',
			'te_testemonail_video'	=> 'cases'
		);
		
		$size = array(
			'wide'									=> 'post-wide-thumbnail',
			'square'								=> 'post-square-thumbnail',
			'tall'									=> 'post-tall-thumbnail'
		);
		
		$dim = $size[$instance['dimensions']]
		
		?>
		
		<div class="widget widget-<?php echo $wclass[$instance['type']]; ?><?php if(!$instance['showLike']) echo " no-addthis"; ?><?php if(!$instance['showAddthis']) echo " no-addthis"; ?>">
			<div class="header-container">
				<h2 class="first-line"><?php echo $titleA; ?><h2>
				<h2 class="second-line"><?php echo $titleB; ?></h2>
			</div>
			
		<?php
		
		$args = array(
			'post_type'				=> $instance['type'],
			'post_status'			=> 'publish',
			'orderby'					=> 'date',
			'order'						=> 'DESC'
		);
		
		// $q = 'post_type='. $instance['type'] .'&post_status=publish';
		
		if($instance['type'] == 'te_event') {
			// $q .= '&meta_key=te_event-options-start-date&orderby=meta_value&order=DESC';
			
			$time = date_format(new DateTime(), 'Y/m/d');
			
			$args['meta_key'] 		= 'te_event-options-start-date';
			$args['orderby']			= 'meta_value';
			$args['order']				= 'DESC';
			$args['meta_query']		= array(array(
				'key'	=> 'te_event-options-end-date',
				'value'	=> $time,
				'compare'	=> '>'
			));
		}
	
		$query = new WP_Query($args);
		
		$count = 0;
		while($query->have_posts() && $count < $instance['items']) : $query->the_post();
			$post_id = get_the_ID();
			
			include("templates/" . $instance['type'] . ".php");
			
			$count++;
		endwhile;
		
		wp_reset_query();
		
		?>
		</div>
		
		<?php if($instance['viewAllButton']) : ?>
		<div class="widget-view-all">
			<a href="<?php echo get_permalink(get_page_by_path($url[$instance['type']])); ?>all/">View all <?php echo $type[$instance['type']]; ?></a>
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
		$instance['items']					= strip_tags($new_instance['items']);
		$instance['thumbnails'] 		= strip_tags($new_instance['thumbnails']);
		$instance['viewAllButton'] 	= strip_tags($new_instance['viewAllButton']);
		$instance['showAddthis'] 		= strip_tags($new_instance['showAddthis']);
		$instance['showRatings'] 		= strip_tags($new_instance['showRatings']);
		$instance['showThumbs'] 		= strip_tags($new_instance['showThumbs']);
		$instance['dimensions'] 		= strip_tags($new_instance['dimensions']);
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '',
			'titleB'			=> '',
			'type'				=> 'post',
			'items'				=> '3',
			'thumbnails'		=> true,
			'viewAllButton'	=> true,
			'showAddthis'	=> true,
			'showRatings'	=> false,
			'showThumbs'	=> false,
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
				<option value="te_testemonial"<?php if($instance['type'] == 'te_testemonial') : ?> selected="selected"<?php endif; ?>>Testemonial</option>
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
			<label for="<?php echo $this->get_field_id('dimensions'); ?>">Dimensions:</label><br />
			<select 
				id="<?php echo $this->get_field_id('dimensions'); ?>" 
				name="<?php echo $this->get_field_name('dimensions'); ?>">
				<option value="wide"<?php if($instance['dimensions'] == 'wide') : ?> selected="selected"<?php endif; ?>>Wide</option>
				<option value="square"<?php if($instance['dimensions'] == 'square') : ?> selected="selected"<?php endif; ?>>Square</option>
				<option value="tall"<?php if($instance['dimensions'] == 'tall') : ?> selected="selected"<?php endif; ?>>Tall</option>
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
		
		<p>
			<label for="<?php echo $this->get_field_id('showAddthis'); ?>">Show AddThis buttons:</label>
			<input 
				type="checkbox" 
				id="<?php echo $this->get_field_id('showAddthis'); ?>" 
				name="<?php echo $this->get_field_name('showAddthis'); ?>" 
				<?php if($instance['showAddthis']) : ?> checked="checked"<?php endif; ?>>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('showRatings'); ?>">Show rating:</label>
			<input 
				type="checkbox" 
				id="<?php echo $this->get_field_id('showRatings'); ?>" 
				name="<?php echo $this->get_field_name('showRatings'); ?>" 
				<?php if($instance['showRatings']) : ?> checked="checked"<?php endif; ?>>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('showThumbs'); ?>">Show thumbs:</label>
			<input 
				type="checkbox" 
				id="<?php echo $this->get_field_id('showThumbs'); ?>" 
				name="<?php echo $this->get_field_name('showThumbs'); ?>" 
				<?php if($instance['showThumbs']) : ?> checked="checked"<?php endif; ?>>
		</p>
		
		<?php
	}
}

function te_load_PostStreamWidget() {
	register_widget('TE_PostStreamWidget');
}

add_action('widgets_init', 'te_load_PostStreamWidget');

?>