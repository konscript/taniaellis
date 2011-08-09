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
			'post'		=> 'blog',
			'event'		=> 'event',
			'article'	=> 'reading-room'
		);
		
		$ptype = array(
			'post'		=> 'post',
			'event'		=> 'te_event',
			'article'	=> 'te_article'
		);
		
		$tsize = array(
			'wide'		=> 'post-wide-thumbnail',
			'square'	=> 'post-square-thumbnail',
			'tall'		=> 'post-tall-thumbnail'
		);
		
		?>
		
		<div class="widget widget-<?php echo $wclass[$instance['type']]; ?>">
			<div class="header-container">
				<h2 class="first-line"><?php echo $titleA; ?><h2>
				<h2 class="second-line"><?php echo $titleB; ?></h2>
			</div>
			
		<?php
		
		$query = new WP_Query('post_type='. $ptype[$instance['type']] .'&post_status=publish,future');
		
		$count = 0;
		while($query->have_posts() && $count < $instance['items']) : $query->the_post();
			
			if($instance['type'] == 'event') {
				$end = new DateTime(
									get_post_meta(get_the_ID(), '_year', true)		.'-'.
									get_post_meta(get_the_ID(), '_month', true)		.'-'.
									get_post_meta(get_the_ID(), '_day', true)		.' '.
									get_post_meta(get_the_ID(), '_hour', true)		.':'.
									get_post_meta(get_the_ID(), '_minute', true)
								);
			}
			
			?>
			
			<div class="item <?php echo $wclass[$instance['type']]; ?>">
				<div class="item-content">
					<?php if($instance['thumbnails']) : ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail($tsize[$instance['size']], array('class' => 'featured-image')); ?>
					</a>
					<?php endif; ?>
				
					<p class="meta-data"><?php the_time('j M Y H:i'); if(isset($end)) echo " - ".date_format($end, 'j M Y H:i'); ?></p>
					
					<span class="by-line">
						<?php if($instance['type'] == 'article') : ?>
							Article
						<?php else : ?>
						By <?php the_author(); ?>
						<?php endif; ?>
					</span>
					
					<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<p class="excerpt"><?php the_excerpt_rss(); ?></p>
				
					<div class="options">
						<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
					</div>
				</div>
			</div>
			
			<?php
			
			$count++;
		endwhile;
		
		wp_reset_query();
		
		?>
		</div>
		<?php
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['titleA'] 	= strip_tags($new_instance['titleA']);
		$instance['titleB'] 	= strip_tags($new_instance['titleB']);
		$instance['type']		= strip_tags($new_instance['type']);
		$instance['size']		= strip_tags($new_instance['size']);
		$instance['items']		= strip_tags($new_instance['items']);
		$instance['thumbnails'] = strip_tags($new_instance['thumbnails']);
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '',
			'titleB'			=> '',
			'type'				=> 'post',
			'size'				=> 'wide',
			'items'				=> '3',
			'thumbnails'		=> true
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
				<option value="event"<?php if($instance['type'] == 'event') : ?> selected="selected"<?php endif; ?>>Event</option>
				<option value="article"<?php if($instance['type'] == 'article') : ?> selected="selected"<?php endif; ?>>Article</option>
					
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
		
		<?php
	}
}

function te_load_PostStreamWidget() {
	register_widget('TE_PostStreamWidget');
}

add_action('widgets_init', 'te_load_PostStreamWidget');

?>