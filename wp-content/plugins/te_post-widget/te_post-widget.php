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
			'te_testemonial_video'	=> 'video-testemonial',
			'te_interview'					=> 'interview',
			'te_case'								=> 'case',
			'te_client'							=> 'clientcase',
			'te_news'								=> 'news',
		);
		
		$type = array(
			'post'									=> 'blog posts',
			'te_article'						=> 'articles',
			'te_event'							=> 'events',
			'te_testemonial'				=> 'testemonials',
			'te_testemonial_video'	=> 'testemonials',
			'te_interview'					=> 'TV interviews',
			'te_case'								=> 'cases',
			'te_client'							=> 'clients',
			'te_news'								=> 'news',
		);
		
		$url = array(
			'post'									=> 'blog/all',
			'te_article'						=> 'reading-room/articles',
			'te_event'							=> 'events/all',
			'te_testemonail'				=> 'cases/all',
			'te_testemonail_video'	=> 'cases/all',
			'te_interview'					=> 'reading-room/interviews',
			'te_case'								=> 'cases/view-all-cases',
			'te_client'							=> 'cases/view-all-clients',
			'te_news'								=> 'about/company-news',
		);
		
		?>
		
		<div class="widget widget-<?php echo $wclass[$instance['type']]; ?><?php if(!$instance['showAddthis']) echo " no-addthis"; ?>">
			<div class="header-container">
				<h2 class="first-line"><?php echo $titleA; ?><h2>
				<h2 class="second-line"><?php echo $titleB; ?></h2>
			</div>
			
		<?php
		
		query_posts(array(
			'post_type'		=> (($instance['type'] == 'te_testemonial_video') ? 'te_testemonial' : $instance['type']),
			'post__in' 		=> $this->items($instance),
			'posts_per_page' => $instance['items']
		));
		
		$count = 0;
		while(have_posts() && $count <= $instance['items']) : the_post();
			$post_id = get_the_ID();
			
			@include WP_PLUGIN_DIR . '/te_post-stream-widget/templates/' .  $instance['type'] . '.php';
			$count++;
		endwhile;
		
		wp_reset_query();
		?>
		
		<?php if($instance['type'] == 'te_client') : ?>
			<div class="client-footer">
				<a href="<?php echo trailingslashit(site_url()) . trailingslashit($url['te_case']); ?>">View all cases</a>
				<a href="<?php echo trailingslashit(site_url()) . trailingslashit($url['te_client']); ?>">View all clients</a>
			</div>
		<?php endif; ?>
		
		</div>
		
		<?php if($instance['viewAllButton']) : ?>
		<div class="widget-view-all">
			<a href="<?php echo trailingslashit(site_url()) . trailingslashit($url[$instance['type']]); ?>">View all <?php echo $type[$instance['type']]; ?></a>
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
		$instance['showAddthis'] 	= strip_tags($new_instance['showAddthis']);
		$instance['showRatings'] 	= strip_tags($new_instance['showRatings']);
		$instance['showThumbs'] 		= strip_tags($new_instance['showThumbs']);
		
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
			'items'					=> '3',
			'thumbnails'		=> true,
			'viewAllButton'	=> false,
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
				<option value="te_case"<?php if($instance['type'] == 'te_case') : ?> selected="selected"<?php endif; ?>>Case</option>
				<option value="te_client"<?php if($instance['type'] == 'te_client') : ?> selected="selected"<?php endif; ?>>Client</option>
				<option value="te_testemonial"<?php if($instance['type'] == 'te_testemonial') : ?> selected="selected"<?php endif; ?>>Testimonial</option>	
				<option value="te_testemonial_video"<?php if($instance['type'] == 'te_testemonial_video') : ?> selected="selected"<?php endif; ?>>Video Testimonial</option>	
				<option value="te_interview"<?php if($instance['type'] == 'te_interview') : ?> selected="selected"<?php endif; ?>>TV Interview</option>	
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('items'); ?>">Items to show:</label><br />
			<input 
				type="text"
				size="2"
				id="<?php echo $this->get_field_id('items'); ?>"
				name="<?php echo $this->get_field_name('items'); ?>"
				value="<?php echo $instance['items']; ?>" />
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
			
				<?php
			}
	}
}

function te_load_PostWidget() {
	register_widget('TE_PostWidget');
}

add_action('widgets_init', 'te_load_PostWidget');

?>