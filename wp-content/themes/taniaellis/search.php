<?php
/*
Template Name: Articles
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
			'theme_location'	=> 'navigation-pages',
			'container'			=> '',
			'menu_id'			   => 'navigation-header-standard',
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
    
          <div class="post-header" id="search">
            <h2 class="first-line">Search Results:</h2>
            <h2 class="second-line"><?php echo $_GET['s']; ?></h2>
          </div>
          <?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>                                
            <div class="post-feed">
                <p class="byline">
                  <?php 
                    print_r(get_post_type_object($post->post_type)->labels->singular_name); 
                  ?>
              
                </p>
            
              <h2 class="title title-search"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          
              <?php $excerpt = get_the_excerpt(); ?>
          
              <?php if($excerpt != null): ?>
                <div class="entry">
                  <?php echo $excerpt; ?>
                </div>
              <?php endif; ?>

              <div class="options">
                <a class="add-comment" href="<?php the_permalink(); ?>">Read more</a>                              
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