<?php get_header(); ?>

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
              
              // Get all things that has to do with the client
              $case['client-id'] = get_post_meta($post->ID, 'te_case-options-client-id', true);
              
              $client['featured-image'] = get_the_post_thumbnail($case['client-id'], 'post-thumbnail');
              $client['description']    = get_post_field('post_content', $case['client-id']);
              
              
            ?>
            
            <!-- The following way to add the correct icon to the header is a bit of a hack, but it is easy! Should this be changed? -->
            <?php
              $style = '';
              if($post_meta['title-icon']) {
                $style = 'background: url(' . $post_meta['title-icon'] . ') top left no-repeat;';
              }
            ?>
            <div class="post-header" style="<?php echo $style; ?>">
              <h2 class="first-line">Cases on</h2>
              <h2 class="second-line">Conferences</h2>
            </div>
                                            
            <div class="post case">
              
              <div class="client-info">
                <div class="thumb-wrapper">
                  <div class="thumb-container">
                    <?php echo $client['featured-image']; ?>
                  </div>
                </div>
                
                <p class="about-headline">About the client</p>
                <h3 class="client-name">ISS er DINmoR</h3>
                <div class="client-description"><?php echo $client['description']; ?></div>

              </div>
              
              <div class="clearer"></div>
              
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
              
              <?php if(has_post_thumbnail($post->ID)) : ?>
                <div class="thumb-wrapper">
      						<div class="thumb-container">
      							<?php the_post_thumbnail('post-wide-image', array('class' => 'featured-image')); ?>
      						</div>
      					</div>
    					<?php endif; ?>
              
              <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <div class="entry">
                <?php if(has_post_thumbnail($post->ID)) : ?>
                  <div class="thumb-wrapper">
                    <div class="thumb-container">
                      <?php the_post_thumbnail('post-big-square-thumbnail'); ?>
                    </div>
                  </div>
                <?php endif; ?>
                <?php the_content(); ?>
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