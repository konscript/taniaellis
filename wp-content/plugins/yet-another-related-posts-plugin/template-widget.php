<?php

if($related_query->have_posts()) : ?>

	<div class="widget widget-blog related">
		<div class="header-container">
			<h2 class="first-line"><?php echo $titleA; ?></h2>
			<h2 class="second-line"><?php echo $titleB; ?></h2>
		</div>
	
		<?php while($related_query->have_posts()) :
			$related_query->the_post(); ?>

			<div class="item blog">
				<div class="item-content">
					<a hre="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('post-wide-thumbnail', array('class' => 'featured-image')); ?>
					</a>
		
					<p class="meta-data"><?php the_time('j M Y H:i'); ?></p>
					<span class="by-line">By <?php the_author(); ?></span>
		
					<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<p class="excerpt"><?php the_excerpt_rss(); ?></p>
	
					<div class="options">
						<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
					</div>
				</div>
			</div>

		<?php endwhile; ?>
	</div>
<?php endif; ?>