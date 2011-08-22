<div class="item reading-room">
	<div class="item-content">
		<?php if($instance['thumbnails']) : ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('post-square-thumbnail', array('class' => 'featured-image')); ?>
		</a>
		<?php endif; ?>
	
		<p class="meta-data"><?php the_time('j M Y'); ?></p>
		
		<span class="by-line">
			Article
		</span>
		
		<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p class="excerpt"><?php the_excerpt_rss(); ?></p>
		
		<div class="options">
			<a href="<?php the_permalink(); ?>#respond" class="add-comment">Add Comment (<?php comments_number('0', '1', '%'); ?>)</a>
			<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
		</div>
	</div>
</div>