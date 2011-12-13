		</div> <!-- #page-wrapper -->

		<footer>
			<ul id="footer-bar">
		    	<li>Tania Ellis&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp; The Social Business Company</li>
		    	<li>T: +45 3214 2295</li>
		    	<li>M: +45 2625 2295</li>
		    	<li>E-mail: te[at]taniaellis[dot]dk</li>
		    	<li>www.taniaellis.dk</li>
			</ul>			
			<?php wp_nav_menu(array(
				'theme_location'	=> 'footer-menu',
				'container' 		=> false,
				'menu_id' 			=> 'footer-menu',
				'menu_class' 		=> '',
				'after' 		=> '<span>|</span>'
			)); ?>
			<a href="http://www.ingenco2.dk/crt/dispcust/c/2000/l/1" target="_blank" id="co2-link"><img src="<?php bloginfo('template_url') ?>/images/co2_neutral_website.png" alt="CO2 neutral hjemmeside" /></a>
			<div class="clearer"></div>
		</footer>
		<?php
		   /* Always have wp_footer() just before the closing </body>
		    * tag of your theme, or you will break many plugins, which
		    * generally use this hook to reference JavaScript files.
		    */

		    wp_footer();
		?>
			<script type="text/javascript">

				// var is_chrome = /chrome/.test( navigator.userAgent.toLowerCase() );
				// 
				// 				if($.browser.webkit) {
				// 					$("img.featured-image").each(function(){
				// 						var o = $(this).closest(".thumb-container");
				// 						var height = $(o).css("height");
				// 						//console.log(height);
				// 
				// 						if(height == "110px")
				// 							$(o).css("height", "100px");
				// 
				// 						if(height == "120px")
				// 							$(o).css("height", "100px");
				// 					});
				// 				}
				// 				
				// 				if($.browser.msie) {
				// 				
				// 					//------------ GENERAL ------------//
				// 					//-- Call To Action Box
				// 					$("#page .box").corner("round bottom 10px");
				// 					$("#page .box .box-header").corner("round top 10px");
				// 					$("#page .box .box-button").corner("round 5px");
				// 
				// 					//-- Social bar
				// 					$("#social-bar").corner("round bottom 10px");
				// 					
				// 					
				// 					//-- Header content
				// 					$("#header .header-content").corner("round 10px");
				// 					
				// 					// Header content -> header title
				// 					$(".header-content .header-title").corner("round tr br 10px");
				// 					
				// 					//-- Shop Link
				// 					$("#shop-link").corner("round bottom 10px");
				// 
				// 					//------------ HOME ------------//
				// 					//-- Social Business Menu
				// 
				// 					$('#navigation-social-business').find('.menu-item a').each(function(){
				// 						$(this).corner("round 10px");
				// 					});
				// 					
				// 					$("#social-bar-frontpage").corner("round bottom 10px");
				// 				}
				
			</script>
	</body>
</html>