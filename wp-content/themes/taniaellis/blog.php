<?php
/*
    Template Name: Blog
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
	        'theme_location' 	=> 'blog-menu',
			'menu_class'		=> 'navigation-header',
			'menu_id'			=> 'navigation-header-standard',
			'link_before'		=> '<span>&nbsp;</span>'
	        )); 
	    ?>
		<div class="header-content">
			<div class="left-column">
				<div class="header-title">
		            <h2 class="first-line">Social Business</h2>
			        <h2 class="second-line">Blog</h2>
		        </div>
		
				<h3 id="tagcloud-title"><span>Most tagged words...</span></h3>
				<div id="tagcloud">
					<?php
					
					$terms = get_terms('post_tag', array(
						'number'				=> 12,
						'hierarchical'	=> 0,
						'orderby'				=> 'count',
						'order'					=> 'DESC'
					));
					
					$scores = array();
					foreach($terms as $term) {
						$scores[$term->term_id] = $term->count;
					}
					
					$max_score = max($scores);
					$min_score = min($scores);
					
					$score_spread = $max_score - $min_score;
					if($score_spread <= 0)
						$score_spread = 1;
					
					$max_class = 5;
					$min_class = 1;
					
					$class_spread = $max_class - $min_class;
					if($class_spread <= 0)
						$class_spread = 1;
						
					$step = $class_spread / $score_spread;
					
					// Shuffle it around
					shuffle($terms);
					
					foreach($terms as $term) :
						$id = $term->term_id;
						$link = clean_url(get_tag_link($id));
						$class_id = ($min_class + (($scores[$id] - $min_score) * $step));
						
						?>
						
						<a href="<?php echo $link ?>" class="tag-<?php echo $id; ?> s<?php echo $class_id; ?>"><?php echo $term->name; ?></a>&nbsp;
						
						<?php
					endforeach;
					
					?>
				</div>
			</div>
			<div class="right-column">
				<div class="header-right-box">
					<h2>What are the focus of change that are opening up for new business opportunities and social innovations?</h2>
					<p>Lorem ipsum dolor sit amet, doalr sit consec tetuer adipscing elit, sed diam nonum my nibh euismod.</p>

					<a class="join" href="#">Join the conversation</a>
				</div>
			</div>

		</div> <!-- .header-content -->
	</div> <!-- #.header-container -->
	
	
</div> <!-- #header -->

<div class="clearer"></div>

<div id="page-content">
	<div id="page">
	  
	  <div id="social-bar" class="addthis_toolbox addthis_32x32_style">
      <ul>
		  	<li><a class="addthis_button_facebook"></a></li>
			  <li><a class="addthis_button_twitter"></a></li>
			  <li><a class="addthis_button_linkedin"></a></li>
			  <li><a class="addthis_button_youtube"></a></li>
			  <li><a class="addthis_button_rss"></a></li>
			</ul>
      <div class="box">
        <p class="box-header">
          <span class="box-first-line">Become a Member</span>
          <span class="box-second-line">Of the Club</span>
        </p>
        <p class="box-content"></p>
        <a class="box-button" href="javascript:void(0)">Join the Club</a>                       
      </div>
    </div>
	  
	<section class="left-sidebar">
		<?php if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Left Sidebar"); ?>
	</section>
	
	<section class="right-sidebar">
		<div class="sidebar-background">
			<?php if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Right Sidebar"); ?>
		</div>
	</section>
	
	<div class="clearer"></div>
		
	</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>