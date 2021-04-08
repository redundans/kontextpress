<?php
/**
 * Gutenberg plugin that adds a PluginDocumentSettingPanel for kicker meta data.
 *
 * @package Kontext
 */

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
add_action(
	'enqueue_block_editor_assets',
	function(): void {
		$screen = get_current_screen();
		$dir    = dirname( __FILE__ );

		$script_asset_path = "$dir/build/index.asset.php";
		if ( ! file_exists( $script_asset_path ) ) {
			throw new Error(
				'You need to run `npm start` or `npm run build` for the "create-block/kicker" block first.'
			);
		}
		$index_js     = 'build/index.js';
		$script_asset = require $script_asset_path;
		wp_enqueue_script(
			'kontext-kicker',
			get_template_directory_uri() . '/editor/blocks/kicker/' . $index_js,
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);
	}
);
