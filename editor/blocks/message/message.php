<?php

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
add_action(
	'enqueue_block_editor_assets',
	function(): void {
		$dir = dirname( __FILE__ );

		$script_asset_path = "$dir/build/index.asset.php";
		if ( ! file_exists( $script_asset_path ) ) {
			throw new Error(
				'You need to run `npm start` or `npm run build` for the "kontext/message" block first.'
			);
		}
		$index_js     = 'build/index.js';
		$script_asset = require $script_asset_path;
		wp_enqueue_script(
			'create-block-message-block-editor',
			get_template_directory_uri() . '/editor/blocks/message/' . $index_js,
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);
		wp_enqueue_style(
			'create-block-message-block-editor',
			get_template_directory_uri() . '/editor/blocks/message/editor.css',
			[],
			$script_asset['version']
		);
	}
);

/**
 * Register block type section.
 */
add_action(
	'init',
	function(): void {
		register_block_type(
			'kontext/message',
			[
				'attributes' => [
					'style' => [
						'type'    => 'string',
						'default' => 'rtl',
					],
				]
			]
		);
	}
);
