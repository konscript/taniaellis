<?php

/*
Template Name: Text Page
*/

get_header();
?>

<div id="header">
	<p id="sub-heading">The <span>Social</span> Business Company &reg;</p>
	<p id="language-picker">
		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
	</p>

	<div class="clearer"></div>

	<div id="header-container">
		<?php
		
		$menu_id = get_post_meta($post->ID, 'te_page-text-menu-id', true);
		?>
		<?php wp_nav_menu(array(
				'menu'							=> $menu_id,
				'container'				  => '',
				'menu_id'				    => 'navigation-header-standard',
				'menu_class'			  => 'navigation-header',
				'link_before'       => '<span>&nbsp;</span>'
				)); ?>
	</div> <!-- #header-container -->
</div> <!-- #header --> 

<div class="clearer"></div>

<div id="page-content-single">
	<div id="page">
		<?php @include("partials/social-bar.php"); ?>
		<section class="left-sidebar">
			<?php 
			generated_dynamic_sidebar("Left Sidebar");
			?>
    </section>
   <section class="right-sidebar-single">
     <div class="sidebar-background">
          
          <?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>
            
            <?php
              $post_meta['first-line']  = get_post_meta($post->ID, 'te_page-text-title-first-line', true);
              $post_meta['second-line'] = get_post_meta($post->ID, 'te_page-text-title-second-line', true);
              $post_meta['title-icon']  = get_post_meta($post->ID, 'te_page-text-title-icon', true);
              $post_meta['lead-text']   = get_post_meta($post->ID, 'te_page-text-lead-paragraph-text', true);
              $post_meta['left-meta']   = get_post_meta($post->ID, 'te_page-text-meta-left', true);
              $post_meta['right-meta']  = get_post_meta($post->ID, 'te_page-text-meta-right', true);
            ?>
            
            <!-- The following way to add the correct icon to the header is a bit of a hack, but it is easy! Should this be changed? -->
            <?php
              $style = '';
              if($post_meta['title-icon']) {
                $style = 'background: url(' . $post_meta['title-icon'] . ') top left no-repeat;';
              }
            ?>
            <div class="post-header" style="<?php echo $style; ?>">
              <h2 class="first-line"><?php echo $post_meta['first-line']; ?></h2>
              <h2 class="second-line"><?php echo $post_meta['second-line']; ?></h2>
              <p class="lead-text"><?php echo $post_meta['lead-text']; ?></p>
            </div>
                                            
            <div class="post">
              <?php if($post_meta['left-meta'] || $post_meta['right-meta']):?>
              <div class="meta">
                <p class="byline">
                  <?php echo $post_meta['left-meta']; ?>
                </p>
                <p class="date">
                  <?php echo $post_meta['right-meta']; ?>
                </p>
              </div>
              <?php endif; ?>
              
              <h2 class="title"><?php the_title(); ?></h2>
              <div class="entry">
                <?php if(has_post_thumbnail($post->ID)) : ?>
                  <div class="thumb-wrapper">
                    <div class="thumb-container">
                      <?php the_post_thumbnail('post-big-square-thumbnail'); ?>
                    </div>
                  </div>
                <?php endif; ?>
                <?php the_content(); ?>
                <div class="clearer"></div>
              </div>
            </div>
            <div class="clearer"></div>
                                                
          <?php endwhile; ?>
          <?php endif; ?>
          
          <div class="clearer"></div>
          
          <?php
          $args = array(
          	'post_type' => 'attachment',
          	'numberposts' => null,
          	'post_status' => null,
          	'post_parent' => $post->ID
          );
          $attachments = get_posts($args);
          ?>
          
      </div>
    </section>
		<div class="clearer"></div>
	</div>
</div>
<?php get_footer(); ?>