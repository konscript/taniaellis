<?php

$author = get_post_meta($post_id, 'te_testemonial-author', true);
//$date = date_format(new DateTime(get_post_meta($post_id, 'te_testemonial-date', true)), 'j M Y');
$text = get_post_meta($post_id, 'te_testemonial-testemonial-text', true);

$case_id = get_post_meta($post_id, 'te_testemonial-case-id', true);

$video_id = get_post_meta($post_id, 'te_testemonial-video-id', true);

if(!empty($video_id) && $video_id > 0) {
	$video_url = get_post_meta($video_id, 'te_video_url', true);
}

?>
<div class="item testemonial">
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
				<?php echo te_vimeo_video($video_url, 240, 100); ?>
			</div>
		<?php endif; ?>
		
		<span class="by-line">
			<?php echo $author; ?>
		</span>
		
		<?php if(!empty($text)) : ?>
			<p class="excerpt"><?php echo $text; ?></p>
		<?php endif; ?>
		
		<?php
		
		if(!empty($case_id)) {
			$case_q = new WP_Query('?p=' . $case_id);
			$case = $case_q->the_post();
		}
		
		?>
		
		<? if(isset($case)) : ?>
			<div class="options">
				<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
			</div>
		<?php endif; ?>
		
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
		
	</div>
</div>