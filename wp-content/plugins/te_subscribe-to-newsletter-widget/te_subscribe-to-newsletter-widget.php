<?php

/*
Plugin Name: TE Newsletter Subscribe Widget
Plugin URI: http://konscript.com
Description: A widget for subscribing to the newsletter.
Version: 1.0
Author URI: http://konscript.com
*/

class TE_NewsletterSubscribeWidget extends WP_Widget {
	function TE_NewsletterSubscribeWidget() {
		$this->WP_widget(
			'te_newsletter-subscribe-widget',
			'TE Newsletter Subscribe Widget',
			array(
				'classname'		=> 'TE Newsletter Subscribe Widget',
				'description' => 'A widget for subscribing to the newsletter.'
			),
			array(
				'id_base'			=> 'te_newsletter-subscribe-widget'
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
		
		$text = apply_filters('widget_title', $instance['text']);

		$buttonText = apply_filters('widget_title', $instance['buttonText']);
		$buttonLink = $instance['buttonLink'];
		
		
		?>

		<div class="widget widget-newsletter-subscribe">
			
			<?php if(!empty($titleA)) : ?>
				<div class="header-container">
					<h2 class="first-line"><?php echo $titleA; ?></h2>
					<h2 class="second-line"><?php echo $titleB; ?></h2>
				</div> <!-- .header-container -->
			<?php endif; ?>
			
			<div class="newsletter-subscribe">
				<div class="item-content">
				
					<div class="header">
						<p class="first-line"><?php echo $headerB; ?></p>
						<p class="second-line"><?php echo $headerA; ?></p>
					</div>
					
					<div class="content">
						<p><?php echo $text; ?></p>
					</div>
					
					<div class="push"></div>
					<a href="<?php echo $buttonLink; ?>" class="read-more" target="_blank"><?php echo $buttonText; ?></a>
					
				</div> <!-- .item-content -->
			</div> <!-- .blog-subscribe -->

		</div> <!-- .widget .widget-blog-subscribe -->
		
		<?php
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['titleA']						= strip_tags($new_instance['titleA']);
		$instance['titleB']						= strip_tags($new_instance['titleB']);
		
		$instance['headerA']					= strip_tags($new_instance['headerA']);
		$instance['headerB']					= strip_tags($new_instance['headerB']);
		
		$instance['text']							= strip_tags($new_instance['text']);
		
		$instance['buttonText']				= strip_tags($new_instance['buttonText']);
		$instance['buttonLink']				= strip_tags($new_instance['buttonLink']);

		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '',
			'titleB'			=> '',
			'headerA'			=> '',
			'headerB'			=> '',
			'text'				=> '',
			'buttonText'	=> '',
			'buttonLink'	=> '',
		);
		
		foreach($defaults as $key => $value) {
			$$key = (!empty($instance[$key])) ? $instance[$key] : $value;

			$idn = $key.'_id';
			$nn = $key.'_name';
			
			$$idn = $this->get_field_id($key);			
			$$nn = $this->get_field_name($key);
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
			<label for="<?php echo $headerA_id; ?>">Header (first):</label><br />
			<input 
				type="text"
				id="<?php echo $headerA_id; ?>"
				name="<?php echo $headerA_name; ?>"
				value="<?php echo $headerA; ?>" />
		</p>

		<p>
			<label for="<?php echo $headerB_id; ?>">Header (second):</label><br />
			<input
				type="text"
				id="<?php echo $headerB_id; ?>"
				name="<?php echo $headerB_name; ?>"
				value="<?php echo $headerB; ?>" />
		</p>
	
		<p>
			<label for="<?php echo $text_id; ?>">Text:</label><br />
			<textarea
				id="<?php echo $text_id; ?>"
				name="<?php echo $text_name; ?>"
				style="width:100%;"
				rows="6"><?php echo $text; ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $buttonText_id; ?>">Button text:</label><br />
			<input 
				type="text"
				id="<?php echo $buttonText_id; ?>"
				name="<?php echo $buttonText_name; ?>"
				value="<?php echo $buttonText; ?>" />
		</p>

		<p>
			<label for="<?php echo $buttonLink_id; ?>">Button link:</label><br />
			<input 
				type="text"
				id="<?php echo $buttonLink_id; ?>"
				name="<?php echo $buttonLink_name; ?>"
				value="<?php echo $buttonLink; ?>" />
		</p>
		
		<?php
	}
}


function te_load_NewsletterSubscribeWidget() {
	register_widget('TE_NewsletterSubscribeWidget');
}
add_action('widgets_init', 'te_load_NewsletterSubscribeWidget');

?>