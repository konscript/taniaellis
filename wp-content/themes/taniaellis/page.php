<?php

/*
    Template Name: Page
*/
    get_header(); 
?>
<p id="sub-heading">The <span>Social</span> Business Company</p>
<p id="language-picker">
    <a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
</p>

<div id="page">
	<section id="left-sidebar">
		<?php if(function_exists('dynamic_sidebar')) dynamic_sidebar(1); ?>
	</section>
	<section id="right-sidebar">
		<?php if(function_exists('dynamic_sidebar')) dynamic_sidebar(2); ?>
	</section>
</div>


<?php get_footer(); ?>