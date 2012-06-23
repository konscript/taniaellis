<div class="item news">
	<div class="item-content">
		<?php if(has_post_thumbnail() && $instance['thumbnails']) : ?>
      <div class="thumb-wrapper">
        <div class="thumb-container">
					<a href="<?php the_permalink(); ?>">
          	<?php the_post_thumbnail('post-square-thumbnail', array('class' => 'featured-image')); ?>
					</a>
        </div>
      </div>
    <?php endif; ?>
	
		<p class="meta-data"><?php the_time('j M Y'); ?></p>
		
		<span class="by-line">
			<?php
        $byline = get_post_meta(get_the_ID(), 'te_news-options-id', true);
        
        if($byline)
          echo $byline;
      ?>
		</span>
		
		<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p class="excerpt"><?php the_excerpt_rss(); ?></p>
		
		<div class="options">
			<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
		</div>
		
		<div class="clearer"></div>
	</div>
</div>