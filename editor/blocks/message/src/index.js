/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */
import { registerBlockType } from '@wordpress/blocks';

const { SelectControl, PanelBody } = wp.components;
const { InnerBlocks, InspectorControls } = wp.editor;
const { Fragment } = wp.element

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */
registerBlockType( 'kontext/message', {
	title: 'Meddelande',
	description: 'Ett enskilt meddelande.',
	category: 'common',
	icon: 'admin-comments',
	attributes: {
		'style': {
			type: 'string',
			default: 'rtl',
		},
	},
	parent: ['kontext/messages'],
	supports: {
		// Removes support for an HTML mode.
		html: false,
	},
	edit( { attributes, setAttributes } ) {
		const { style } = attributes;
		const ALLOWED_BLOCKS = [
			'core/paragraph',
			'core/image'
		];
		const classes = `message message--${style}`;
		return (
            <Fragment>
				<InspectorControls>
					<PanelBody title='Section Intro Settings'>
						<SelectControl
							label={ 'Style' }
							value={ style || 'rtl' }
							onChange={ value => setAttributes( { style: ( 'default' !== value ) ? value : undefined } ) }
							options={ [
								{ value: 'rtl', label: 'Högerställ' },
								{ value: 'ltr', label: 'Vänsterställ' },
							] }
						/>
					</PanelBody>
				</InspectorControls>
				<div className={classes}>
					<InnerBlocks
						allowedBlocks={ALLOWED_BLOCKS}
					/>
				</div>
			</Fragment>
		);
	},
	save( { attributes } ) {
		const { style } = attributes;
		const classes = `Conversation Conversation--${style}`;
		return (
			<div className={classes}>
				<div className="Conversation-message">
					<div className="Conversation-bubble">
						<InnerBlocks.Content />
					</div>
				</div>
			</div>
		);
	},
} );
