<div class="item blog">
	<div class="item-content">
		<?php if($instance['thumbnails']) : ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail($tsize[$instance['size']], array('class' => 'featured-image')); ?>
		</a>
		<?php endif; ?>
	
		<p class="meta-data"><?php the_time('j M Y'); ?></p>
		
		<span class="by-line">
			By <?php the_author(); ?>
		</span>
		
		<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p class="excerpt"><?php the_excerpt_rss(); ?></p>
		
		<div class="options">
			<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
		</div>
		
		<div class="clearer"></div>
	</div>
</div>