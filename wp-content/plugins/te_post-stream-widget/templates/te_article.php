<div class="item reading-room'">
	<div class="item-content">
		<?php if(has_post_thumbnail($post->ID) && $instance['thumbnails']) : ?>
      <div class="thumb-wrapper">
        <div class="thumb-container">
          <?php the_post_thumbnail($tsize[$instance['size']], array('class' => 'featured-image')); ?>
        </div>
      </div>
    <?php endif; ?>
	
		<p class="meta-data"><?php the_time('j M Y'); ?></p>
		
		<span class="by-line">
			Article
		</span>
		
		<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p class="excerpt"><?php the_excerpt_rss(); ?></p>
		
		<div class="options">
			<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
		</div>
	</div>
</div>