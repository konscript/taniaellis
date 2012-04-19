<?php
/*
Template Name: All Cases
*/
?>

<?php get_header(); ?>

<div id="header">
  <p id="sub-heading">The <span>Social</span> Business Company &reg;</p>
  <p id="language-picker">
    <a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
  </p>

  <div class="clearer"></div>

  <div id="header-container">

    <?php wp_nav_menu(array(
			'theme_location'	=> 'cases-menu',
			'container'			=> '',
			'menu_id'			   => 'navigation-cases',
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
      <?php if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Left Sidebar"); ?>
    </section>

		<section class="right-sidebar-single">
		  <div class="sidebar-background">


		  		<?php

		  			// Fetch the pages ID
		  			$page_id = $wp_query->post->ID;

            $post_meta['first-line']  = get_post_meta($page_id, 'te_page-text-title-first-line', true);
            $post_meta['second-line'] = get_post_meta($page_id, 'te_page-text-title-second-line', true);
            $post_meta['title-icon']  = get_post_meta($page_id, 'te_page-text-title-icon', true);
            $post_meta['lead-text']   = get_post_meta($page_id, 'te_page-text-lead-paragraph-text', true);
            $post_meta['left-meta']   = get_post_meta($page_id, 'te_page-text-meta-left', true);
            $post_meta['right-meta']  = get_post_meta($page_id, 'te_page-text-meta-right', true);

            if(empty($post_meta['first-line']))
            	$post_meta['first-line'] = 'Cases';
           	if(empty($post_meta['second-line']))
            	$post_meta['second-line'] = 'All Cases';
          ?>
		    
          <!-- The following way to add the correct icon to the header is a bit of a hack, but it is easy! Should this be changed? -->
          <?php
            $style = '';
            if($post_meta['title-icon']) {
              $style = 'background: url(' . $post_meta['title-icon'] . ') top left no-repeat;';
            }
          ?>
          <div class="post-header" id="case" style="<?php echo $style; ?>">
            <h2 class="first-line"><?php echo $post_meta['first-line']; ?></h2>
            <h2 class="second-line"><?php echo $post_meta['second-line']; ?></h2>
            <p class="lead-text"><?php echo $post_meta['lead-text']; ?></p>
          </div>
		      <?php query_posts(array('post_type' => 'te_case', 'post_status' => 'publish', 'paged' => $paged)); ?>
		      <?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>                                
		        <div class="post-feed">
								
								<!-- Fetch the client ID -->
								<?php $client_id = get_post_meta($post->ID, 'te_case-options-client-id', true); ?>
								
								<?php if(has_post_thumbnail($client_id)): ?>
									<div class="thumb-wrapper">
										<div class="thumb-container">
											<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($client_id, 'post-square-thumbnail', array("class" => "featured-image")); ?></a>
										</div>
									</div>
								<?php endif; ?>
								<p class="byline">
									<?php 
										$client_name	= get_the_title($client_id);
									?>
									
									<?php echo $client_name; ?>
		            </p>
		            <p class="date">
		              <?php the_time('j F Y'); ?>
		            </p>
		            
		          <!-- </div>     -->
		          <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		          <div class="entry">
		            <?php the_excerpt(); ?>
		          </div>
		
		          <div class="options">
		            <a class="add-comment" href="<?php echo get_permalink($post->ID) . '#respond'; ?>">Add comment (<?php comments_number('0', '1', '%'); ?>)</a>
		            <a class="read-more" href="<?php echo te_get_article_url($post->ID); ?>">Read more</a>                              
		          </div>
		        </div>
		      <?php endwhile; ?>
		      
		      <div class="posts-nav-links">
		        <?php posts_nav_link(' ', '« Previous Page', 'Next Page »'); ?>
		      </div>
		      
		      <?php endif; ?>
		      
		      <div class="clearer"></div>
		      
		  </div>
		</section>

    <div class="clearer"></div>

  </div> <!-- #page -->

</div> <!-- #page-content -->

<?php get_footer(); ?>