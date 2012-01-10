<div class="widget-inset">
	<div class="item clientcase">
			<?php if(has_post_thumbnail($post->ID) && $instance['thumbnails']) : ?>
	      <div class="thumb-wrapper">
	        <div class="thumb-container">
          	<?php the_post_thumbnail('post-square-small-thumbnail', array('class' => 'featured-image')); ?>
	        </div>
	      </div>
	    <?php endif; ?>		
	</div>
</div>