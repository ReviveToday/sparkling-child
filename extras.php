<?php

/**
 * Register slider post type. Replaces category-based post implementation with
 * a CPT-based version for finer controls, and not being content-based.
 *
 * @return void
 */
function sparkling_rt_register_slider_post_type() {
	return register_post_type( 'sp_rt_featslider', [
		'label'               => __( "Sliders", 'sparkling' ),
		'description'         => __( "Featured items slider entries", 'sparkling' ),
		'supports'            => ['title', 'editor', 'custom-fields', 'thumbnail'],
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
		'rewrite'             => false
	]);
}
add_action( 'init', 'sparkling_rt_register_slider_post_type');

/**
 * Replaces sparkling_featured_slider in inc/extras.php. This version uses a custom
 * post type instead of a category-based post slider.
 *
 * @return void
 */
function sparkling_featured_slider() {
	// TODO - MODIFY THIS FUNCTION
	
	if ( is_front_page() && of_get_option( 'sparkling_slider_checkbox' ) == 1 ) {
		echo '<div class="flexslider">';
		echo '<ul class="slides">';

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
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				
				$url = get_post_meta(get_the_ID(), 'rt_url', true);
				if ( of_get_option( 'sparkling_slider_link_checkbox', 1 ) == 1 && !empty($url) ) {
					echo "<li><a href=\"{$url}\">";
				} else {
					echo '<li><a>';
				}

				if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) :
					if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) {
						$feat_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						$args           = array(
							'resize' => '1920,550',
						);
						$photon_url     = jetpack_photon_url( $feat_image_url[0], $args );
						echo '<img src="' . $photon_url . '">';
					} else {
						echo get_the_post_thumbnail( get_the_ID(), 'activello-slider' );
					}
				endif;

				echo '<div class="flex-caption">';
				if ( get_the_title() != '' ) {
					echo '<h2 class="entry-title">' . get_the_title() . '</h2>';
				}
				if ( get_the_excerpt() != '' ) {
					echo '<div class="excerpt">' . get_the_excerpt() . '</div>';
				}
				echo '</div>';
				echo '</a></li>';
			endwhile;
		endif;
		wp_reset_postdata();
		echo '</ul>';
		echo ' </div>';
	}// End if().
}