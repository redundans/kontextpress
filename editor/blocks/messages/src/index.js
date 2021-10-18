/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */
import { registerBlockType } from '@wordpress/blocks';

const { Fragment, InnerBlocks } = wp.editor;

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */
registerBlockType( 'kontext/messages', {
	title: 'Konversation',
	description: 'Ett konversationsblock för sms-liknande chat.',
	category: 'common',
	icon: 'format-chat',
	supports: {
		// Removes support for an HTML mode.
		html: false,
	},
	edit() {
		const ALLOWED_BLOCKS = [ 'kontext/message' ];
		return (
			<div className="messages">
				<InnerBlocks
					allowedBlocks={ALLOWED_BLOCKS}
				/>
			</div>
		);
	},
	save( { attributes } ) {
		const { title } = attributes;
		return (
			<div className="Text Text--article">
				<InnerBlocks.Content />
			</div>
		);
	},
} );
