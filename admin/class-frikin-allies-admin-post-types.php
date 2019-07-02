<?php


/**
 * The custom post types of the plugin.
 *
 * @link       https://frik-in.io
 * @since      1.0.0
 * @package     Frikin_Allies
 * @subpackage    Frikin_Allies/admin
 * @author        Carlos Cortés <tky2048@frik-in.com>
 */
class Frikin_Allies_Admin_Post_Types
{
	/**
	 * The post meta data
	 *
	 * @since        1.0.0
	 * @access        private
	 * @var            string $meta The post meta data.
	 */
	private $meta;

	/**
	 * The ID of this plugin.
	 *
	 * @since        1.0.0
	 * @access        private
	 * @var            string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since        1.0.0
	 * @access        private
	 * @var            string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $New_Frikin_Api The name of this plugin.
	 * @param string $version The version of this plugin.
	 * @since        1.0.0
	 */
	public function __construct($plugin_name, $version)
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Creates a new custom post type called "ally".
	 *
	 * @since 1.0.0
	 * @access public
	 * @uses register_post_type()
	 */
	public static function new_cpt_ally()
	{
		$cap_type 						= array('ally', 'allies');
		$plural 						= __('Allies', 'frikin-allies');
		$single 						= __('Allies', 'frikin-allies');
		$cpt_name 						= 'ally';

		$opts['can_export'] = TRUE;
		$opts['capability_type'] = $cap_type;
		$opts['description'] = '';
		$opts['exclude_from_search'] = FALSE;
		$opts['has_archive'] = TRUE;
		$opts['hierarchical'] = FALSE;
		$opts['map_meta_cap'] = TRUE;
		$opts['menu_icon'] = 'dashicons-calendar-alt';
		$opts['menu_position'] = 22;
		$opts['public'] = TRUE;
		$opts['publicly_querable'] = TRUE;
		$opts['query_var'] = TRUE;
		$opts['register_meta_box_cb'] = '';
		$opts['rewrite'] = FALSE;
		$opts['show_in_admin_bar'] = TRUE;
		$opts['show_in_menu'] = TRUE;
		$opts['show_in_nav_menu'] = TRUE;
		$opts['show_in_rest'] = TRUE;
		$opts['supports'] = array('title', 'editor', 'author', 'thumbnail', 'revisions', 'excerpt', 'custom-fields');
		$opts['taxonomies'] = array('category', 'post_tag', 'ally-type');

		$opts['labels']['name'] = _x('Allies', 'Post type general name', 'frikin-allies');
		$opts['labels']['singular_name'] = _x('Allies', 'Post type singular name', 'frikin-allies');
		$opts['labels']['menu_name'] = _x('Allies', 'Admin Menu text', 'frikin-allies');
		$opts['labels']['name_admin_bar'] = _x('Allies', 'Add New on Toolbar', 'frikin-allies');
		$opts['labels']['add_new'] = __('Add New', 'frikin-allies');
		$opts['labels']['add_new_item'] = __('Add New Allies', 'frikin-allies');
		$opts['labels']['new_item'] = __('New Allies', 'frikin-allies');
		$opts['labels']['edit_item'] = __('Edit Allies', 'frikin-allies');
		$opts['labels']['view_item'] = __('View Allies', 'frikin-allies');
		$opts['labels']['all_items'] = __('All Allies', 'frikin-allies');
		$opts['labels']['search_items'] = __('Search Allies', 'frikin-allies');
		$opts['labels']['parent_item_colon'] = __('Parent Allies:', 'frikin-allies');
		$opts['labels']['not_found'] = __('No allies found.', 'frikin-allies');
		$opts['labels']['not_found_in_trash'] = __('No allies found in Trash.', 'frikin-allies');
		$opts['labels']['featured_image'] = _x('Allies Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'frikin-allies');
		$opts['labels']['set_featured_image'] = _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'frikin-allies');
		$opts['labels']['remove_featured_image'] = _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'frikin-allies');
		$opts['labels']['use_featured_image'] = _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'frikin-allies');
		$opts['labels']['archives'] = _x('Allies archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'frikin-allies');
		$opts['labels']['insert_into_item'] = _x('Insert into ally', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'frikin-allies');
		$opts['labels']['uploaded_to_this_item'] = _x('Uploaded to this ally', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'frikin-allies');
		$opts['labels']['filter_items_list'] = _x('Filter allies list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'frikin-allies');
		$opts['labels']['items_list_navigation'] = _x('Allies list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'frikin-allies');
		$opts['labels']['items_list'] = _x('Allies list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'frikin-allies');

		$opts['rewrite']['slug'] = strtolower($plural);

		$opts = apply_filters('frikin-allies-ally-options', $opts);

		register_post_type(strtolower($cpt_name), $opts);
	}

	/**
	 * Add "ally" capabilities to user roles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @uses add_cap()
	 */
	public static function add_custom_capabilities()
	{
		$admins = get_role('administrator');
		$editors = get_role('editor');

		// Allies
		$admins->add_cap('edit_allies');
		$admins->add_cap('edit_others_allies');
		$admins->add_cap('publish_allies');
		$admins->add_cap('read_private_allies');
		$admins->add_cap('delete_allies');
		$admins->add_cap('delete_private_allies');
		$admins->add_cap('delete_published_allies');
		$admins->add_cap('delete_others_allies');
		$admins->add_cap('edit_private_allies');
		$admins->add_cap('edit_published_allies');
		$editors->add_cap('edit_allies');
		$editors->add_cap('edit_others_allies');
		$editors->add_cap('publish_allies');
		$editors->add_cap('read_private_allies');
		$editors->add_cap('delete_allies');
		$editors->add_cap('delete_private_allies');
		$editors->add_cap('delete_published_allies');
		$editors->add_cap('delete_others_allies');
		$editors->add_cap('edit_private_allies');
		$editors->add_cap('edit_published_allies');
	}
}
