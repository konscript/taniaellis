
<div id="container">
  <?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>
    <div class="post">
      <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
      <div class="entry">
        <?php the_content(); ?>
      </div>
      <p class="meta">On <?php the_date('F j'); ?> by <?php the_author(); ?></p>
    </div>
  <?php endwhile; ?>
  <?php endif; ?>
</div>

