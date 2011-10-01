<?php

$start = get_event_start(get_the_ID());
$end = get_event_end(get_the_ID());

?>
<div class="item event">
	<div class="item-content">
		<?php if(has_post_thumbnail(get_the_ID()) && $instance['thumbnails']) : ?>
      <div class="thumb-wrapper">
        <div class="thumb-container">
					<a href="<?php the_permalink(); ?>">
          	<?php the_post_thumbnail($dim, array('class' => 'featured-image')); ?>
					</a>
        </div>
      </div>
    <?php endif; ?>

		<p class="meta-data">
			<span>Event Date:</span> <?php echo date_format($start, 'j M H:i') . " - " . date_format($end, 'j M H:i'); ?>
		</p>
		
		<p class="byline">&nbsp;</p>
		
		<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p class="excerpt"><?php the_excerpt_rss(); ?></p>
		
		<div class="options">

			<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
		</div>
	</div>
</div>