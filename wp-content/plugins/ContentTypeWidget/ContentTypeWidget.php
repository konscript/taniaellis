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
		
		if($instance['format'] === "wide")
			$thumbnailSize = 'post-wide-thumbnail';
		else
			$thumbnailSize = 'thumbnail';
		
		echo "<div class=\"widget widget-$widget_class\">";
		
		// START -> Title
		
		$titleA = apply_filters('widget_title', $instance['titleA']);
		$titleB = apply_filters('widget_title', $instance['titleB']);
		
		?><div class="header-container">
		
		<h2 class="first-line"><?php echo $titleA; ?></h2>
		<h2 class="second-line"><?php echo $titleB; ?></h2>
	 	
		</div><?php
		
		// START -> Post
		
		for($i = 1; $i <= $instance['itemCount']; $i++) {
			echo "<div class=\"item $widget_class\"><div class='item-content'>";
			$item = "item_$i";
			$postId = $instance[$item];
			
			$attr = array(
				'class'	=> "featured-image"
			);
			
			if($instance['thumbnailEnabled'] && has_post_thumbnail($postId))
				echo get_the_post_thumbnail($postId, $thumbnailSize, $attr);
			
			$qpost = get_post($postId);
			
			if($widget_class == "event") {
				$date = "Event Date: " . get_post_meta($postId, 'event_date', true);
			} else {
				$post_date = $qpost->post_date;
				$date = date_format(new DateTime($post_date), 'j M Y');
			}
			echo "<p class=\"meta-data\">$date</p>";
			
			$title = $qpost->post_title;
			$title = apply_filters('post_title', $title);
			$title = str_replace(']]>', ']]&gt;', $title);
			
			echo "<h2 class=\"title\">$title</h2>";
			
			
			$content = $qpost->post_content;
			$content = str_replace(']]>', ']]&gt;', $content);
			
			echo "<p class=\"excerpt\">$content</p>";
			
			echo "<div class=\"options\"><a class=\"read-more\" href=\"#\">Read more</a></div>";
			
			echo "</div></div>";
		}

		echo $after_widget;
		
		?></div><?php
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['titleA'] = strip_tags($new_instance['titleA']);
		$instance['titleB'] = strip_tags($new_instance['titleB']);
		$instance['postType'] = strip_tags($new_instance['postType']);
		$instance['format'] = strip_tags($new_instance['format']);
		$instance['itemCount'] = strip_tags($new_instance['itemCount']);
		$instance['thumbnailEnabled'] = strip_tags($new_instance['thumbnailEnabled']);
	
		for($i = 1; $i <= $instance['itemCount']; $i++) {
			$instance["item_$i"] = strip_tags($new_instance["item_$i"]);
		}
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'	=> '',
			'titleB'	=> '',
			'postType'	=> 'te_article',
			'format'	=> 'wide',
			'itemCount'	=> 1,
			'thumbnailEnabled' => true
		);
		
		$instnace = wp_parse_args((array) $instance, $defaults);
		
		$titleAId = $this->get_field_id('titleA');
		$titleBId = $this->get_field_id('titleB');
		$postTypeId = $this->get_field_id('postType');
		$formatId = $this->get_field_id('format');
		$itemCountId = $this->get_field_id('itemCount');
		$thumbnailEnabledId = $this->get_field_id('thumbnailEnabled');
		
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
			<label for="<?php echo $formatId; ?>">Image Format:</label>
			<select id="<?php echo $formatId; ?>" name="<?php echo $this->get_field_name('format'); ?>">
				<option value="wide"<?php if($instance['format'] == 'wide') echo ' selected="selected"'; ?>>Wide</option>
				<option value="thin"<?php if($instance['format'] == 'square') echo ' selected="selected"'; ?>>Square</option>
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

function load_widget_ContentTypeWidget() {
	register_widget('ContentTypeWidget');
}

add_action('widgets_init', 'load_widget_ContentTypeWidget');

?>