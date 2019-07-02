const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
import { InnerBlocks } from '@wordpress/editor'; // or wp.editor
const ALLOWED_BLOCKS = ['core/paragraph','core/image','core/heading','core/gallery','core/list','core/quote','core/audio','core/cover',
	'core/file','core/video','core/preformatted','core/code','core/freeform','core/html','core/pullquote','core/table','core/verse','core/button',
	'core/columns','core/media-text','core/more','core/nextpage','core/separator','core/spacer','core/shortcode','core/archives','core/categories',
	'core/latest-comments','core/latest-posts','core/embed','core-embed/twitter','core-embed/youtube','core-embed/facebook','core-embed/instagram',
	'core-embed/wordpress','core-embed/soundcloud', 'core-embed/spotify', 'core-embed/flickr', 'core-embed/vimeo', 'core-embed/animoto',
	'core-embed/cloudup','core-embed/collegehumor','core-embed/dailymotion','core-embed/funnyordie','core-embed/hulu','core-embed/imgur',
	'core-embed/issuu','core-embed/kickstarter','core-embed/meetup-com','core-embed/mixcloud','core-embed/photobucket','core-embed/polldaddy',
	'core-embed/reddit','core-embed/reverbnation','core-embed/screencast','core-embed/scribd','core-embed/slideshare','core-embed/smugmug',
	'core-embed/speaker','core-embed/ted','core-embed/tumblr','core-embed/videopress','core-embed/wordpress-tv',];

/**
 * Register: a Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'frik-in/innerblock', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Inner - Block' ), // Block title.
	icon: 'dashicons-products', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.

	attributes: {
		align: {
			default: 'full',
			type: 'string',
		},
	},
	keywords: [
		__( 'innerblock' ),
	],

	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	edit: (props) =>{
		return(
			<InnerBlocks
				templateLock={false}
				allowedBlocks={ALLOWED_BLOCKS}
			/>
		);
	},

	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	save: function( props ) {
		return <InnerBlocks.Content/>;
	},
} );
