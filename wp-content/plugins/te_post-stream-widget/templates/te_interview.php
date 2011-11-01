<?php

$meta = get_post_meta($post_id, 'te_interview-meta', true);

$date = get_interview_date($post_id);


$video_id = get_post_meta($post_id, 'te_interview-video-id', true);

if(!empty($video_id) && $video_id > 0) {
	$video_url = get_post_meta($video_id, 'te_video_url', true);
}

?>
<div class="item interview">
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

		<?php if($video_id && $video_url) : ?>
			<div class="video">
				<?php echo te_vimeo_video($video_url, 240, 135); ?>
			</div>
		<?php endif; ?>
	
		<p class="meta-data"><?php echo $date; ?></p>
		
		<span class="by-line">
			<?php echo $meta; ?>
		</span>
		
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
		
	</div>
</div>