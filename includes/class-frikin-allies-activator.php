<?php

/**
 * Fired during plugin activation
 *
 * @link       frik-in.io
 * @since      1.0.0
 *
 * @package    Frikin_Allies
 * @subpackage Frikin_Allies/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Frikin_Allies
 * @subpackage Frikin_Allies/includes
 * @author     Frik-in <webmaster@frik-in.com>
 */
class Frikin_Allies_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// schedule events (cron jobs)
		require_once plugin_dir_path( __FILE__ ) . 'class-frikin-allies-cron.php';
		Frikin_Allies_Cron::schedule();
	}

}
