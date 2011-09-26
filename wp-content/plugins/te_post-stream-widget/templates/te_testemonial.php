<?php

$author = get_post_meta($post_id, 'te_testemonial-author', true);
$date = date_format(new DateTime(get_post_meta($post_id, 'te_testemonial-date', true)), 'j M Y');
$text = get_post_meta($post_id, 'te_testemonial-testemonial-text', true);

$case_id = get_post_meta($post_id, 'te_testemonial-case-id', true);

?>
<div class="item testemonial">
	<div class="item-content">
		<?php if($instance['thumbnails']) : ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('post-square-thumbnail', array('class' => 'featured-image')); ?>
		</a>
		<?php endif; ?>
	
		<p class="meta-data"><?php echo $date; ?></p>
		
		<span class="by-line">
			<?php echo $author; ?>
		</span>
		
		<p class="excerpt"><?php echo $text; ?></p>
		
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
		
	</div>
</div>