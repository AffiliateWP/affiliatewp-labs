<?php
namespace AffWP\Labs;

use AffWP\Labs;

/**
 * Implements the Email Customizer feature for labs.
 *
 * @since 1.0
 *
 * @see \AffWP\Labs\Feature
 */
final class Email_Customizer extends Labs\Feature implements Labs\Customizer_Feature {

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
		add_action( 'affwp_labs_customize_register', array( $this, 'set_up_customizer' ) );

		parent::__construct();
	}

	/**
	 * Sets up the Email Customizer.
	 *
	 * @access public
	 * @since  1.0
	 *
	 * @param \WP_Customize_Manager $wp_customize Customizer instance.
	 */
	public function set_up_customizer( $wp_customize ) {
		$this->wp_customize = $wp_customize;

		// Settings before controls is required. Sections and panels anytime.
		$this->register_settings();
		$this->register_controls();
		$this->register_sections();
	}

	/**
	 * Registers settings to the Affiliate Area Styles control(s).
	 *
	 * @access public
	 * @since  1.0
	 */
	public function register_settings() {
		$this->wp_customize->add_setting( 'affwp_settings[labs][email][primary]', array(
			'type'              => 'option',
			'default'           => '#FF6633',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage'
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
			new \WP_Customize_Color_Control( $this->wp_customize, 'email_customizer_primary', array(
				'settings'   => 'affwp_settings[labs][email][primary]',
				'label'    => __( 'Primary Color', 'affiliatewp-labs' ),
				'section'  => 'affwp_labs_email_customizer',
				'priority' => 10
			) )
		);
	}

	/**
	 * Registers the the Affiliate Area Styles section.
	 *
	 * @access public
	 * @since  1.0
	 */
	public function register_sections() {
		$this->wp_customize->add_section( 'affwp_labs_email_customizer', array(
			'title' => __( 'Email Customizer', 'affiliatewp-labs' ),
			'panel' => affiliate_wp()->labs->get_panel_id()
		) );
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
		$settings['email_customizer'] = array(
			'name' => __( 'Email Customizer', 'affiliatewp-labs' ),
			'desc' => __( 'Adds the ability to customize AffiliateWP emails.', 'affiliatewp-labs' ),
			'type' => 'checkbox'
		);

		return $settings;
	}

}
