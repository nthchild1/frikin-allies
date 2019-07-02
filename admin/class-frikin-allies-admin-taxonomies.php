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
class Frikin_Allies_Admin_Taxonomies{
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


	/**
	 * Creates the new taxonomy "ally-type" for the custom post type "ally".
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	public static function new_taxonomy_ally_type() {
		$plural 	= 'Types';
		$single 	= 'Type';
		$tax_name 	= 'ally-type';

		$opts['hierarchical']	= TRUE;
		$opts['public']			= TRUE;
		$opts['query_var']				 = $tax_name;
		$opts['show_admin_column'] = TRUE;
		$opts['show_in_nav_menus'] = TRUE;
		$opts['show_tag_cloud'] 	 = TRUE;
		$opts['show_ui']					 = TRUE;
		$opts['show_in_rest']			 = TRUE;
		$opts['sort'] 						 = '';

		$opts['capabilities']['assign_terms'] = 'edit_posts';
		$opts['capabilities']['delete_terms'] = 'manage_categories';
		$opts['capabilities']['edit_terms'] 	= 'manage_categories';
		$opts['capabilities']['manage_terms'] = 'manage_categories';

		$opts['labels']['add_new_item'] 							= __( 'Add New Type', 'frikin-allies' );
		$opts['labels']['add_or_remove_items'] 				= __( 'Add or remove Types', 'frikin-allies' );
		$opts['labels']['all_items'] 									= __( 'Types', 'frikin-allies' );
		$opts['labels']['choose_from_most_used'] 			= __( 'Choose from most used Types', 'frikin-allies' );
		$opts['labels']['edit_item'] 									= __( 'Edit Type' , 'frikin-allies');
		$opts['labels']['menu_name'] 									= __( 'Types', 'frikin-allies' );
		$opts['labels']['name'] 											= __( 'Types', 'frikin-allies' );
		$opts['labels']['new_item_name'] 							= __( 'New Type Name', 'frikin-allies' );
		$opts['labels']['not_found'] 									= __( 'No Types Found', 'frikin-allies' );
		$opts['labels']['parent_item'] 								= __( 'Parent Type', 'frikin-allies' );
		$opts['labels']['parent_item_colon'] 					= __( 'Parent Type:', 'frikin-allies' );
		$opts['labels']['popular_items'] 							= __( 'Popular Types', 'frikin-allies' );
		$opts['labels']['search_items'] 							= __( 'Search Types', 'frikin-allies' );
		$opts['labels']['separate_items_with_commas'] = __( 'Separate Types with commas', 'frikin-allies' );
		$opts['labels']['singular_name'] 							= __( 'Type', 'frikin-allies' );
		$opts['labels']['update_item'] 								= __( 'Update Type', 'frikin-allies' );
		$opts['labels']['view_item'] 									= __( 'View Type', 'frikin-allies' );

		$opts['rewrite']['ep_mask']			 = EP_NONE;
		$opts['rewrite']['hierarchical'] = FALSE;
		$opts['rewrite']['slug']				 = strtolower( $tax_name );
		$opts['rewrite']['with_front']	 = FALSE;

		$opts = apply_filters( 'frikin-allies-ally-type-options', $opts );
		register_taxonomy( $tax_name, 'ally', $opts );
	} // new_taxonomy_ally_type()


	/**
	 * Creates the new taxonomy "ally-type" for the custom post type "ally".
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	public static function new_taxonomy_relation_type() {
		$plural 										= 'Relations';
		$single 										= 'Relations';
		$tax_name 										= 'Relation';

		$opts['hierarchical']			 				= TRUE;
		$opts['public']									= TRUE;
		$opts['query_var']				 				= $tax_name;
		$opts['show_admin_column'] 						= TRUE;
		$opts['show_in_nav_menus'] 						= TRUE;
		$opts['show_tag_cloud'] 	 					= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['show_in_rest']			 				= TRUE;
		$opts['sort'] 									= '';

		$opts['capabilities']['assign_terms'] 			= 'edit_posts';
		$opts['capabilities']['delete_terms'] 			= 'manage_categories';
		$opts['capabilities']['edit_terms'] 			= 'manage_categories';
		$opts['capabilities']['manage_terms'] 			= 'manage_categories';

		$opts['labels']['add_new_item'] 				= __( 'Add New Relation', 'frikin-allies' );
		$opts['labels']['add_or_remove_items'] 			= __( 'Add or remove Relations', 'frikin-allies' );
		$opts['labels']['all_items'] 					= __( 'Relations', 'frikin-allies' );
		$opts['labels']['choose_from_most_used'] 		= __( 'Choose from most used Relation', 'frikin-allies' );
		$opts['labels']['edit_item'] 					= __( 'Edit Relation' , 'frikin-allies');
		$opts['labels']['menu_name'] 					= __( 'Relation', 'frikin-allies' );
		$opts['labels']['name'] 						= __( 'Relations', 'frikin-allies' );
		$opts['labels']['new_item_name'] 				= __( 'New Relation Name', 'frikin-allies' );
		$opts['labels']['not_found'] 					= __( 'No Relation Found', 'frikin-allies' );
		$opts['labels']['parent_item'] 					= __( 'Parent Relation', 'frikin-allies' );
		$opts['labels']['parent_item_colon'] 			= __( 'Parent Relation:', 'frikin-allies' );
		$opts['labels']['popular_items'] 				= __( 'Popular Relations', 'frikin-allies' );
		$opts['labels']['search_items'] 				= __( 'Search Relations', 'frikin-allies' );
		$opts['labels']['separate_items_with_commas'] 	= __( 'Separate Relations with commas', 'frikin-allies' );
		$opts['labels']['singular_name'] 				= __( 'Relation', 'frikin-allies' );
		$opts['labels']['update_item'] 					= __( 'Update Relation', 'frikin-allies' );
		$opts['labels']['view_item'] 					= __( 'View Relation', 'frikin-allies' );

		$opts['rewrite']['ep_mask']			 = EP_NONE;
		$opts['rewrite']['hierarchical'] = FALSE;
		$opts['rewrite']['slug']				 = strtolower( $tax_name );
		$opts['rewrite']['with_front']	 = FALSE;

		$opts = apply_filters( 'frikin-allies-ally-type-options', $opts );
		register_taxonomy( $tax_name, 'ally', $opts );
	} // new_taxonomy_ally_type()
}
