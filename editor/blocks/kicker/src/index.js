import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { withSelect, withDispatch } from '@wordpress/data';
import { TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * The PluginDocumentSettingPanel for inserting a kicker
 * into admin sidebar.
 *
 * @param {any} props
 */
let KickerPanel = ( props ) => {
	return (
		<>
			<PluginDocumentSettingPanel
				name="kicker-panel"
				title={ __( 'Kicker' ) }
			>
				<TextControl
					label={ __( 'Write your kicker here' ) }
					value={ props.kicker }
					onChange={ ( value ) => props.onKickerChange( value ) }
				/>
			</PluginDocumentSettingPanel>
		</>
	);
};

KickerPanel = withSelect( ( select ) => {
	let kicker = '';
	const postMeta = select( 'core/editor' ).getEditedPostAttribute( 'meta' );
	if ( postMeta ) {
		kicker = postMeta.kontext_kicker;
	}
	return {
		kicker,
	};
} )( KickerPanel );

KickerPanel = withDispatch( ( dispatch ) => {
	const { editPost } = dispatch( 'core/editor' );
	return {
		onKickerChange: ( value ) => {
			editPost( { meta: { kontext_kicker: value } } );
		},
	};
} )( KickerPanel );

/**
 * Register the SlotFill into admin.
 */
registerPlugin( 'kicker-panel', {
	render: KickerPanel,
	icon: '',
} );
