<?php

/*
Plugin Name: Text Widget
Plugin URI: http://konscript.com
Description: A widget that displays an excerpt of some content type.
Version: 0.1
Author URI: http://konscript.com
*/

class ContentTypeWidget extends WP_Widget {
	function ContentTypeWidget() {
		$widget_ops = array(
			'classname'		=> 'Text Widget',
			'description'	=> 'A widget that displays an excerpt of some content type.'
		);
		
		$control_ops = array(
			'id_base'		=> 'content-type-widget'
		);
		
		$this->WP_Widget(
			$control_ops['id_base'],
			$widget_ops['classname'], 
			$widget_ops,
			$control_ops
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		// START -> Widget
		
		echo $before_widget;
		
		switch($instance['postType']) {
			default:
				$widget_class = 'blog';
				break;
			case 'te_article':
				$widget_class = 'reading-room';
				break;
			case 'te_event':
				$widget_class = 'event';
				break;
		}
		
		if($instance['format'] == "wide")
			$thumbnailSize = 'post-wide-thumbnail';
		else
			$thumbnailSize = 'post-square-small-thumbnail';
		
		echo "<div class=\"widget widget-$widget_class\">";
		
		// START -> Title
		
		$titleA = apply_filters('widget_title', $instance['titleA']);
		$titleB = apply_filters('widget_title', $instance['titleB']);
		
		?><div class="header-container">
		
		<h2 class="first-line"><?php echo $titleA; ?></h2>
		<h2 class="second-line"><?php echo $titleB; ?></h2>
	 	
		</div><?php
		
		// START -> Post
		
		if($instance['streamEnabled']) {
			$posts = get_posts(array(
				'numberposts'	=> $instance['itemCount'],
				'post_type'		=> $instance['postType'],
				'order_by'		=> 'post_date',
				'order'			=> 'DESC',
				'post_status'	=> 'publish,future'
			));
		} else {
			$posts = array();
			
			for($i = 1; $i <= $instance['itemCount']; $i++) {
				if(isset($instance["item_$i"]) && !empty($instance["item_$i"])) {
					$post = get_post($instance["item_$i"]); // Returns null if post not found
					if(isset($post)) {
						$posts[] = $post;
						unset($post);
					}
				}
			}
		}
		
		foreach($posts as $key => $post) {
			echo "<div class=\"item $widget_class\"><div class='item-content'>";
			
			
			$attr = array(
				'class'	=> "featured-image"
			);
			
			if($instance['thumbnailEnabled'] && has_post_thumbnail($post->ID))
				echo "<a href=\"". get_permalink($post->ID)."\">" . get_the_post_thumbnail($post->ID, $thumbnailSize, $attr) . "</a>";
				//echo get_the_post_thumbnail($post->ID, $thumbnailSize, $attr);
			
			if($widget_class == "event") {
				$end_day = get_post_meta($post->ID, '_day', true);
				$end_month = get_post_meta($post->ID, '_month', true);
				$end_year = get_post_meta($post->ID, '_year', true);
				$end_hour = get_post_meta($post->ID, '_hour', true);
				$end_minute = get_post_meta($post->ID, '_minute', true);
				
				$end_date = new DateTime($end_year."-".$end_month."-".$end_day." ".$end_hour.":".$end_minute);
				
				$post_date = $post->post_date;
				$start_date = new DateTime($post_date);
				
				$gs_date = getdate($start_date->getTimestamp());
				
				if($gs_date['year'] == $end_year && $gs_date['mon'] == $end_month && $gs_date['mday'] == $end_day) {
					$date = "". date_format($start_date, 'j M Y H:i - ') . date_format($start_date, 'H:i');
				} else {
					$date = "". date_format($start_date, 'j M Y H:i') . " - " . date_format($end_date, 'j M Y H:i');
				}
			} else {
				$post_date = $post->post_date;
				$date = date_format(new DateTime($post_date), 'j M Y');
			}
			echo "<p class=\"meta-data\">$date</p>";
			
			if($widget_class == "reading-room") {
				echo "<span class=\"by-line\">Article</span>";
			} else if($widget_class == "blog") {
				echo "<span class=\"by-line\">By Tania Ellis</span>";
			}
			
			$title = $post->post_title;
			$title = apply_filters('post_title', $title);
			$title = str_replace(']]>', ']]&gt;', $title);
			
			echo "<a href=\"". get_permalink($post->ID)."\" class=\"title\">$title</a>";
			
			echo "<p class=\"excerpt\">".$post->post_excerpt . the_excerpt()."</p>";
			
			echo "<div class=\"options\"><a class=\"read-more\" href=\"". get_permalink($post->ID)."\">Read more</a></div>";
			
			echo "</div></div>";
		}

		echo $after_widget;
		
		echo "</div>";
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['titleA'] = strip_tags($new_instance['titleA']);
		$instance['titleB'] = strip_tags($new_instance['titleB']);
		$instance['postType'] = strip_tags($new_instance['postType']);
		$instance['format'] = strip_tags($new_instance['format']);
		$instance['itemCount'] = strip_tags($new_instance['itemCount']);
		$instance['thumbnailEnabled'] = strip_tags($new_instance['thumbnailEnabled']);
		$instance['streamEnabled'] = strip_tags($new_instance['streamEnabled']);
	
		for($i = 1; $i <= $instance['itemCount']; $i++) {
			$instance["item_$i"] = strip_tags($new_instance["item_$i"]);
		}
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '',
			'titleB'			=> '',
			'postType'			=> 'te_article',
			'format'			=> 'wide',
			'itemCount'			=> 1,
			'thumbnailEnabled'	=> true,
			'streamEnabled'		=> false
		);
		
		$instnace = wp_parse_args((array) $instance, $defaults);
		
		$titleAId = $this->get_field_id('titleA');
		$titleBId = $this->get_field_id('titleB');
		$postTypeId = $this->get_field_id('postType');
		$formatId = $this->get_field_id('format');
		$itemCountId = $this->get_field_id('itemCount');
		$thumbnailEnabledId = $this->get_field_id('thumbnailEnabled');
		$streamEnabledId = $this->get_field_id('streamEnabled');
		
		?>
		
		<p>
			<label for="<?php echo $titleAId; ?>">Title (first):</label>
			<input id="<?php echo $titleAId; ?>" name="<?php echo $this->get_field_name( 'titleA' ); ?>" value="<?php echo $instance['titleA']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $titleBId; ?>">Title (second):</label>
			<input id="<?php echo $titleBId; ?>" name="<?php echo $this->get_field_name( 'titleB' ); ?>" value="<?php echo $instance['titleB']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $thumbnailEnabledId; ?>">Show thumbnails:</label>
			<input type="checkbox" id="<?php echo $thumbnailEnabledId; ?>" name="<?php echo $this->get_field_name( 'thumbnailEnabled' ); ?>"<?php if($instance['thumbnailEnabled']) echo ' checked="checked"'; ?> />
		</p>
		
		<p>
			<label for="<?php echo $streamEnabledId; ?>">Show recent items:</label>
			<input type="checkbox" id="<?php echo $streamEnabledId; ?>" name="<?php echo $this->get_field_name( 'streamEnabled' ); ?>"<?php if($instance['streamEnabled']) echo ' checked="checked"'; ?> />
		</p>
		
		<p>
			<label for="<?php echo $formatId; ?>">Image Format:</label>
			<select id="<?php echo $formatId; ?>" name="<?php echo $this->get_field_name('format'); ?>">
				<option value="wide"<?php if($instance['format'] == 'wide') echo ' selected="selected"'; ?>>Wide</option>
				<option value="square"<?php if($instance['format'] == 'square') echo ' selected="selected"'; ?>>Square</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $postTypeId; ?>">Post type:</label>
			<select id="<?php echo $postTypeId; ?>" name="<?php echo $this->get_field_name('postType'); ?>">
				<?php
					$list = array("post" => "Post", "te_article" => "Article", 'te_event' => 'Event');
					foreach($list as $key => $value) {
						$selected = ($instance['postType'] == $key) ? ' selected="selected"' : '';
						echo "<option value=\"$key\"$selected>$value</option>";
					}
				
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $itemCountId; ?>">Number of items:</label>
			<select id="<?php echo $itemCountId; ?>" name="<?php echo $this->get_field_name('itemCount'); ?>">
				<?php
				
				for($i = 1; $i <= 10; $i++) {
					if($instance['itemCount'] == $i)
						$selected = 'selected="selected"';
					else
						$selected = '';
						
					echo "<option value=\"$i\" $selected>" . $i. "</option>";
				}
				
				?>
			</select>
		</p>
			
		<?php
		
		if(!$instance['streamEnabled']) {
		
			for($i = 1; $i <= (int)$instance['itemCount']; $i++) {
				?>
			
				<p>
					<label for="<?php echo $this->get_field_id("item_$i"); ?>">Item <?php echo $i; ?>:</label>
					<select id="<?php echo $this->get_field_id("item_$i"); ?>" name="<?php echo $this->get_field_name("item_$i"); ?>">
						<?php

						$args = array(
							'post_type'		=> $instance['postType'],
							'numberposts'	=> -1
						);

						foreach(get_posts($args) as $key => $value) {
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
}

function load_widget_ContentTypeWidget() {
	register_widget('ContentTypeWidget');
}

add_action('widgets_init', 'load_widget_ContentTypeWidget');

?>