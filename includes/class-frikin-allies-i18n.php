<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       frik-in.io
 * @since      1.0.0
 *
 * @package    Frikin_Allies
 * @subpackage Frikin_Allies/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Frikin_Allies
 * @subpackage Frikin_Allies/includes
 * @author     Frik-in <webmaster@frik-in.com>
 */
class Frikin_Allies_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'frikin-allies',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
    function set_script_translations() {
        if ( function_exists( 'wp_set_script_translations' ) ) {
            wp_set_script_translations( 'frikin-allies-build-js', 'frikin-allies', plugin_dir_path( __FILE__ ) . '/languages' );
        }
    }
}
