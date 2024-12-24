<?php

namespace JSF_Refresh_Filter;

use \JSF_Refresh_Filter\Plugin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

class Assets {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend' ) );
	}

	public function frontend() {
		wp_register_script(
			'jet-engine-refresh-filter-frontend',
			Plugin::instance()->get_url( '/assets/js/frontend.js' ),
			array( 'jet-plugins' ),
			Plugin::instance()->version
		);
	}

}
