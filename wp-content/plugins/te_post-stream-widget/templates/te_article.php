<div class="item reading-room">
	<div class="item-content">
		<?php if(has_post_thumbnail($post->ID) && $instance['thumbnails']) : ?>
      <div class="thumb-wrapper">
        <div class="thumb-container">
					<a href="<?php the_permalink(); ?>">
          	<?php the_post_thumbnail($tsize[$instance['size']], array('class' => 'featured-image')); ?>
					</a>
        </div>
      </div>
    <?php endif; ?>
	
		<p class="meta-data"><?php the_time('j M Y'); ?></p>
		
		<span class="by-line">
			Article
		</span>
		
		<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p class="excerpt"><?php the_excerpt_rss(); ?></p>
		
		<?php if(function_exists('wp_gdsr_render_article') && $instance['showRatings']) : ?>
			<div class="rating">
				<?php wp_gdsr_render_article(); ?>
			</div>
		<?php endif; ?>
		
		<div class="options">
			<a class="add-comment" href="<?php echo get_permalink($post->ID) . '#respond'; ?>">Add comment (<?php comments_number('0', '1', '%'); ?>)</a>
			<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
		</div>
	</div>
</div>