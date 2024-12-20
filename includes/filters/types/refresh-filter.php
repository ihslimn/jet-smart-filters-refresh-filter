<?php
namespace JSF_Refresh_Filter\Filters\Types;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


class Refresh_Filter extends \Jet_Smart_Filters_Filter_Base {

	/**
	 * Get provider ID
	 *
	 * @return string
	 */
	public function get_id() {
		return 'refresh-filter';
	}

	/**
	 * Get provider name
	 *
	 * @return string
	 */
	public function get_name() {
		return __( 'Refresh Filter', 'jet-engine' );
	}

	/**
	 * Get provider wrapper selector
	 *
	 * @return string
	 */
	public function get_scripts() {
		return array( 'jet-engine-refresh-filter-frontend' );
	}

	public function get_template( $args = array() ) {
		return jet_smart_filters_refresh_filter()->get_path( 'includes/filters/types/refresh-filter-template.php' );
	}

	/**
	 * Prepare filter template argumnets
	 *
	 * @param  [type] $args [description]
	 *
	 * @return [type]       [description]
	 */
	public function prepare_args( $args ) {

		$content_provider = isset( $args['content_provider'] ) ? $args['content_provider'] : false;

		return array(
			'options'              => false,
			'query_type'           => 'refresh',
			'query_var'            => '',
			'content_provider'     => $content_provider,
			'apply_type'           => 'ajax',
			'refresh_rate'         => $args['refresh_rate'] ?? 5,
		);

	}

	public function additional_filter_data_atts( $args ) {
		$additional_filter_data_atts = array();

		$additional_filter_data_atts['data-refresh-rate'] = $args['refresh_rate'];

		return $additional_filter_data_atts;
	}

}
