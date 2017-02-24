<?php
namespace AffWP\Labs;

use AffWP\Labs;

if ( ! class_exists( 'AffWP\Labs\Feature' ) ) {
	require_once AFFILIATEWP_PLUGIN_DIR . 'includes/abstracts/class-affwp-labs-feature.php';
}

/**
 * Implements the Affiliate Area Styles feature for labs.
 *
 * @since 2.0.4
 *
 * @see \AffWP\Labs\Feature
 */
final class Affiliate_Area_Styles extends Labs\Feature {

	/**
	 * Customizer instance.
	 *
	 * @access protected
	 * @since  2.0.4
	 * @var    \WP_Customize_Manager
	 */
	protected $wp_customize;

	/**
	 * Affiliate Area panel ID.
	 *
	 * @access protected
	 * @since  2.0.4
	 * @var    string
	 */
	protected $panel_id = 'affwp_labs_affarea_styles';

	public function __construct() {
		add_action( 'customize_register', array( $this, 'set_up_customizer' ) );

		parent::__construct();
	}

	public function set_up_customizer( $wp_customize ) {
		$this->wp_customize = $wp_customize;

		$this->register_panel();
		$this->register_sections();
	}

	public function register_panel() {
		$this->wp_customize->add_panel( $this->panel_id, array(
			// Deliberately not translatable.
			'title' => 'AffiliateWP'
		) );

	}
	/**
	 * Registers the AMP Template panel sections.
	 *
	 * @since 0.4
	 * @access public
	 */
	public function register_sections() {
		$this->wp_customize->add_section( 'affwp_etc_customizer_registration', array(
			'title' => __( 'Registration', 'affiliate-wp' ),
			'panel' => $this->panel_id
		) );

		$this->wp_customize->add_section( 'affwp_etc_customizer_accepted', array(
			'title' => __( 'Accepted Affiliate', 'affiliate-wp' ),
			'panel' => $this->panel_id
		) );

		$this->wp_customize->add_section( 'affwp_etc_customizer_pending', array(
			'title' => __( 'Pending Affiliate', 'affiliate-wp' ),
			'panel' => $this->panel_id
		) );

		$this->wp_customize->add_section( 'affwp_etc_customizer_referral', array(
			'title' => __( 'New Referral', 'affiliate-wp' ),
			'panel' => $this->panel_id
		) );
	}


	/**
	 * Registers the labs setting.
	 *
	 * @access public
	 * @since  2.0.4
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
