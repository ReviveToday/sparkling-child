<?php
/**
 * ReviveToday v2 theme, based upon the Sparkling theme.
 *
 * @package revivetoday-child
 * @author soup-bowl <code@soupbowl.io>
 * @license MIT
 */

?>
		</div><!-- close .row -->
	</div><!-- close .container -->
</div><!-- close .site-content -->

	<div id="footer-area">
		<div class="container footer-inner">
			<div class="row">
				<?php get_sidebar( 'footer' ); ?>
			</div>
		</div>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info container">
				<div class="row">
					<?php
					if ( of_get_option( 'footer_social' ) ) {
						sparkling_social_icons();}
					?>
					<nav role="navigation" class="col-md-6">
						<?php sparkling_footer_links(); ?>
					</nav>
					<div class="copyright col-md-6">
						<?php
						$rt_year = date( 'Y' );
						printf(
							esc_html( '%1$s, %2$s. %3$s.' ),
							of_get_option( 'custom_footer_text', "&copy; 2018 - {$rt_year} Revive Today" ),
							'a <a href="https://www.soupbowl.io">soupbowl</a> site',
							'<a href="https://github.com/revivetoday/sparkling-child" target="_blank">Theme Details</a>'
							);
						?>
					</div>
				</div>
			</div><!-- .site-info -->
			<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
		</footer><!-- #colophon -->
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
