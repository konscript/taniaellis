<?php

/*
Plugin Name: TE Pack Widget
Plugin URI: http://konscript.com
Description: A widget for displaying packages.
Version: 1.0
Author URI: http://konscript.com
*/

class TE_PackWidget extends WP_Widget {
	function TE_PackWidget() {
		$this->WP_widget(
			'te_pack-widget',
			'TE Pack Widget',
			array(
				'classname'		=> 'TE Pack Widget',
				'description' => 'A widget for displaying packages.'
			),
			array(
				'id_base'			=> 'te_pack-widget'
			)
		);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		$titleA = apply_filters('widget_title', $instance['titleA']);
		$titleB = apply_filters('widget_title', $instance['titleB']);
		
		$headerA = apply_filters('widget_title', $instance['headerA']);
		$headerB = apply_filters('widget_title', $instance['headerB']);
		$subheaderA = apply_filters('widget_title', $instance['subheaderA']);
		$subheaderB = apply_filters('widget_title', $instance['subheaderB']);
		
		$packTitleA = apply_filters('widget_title', $instance['packTitleA']);
		$packTitleB = apply_filters('widget_title', $instance['packTitleB']);

		$textA = apply_filters('widget_excerpt', $instance['textA']);
		$textB = apply_filters('widget_excerpt', $instance['textB']);
		
		$colorA = apply_filters('widget_excerpt', $instance['colorA']);
		$colorB = apply_filters('widget_excerpt', $instance['colorB']);
		
		$item1A = apply_filters('widget_excerpt', $instance['item1A']);
		$item2A = apply_filters('widget_excerpt', $instance['item2A']);
		$item3A = apply_filters('widget_excerpt', $instance['item3A']);
		$item4A = apply_filters('widget_excerpt', $instance['item4A']);
		$item5A = apply_filters('widget_excerpt', $instance['item5A']);
		$item6A = apply_filters('widget_excerpt', $instance['item6A']);
		$item7A = apply_filters('widget_excerpt', $instance['item7A']);
		$item8A = apply_filters('widget_excerpt', $instance['item8A']);
		
		$item1B = apply_filters('widget_excerpt', $instance['item1B']);
		$item2B = apply_filters('widget_excerpt', $instance['item2B']);
		$item3B = apply_filters('widget_excerpt', $instance['item3B']);
		$item4B = apply_filters('widget_excerpt', $instance['item4B']);
		$item5B = apply_filters('widget_excerpt', $instance['item5B']);
		$item6B = apply_filters('widget_excerpt', $instance['item6B']);
		$item7B = apply_filters('widget_excerpt', $instance['item7B']);
		$item8B = apply_filters('widget_excerpt', $instance['item8B']);
		
		$linkA = $instance['linkA'];
		$linkB = $instance['linkB'];
		$linkTextA = $instance['linkTextA'];
		$linkTextB = $instance['linkTextB'];
		
		$viewAllURL = $instance['viewAllURL'];
		$viewAllText = $instance['viewAllText'];
		
		?>

		<div class="widget widget-key-services" style="background: url('<?php bloginfo('template_url'); ?>/images/post_type_icon_pack.png') top left no-repeat">
			
			<?php if(!empty($titleA)) : ?>
				<div class="header-container">
					<h2 class="first-line"><?php echo $titleA; ?></h2>
					<h2 class="second-line"><?php echo $titleB; ?></h2>
				</div> <!-- .header-container -->
			<?php endif; ?>

			<div class="key-services">
				<div class="item-content">
				
					<div class="key-service uneven" id="<?php echo $colorA; ?>">

						<div class="header">
							<p class="second-line"><?php echo $headerA; ?></p>
							<p class="first-line"><?php echo $subheaderA; ?></p>
						</div>

						<p class="content">
							<strong><?php echo $packTitleA; ?></strong><br>
							<?php echo $textA; ?>
						</p>

						<ul>
							<?php if(!empty($item1A)) : ?>
								<li><span>&nbsp;</span><?php echo $item1A; ?></li>
							<?php endif; ?>
							<?php if(!empty($item2A)) : ?>
								<li><span>&nbsp;</span><?php echo $item2A; ?></li>
							<?php endif; ?>
							<?php if(!empty($item3A)) : ?>
								<li><span>&nbsp;</span><?php echo $item3A; ?></li>
							<?php endif; ?>
							<?php if(!empty($item4A)) : ?>
								<li><span>&nbsp;</span><?php echo $item4A; ?></li>
							<?php endif; ?>
							<?php if(!empty($item5A)) : ?>
								<li><span>&nbsp;</span><?php echo $item5A; ?></li>
							<?php endif; ?>
							<?php if(!empty($item6A)) : ?>
								<li><span>&nbsp;</span><?php echo $item6A; ?></li>
							<?php endif; ?>
							<?php if(!empty($item7A)) : ?>
								<li><span>&nbsp;</span><?php echo $item7A; ?></li>
							<?php endif; ?>
							<?php if(!empty($item8A)) : ?>
								<li><span>&nbsp;</span><?php echo $item8A; ?></li>
							<?php endif; ?>
						</ul>
						
						<div class="push"></div>
						<a href="<?php echo $linkA;?>" class="key-service-read-more"><?php echo $linkTextA; ?></a>
					</div> <!-- .key-service #grey -->
					
					<div class="key-service" id="<?php echo $colorB; ?>">

						<div class="header">
							<p class="second-line"><?php echo $headerB; ?></p>
							<p class="first-line"><?php echo $subheaderB; ?></p>
						</div>

						<p class="content">
							<strong><?php echo $packTitleB; ?></strong><br>
							<?php echo $textB; ?>
						</p>

						<ul>
							<?php if(!empty($item1B)) : ?>
								<li><span>&nbsp;</span><?php echo $item1B; ?></li>
							<?php endif; ?>
							<?php if(!empty($item2B)) : ?>
								<li><span>&nbsp;</span><?php echo $item2B; ?></li>
							<?php endif; ?>
							<?php if(!empty($item3B)) : ?>
								<li><span>&nbsp;</span><?php echo $item3B; ?></li>
							<?php endif; ?>
							<?php if(!empty($item4B)) : ?>
								<li><span>&nbsp;</span><?php echo $item4B; ?></li>
							<?php endif; ?>
							<?php if(!empty($item5B)) : ?>
								<li><span>&nbsp;</span><?php echo $item5B; ?></li>
							<?php endif; ?>
							<?php if(!empty($item6B)) : ?>
								<li><span>&nbsp;</span><?php echo $item6B; ?></li>
							<?php endif; ?>
							<?php if(!empty($item7B)) : ?>
								<li><span>&nbsp;</span><?php echo $item7B; ?></li>
							<?php endif; ?>
							<?php if(!empty($item8B)) : ?>
								<li><span>&nbsp;</span><?php echo $item8B; ?></li>
							<?php endif; ?>
						</ul>
						
						<div class="push"></div>
						<a href="<?php echo $linkB;?>" class="key-service-read-more"><?php echo $linkTextB; ?></a>
					</div> <!-- .key-service #grey -->
				</div> <!-- .item-content -->
			</div> <!-- .item .key-services -->
		</div> <!-- .widget .widget-key-services -->
		
		<?php if(!empty($viewAllText) && !empty($viewAllURL)) : ?>
		<div class="widget-view-all">
			<a href="<?php echo $viewAllURL; ?>"><?php echo $viewAllText; ?></a>
		</div>

		<?php endif; ?>
		
		
		<?php
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['titleA']						= strip_tags($new_instance['titleA']);
		$instance['titleB']						= strip_tags($new_instance['titleB']);
		
		$instance['headerA']					= strip_tags($new_instance['headerA']);
		$instance['headerB']					= strip_tags($new_instance['headerB']);
		$instance['subheaderA']				= strip_tags($new_instance['subheaderA']);
		$instance['subheaderB']				= strip_tags($new_instance['subheaderB']);
		
		$instance['packTitleA']				= strip_tags($new_instance['packTitleA']);
		$instance['packTitleB']				= strip_tags($new_instance['packTitleB']);
		
		$instance['textA']						= strip_tags($new_instance['textA']);
		$instance['textB']						= strip_tags($new_instance['textB']);
		
		$instance['colorA']						= strip_tags($new_instance['colorA']);
		$instance['colorB']						= strip_tags($new_instance['colorB']);
		
		$instance['item1A']						= strip_tags($new_instance['item1A']);
		$instance['item2A']						= strip_tags($new_instance['item2A']);
		$instance['item3A']						= strip_tags($new_instance['item3A']);
		$instance['item4A']						= strip_tags($new_instance['item4A']);
		$instance['item5A']						= strip_tags($new_instance['item5A']);
		$instance['item6A']						= strip_tags($new_instance['item6A']);
		$instance['item7A']						= strip_tags($new_instance['item7A']);
		$instance['item8A']						= strip_tags($new_instance['item8A']);
		
		$instance['item1B']						= strip_tags($new_instance['item1B']);
		$instance['item2B']						= strip_tags($new_instance['item2B']);
		$instance['item3B']						= strip_tags($new_instance['item3B']);
		$instance['item4B']						= strip_tags($new_instance['item4B']);
		$instance['item5B']						= strip_tags($new_instance['item5B']);
		$instance['item6B']						= strip_tags($new_instance['item6B']);
		$instance['item7B']						= strip_tags($new_instance['item7B']);
		$instance['item8B']						= strip_tags($new_instance['item8B']);
		
		$instance['linkA']				= strip_tags($new_instance['linkA']);
		$instance['linkB']				= strip_tags($new_instance['linkB']);
		$instance['linkTextA']		= strip_tags($new_instance['linkTextA']);
		$instance['linkTextB']		= strip_tags($new_instance['linkTextB']);
		
		
		$instance['viewAllURL']	= strip_tags($new_instance['viewAllURL']);
		$instance['viewAllText']		= strip_tags($new_instance['viewAllText']);

		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '',
			'titleB'			=> '',
			'headerA'			=> '',
			'headerB'			=> '',
			'subheaderA'	=> '',
			'subheaderB'	=> '',
			'packTitleA'	=> '',
			'packTitleB'	=> '',
			'textA'				=> '',
			'textB'				=> '',
			'colorA'			=> 'grey',
			'colorB'			=> 'grey',
			'item1A'			=> '',
			'item2A'			=> '',
			'item3A'			=> '',
			'item4A'			=> '',
			'item5A'			=> '',
			'item6A'			=> '',
			'item7A'			=> '',
			'item8A'			=> '',
			'item1B'			=> '',
			'item2B'			=> '',
			'item3B'			=> '',
			'item4B'			=> '',
			'item5B'			=> '',
			'item6B'			=> '',
			'item7B'			=> '',
			'item8B'			=> '',
			'linkA'				=> '',
			'linkB'				=> '',
			'linkTextA'		=> '',
			'linkTextB'		=> '',
			'viewAllURL'	=> '',
			'viewAllText'	=> '',
		);
		
		foreach($defaults as $key => $value) {
			$$key = (!empty($instance[$key])) ? $instance[$key] : $value;

			$idn = $key.'_id';
			$nn = $key.'_name';
			
			$$idn = $this->get_field_id($key);			
			$$nn = $this->get_field_name($key);
		}
		
		$orangeColor = "orange";
		$blueColor = "blue";
		$purpleColor = "purple";
		$greyColor = "grey";
		
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
		
		<p><h3>Pack A</h3></p>
		
		<p>
			<label for="<?php echo $headerA_id; ?>">Header:</label><br />
			<input 
				type="text"
				id="<?php echo $headerA_id; ?>"
				name="<?php echo $headerA_name; ?>"
				value="<?php echo $headerA; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $subheaderA_id; ?>">SubHeader:</label><br />
			<input 
				type="text"
				id="<?php echo $subheaderA_id; ?>"
				name="<?php echo $subheaderA_name; ?>"
				value="<?php echo $subheaderA; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $packTitleA_id; ?>">Content title:</label><br />
			<input 
				type="text"
				id="<?php echo $packTitleA_id; ?>"
				name="<?php echo $packTitleA_name; ?>"
				value="<?php echo $packTitleA; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $textA_id; ?>">Text:</label><br />
			<textarea
				id="<?php echo $textA_id; ?>"
				name="<?php echo $textA_name; ?>"
				style="width:100%;"
				rows="6"><?php echo $textA; ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $linkTextA_id; ?>">Button text:</label><br />
			<input 
				type="text"
				id="<?php echo $linkTextA_id; ?>"
				name="<?php echo $linkTextA_name; ?>"
				value="<?php echo $linkTextA; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $linkA_id; ?>">Button link:</label><br />
			<input 
				type="text"
				id="<?php echo $linkA_id; ?>"
				name="<?php echo $linkA_name; ?>"
				value="<?php echo $linkA; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $colorA_id; ?>">Color:</label><br />
			<select id="<?php echo $colorA_id; ?>" name="<?php echo $colorA_name; ?>">
				<option value="<?php echo $orangeColor; ?>"<?php if($instance['colorA'] == $orangeColor) : ?> selected="selected"<?php endif; ?>>Orange</option>
				<option value="<?php echo $blueColor; ?>"<?php if($instance['colorA'] == $blueColor) : ?> selected="selected"<?php endif; ?>>blue</option>
				<option value="<?php echo $purpleColor; ?>"<?php if($instance['colorA'] == $purpleColor) : ?> selected="selected"<?php endif; ?>>Purple</option>
				<option value="<?php echo $greyColor; ?>"<?php if($instance['colorA'] == $greyColor) : ?> selected="selected"<?php endif; ?>>Grey</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $item1A_id; ?>">Item 1:</label><br />
			<input 
				type="text"
				id="<?php echo $item1A_id; ?>"
				name="<?php echo $item1A_name; ?>"
				value="<?php echo $item1A; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $item2A_id; ?>">Item 2:</label><br />
			<input 
				type="text"
				id="<?php echo $item2A_id; ?>"
				name="<?php echo $item2A_name; ?>"
				value="<?php echo $item2A; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $item3A_id; ?>">Item 3:</label><br />
			<input 
				type="text"
				id="<?php echo $item3A_id; ?>"
				name="<?php echo $item3A_name; ?>"
				value="<?php echo $item3A; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $item4A_id; ?>">Item 4:</label><br />
			<input 
				type="text"
				id="<?php echo $item4A_id; ?>"
				name="<?php echo $item4A_name; ?>"
				value="<?php echo $item4A; ?>" />
		</p>
			
		<p>
			<label for="<?php echo $item5A_id; ?>">Item 5:</label><br />
			<input 
				type="text"
				id="<?php echo $item5A_id; ?>"
				name="<?php echo $item5A_name; ?>"
				value="<?php echo $item5A; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $item6A_id; ?>">Item 6:</label><br />
			<input 
				type="text"
				id="<?php echo $item6A_id; ?>"
				name="<?php echo $item6A_name; ?>"
				value="<?php echo $item6A; ?>" />
		</p>
		
		<p7
			<label for="<?php echo $item7A_id; ?>">Item 7:</label><br />
			<input 
				type="text"
				id="<?php echo $item7A_id; ?>"
				name="<?php echo $item7A_name; ?>"
				value="<?php echo $item7A; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $item8A_id; ?>">Item 8:</label><br />
			<input 
				type="text"
				id="<?php echo $item8A_id; ?>"
				name="<?php echo $item8A_name; ?>"
				value="<?php echo $item8A; ?>" />
		</p>
		
		<p><h3>Pack B</h3></p>
		
		<p>
			<label for="<?php echo $headerB_id; ?>">Header:</label><br />
			<input 
				type="text"
				id="<?php echo $headerB_id; ?>"
				name="<?php echo $headerB_name; ?>"
				value="<?php echo $headerB; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $subheaderB_id; ?>">SubHeader:</label><br />
			<input 
				type="text"
				id="<?php echo $subheaderB_id; ?>"
				name="<?php echo $subheaderB_name; ?>"
				value="<?php echo $subheaderB; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $packTitleB_id; ?>">Content title:</label><br />
			<input 
				type="text"
				id="<?php echo $packTitleB_id; ?>"
				name="<?php echo $packTitleB_name; ?>"
				value="<?php echo $packTitleB; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $textB_id; ?>">Text:</label><br />
			<textarea
				id="<?php echo $textB_id; ?>"
				name="<?php echo $textB_name; ?>"
				style="width:100%;"
				rows="6"><?php echo $textB; ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $linkTextB_id; ?>">Button text:</label><br />
			<input 
				type="text"
				id="<?php echo $linkTextB_id; ?>"
				name="<?php echo $linkTextB_name; ?>"
				value="<?php echo $linkTextB; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $linkB_id; ?>">Button link:</label><br />
			<input 
				type="text"
				id="<?php echo $linkB_id; ?>"
				name="<?php echo $linkB_name; ?>"
				value="<?php echo $linkB; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $colorB_id; ?>">Color:</label><br />
			<select id="<?php echo $colorB_id; ?>" name="<?php echo $colorB_name; ?>">
				<option value="<?php echo $orangeColor; ?>"<?php if($instance['colorB'] == $orangeColor) : ?> selected="selected"<?php endif; ?>>Orange</option>
				<option value="<?php echo $blueColor; ?>"<?php if($instance['colorB'] == $blueColor) : ?> selected="selected"<?php endif; ?>>blue</option>
				<option value="<?php echo $purpleColor; ?>"<?php if($instance['colorB'] == $purpleColor) : ?> selected="selected"<?php endif; ?>>Purple</option>
				<option value="<?php echo $greyColor; ?>"<?php if($instance['colorB'] == $greyColor) : ?> selected="selected"<?php endif; ?>>Grey</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $item1A_id; ?>">Item 1:</label><br />
			<input 
				type="text"
				id="<?php echo $item1B_id; ?>"
				name="<?php echo $item1B_name; ?>"
				value="<?php echo $item1B; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $item2B_id; ?>">Item 2:</label><br />
			<input 
				type="text"
				id="<?php echo $item2B_id; ?>"
				name="<?php echo $item2B_name; ?>"
				value="<?php echo $item2B; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $item3B_id; ?>">Item 3:</label><br />
			<input 
				type="text"
				id="<?php echo $item3B_id; ?>"
				name="<?php echo $item3B_name; ?>"
				value="<?php echo $item3B; ?>" />
		</p>

		<p>
			<label for="<?php echo $item4B_id; ?>">Item 4:</label><br />
			<input 
				type="text"
				id="<?php echo $item4B_id; ?>"
				name="<?php echo $item4B_name; ?>"
				value="<?php echo $item4B; ?>" />
		</p>

		<p>
			<label for="<?php echo $item5B_id; ?>">Item 5:</label><br />
			<input 
				type="text"
				id="<?php echo $item5B_id; ?>"
				name="<?php echo $item5B_name; ?>"
				value="<?php echo $item5B; ?>" />
		</p>

		<p>
			<label for="<?php echo $item6B_id; ?>">Item 6:</label><br />
			<input 
				type="text"
				id="<?php echo $item6B_id; ?>"
				name="<?php echo $item6B_name; ?>"
				value="<?php echo $item6B; ?>" />
		</p>

		<p7
			<label for="<?php echo $item7B_id; ?>">Item 7:</label><br />
			<input 
				type="text"
				id="<?php echo $item7B_id; ?>"
				name="<?php echo $item7B_name; ?>"
				value="<?php echo $item7B; ?>" />
		</p>

		<p>
			<label for="<?php echo $item8B_id; ?>">Item 8:</label><br />
			<input 
				type="text"
				id="<?php echo $item8B_id; ?>"
				name="<?php echo $item8B_name; ?>"
				value="<?php echo $item8B; ?>" />
		</p>
		
		<p><h3>View all</h3></p>
	
		
		<p>
			<label for="<?php echo $viewAllURL_id; ?>">View All URL:</label><br />
			<input 
				type="text"
				id="<?php echo $viewAllURL_id; ?>"
				name="<?php echo $viewAllURL_name; ?>"
				value="<?php echo $viewAllURL; ?>" />
		</p>

		<p>
			<label for="<?php echo $viewAllText_id; ?>">View All Text:</label><br />
			<input 
				type="text"
				id="<?php echo $viewAllText_id; ?>"
				name="<?php echo $viewAllText_name; ?>"
				value="<?php echo $viewAllText; ?>" />
		</p>
		
		<?php
	}
}


function te_load_PackWidget() {
	register_widget('TE_PackWidget');
}
add_action('widgets_init', 'te_load_PackWidget');

?>