<?php
namespace AffWP\Labs;

use AffWP\Labs;

if ( ! class_exists( 'AffWP\Labs\Feature' ) ) {
	require_once AFFILIATEWP_PLUGIN_DIR . 'includes/abstracts/class-affwp-labs-feature.php';
}

/**
 * Implements the Affiliate Area Styles feature for labs.
 *
 * @since 1.0
 *
 * @see \AffWP\Labs\Feature
 */
final class Affiliate_Area_Styles extends Labs\Feature {

	/**
	 * Customizer instance.
	 *
	 * @access protected
	 * @since  1.0
	 * @var    \WP_Customize_Manager
	 */
	protected $wp_customize;

	/**
	 * Sets up the Affiliate Area Styles section in the Customizer.
	 *
	 * @access public
	 * @since  1.0
	 */
	public function __construct() {
		add_action( 'affwp_labs_customize_register', array( $this, 'set_up_customizer' ), 20 );

		parent::__construct();
	}

	/**
	 * Sets up the Customizer for AAS.
	 *
	 * @access public
	 * @since  1.0
	 *
	 * @param \WP_Customize_Manager $wp_customize Customizer instance.
	 */
	public function set_up_customizer( $wp_customize ) {
		$this->wp_customize = $wp_customize;

		$this->register_sections();
		$this->register_controls();
	}

	/**
	 * Registers the the Affiliate Area Styles section.
	 *
	 * @access public
	 * @since  1.0
	 */
	public function register_sections() {
		$this->wp_customize->add_section( 'affwp_labs_affiliate_area', array(
			'title' => __( 'Affiliate Area Styles', 'affiliate-wp' ),
			'panel' => affiliate_wp()->labs->get_panel_id()
		) );
	}

	/**
	 * Registers controls to the the Affiliate Area Styles section(s).
	 *
	 * @access public
	 * @since  1.0
	 */
	public function register_controls() {
		$this->wp_customize->add_control(
			new \WP_Customize_Color_Control( $this->wp_customize, 'affiliate_area_primary', array(
				'settings'   => 'affwp_settings',
				'label'    => __( 'Primary Color', 'amp' ),
				'section'  => 'affwp_labs_affiliate_area',
				'priority' => 10
			) )
		);
	}

	/**
	 * Registers the labs setting.
	 *
	 * @access public
	 * @since  1.0
	 *
	 * @param array $settings Labs settings.
	 * @return array Modified labs settings.
	 */
	public function register_labs_setting( $settings ) {
		$settings['affiliate_area_styles'] = array(
			'name' => __( 'Affiliate Area Style Customizer', 'affiliate-wp' ),
			'desc' => __( 'Adds the ability to customize styling of the affiliate area.', 'affiliate-wp' ),
			'type' => 'checkbox'
		);

		return $settings;
	}


}
