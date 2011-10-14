<div class="item blog">
	<div class="item-content">
		<?php if(has_post_thumbnail($post->ID) && $instance['thumbnails']) : ?>
      <div class="thumb-wrapper">
        <div class="thumb-container">
					<a href="<?php the_permalink(); ?>">
          	<?php the_post_thumbnail('post-wide-thumbnail', array('class' => 'featured-image')); ?>
					</a>
        </div>
      </div>
    <?php endif; ?>
	
		<p class="meta-data"><?php the_time('j M Y'); ?></p>
		
		<span class="by-line">
			By <?php the_author(); ?>
		</span>
		
		<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p class="excerpt"><?php the_excerpt_rss(); ?></p>
		
		<?php if(function_exists('wp_gdsr_render_article') && $instance['showRatings']) : ?>
			<div class="rating">
				<?php wp_gdsr_render_article(); ?>
			</div>
		<?php endif; ?>
		
		<?php if(function_exists('wp_gdsr_render_article') && $instance['showThumbs']) : ?>
		<div class="like">
			<?php wp_gdsr_render_article_thumbs(); ?>
		</div>
		<?php endif; ?>

		
		<div class="options">
			<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
		</div>
		
		<div class="clearer"></div>
	</div>
</div>