<?php
/**
 * ReviveToday v2 theme, based upon the Sparkling theme.
 *
 * @package revivetoday-child
 * @author soup-bowl <code@soupbowl.io>
 * @license MIT
 */

/**
 * Purges the transient cache for the slider.
 *
 * @return void
 */
function sparking_rt_refresh_slider() {
	delete_transient( 'rt_slider' );
}
add_action( 'publish_sp_rt_featslider', 'sparking_rt_refresh_slider' );
add_action( 'trash_sp_rt_featslider', 'sparking_rt_refresh_slider' );

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
			'supports'            => [ 'title', 'editor', 'thumbnail' ],
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
	if ( is_front_page() && 1 === of_get_option( 'sparkling_slider_checkbox' ) ) {
		echo wp_kses(
			'<div class="flexslider"><ul class="slides">',
			[
				'div' => [ 'class' => [] ],
				'ul'  => [ 'class' => [] ],
			]
		);

		$query = get_transient( 'rt_slider' );
		if ( false === $query ) {
			// phpcs:disable WordPress.DB.SlowDBQuery
			$query = new WP_Query(
				[
					'post_type'      => 'sp_rt_featslider',
					'posts_per_page' => -1,
					'meta_query'     => [
						[
							'key'     => '_thumbnail_id',
							'compare' => 'EXISTS',
						],
					],
				]
			);
			// phpcs:enable

			set_transient( 'rt_slider', $query, 1 * YEAR_IN_SECONDS );
		}

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

/**
 * Additional values for use by the homepage slider.
 *
 * @param WP_Post $post The post object being edited.
 * @return void
 */
function rt_slider_custombox( WP_Post $post ) {
	add_meta_box(
		'rtsliderdetails',
		'Slider Extras',
		function ( WP_Post $post ) {
			$existing = get_post_meta( $post->ID, 'rt_url', true );
			?>
			<input type="hidden" name="rt_nonce" value="<?php echo esc_attr( wp_create_nonce( 'rt_nonce' ) ); ?>">
			<table class="form-table" role="presentation">
				<tbody>
				<tr>
					<td class="first"><label for="rt_slider_url">Slider URL</label></td>
					<td><input type="text" name="rt_slider_url" value="<?php echo esc_attr( $existing ); ?>" placeholder="http://google.com" style="width:80%"></td>
				</tr>
				</tbody>
			</table>
			<?php
		},
		'sp_rt_featslider',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes_sp_rt_featslider', 'rt_slider_custombox' );

/**
 * Stores the result of the slider adjustments.
 *
 * @param integer $post_id Post ID of the adjusted slider entity.
 * @return void
 */
function rt_slider_storeresult( int $post_id ) {
	if ( isset( $_REQUEST['rt_nonce'] ) && wp_verify_nonce( sanitize_key( $_REQUEST['rt_nonce'] ), 'rt_nonce' ) ) {
		if ( isset( $_REQUEST['rt_slider_url'] ) ) {
			update_post_meta( $post_id, 'rt_url', esc_url_raw( wp_unslash( $_REQUEST['rt_slider_url'] ) ) );
		}
	}
}
add_action( 'publish_sp_rt_featslider', 'rt_slider_storeresult' );
