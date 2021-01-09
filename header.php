<?php
/**
 * ReviveToday v2 theme, based upon the Sparkling theme.
 *
 * @package revivetoday-child
 * @author soup-bowl <code@soupbowl.io>
 * @license MIT
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="<?php echo esc_attr( of_get_option( 'nav_bg_color' ) ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<a class="sr-only sr-only-focusable" href="#content">Skip to main content</a>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<nav class="navbar navbar-default 
		<?php
		if ( of_get_option( 'sticky_header' ) ) {
			echo 'navbar-fixed-top';}
		?>
" role="navigation">
			<div class="container">
				<div class="row">
					<div class="site-navigation-inner col-sm-12">
						<div class="navbar-header">
							<button type="button" class="btn navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>

							<div id="logo">
								<?php if ( '' !== get_header_image() ) { ?>
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="navbar-banner" src="<?php header_image(); ?>"  height="<?php echo esc_attr( get_custom_header()->height ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
											<?php if ( is_home() ) { ?>
											<h1 class="site-name hide-site-name"><a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
												<?php
											}
								} else {
									echo is_home() ? '<h1 class="site-name">' : '<p class="site-name">';
									?>
											<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
									<?php echo is_home() ? '</h1>' : '</p>'; ?>
								<?php } ?>
							</div><!-- end of #logo -->
						</div>
						<?php sparkling_header_menu(); // main navigation. ?>
					</div>
				</div>
			</div>
		</nav><!-- .site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

		<div class="top-section">
			<?php sparkling_featured_slider(); ?>
			<?php sparkling_call_for_action(); ?>
		</div>

		<div class="container main-content-area">
			<?php $layout_class = get_layout_class(); ?>
			<div class="row <?php echo esc_attr( $layout_class ); ?>">
				<div class="main-content-inner <?php echo esc_attr( sparkling_main_content_bootstrap_classes() ); ?>">
					<?php
					if ( function_exists( 'the_ad_placement' ) ) {
						the_ad_placement( 'above-title' );
					}
