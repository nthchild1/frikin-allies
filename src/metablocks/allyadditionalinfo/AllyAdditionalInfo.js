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
import Suggestions from '../../Search/Suggestions';
import IconEvents from '../../icons/IconEvents'; // or wp.editor

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
registerBlockType( 'frik-in/ally-additional-info', {
    // Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
    title: __( 'Ally - Alliance additional info' ), // Block title.
    icon: 'calendar-alt', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
    category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
    /*
        supports: {
        align: ['full'],
    },*/
    attributes: {
        'event-additional-info-website': {
            type: 'url',
            source: 'meta',
            meta: 'event-additional-info-website'
        },
    },
    keywords: [
        __( 'Events' ),
        __( 'Eventos' ),
        __( 'Frik-in' ),
        __( 'Información adicional' ),
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
                pendienteFrikinDate: this.attributes['pendiente-frikin-date'] ? this.attributes['pendiente-frikin-date'] : null,
                pendienteAllyDate: this.attributes['pendiente-ally-date'] ? this.attributes['pendiente-ally-date'] : null,

                allianceState: this.attributes['alliance-state'] ? this.attributes['alliance-state'] : null,
                allianceSize: this.attributes['alliance-size'] ? this.attributes['alliance-size'] : null,

                //Input Values
                pendienteFrikin: this.attributes['pendiente-frikin'] ? this.attributes['pendiente-frikin'] : false,
                pendienteAlly: this.attributes['pendiente-ally'] ? this.attributes['pendiente-ally'] : false,

                importanceFrikin: this.attributes['importance-frikin'] ? this.attributes['importance-frikin'] : false,
                importanceAlly: this.attributes['importance-ally'] ? this.attributes['importance-ally'] : false,

                //Tools
            };
            wp.data.dispatch('core/editor').lockPostSaving('aria-disabled');
        }

        componentDidUpdate(){
            if ( (this.state.allianceSize !== null) && (this.state.allianceState !== null) )
            {
                wp.data.dispatch('core/editor').unlockPostSaving('aria-disabled');
            }
            else{
               // wp.data.dispatch('core/notices').createErrorNotice('Both alliance size and alliance state are needed')
            }
        }

        render() {
            let dateModule, placeModule;

            const placeSelected = this.state.placeSelected;
            const allianceState = this.state.allianceState;
            const pendienteFrikin = this.state.pendienteFrikin;
            const searchBuffer = this.state.searchBuffer;
            const dateType =  this.state.dateType;
            const pendienteAlly = this.state.pendienteAlly;

            const pendienteFrikinCheckbox = this.state.pendienteFrikin ? [<label htmlFor="pendiente-frikin-checkbox">Pendiente Frik-in</label>,
                <input defaultChecked type="checkbox"  value={this.state.pendienteFrikin}
                       id="pendiente-frikin-checkbox" name="pendiente-frikin-checkbox"
                       onClick={() => this.setState({pendienteFrikin: !this.state.pendienteFrikin})}/>] : [<label htmlFor="pendiente-frikin-checkbox">Pendiente Frik-in</label>,
                <input type="checkbox"  value={this.state.pendienteFrikin}
                       id="pendiente-frikin-checkbox" name="pendiente-frikin-checkbox"
                       onClick={() => this.setState({pendienteFrikin: !this.state.pendienteFrikin})}/>];

            const pendienteAllyCheckbox = this.state.pendienteAlly ? [<label htmlFor="pendiente-ally-checkbox">Pendiente Ally</label>,
                <input defaultChecked type="checkbox"  value={this.state.pendienteAlly}
                       id="pendiente-ally-checkbox" name="pendiente-ally-checkbox"
                       onClick={() => this.setState({pendienteAlly: !this.state.pendienteAlly})}/>] : [<label htmlFor="pendiente-ally-checkbox">Pendiente Frik-in</label>,
                <input type="checkbox"  value={this.state.pendienteAlly}
                       id="pendiente-ally-checkbox" name="pendiente-ally-checkbox"
                       onClick={() => this.setState({pendienteAlly: !this.state.pendienteAlly})}/>,];

            let pendientesModule = [
                pendienteFrikinCheckbox,
                pendienteFrikin ? [
                    <label htmlFor="pendiente-frikin-date">Pendiente Date</label>,
                    <input value={this.state.pendienteFrikinDate} type="date"
                           id="pendiente-frikin-date" name="pendiente-frikin-date"
                           onChange={ event => {
                               this.setState( { pendienteFrikinDate: event.target.value } );
                               this.setAttributes( { 'pendiente-frikin-date': event.target.value } );
                           }}
                    />] : null,

                pendienteAllyCheckbox,

                pendienteAlly ? [
                    <label htmlFor="pendiente-ally-date">Pendiente Date</label>,
                    <input value={this.state.pendienteAllyDate} type="date"
                           id="pendiente-frikin-date" name="pendiente-frikin-date"
                           onChange={ event => {
                               this.setState( { pendienteAllyDate: event.target.value } );
                               this.setAttributes( { 'pendiente-ally-date': event.target.value } );
                           }}
                    />] : null,
            ];


            let allianceStateModule = [
                <label htmlFor="alliance-state-select">State</label>,
                <select id="alliance-state-select" name="alliance-state"
                        onChange={event => this.setState({allianceState: event.target.value})}>
                    <option value="" disabled selected>Select your option</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="uncertain">Uncertain</option>
                </select>];

            let allianceSizeModule = [
                <label htmlFor="alliance-size-select">Size</label>,
                <select id="alliance-size-select" name="alliance-size"
                        onChange={event => this.setState({allianceSize: event.target.value})}>
                    <option value="" disabled selected>Select your option</option>
                    <option value="1">Tier 1</option>
                    <option value="2">Tier 2</option>
                    <option value="3">Tier 3</option>
                </select>];

            let importanceModule = [

                <label htmlFor="importance-frikin">Importance Frik-in</label>,
                <input value={this.state.importanceFrikin} type="number"
                       id="importance-frikin" name="importance-frikin"
                       onChange={ event => {
                           this.setState( { importanceFrikin: event.target.value } );
                           this.setAttributes( { 'importance-frikin': event.target.value } );
                       }}
                />,
                <label htmlFor="importance-ally">Importance Ally</label>,
                <input value={this.state.importanceAlly} type="number"
                       id="importance-ally" name="importance-ally"
                       onChange={ event => {
                           this.setState( { importanceAlly: event.target.value } );
                           this.setAttributes( { 'importance-ally': event.target.value } );
                       }}
                />
            ];

            //EDITOR RETURN
            return <div className ={this.props.className}>
                    {allianceStateModule}
                    {pendientesModule}
                    {allianceSizeModule}
                    {importanceModule}
            </div>
        }},

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