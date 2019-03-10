<?php

add_action( 'customize_register', function( $wp_customize ) {
	$wp_customize->add_setting(
		'sparkling[site_layout]', array(
			'default'           => 'full-width',
			'type'              => 'option',
			'sanitize_callback' => 'sparkling_sanitize_layout',
		)
	);

    $wp_customize->add_setting(
		'sparkling[element_color]', array(
			'default'           => sanitize_hex_color( '#138E96' ),
			'type'              => 'option',
			'sanitize_callback' => 'sparkling_sanitize_hexcolor',
		)
	);

	$wp_customize->add_setting(
		'sparkling[link_color]', array(
			'default'           => sanitize_hex_color( '#020000' ),
			'type'              => 'option',
			'sanitize_callback' => 'sparkling_sanitize_hexcolor',
		)
	);

    $wp_customize->add_setting(
		'sparkling[nav_bg_color]', array(
			'default'           => sanitize_hex_color( '#138E96' ),
			'type'              => 'option',
			'sanitize_callback' => 'sparkling_sanitize_hexcolor',
		)
	);

	$wp_customize->add_setting(
		'sparkling[nav_item_hover_color]', array(
			'default'           => sanitize_hex_color( '#CECECE' ),
			'type'              => 'option',
			'sanitize_callback' => 'sparkling_sanitize_hexcolor',
		)
	);

	$wp_customize->add_setting(
		'sparkling[nav_dropdown_bg]', array(
			'default'           => sanitize_hex_color( '#020202' ),
			'type'              => 'option',
			'sanitize_callback' => 'sparkling_sanitize_hexcolor',
		)
	);

	$wp_customize->add_setting(
		'sparkling[nav_dropdown_item]', array(
			'default'           => sanitize_hex_color( '#D8CDCD' ),
			'type'              => 'option',
			'sanitize_callback' => 'sparkling_sanitize_hexcolor',
		)
	);

    $wp_customize->add_setting(
		'sparkling[nav_dropdown_item_hover]', array(
			'default'           => sanitize_hex_color( '#EDE1E1' ),
			'type'              => 'option',
			'sanitize_callback' => 'sparkling_sanitize_hexcolor',
		)
	);

	$wp_customize->add_setting(
		'sparkling[nav_dropdown_bg_hover]', array(
			'default'           => sanitize_hex_color( '#138E96' ),
			'type'              => 'option',
			'sanitize_callback' => 'sparkling_sanitize_hexcolor',
		)
	);

	$wp_customize->add_setting(
		'sparkling[custom_footer_text]', array(
			'default'           => 'Copyright © 2018 Revive Today. ',
			'type'              => 'option',
			'sanitize_callback' => 'sparkling_sanitize_strip_slashes',
		)
	);

	$wp_customize->remove_section( 'epsilon_recomended_section' );
}, 99 );