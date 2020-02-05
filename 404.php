<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package sparkling
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="post-inner-content">

				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! We don\'t seem to have that anymore...', 'sparkling' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<div class="oh-no-404"></div>

						<p><?php esc_html_e( 'We popped open some boxes, dusted off the tape collection, and asked our mate Jim. Give our search a try!', 'sparkling' ); ?></p>

						<?php get_search_form(); ?>


				</section><!-- .error-404 -->
			</div>
		</main><!-- #main -->
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
