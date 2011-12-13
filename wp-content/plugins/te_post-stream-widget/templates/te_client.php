<div class="widget-inset">
	<div class="item clientcase">
			<?php if(has_post_thumbnail($post->ID) && $instance['thumbnails']) : ?>
	      <div class="thumb-wrapper">
	        <div class="thumb-container">
						<a href="<?php the_permalink(); ?>">
	          	<?php the_post_thumbnail('post-square-small-thumbnail', array('class' => 'featured-image')); ?>
						</a>
	        </div>
	      </div>
	    <?php endif; ?>		
	</div>
</div>