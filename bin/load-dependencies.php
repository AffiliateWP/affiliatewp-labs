<?php
/**
 * Loads any dependencies needed for the plugin's unit tests to run on local
 * and in a CI environment.
 *
 * Plugin dependencies are defined in the array returned from tests/dependencies.php.
 *
 * This script loads the dependencies, activation happens on the 'muplugins_loaded' hook
 * in tests/bootstrap.php.
 *
 * Pattern inspired by Casey Bisson's work with bStat.
 *
 * @link https://github.com/misterbisson Casey Bisson
 */

/**
 * Downloads a given plugin resource.
 *
 * @param string $path   Local plugin path.
 * @param array  $plugin Plugin information.
 * @return true Always true.
 */
function download_plugin( $path, $plugin ) {

	// Clone the plugin.
	echo passthru( "git clone {$plugin['repo']} $path" ) . "\n\n";

	return true;
}

/**
 * Loops through and downloads all plugin dependencies.
 *
 * @return void
 */
function download_plugins() {
	$plugins_dir  = '/tmp/wordpress/wp-content/plugins/';
	$dependencies = require dirname( __DIR__ ). '/tests/dependencies.php';

	foreach ( $dependencies as $current_plugin_dir => $dependency ) {

		if ( ! is_dir( $plugins_dir . $current_plugin_dir ) ) {

			if ( download_plugin( $plugins_dir . $current_plugin_dir, $dependency ) ) {

				echo "Downloaded $current_plugin_dir\n";

			} else {

				echo "Failed to download $current_plugin_dir\n";

			}

		} else {

			echo "Plugin directory exists, skipping $plugins_dir$current_plugin_dir\n";

		}
	}
}

download_plugins();
