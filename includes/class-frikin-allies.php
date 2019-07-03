<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       frik-in.io
 * @since      1.0.0
 *
 * @package    Frikin_Allies
 * @subpackage Frikin_Allies/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Frikin_Allies
 * @subpackage Frikin_Allies/includes
 * @author     Frik-in <webmaster@frik-in.com>
 */
class Frikin_Allies {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Frikin_Allies_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'FRIKIN_ALLIES_VERSION' ) ) {
			$this->version = FRIKIN_ALLIES_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'frikin-allies';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Frikin_Allies_Loader. Orchestrates the hooks of the plugin.
	 * - Frikin_Allies_i18n. Defines internationalization functionality.
	 * - Frikin_Allies_Admin. Defines all hooks for the admin area.
	 * - Frikin_Allies_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {


		/**
		 * The class responsible for defining all actions relating to custom post types.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-frikin-allies-admin-post-types.php';

		/**
		 * The class responsible for defining all actions relating to custom taxonomies.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-frikin-allies-admin-taxonomies.php';

		/**
		 * The class responsible for defining all actions relating to metablocks.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-frikin-allies-admin-metablocks.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-frikin-allies-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-frikin-allies-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-frikin-allies-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-frikin-allies-public.php';

		$this->loader = new Frikin_Allies_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Frikin_Allies_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Frikin_Allies_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Frikin_Allies_Admin( $this->get_plugin_name(), $this->get_version() );
		$plugin_post_types = new Frikin_Allies_Admin_Post_Types( $this->get_plugin_name(), $this->get_version() );
		$plugin_metablocks = new Frikin_Allies_Admin_Metablocks( $this->get_plugin_name(), $this->get_version() );
		$plugin_taxonomies = new Frikin_Allies_Admin_Taxonomies( $this->get_plugin_name(), $this->get_version() );
		$plugin_i18n = new Frikin_Allies_i18n($this->get_plugin_name(),$this->get_version());

		$this->loader->add_action( 'init', $plugin_taxonomies, 'new_taxonomy_ally_type' );
		$this->loader->add_action( 'init', $plugin_taxonomies, 'new_taxonomy_relation_type' );
		$this->loader->add_action( 'init', $plugin_post_types, 'new_cpt_ally' );
		$this->loader->add_filter( 'init', $plugin_post_types, 'add_custom_capabilities' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Metablocks
		$this->loader->add_action( 'add_meta_boxes_place', $plugin_metablocks, 'set_meta' );
		$this->loader->add_action('init', $plugin_metablocks, 'register_metablocks');
		$this->loader->add_action( 'save_post_place', $plugin_metablocks, 'validate_meta', 10, 2 );
		$this->loader->add_action( 'init', $plugin_metablocks, 'register_meta_for_rest' );
		$this->loader->add_action( 'init',$plugin_metablocks, 'register_template' );

		// Translation
        $this->loader->add_action( 'init', $plugin_i18n,'set_script_translations' );

    }

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Frikin_Allies_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Frikin_Allies_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
