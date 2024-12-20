<?php
namespace JSF_Refresh_Filter\Filters;

class Manager {

	public function __construct() {
		add_action( 'jet-smart-filters/filter-types/register', array( $this, 'register_filter_types' ) );
		add_action( 'jet-engine/elementor-views/widgets/register', array( $this, 'register_widgets' ), 20, 2 );
		add_filter( 'jet-smart-filters/admin/filter-types', array( $this, 'hide_refresh_filter' ) );
	}

	public function hide_refresh_filter( $types ) {
		unset( $types['refresh-filter'] );
		return $types;
	}

	public function register_widgets( $widgets_manager, $elementor_views ) {

		if ( ! function_exists( 'jet_smart_filters' ) ) {
			return;
		}

		$filters_path = jet_smart_filters_refresh_filter()->get_path( 'includes/filters/widgets/' );

		$elementor_views->register_widget(
			$filters_path . 'refresh-filter.php',
			$widgets_manager,
			__NAMESPACE__ . '\Widgets\Refresh_Filter'
		);

	}

	public function register_filter_types( $types_manager ) {

		$filters_path = jet_smart_filters_refresh_filter()->get_path( 'includes/filters/types/' );

		$types_manager->register_filter_type(
			'\JSF_Refresh_Filter\Filters\Types\Refresh_Filter',
			$filters_path . 'refresh-filter.php'
		);

	}

}
