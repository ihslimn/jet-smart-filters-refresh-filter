<?php
namespace JSF_Refresh_Filter\Filters\Widgets;

use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Refresh_Filter extends \Elementor\Jet_Smart_Filters_Base_Widget {

	public function get_name() {
		return 'jet-smart-filters-refresh-filter';
	}

	public function get_title() {
		return __( 'Refresh Filter', 'jet-engine' );
	}

	public function get_icon() {
		return '';
	}

	public function get_help_url() {}

	protected function register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'Content', 'jet-smart-filters' ),
			)
		);

		$this->add_control(
			'content_provider',
			array(
				'label'   => __( 'This filter for', 'jet-smart-filters' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => jet_smart_filters()->data->content_providers(),
			)
		);

		$this->add_control(
			'apply_type',
			array(
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'ajax',
			)
		);
		
		$this->add_control(
			'apply_on',
			array(
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'value',
			)
		);

		$this->add_control(
			'epro_posts_notice',
			array(
				'type' => Controls_Manager::RAW_HTML,
				'raw'  => __( 'Please set <b>jet-smart-filters</b> into Query ID option of Posts widget you want to filter', 'jet-smart-filters' ),
				'condition' => array(
					'content_provider' => array( 'epro-posts', 'epro-portfolio' ),
				),
			)
		);

		$this->add_control(
			'query_id',
			array(
				'label'       => esc_html__( 'Query ID', 'jet-smart-filters' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'description' => __( 'Set unique query ID if you use multiple widgets of same provider on the page. Same ID you need to set for filtered widget.', 'jet-smart-filters' ),
			)
		);

		$this->add_control(
			'refresh_rate',
			array(
				'label'       => esc_html__( 'Refresh Rate', 'jet-smart-filters' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 5,
				'default'     => 10,
				'label_block' => true,
				'description' => __( 'Filters will be applied once the specified amount of seconds. Try not to set the value too low to prevent excessive server load.', 'jet-smart-filters' ),
			)
		);

		$this->end_controls_section();

		$this->register_filter_settings_controls();

	}

	protected function render() {
		jet_smart_filters_refresh_filter()->assets->frontend();

		jet_smart_filters()->set_filters_used();

		$this->add_render_attribute(
			'_wrapper',
			array(
				'style' => 'display: none;',
			)
		);

		$args = $this->get_settings();

		$args['filter_id'] = 0;

		jet_smart_filters()->filter_types->render_filter_template( $this->get_widget_fiter_type(), $args );
	}

}
