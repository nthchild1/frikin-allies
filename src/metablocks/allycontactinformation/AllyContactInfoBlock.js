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
registerBlockType( 'frik-in/ally-contact-info', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Ally - Contact Info' ), // Block title.
	icon: 'calendar-alt', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	/*
		supports: {
		align: ['full'],
	}, */
	attributes: {
		'ally-contact-information-website': {
			type: 'text',
			source: 'meta',
			meta: 'ally-contact-information-website'
		},
		'ally-contact-information-representative-name': {
			type: 'text',
			source: 'meta',
			meta: 'ally-contact-information-representative-name'
		},
		'ally-contact-information-representative-phone': {
			type: 'text',
			source: 'meta',
			meta: 'ally-contact-information-representative-phone'
		},
		'ally-contact-information-email': {
			type: 'text',
			source: 'meta',
			meta: 'ally-contact-information-email'
		},
		'ally-contact-information-twitter': {
			type: 'text',
			source: 'meta',
			meta: 'ally-contact-information-twitter'
		},
		'ally-contact-information-facebook': {
			type: 'text',
			source: 'meta',
			meta: 'ally-contact-information-facebook'
		},
		'ally-contact-information-other': {
			type: 'text',
			source: 'meta',
			meta: 'ally-contact-information-other'
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
				website: this.attributes['ally-contact-information-website'] ? this.attributes['ally-contact-information-website'] : null,
				name: this.attributes['ally-contact-information-representative-name'] ? this.attributes['ally-contact-information-representative-name'] : null,
				phone: this.attributes['ally-contact-information-representative-phone'] ? this.attributes['ally-contact-information-representative-phone'] : null,
				email: this.attributes['ally-contact-information-email'] ? this.attributes['ally-contact-information-email'] : null,
				twitter: this.attributes['ally-contact-information-twitter'] ? this.attributes['ally-contact-information-twitter'] : null,
				facebook: this.attributes['ally-contact-information-facebook'] ? this.attributes['ally-contact-information-facebook'] : null,
				other: this.attributes['ally-contact-information-other'] ? this.attributes['ally-contact-information-other'] : null
			};
		}

		render() {
			//EDITOR RETURN
			return <div className ={this.props.className}>

				<label for="website">Representative Website </label>
				<input value={this.state.website}
					   type="text" id="webiste"
					   onChange={ event => {
						   this.setState( { website: event.target.value } );
						   this.setAttributes( { 'ally-contact-information-website': event.target.value } );
					   }}
				/>

				<label htmlFor="name">Representative Name </label>
				<input value={ this.state.name }
					   type="text" id="name"
					   onChange={ event => {
						   this.setState( { name: event.target.value } );
						   this.setAttributes( { 'ally-contact-information-representative-name': event.target.value } );
					   } }
				/>

				<label htmlFor="phone"> Representative Phone </label>
				<input value={ this.state.phone }
					   type="text" id="phone"
					   onChange={ event => {
						   this.setState( { phone: event.target.value } );
						   this.setAttributes( { 'ally-contact-information-representative-phone': event.target.value } );
					   } }
				/>

				<label htmlFor="email">Representative email </label>
				<input value={ this.state.email }
					   type="text" id="email"
					   onChange={ event => {
						   this.setState( { email: event.target.value } );
						   this.setAttributes( { 'ally-contact-information-email': event.target.value } );
					   } }
				/>

				<label htmlFor="facebook">Representative Facebook </label>
				<input value={ this.state.facebook }
					   type="text" id="facebook"
					   onChange={ event => {
						   this.setState( { facebook: event.target.value } );
						   this.setAttributes( { 'ally-contact-information-facebook': event.target.value } );
					   } }
				/>

				<label htmlFor="email">Representative Twitter </label>
				<input value={ this.state.twitter }
					   type="text" id="twitter"
					   onChange={ event => {
						   this.setState( { twitter: event.target.value } );
						   this.setAttributes( { 'ally-contact-information-twitter': event.target.value } );
					   } }
				/>

				<label htmlFor="other"> other </label>
				<input value={ this.state.other }
					   type="text" id="other"
					   onChange={ event => {
						   this.setState( { other: event.target.value } );
						   this.setAttributes( { 'ally-contact-information-other': event.target.value } );
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
