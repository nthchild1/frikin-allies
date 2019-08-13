<?php
/**
 * The custom taxonomies of the plugin.
 *
 * @link       https://frik-in.io
 * @since      1.0.0
 *
 * @package 		Frikin_Allies
 * @subpackage 	Frikin_Allies/admin
 */

/**
 * The custom taxonomies of the plugin.
 *
 * @package 		Frikin_Allies
 * @subpackage 	Frikin_Allies/admin
 * @author     	Pablo Dominguez <webmaster@astroweb.me>
 */
class Frikin_Allies_Mailing{
	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 			string 			$meta    			The post meta data.
	 */
	private $meta;

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 			string 			$plugin_name 		The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 			string 			$version 			The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$Frikin_API 		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function test(){
	    /*
		wp_mail( 'tky2048@gmail.com', 'TEST', 'THIS IS JUST A TEST', '', '' );
		echo "<script>console.log( 'mail sent' );</script>";
        */
	}
}
