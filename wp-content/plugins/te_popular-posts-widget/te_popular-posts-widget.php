<?php

/*
Plugin Name: TE Popular Posts Widget
Plugin URI: http://konscript.com
Description: A widget that displays popular posts
Version: 1.0
Author URI: http://konscript.com
*/

class TE_PopularPostsWidget extends WP_Widget {
	function TE_PopularPostsWidget	() {
		$this->WP_widget(
			'te_popular-posts-widget',
			'TE Popular Posts Widget',
			array(
				'classname'		=> 'TE Popular Posts Widget',
				'description' => 'A widget that displays popular posts.'
			),
			array(
				'id_base'			=> 'te_popular-posts-widget'
			)
		);
	}
	
	function widget($args, $instance) {
		global $post, $wp_query;

		extract($args);
		
		$titleA = apply_filters('widget_title', $instance['titleA']);
		$titleB = apply_filters('widget_title', $instance['titleB']);
		
		echo $before_widget;
		
		
		$in_context = ($instance['contextAware']) ? true : false;
		$is_article = ($wp_query->query_vars['te_article-category']) ? true : false;
		
		$ppp = ($instance['postCount']) ? $instance['postCount'] : 3;

		$q_args = array(
				'post_type'					=> $instance['postType'],
        'posts_per_page'    => $ppp,
				'gdsr_sort'					=> 'rating',
				'gdsr_order'				=> 'desc',
				'sort_order'				=> 'desc',
        'caller_get_posts'  => 1 // ignore sticky status
    );

		if($in_context)
		{
			if($is_article)
			{
				$q_args['te_article-category'] = $wp_query->query_vars['te_article-category'];
			}
			else
			{
				$q_args['category'] = getCurrentCatID();
			}
		}
		
 		
		query_posts( $q_args );

		$cclass = ($instance['postType'] == 'post') ? 'blog' : 'reading-room';
		$isize = ($instance['postType'] == 'post') ? 'post-wide-thumbnail' : 'post-square-small-thumbnail';

		if(have_posts()) : ?>
			<div class="widget widget-<?php echo $cclass; ?> popular no-addthis">
				<div class="header-container">
					<h2 class="first-line"><?php echo $titleA; ?><h2>
					<h2 class="second-line"><?php echo $titleB; ?></h2>
				</div>
				<?php while(have_posts()) : ?>
					<?php the_post(); ?>
					<div class="item <?php echo $cclass; ?>">
						<div class="item-content">								
								<?php if(has_post_thumbnail(get_the_ID())) : ?>
						      <div class="thumb-wrapper">
						        <div class="thumb-container">
											<a href="<?php the_permalink(); ?>">
						          	<?php the_post_thumbnail($isize, array('class' => 'featured-image')); ?>
											</a>
						        </div>
						      </div>
						    <?php endif; ?>
					
								<p class="meta-data"><?php the_time('j M Y') ?></p>
								<span class="by-line">
									<?php
										$categories = get_the_category();
										if(count($categories) > 0) {
											echo $categories[0]->name;
										}
									?>
								</span>
					
								<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<p class="excerpt"><?php the_excerpt_rss(); ?></a>
								
								<div class="rating">
									<?php wp_gdsr_render_article(); ?>
								</div>
						
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
		
		$instance['titleA']					= strip_tags($new_instance['titleA']);
		$instance['titleB']					= strip_tags($new_instance['titleB']);
		$instance['postType']				= strip_tags($new_instance['postType']);
		$instance['contextAware']		= strip_tags($new_instance['contextAware']);
		$instance['postCount']			= strip_tags($new_instance['postCount']);
		
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
			'titleA'					=> '',
			'titleB'					=> '',
			'postType'				=> 'post',
			'contextAware'		=> 'true',
			'postCount'			=> 3,
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
			<label for="<?php echo $postCount_id; ?>">Number of posts:</label><br />
			<input 
				type="text"
				size="2"
				id="<?php echo $postCount_id; ?>"
				name="<?php echo $postCount_name; ?>"
				value="<?php echo $postCount; ?>" />
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
		
		<p>
			<label for="<?php echo $this->get_field_id('contextAware'); ?>">Context awareness:</label>
			<input 
				type="checkbox" 
				id="<?php echo $this->get_field_id('contextAware'); ?>" 
				name="<?php echo $this->get_field_name('contextAware'); ?>" 
				<?php if($instance['contextAware']) : ?> checked="checked"<?php endif; ?>>
		</p>
		
		<?php
	}
}

function te_load_PopularPostsWidget() {
	register_widget('TE_PopularPostsWidget');
}

add_action('widgets_init', 'te_load_PopularPostsWidget');
	
?>