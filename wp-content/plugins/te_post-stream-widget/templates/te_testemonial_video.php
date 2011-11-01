<?php

$author = get_post_meta($post_id, 'te_testemonial-author', true);
$date = date_format(new DateTime(get_post_meta($post_id, 'te_testemonial-date', true)), 'j M Y');
$text = get_post_meta($post_id, 'te_testemonial-testemonial-text', true);
$case_link = get_post_meta($post_id, 'te_testemonial-case-link', true);
$case_link_text = get_post_meta($post_id, 'te_testemonial-case-link-text', true);

$case_id = get_post_meta($post_id, 'te_testemonial-case-id', true);
if(!empty($case_id)) {
	$case_q = new WP_Query('?p=' . $case_id);
	$case = $case_q->the_post();
}

$video_id = get_post_meta($post_id, 'te_testemonial-video-id', true);
$video_video_url = get_post_meta($video_id, 'te_video_url', true);

?>
<div class="item video-testemonial">
	<div class="item-content">
		
		<div class="video">
	 		<?php echo te_vimeo_video($testemonial['video-url'], 240, 100); ?>
		</div>
	
		<p class="meta-data"><?php echo $date; ?></p>
		
		<span class="by-line">
			<?php echo $author; ?>
		</span>
		
		<? if(isset($case)) : ?>
			<a href="<?php echo $case_link; ?>" class="case"><?php echo $case_link_text; ?></a>
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