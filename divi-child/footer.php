<?php if ( 'on' == et_get_option( 'divi_back_to_top', 'false' ) ) : ?>
	<span class="et_pb_scroll_top et-pb-icon"></span>
<?php endif;
if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>
			<footer id="main-footer">
				<?php get_sidebar( 'footer' ); ?>
		<?php
			if ( has_nav_menu( 'footer-menu' ) ) : ?>
				<div id="et-footer-nav">
					<div class="container">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'depth'          => '1',
								'menu_class'     => 'bottom-nav',
								'container'      => '',
								'fallback_cb'    => '',
							) );
						?>
					</div>
				</div> <!-- #et-footer-nav -->
			<?php endif; ?>
				<div id="footer-bottom">
					<div class="container clearfix">
				<?php
					if ( false !== et_get_option( 'show_footer_social_icons', true ) ) {
						get_template_part( 'includes/social_icons', 'footer' );
					}
				?>
<!--- CeJay Associates Footer -->
<p id="footer-info">
     Copyright&copy; 
                                    <script language="JavaScript" type="text/javascript">
                <!--
                document.write(' 2014-' + (new Date()).getFullYear()); 
                // -->
     </script>. All Rights Reserved. <span style="white-space: nowrap;">Site by <a href="https://cejayassoc.com">CeJay Associates, LLC</a></span></p>    
<!-- End CeJay Associates Footer -->			
					</div>	<!-- .container -->
				</div>
			</footer> <!-- #main-footer -->
		</div> <!-- #et-main-area -->
<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>
	</div> <!-- #page-container -->
	<?php wp_footer(); ?>
</body>
</html>