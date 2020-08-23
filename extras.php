<?php
/**
 * ReviveToday v2 theme, based upon the Sparkling theme.
 *
 * @package revivetoday-child
 * @author soup-bowl <code@soupbowl.io>
 * @license MIT
 */

/**
 * Register slider post type. Replaces category-based post implementation with
 * a CPT-based version for finer controls, and not being content-based.
 *
 * @return void
 */
function sparkling_rt_register_slider_post_type() {
	register_post_type(
		'sp_rt_featslider',
		[
			'label'               => __( 'Sliders', 'sparkling' ),
			'description'         => __( 'Featured items slider entries', 'sparkling' ),
			'supports'            => [ 'title', 'editor', 'custom-fields', 'thumbnail' ],
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 27,
			'menu_icon'           => 'dashicons-id-alt',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => false,
		]
	);
}
add_action( 'init', 'sparkling_rt_register_slider_post_type' );

/**
 * Replaces sparkling_featured_slider in inc/extras.php. This version uses a custom
 * post type instead of a category-based post slider.
 *
 * @return void
 */
function sparkling_featured_slider() {
	// TODO - MODIFY THIS FUNCTION.

	if ( is_front_page() && 1 === of_get_option( 'sparkling_slider_checkbox' ) ) {
		echo wp_kses(
			'<div class="flexslider"><ul class="slides">',
			[
				'div' => [ 'class' => [] ],
				'ul'  => [ 'class' => [] ],
			]
		);

		$count    = of_get_option( 'sparkling_slide_number' );
		$slidecat = of_get_option( 'sparkling_slide_categories' );

		$query = new WP_Query(
			[
				'post_type'      => 'sp_rt_featslider',
				'posts_per_page' => $count,
				'meta_query'     => [
					[
						'key'     => '_thumbnail_id',
						'compare' => 'EXISTS',
					],
				],
			]
		);
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();

				$url = get_post_meta( get_the_ID(), 'rt_url', true );
				if ( 1 === of_get_option( 'sparkling_slider_link_checkbox', 1 ) && ! empty( $url ) ) {
					echo wp_kses(
						"<li><a href=\"{$url}\">",
						[
							'li' => [],
							'a'  => [ 'href' => [] ],
						]
					);
				} else {
					echo wp_kses(
						'<li><a>',
						[
							'li' => [],
							'a'  => [],
						]
					);
				}

				if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) {
					echo get_the_post_thumbnail( get_the_ID(), 'activello-slider' );
				}

				echo '<div class="flex-caption">';
				if ( '' !== get_the_title() ) {
					echo wp_kses( '<h2 class="entry-title">' . get_the_title() . '</h2>', [ 'h2' => [ 'class' => [] ] ] );
				}
				if ( '' !== get_the_excerpt() ) {
					echo wp_kses( '<div class="excerpt">' . get_the_excerpt() . '</div>', [ 'div' => [ 'class' => [] ] ] );
				}

				echo wp_kses(
					'</div></a></li>',
					[
						'div' => [],
						'a'   => [],
						'li'  => [],
					]
				);
			}
		}
		wp_reset_postdata();
		echo wp_kses(
			'</ul></div>',
			[
				'ul'  => [],
				'div' => [],
			]
		);
	}
}
