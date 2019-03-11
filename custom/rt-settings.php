<?php
class rt_settings {
	public function register_hooks() {
		add_action( 'add_meta_boxes', [ &$this, 'form_setup' ] );
		add_action( 'publish_page', [ &$this, 'store_custom' ] );
	}

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

	public function store_custom( $post_ID ) {
		$rt_dlu = ( isset( $_REQUEST['rt_displastupdated'] ) && '1' === $_REQUEST['rt_displastupdated'] ) ? true : false;
		update_post_meta( $post_ID, 'rt_show_last_updated', $rt_dlu );

		$rt_dsb = ( isset( $_REQUEST['rt_dispsharingbuttons'] ) && '1' === $_REQUEST['rt_dispsharingbuttons'] ) ? true : false;
		update_post_meta( $post_ID, 'rt_show_sharing_buttons', $rt_dsb );
	}
}
