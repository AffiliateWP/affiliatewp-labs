<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Affiliatewp_Labs
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {

	// Plugin dir on local.
	$local_plugin_dir = dirname( dirname( dirname( __FILE__ ) ) );

	// Grab the plugin dependencies map.
	$dependencies = require __DIR__ . '/dependencies.php';

	foreach ( $dependencies as $current_plugin_dir => $dependency ) {

		// Load AffiliateWP if it's already there (as on local).
		if ( is_dir( $local_plugin_dir . $current_plugin_dir ) ) {

			require( $local_plugin_dir . $dependency['path'] );

			echo "AffiliateWP loaded from local environment.\n";

		// Otherwise load it for the benefit of Travis CI.
		} elseif ( is_dir( WP_PLUGIN_DIR . '/' . $current_plugin_dir ) ) {

			require WP_PLUGIN_DIR . '/' . $dependency['path'];

			echo "AffiliateWP loaded from the test environment.\n";

		} else {

			echo "AffiliateWP could not be loaded.\n";

		}

	}

	// Load the addon.
	require dirname( dirname( __FILE__ ) ) . '/affiliatewp-labs.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
