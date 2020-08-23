<?php
/**
 * ReviveToday v2 theme, based upon the Sparkling theme.
 *
 * @package revivetoday-child
 * @author soup-bowl <code@soupbowl.io>
 * @license MIT
 */

/**
 * Setting modifications relating to ReviveToday.
 */
class Rt_Settings {
	/**
	 * Hooks into the WordPress system.
	 *
	 * @return void Runs add_action to hook into WP.
	 */
	public function register_hooks() {
		add_action( 'add_meta_boxes', [ &$this, 'form_setup' ] );
		add_action( 'publish_page', [ &$this, 'store_custom' ] );
	}

	/**
	 * Adds a box in editor view to enable custom settings.
	 *
	 * @return void Adds meta boxes into WP.
	 */
	public function form_setup() {
		add_meta_box(
			'rtsettings',
			'ReviveToday Theme Settings',
			function( $post ) {
				$rt_dlu = (int) get_post_meta( $post->ID, 'rt_show_last_updated', true );
				$rt_dsb = (int) get_post_meta( $post->ID, 'rt_show_sharing_buttons', true );
				?>
				<div>
					<input type="checkbox" name="rt_displastupdated" value="1" <?php checked( $rt_dlu, 1 ); ?> />
					<label for="rt_displastupdated">Show last updated</label>
				</div>
				<div>
					<input type="checkbox" name="rt_dispsharingbuttons" value="1" <?php checked( $rt_dsb, 1 ); ?> />
					<label for="rt_dispsharingbuttons">Show sharing buttons</label>
				</div>
				<?php
			},
			'page',
			'side',
			'low'
		);
	}

	/**
	 * Handles the storage of custom setting changes.
	 *
	 * @param integer $post_id Post ID of the processed entity.
	 * @return void
	 */
	public function store_custom( $post_id ) {
		$rt_dlu = ( isset( $_REQUEST['rt_displastupdated'] ) && '1' === $_REQUEST['rt_displastupdated'] ) ? true : false;
		update_post_meta( $post_id, 'rt_show_last_updated', $rt_dlu );

		$rt_dsb = ( isset( $_REQUEST['rt_dispsharingbuttons'] ) && '1' === $_REQUEST['rt_dispsharingbuttons'] ) ? true : false;
		update_post_meta( $post_id, 'rt_show_sharing_buttons', $rt_dsb );
	}
}
