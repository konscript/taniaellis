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
				$class = 'widget-books';
				break;
			case 'te_article':
				$class = 'widget-reading-room';
				break;
		}
		
		if($instance['format'] === "wide")
			$side = 'right';
		else
			$side = 'left';
		
		echo "<div class=\"widget-container-$side $class\">";
		
		// START -> Title
		
		$titleA = apply_filters('widget_title', $instance['titleA']);
		$titleB = apply_filters('widget_title', $instance['titleB']);
		
		?><div class="header-container">
		
		<h2 class="first-line"><?php echo $titleA; ?></h2>
		<h2 class="second-line"><?php echo $titleB; ?></h2>
	 	
		</div><?php
		

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
			'format'	=> 'thin',
			'itemCount'	=> 1
		);
		
		$instnace = wp_parse_args((array) $instance, $defaults);
		
		$titleAId = $this->get_field_id('titleA');
		$titleBId = $this->get_field_id('titleB');
		$postTypeId = $this->get_field_id('postType');
		$formatId = $this->get_field_id('format');
		$itemCountId = $this->get_field_id('itemCount');
		
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
			<label for="<?php echo $formatId; ?>">Format:</label>
			<select id="<?php echo $formatId; ?>" name="<?php echo $this->get_field_name('format'); ?>">
				<option value="wide"<?php if($instance['format'] == 'wide') echo ' selected="selected"'; ?>>Wide</option>
				<option value="thin"<?php if($instance['format'] == 'thin') echo ' selected="selected"'; ?>>Thin</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $postTypeId; ?>">Post type:</label>
			<select id="<?php echo $postTypeId; ?>" name="<?php echo $this->get_field_name('postType'); ?>">
				<?php
								// 
								// $args = array('public'   => true,'_builtin' => false);
								// 
								// foreach(get_post_types($args, 'objects') as $key => $value) {
								// 	$labels = (array) $value->labels;
								// 	$name = $labels['singular_name'];
								// 	if($instance['postType'] == $key)
								// 		$selected = 'selected="selected"';
								// 	else
								// 		$selected = '';
								// 		
								// 	echo "<option value=\"$key\" $selected>" . $name. "</option>";
								// }
								
					$list = array("post" => "Post", "te_article" => "Article");
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