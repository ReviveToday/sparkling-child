<?php

/**
 * Extra function replacers.
 */
include_once __DIR__ . '/extras.php';

/**
 * Overrides customier values.
 */
include_once __DIR__ . '/customizer.php';

/**
 * Add the configuration options added by this child.
 */
include_once __DIR__ . '/custom/rt-settings.php';

( new rt_settings() )->register_hooks();

add_action( 'wp_enqueue_scripts', function () {
	// Add Bootstrap default CSS
	wp_enqueue_style( 'sparkling-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );

	// Add Font Awesome stylesheet
	wp_enqueue_style( 'sparkling-icons', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css', null, '5.1.1.', 'all' );

	$font = of_get_option( 'main_body_typography' );
	if ( isset( $font['subset'] ) ) {
		wp_register_style( 'sparkling-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700|Roboto+Slab:400,300,700&subset=' . $font['subset'] );
	} else {
		wp_register_style( 'sparkling-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700|Roboto+Slab:400,300,700' );
	}

	wp_enqueue_style( 'sparkling-fonts' );

	// Add slider CSS only if is front page ans slider is enabled
	if ( ( is_home() || is_front_page() ) && of_get_option( 'sparkling_slider_checkbox' ) == 1 ) {
		wp_enqueue_style( 'flexslider-css', get_template_directory_uri() . '/assets/css/flexslider.css' );
	}

	// Add main theme stylesheet
	wp_enqueue_style( 'sparkling-style', get_stylesheet_uri(), null, '2.4.2', 'all' );

	// Add Bootstrap default JS
	wp_enqueue_script( 'sparkling-bootstrapjs', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', array( 'jquery' ) );

	if ( ( is_home() || is_front_page() ) && of_get_option( 'sparkling_slider_checkbox' ) == 1 ) {
		// Add slider JS only if is front page ans slider is enabled
		wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/assets/js/vendor/flexslider.min.js', array( 'jquery' ), '20140222', true );
		// Flexslider customization
		wp_enqueue_script(
			'flexslider-customization', get_template_directory_uri() . '/assets/js/flexslider-custom.js', array(
				'jquery',
				'flexslider-js',
			), '20140716', true
		);
	}

	// Main theme related functions
	wp_enqueue_script( 'sparkling-functions', get_template_directory_uri() . '/assets/js/functions.js', array( 'jquery' ), '20180503', false );

	// This one is for accessibility
	wp_enqueue_script( 'sparkling-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20140222', true );

	// Treaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Academicons
	if ( of_get_option( 'academicons' ) == 1 ) {
		wp_enqueue_style( 'academicons-css', get_template_directory_uri() . '/assets/css/academicons.min.css', null, '1.8.6', 'all' );
	}

	wp_enqueue_style( 'sparkling-fonts' );
	
	// ReviveToday - Actually custom part.
	wp_enqueue_style( 'sparkling', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'sparkling-child', get_stylesheet_directory_uri() . '/style.css', [ 'sparkling' ], wp_get_theme()->get('Version') );
});

function get_layout_class() {
	global $post;
	if ( is_singular() && get_post_meta( $post->ID, 'site_layout', true ) && ! is_singular( array( 'product' ) ) ) {
		$layout_class = get_post_meta( $post->ID, 'site_layout', true );
	} elseif ( function_exists( 'is_woocommerce' ) && function_exists( 'is_it_woocommerce_page' ) && is_it_woocommerce_page() && ! is_search() ) {// Check for WooCommerce
		$page_id = ( is_product() ) ? $post->ID : get_woocommerce_page_id();

		if ( $page_id && get_post_meta( $page_id, 'site_layout', true ) ) {
			$layout_class = get_post_meta( $page_id, 'site_layout', true );
		} else {
			$layout_class = of_get_option( 'woo_site_layout', 'full-width' );
		}
	} else {
		$layout_class = of_get_option( 'site_layout', 'full-width' );
	}

	return $layout_class;
}