<?php
/**
 * The custom post types of the plugin.
 *
 * @link       https://frik-in.io
 * @since      1.0.0
 * @package     Frikin_Allies
 * @subpackage 	Frikin_Allies/admin
 * @author     	Carlos Cortés <tky2048@frik-in.com>
 */
class Frikin_Allies_Admin_Metablocks {
	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
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
	 * @param 		string 			$plugin_name		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->set_meta();
	}

	private function sanitizer( $type, $data ) {
		if ( empty( $type ) ) { return; }
		if ( empty( $data ) ) { return; }
		$return 	= '';
		$sanitizer 	= new Frikin_Allies_Sanitize();
		$sanitizer->set_data( $data );
		$sanitizer->set_type( $type );
		$return = $sanitizer->clean();
		unset( $sanitizer );
		return $return;
	} // sanitizer()

	/*
	 * Register fields for use in the REST API.
	 */
	public function register_meta_for_rest() {
		$args = array(
			'type'			=> 'string',
			'single'		=> true,
			'show_in_rest'	=> true,
		);

		$metas = $this->get_metablocks_fields();
		foreach ( $metas as $meta ) {
			$name = $meta[0];
			register_meta( 'post', $name, $args );
		}
	}

	/**
	 * Returns an array of the all the metabox fields and their respective types
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		array 		Metabox fields and types
	 */
	private function get_metablocks_fields() {
		$fields = array();
		//ally-contact-information
		$fields[] = array( 'website', 'url' );
		$fields[] = array( 'representative-name', 'text' );
		$fields[] = array( 'representative-phone', 'phone' );
		$fields[] = array( 'representative-email', 'email' );
		$fields[] = array( 'representative-twitter', 'text' );
		$fields[] = array( 'representative-facebook', 'text' );
		$fields[] = array( 'other-info', 'text' );

		//ally-social-networks
		$fields[] = array( 'facebook', 'url' );
		$fields[] = array( 'twitter', 'url' );
		$fields[] = array( 'instagram', 'url' );
		$fields[] = array( 'youtube', 'url' );

		//ally-importance
		$fields[] = array( 'ally-importance-us', 'number' );
		$fields[] = array( 'ally-importance-them', 'number' );
        $fields[] = array( 'pendiente-frikin-date', 'date' );
        $fields[] = array( 'pendiente-ally-date', 'date' );
        $fields[] = array( 'alliance-state', 'text' );
        $fields[] = array( 'alliance-size', 'text' );
        $fields[] = array( 'importance-ally', 'number' );
        $fields[] = array( 'importance-frikin', 'number' );

		return $fields;
	} // get_metabox_fields()

	/**
	 * Sets the class variable $options
	 */
	public function set_meta() {
		global $post;
		if ( empty( $post ) ) { return; }
		if ( ! in_array( $post->post_type, array( 'ally' ) ) ) { return; }
		//wp_die( '<pre>' . print_r( $post->ID ) . '</pre>' );
		$this->meta = get_post_custom( $post->ID );
	} // set_meta()

	public function register_metablocks() {
		// Register block styles for both frontend + backend.
		wp_register_style(
			'frikin_blocks-cgb-style-css', // Handle.
			plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
			array( 'wp-editor' ), // Dependency to include the CSS after it.
			null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
		);

		// Register block editor script for backend.
		wp_register_script(
			'frikin_blocks-cgb-block-js', // Handle.
			plugins_url( 'dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
			null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
			true // Enqueue the script in the footer.
		);

		// Register block editor styles for backend.
		wp_register_style(
			'frikin_blocks-cgb-block-editor-css', // Handle.
			plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
			array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
			null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
		);

		/**
		 * Register Gutenberg block on server-side.
		 *
		 * Register the block on server-side to ensure that the block
		 * scripts and styles for both frontend and backend are
		 * enqueued when the editor loads.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
		 * @since 1.16.0
		 */
		register_block_type(
			'cgb/block-frikin-blocks', array(
				// Enqueue blocks.style.build.css on both frontend & backend.
				'style'         => 'frikin_blocks-cgb-style-css',
				// Enqueue blocks.build.js in the editor only.
				'editor_script' => 'frikin_blocks-cgb-block-js',
				// Enqueue blocks.editor.build.css in the editor only.
				'editor_style'  => 'frikin_blocks-cgb-block-editor-css',
			)
		);
	}

	/**
	 * Check each nonce. If any don't verify, $nonce_check is increased.
	 * If all nonces verify, returns 0.
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		int 		The value of $nonce_check
	 */
	private function check_nonces( $posted, $post_type ) {
		$nonces 		= array();
		$nonce_check 	= 0;
		if ( in_array( $post_type, array( 'place', 'mall' ) ) ) {
			$nonces[] 		= 'place_additional_info_nonce';
			$nonces[] 		= 'place_social_networks_nonce';
		} elseif ( in_array( $post_type, array( 'ally' ) ) ) {
			$nonces[] 		= 'ally_additional_info_nonce';
		} elseif ( in_array( $post_type, array( 'activity' ) ) ) {
			$nonces[] 		= 'activity_additional_info_nonce';
		}

		foreach ( $nonces as $nonce ) {
			if ( ! isset( $posted[$nonce] ) ) { $nonce_check++; }
			if ( isset( $posted[$nonce] ) && ! wp_verify_nonce( $posted[$nonce], $this->plugin_name ) ) { $nonce_check++; }
		}
		return $nonce_check;
	} // check_nonces()

	/**
	 * Saves metabox data
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @param 	int 		$post_id 		The post ID
	 * @param 	object 		$object 		The post object
	 * @return 	void
	 */
	public function validate_meta( $post_id, $object ) {
		//wp_die( '<pre>' . print_r( $_POST ) . '</pre>' );
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		if (  ! in_array( $object->post_type, array('ally') )  ) { return $post_id; }
		$nonce_check = $this->check_nonces( $_POST, $object->post_type );
		if ( 0 < $nonce_check ) { return $post_id; }
		$metas = $this->get_metabox_fields();
		$latitude = 0;
		$longitude = 0;
		$ally_place_id = null;
		foreach ( $metas as $meta ) {
			$name = $meta[0];
			$type = $meta[1];

			$new_value = $this->sanitizer( $type, $_POST[$name] );

			update_post_meta( $post_id, $name, $new_value );
		} // foreach
	} // validate_meta()

	/**
	 * Registers template for Allies custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @param 	int 		$post_id 		The post ID
	 * @param 	object 		$object 		The post object
	 * @return 	void
	 */
	public function register_template(){
		$post_type_object = get_post_type_object( 'ally' );
		$post_type_object->template = array(
			array('frik-in/ally-social-networks'),
			array('frik-in/ally-contact-info'),
            array('frik-in/ally-additional-info'),
            array('frik-in/innerblock')
		);
		$post_type_object->template_lock = 'all';
	}
}
