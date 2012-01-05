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
				'theme_location'		=> 'cases-menu',
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
			generated_dynamic_sidebar("Single Case Sidebar");
			?>
    </section>
   <section class="right-sidebar-single">
     <div class="sidebar-background">
          
          <?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>
            
            <?php
              $case['first-line']   = get_post_meta($post->ID, 'te_case-meta-first-line', true);
              $case['second-line']  = get_post_meta($post->ID, 'te_case-meta-second-line', true);
              $case['left-meta']    = get_post_meta($post->ID, 'te_case-meta-left', true);
              $case['right-meta']   = get_post_meta($post->ID, 'te_case-meta-right', true);
              
              // Get all things that has to do with the client
              $case['client-id'] = get_post_meta($post->ID, 'te_case-options-client-id', true);
              
              $client['featured-image'] = get_the_post_thumbnail($case['client-id'], 'post-thumbnail');
              $client['description']    = get_post_field('post_content', $case['client-id']);
							$client['name']						= get_post_field('post_title', $case['client-id']);
              
              
            ?>
            
            <!-- The following way to add the correct icon to the header is a bit of a hack, but it is easy! Should this be changed? -->
            <div class="post-header" id="case">
              <h2 class="first-line"><?php echo $case['first-line']; ?></h2>
              <h2 class="second-line"><?php echo $case['second-line']; ?></h2>
            </div>
                                            
            <div class="post case">
              
              <div class="client-info">
                <div class="thumb-wrapper">
                  <div class="thumb-container">
                    <?php echo $client['featured-image']; ?>
                  </div>
                </div>
                
                <p class="about-headline">About the client</p>
                <h3 class="client-name"><?php echo $client['name']; ?></h3>
                <div class="client-description"><?php echo $client['description']; ?></div>

              </div>
              
              <div class="clearer"></div>
              
              <?php if(has_post_thumbnail($post->ID)) : ?>
                <div class="thumb-wrapper">
      						<div class="thumb-container">
      							<?php the_post_thumbnail('post-wide-image', array('class' => 'featured-image')); ?>
      						</div>
      					</div>
    					<?php endif; ?>
    					
    					<?php if($case['left-meta'] || $case['right-meta']):?>
                <div class="meta">
                  <p class="byline">
                    <?php echo $case['left-meta']; ?>
                  </p>
                  <p class="date">
                    <?php echo $case['right-meta']; ?>
                  </p>
                </div>
              <?php endif; ?>
              
              <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <div class="entry">
                <?php the_content(); ?>
              </div>
            </div>
            <div class="clearer"></div>
            
            <?php if(has_term('', 'te_case-category', $post->ID) || has_term('', 'te_case-tag', $post->ID)): ?>
              <div class="post-identification">
                <?php if(has_term('', 'te_case-category', $post->ID)): ?>
                  <p class="post-categories">
                    <?php echo get_the_term_list($post->ID, 'te_case-category', 'Posted in |&nbsp;', '&nbsp;|&nbsp;', ''); ?>
                  </p>
                <?php endif; ?>
                <?php if(has_term('', 'te_case-tag', $post->ID)): ?>
                  <p class="post-tags">
                    <?php echo get_the_term_list($post->ID, 'te_case-tag', 'Tagged |&nbsp;', '&nbsp;|&nbsp;', ''); ?>
                  </p>
                <?php endif; ?>
              </div>
            <?php endif; ?>
                                                
          <?php endwhile; ?>
          <?php endif; ?>
          
          <div class="clearer"></div>
          
          <?php comments_template(); ?>
          
      </div>
    </section>
		<div class="clearer"></div>
	</div>
</div>
<?php get_footer(); ?>