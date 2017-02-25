<?php
namespace AffWP\Labs;

/**
 * Defines the scope of a customizer-based Labs feature.
 *
 * @since 1.0
 */
interface Customizer_Feature {

	/**
	 * Sets up the Customizer for the feature, including running the register_*() methods.
	 *
	 * @access public
	 * @since  1.0
	 *
	 * @param \WP_Customize_Manager $wp_customizer Customizer instance.
	 */
	public function set_up_customizer( $wp_customizer );

	/**
	 * Registers settings for the Customizer-based feature.
	 *
	 * @access public
	 * @since  1.0
	 */
	public function register_settings();

	/**
	 * Registers controls for the Customizer-based feature.
	 *
	 * @access public
	 * @since  1.0
	 */
	public function register_controls();

	/**
	 * Registers sections for the Customizer-based feature.
	 *
	 * @access public
	 * @since  1.0
	 */
	public function register_sections();

}
