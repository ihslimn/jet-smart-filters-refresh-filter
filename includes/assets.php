<?php

namespace JSF_Refresh_Filter;

use \JSF_Refresh_Filter\Plugin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

class Assets {

	public function frontend() {
		wp_enqueue_script(
			'jet-engine-refresh-filter-frontend',
			Plugin::instance()->get_url( '/assets/js/frontend.js' ),
			array( 'jet-plugins' ),
			Plugin::instance()->version,
			true
		);
	}

}
