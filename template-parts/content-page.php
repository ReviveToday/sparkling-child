<?php
/**
 * ReviveToday v2 theme, based upon the Sparkling theme.
 *
 * @package revivetoday-child
 * @author soup-bowl <code@soupbowl.io>
 * @license MIT
 */

if ( is_page_template( 'page-fullwidth.php' ) ) {
	the_post_thumbnail(
		'sparkling-featured-fullwidth',
		array(
			'class' => 'single-featured',
		)
	);
} else {
	the_post_thumbnail(
		'sparkling-featured',
		array(
			'class' => 'single-featured',
		)
	);
}
?>

<div class="post-inner-content">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sparkling' ),
					'after'  => '</div>',
				)
			);
			?>

	<?php
	// Checks if this is homepage to enable homepage widgets.
	if ( is_front_page() ) {
		get_sidebar( 'home' );
	}
	?>

	<?php
	$lu_conf = get_post_meta( get_the_ID(), 'rt_show_last_updated', true );
	if ( ! empty( $lu_conf ) && ( true === $lu_conf || '1' === $lu_conf ) ) {
		echo wp_kses_post( '<em>Last updated: ' . get_the_modified_date() . '</em>' );
	}

	$sb_conf = get_post_meta( get_the_ID(), 'rt_show_sharing_buttons', true );
	if ( ! empty( $sb_conf ) && ( true === $sb_conf || '1' === $sb_conf ) ) {
		get_template_part( 'template-parts/social', 'buttons' );
	}
	?>

	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'sparkling' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<i class="fa fa-edit"></i><span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
</div>
