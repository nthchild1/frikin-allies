/**
 * BLOCK: frikin-block-event-additional-info
 * Registering a basic block with Gutenberg.
 */

//  Import CSS.
import "./style.scss";
import "./editor.scss";
import IconCalendar from "../../icons/IconCalendar";
import IconRetail from "../../icons/IconReatilSpace";
import IconLink from "../../icons/IconLink";

const {__} = wp.i18n; // Import __() from wp.i18n
const {registerBlockType} = wp.blocks; // Import registerBlockType() from wp.blocks
import Suggestions from "../../Search/Suggestions";
import IconEvents from "../../icons/IconEvents"; // or wp.editor

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
registerBlockType("frik-in/ally-additional-info", {
    // Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
    title: __("Ally - Alliance additional info"), // Block title.
    icon: "calendar-alt", // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
    category: "common", // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
    /*
          supports: {
          align: ['full'],
      },*/
    attributes: {
        "pending-date": {
            type: "url",
            source: "meta",
            meta: "pending-date"
        },
        "alliance-state": {
            type: "url",
            source: "meta",
            meta: "alliance-state"
        },
        "alliance-size": {
            type: "url",
            source: "meta",
            meta: "alliance-size"
        },
        "pending-part": {
            type: "text",
            source: "meta",
            meta: "pending-part"
        },
        "importance-frikin": {
            type: "url",
            source: "meta",
            meta: "importance-frikin"
        },
        "importance-ally": {
            type: "url",
            source: "meta",
            meta: "importance-ally"
        }
    },
    keywords: [
        __("Events"),
        __("Eventos"),
        __("Frik-in"),
        __("Información adicional")
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
                pendingDate: this.attributes["pending-date"]
                    ? this.attributes["pending-date"]
                    : null,

                allianceState: this.attributes["alliance-state"]
                    ? this.attributes["alliance-state"]
                    : "",
                allianceSize: this.attributes["alliance-size"]
                    ? this.attributes["alliance-size"]
                    : "",

                //Input Values
                pendingPart: this.attributes["pending-part"]
                    ? this.attributes["pending-part"]
                    : "none",

                importanceFrikin: this.attributes["importance-frikin"]
                    ? this.attributes["importance-frikin"]
                    : "0",
                importanceAlly: this.attributes["importance-ally"]
                    ? this.attributes["importance-ally"]
                    : "0"

                //Tools
            };
            wp.data.dispatch("core/editor").lockPostSaving("aria-disabled");
        }

        componentDidUpdate(prevProps, prevState) {
            if (prevState.pendingPart !== this.state.pendingPart) {
                if (this.state.pendingPart === "none") {
                    this.setState({pendingDate: null});
                    this.setAttributes({"pending-date": ""});
                }
            }

            // wp.data.dispatch('core/notices').createErrorNotice('Both alliance size and alliance state are needed')
        }

        render() {
            let dateModule, placeModule;
            const allianceState = this.state.allianceState;
            const pendingPart = this.state.pendingPart;
            let pendingsModule = [
                [
                    <label htmlFor="pending-part">{__("Parte con Pendiente", "frikin-allies")}</label>,
                    <select value={this.state.pendingPart}
                            id="pending-part" name="pending-part"
                            onChange={event => {
                                this.setState({pendingPart: event.target.value});
                                this.setAttributes({"pending-part": event.target.value});
                            }}
                    >
                        <option value="none">{__("Ninguno", "frikin-allies")}</option>
                        <option value="frikin">{__("Frik-in", "frikin-allies")}</option>
                        <option value="ally">{__("Aliado", "frikin-allies")}</option>
                    </select>
                ],

                pendingPart !== "none"
                    ? [
                        <label htmlFor="pending-date">{__("Fecha de Pendiente", "frikin-allies")}</label>,
                        <input value={this.state.pendingDate}
                               type="date" id="pending-date" name="pending-date"
                               onChange={event => {
                                   this.setState({pendingDate: event.target.value});
                                   this.setAttributes({"pending-date": event.target.value});
                               }}
                        />
                    ]
                    : null
            ];

            let allianceStateModule = [
                <label htmlFor="alliance-state-select">{__("Estado de Alianza", "frikin-allies")}</label>,
                <select value={this.state.allianceState}
                        id="alliance-state-select" name="alliance-state"
                        onChange={event => {
                            this.setState({allianceState: event.target.value}, () => {
                                if (this.state.allianceSize !== "" && this.state.allianceState !== "") {
                                    wp.data.dispatch("core/editor").unlockPostSaving("aria-disabled");
                                }
                            });
                            this.setAttributes({"alliance-state": event.target.value});
                        }}
                >
                    <option value="">{__("Selecciona tu opción", "frikin-allies")}</option>
                    <option value="active">{__("Activa", "frikin-allies")}</option>
                    <option value="inactive">{__("Inactiva", "frikin-allies")}</option>
                    <option value="uncertain">{__("Incierta", "frikin-allies")}</option>
                </select>
            ];

            let allianceSizeModule = [
                <label htmlFor="alliance-size-select">{__("Tamaño", "frikin-allies")}</label>,
                <select
                    id="alliance-size-select"
                    name="alliance-size"
                    value={this.state.allianceSize}
                    onChange={event => {
                        this.setState({allianceSize: event.target.value}, () => {
                            if (this.state.allianceSize !== "" && this.state.allianceState !== "") {
                                wp.data.dispatch("core/editor").unlockPostSaving("aria-disabled");
                            }
                        });
                        this.setAttributes({"alliance-size": event.target.value});
                    }}
                >
                    <option value="" disabled selected> {__("Selecciona tu opción", "frikin-allies")}</option>
                    <option value="1">{__("Nivel 1", "frikin-allies")}</option>
                    <option value="2">{__("Nivel 2", "frikin-allies")}</option>
                    <option value="3">{__("Nivel 3", "frikin-allies")}</option>
                </select>
            ];

            let importanceModule = [
                <label htmlFor="importance-frikin">{__("Importancia Frik-in", "frikin-allies")}</label>,
                <input value={this.state.importanceFrikin}
                       type="number" id="importance-frikin" name="importance-frikin"
                       onChange={event => {
                           this.setState({importanceFrikin: event.target.value});
                           this.setAttributes({"importance-frikin": event.target.value});
                       }}
                />,
                <label htmlFor="importance-ally">{__("Importancia Aliado", "frikin-allies")}</label>,
                <input value={this.state.importanceAlly}
                       type="number" id="importance-ally" name="importance-ally"
                       onChange={event => {
                           this.setState({importanceAlly: event.target.value});
                           this.setAttributes({"importance-ally": event.target.value});
                       }}
                />
            ];
            //EDITOR RETURN
            return (
                <div className={this.props.className}>
                    <div>
                        {pendingsModule}
                        {allianceStateModule}
                    </div>
                    <div>
                        {allianceSizeModule}
                        {importanceModule}
                    </div>
                </div>
            );
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
    save: function (props) {
        return null;
    }
});
