/**
 * BLOCK: frikin-block-event-additional-info
 * Registering a basic block with Gutenberg.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';
import IconCalendar from '../../icons/IconCalendar';
import IconRetail from '../../icons/IconReatilSpace';
import IconLink from '../../icons/IconLink';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks

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
registerBlockType( 'frik-in/ally-social-networks', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Ally - Social Networks' ), // Block title.
	icon: 'calendar-alt', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	/*
		supports: {
		align: ['full'],
	}, */
	attributes: {
		'ally-social-networks-facebook': {
			type: 'text',
			source: 'meta',
			meta: 'ally-social-networks-facebook'
		},
		'ally-social-networks-twitter': {
			type: 'text',
			source: 'meta',
			meta: 'ally-social-networks-twitter'
		},
		'ally-social-networks-instagram': {
			type: 'text',
			source: 'meta',
			meta: 'ally-social-networks-instagram'
		},
		'ally-social-networks-youtube': {
			type: 'text',
			source: 'meta',
			meta: 'ally-social-networks-youtube'
		},

		/*
		align: {
			default: 'full',
			type: 'string',
		},*/
	},
	keywords: [
		__( 'Social' ),
		__( 'Ally' ),
		__( 'Frik-in' ),
		__( 'redes sociales' ),
		__( 'social networks' ),
	],

	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */

	edit: class extends React.Component {
		// Creates a <p class='wp-block-frik-in-social-networks'></p>.
		constructor(props) {
			super(...arguments);
			this.props = props;
			this.attributes = props.attributes;
			this.setAttributes = props.setAttributes;
			this.state = {
				//Attributes
				facebook: this.attributes['ally-social-networks-facebook'] ? this.attributes['ally-social-networks-facebook'] : null,
				twitter: this.attributes['ally-social-networks-twitter'] ? this.attributes['ally-social-networks-twitter'] : null,
				instagram: this.attributes['ally-social-networks-instagram'] ? this.attributes['ally-social-networks-instagram'] : null,
				youtube: this.attributes['ally-social-networks-youtube'] ? this.attributes['ally-social-networks-youtube'] : null,

			};
		}

		render() {
			//EDITOR RETURN
			return <div className ={this.props.className}>

				<label for="facebook">Facebook </label>
				<input value={this.state.facebook}
					   type="text" id="facebook"
					   onChange={ event => {
						   this.setState( { facebook: event.target.value } );
						   this.setAttributes( { 'ally-social-networks-facebook': event.target.value } );
					   }}
				/>

				<label htmlFor="instagram">Instagram </label>
				<input value={ this.state.instagram }
					   type="text" id="instagram"
					   onChange={ event => {
						   this.setState( { instagram: event.target.value } );
						   this.setAttributes( { 'ally-social-networks-instagram': event.target.value } );
					   } }
				/>

				<label htmlFor="twitter"> Twitter </label>
				<input value={ this.state.twitter }
					   type="text" id="twitter"
					   onChange={ event => {
						   this.setState( { twitter: event.target.value } );
						   this.setAttributes( { 'ally-social-networks-twitter': event.target.value } );
					   } }
				/>

				<label htmlFor="youtube">YouTube </label>
				<input value={ this.state.youtube }
					   type="text" id="youtube"
					   onChange={ event => {
						   this.setState( { youtube: event.target.value } );
						   this.setAttributes( { 'ally-social-networks-youtube': event.target.value } );
					   } }
				/>
			</div>
		}
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
		return null;
	},
});
