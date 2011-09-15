<?php

// $end = new DateTime(
// 	get_post_meta($post_id, '_year', true)		.'-'.
// 	get_post_meta($post_id, '_month', true)		.'-'.
// 	get_post_meta($post_id, '_day', true)		.' '.
// 	get_post_meta($post_id, '_hour', true)		.':'.
// 	get_post_meta($post_id, '_minute', true)
// );

?>
<div class="item event">
	<div class="item-content">
		<?php if(has_post_thumbnail($post->ID) && $instance['thumbnails']) : ?>
      <div class="thumb-wrapper">
        <div class="thumb-container">
          <?php the_post_thumbnail($tsize[$instance['size']], array('class' => 'featured-image')); ?>
        </div>
      </div>
    <?php endif; ?>

		<p class="meta-data">
			<?php //the_time('j M Y H:i'); echo " - ".date_format($end, 'j M Y H:i'); ?>
			Event Date:
		</p>
		
		<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p class="excerpt"><?php the_excerpt_rss(); ?></p>
		
		<div class="options">

			<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
		</div>
	</div>
</div>