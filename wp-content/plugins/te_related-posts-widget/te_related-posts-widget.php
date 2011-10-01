<?php

/*
Plugin Name: TE Related Posts Widget
Plugin URI: http://konscript.com
Description: A widget that displays related posts
Version: 1.0
Author URI: http://konscript.com
*/

class TE_RelatedPostsWidget extends WP_Widget {
	function TE_RelatedPostsWidget	() {
		$this->WP_widget(
			'te_related-posts-widget',
			'TE Related Posts Widget',
			array(
				'classname'		=> 'TE Related Posts Widget',
				'description' => 'A widget that displays related posts.'
			),
			array(
				'id_base'			=> 'te_related-posts-widget'
			)
		);
	}
	
	function widget($args, $instance) {
		global $post;
    if (!is_singular())
      return;

		extract($args);
		
		$titleA = apply_filters('widget_title', $instance['titleA']);
		$titleB = apply_filters('widget_title', $instance['titleB']);
		
		echo $before_widget;
		
		$scores = the_related_get_scores(); // pass the post ID if outside of the loop
			
		if(is_array($scores) && count($scores) > 0)
    	$posts = array_slice( array_keys( $scores ), 0, 5); // keep only the the five best results
		else
    	$posts = array();

		$args = array(
				'post_type'					=> $instance['postType'],
        'post__in'          => $posts,
        'posts_per_page'    => 3,
        'caller_get_posts'  => 1 // ignore sticky status
    );
    $query = new WP_Query( $args );

		$cclass = ($instance['postType'] == 'post') ? 'blog' : 'reading-room';

		if($query->have_posts()) : ?>
			<div class="widget widget-<?php echo $cclass; ?> related">
				<div class="header-container">
					<h2 class="first-line"><?php echo $titleA; ?><h2>
					<h2 class="second-line"><?php echo $titleB; ?></h2>
				</div>
				<?php while($query->have_posts()) : ?>
					<?php $query->the_post(); ?>
					<div class="item <?php echo $cclass; ?>">
						<div class="item-content">								
								<?php if(has_post_thumbnail($post->ID)) : ?>
						      <div class="thumb-wrapper">
						        <div class="thumb-container">
											<a href="<?php the_permalink(); ?>">
						          	<?php the_post_thumbnail('post-wide-thumbnail', array('class' => 'featured-image')); ?>
											</a>
						        </div>
						      </div>
						    <?php endif; ?>
					
								<p class="meta-data"><?php the_time('j M Y') ?></p>
								<span class="by-line">
									<?php if($instance['postType'] == 'te_article') : ?>
										<?php //echo te_get_article_author(get_the_ID()); ?>
										Article
									<?php else : ?>
										By <?php the_author(); ?>
									<?php endif; ?>
								</span>
					
								<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<p class="excerpt"><?php the_excerpt_rss(); ?></a>
						
								<div class="options">
									<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
								</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>		
		<?php endif;
		
		wp_reset_query();
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['titleA']			= strip_tags($new_instance['titleA']);
		$instance['titleB']			= strip_tags($new_instance['titleB']);
		$instance['postType']		= strip_tags($new_instance['postType']);
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'			=> '',
			'titleB'			=> '',
			'postType'		=> 'post',
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
			<label for="<?php echo $postType_id; ?>">Type:</label><br />
			<select 
				id="<?php echo $postType_id; ?>"
				name="<?php echo $postType_name; ?>">
				
				<option value="post"<?php if($instance['postType'] == 'post') echo " selected=\"selected\""; ?>>Blog Post</option>
				<option value="te_article"<?php if($instance['postType'] == 'te_article') echo " selected=\"selected\""; ?>>Article</option>
			</select>
		</p>
		
		<?php
	}
}

function te_load_RelatedPostsWidget() {
	register_widget('TE_RelatedPostsWidget');
}

add_action('widgets_init', 'te_load_RelatedPostsWidget');
	
?>