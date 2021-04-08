<?php
/**
 * Kontext Press functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kontext
 */

require 'editor/blocks/kicker/kicker.php';

/**
 * Enqueue scripts and styles.
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style(
			'bundle-style',
			get_theme_file_uri( '/dist/bundle.css' ),
			array(),
			filemtime( get_theme_file_path( '/dist/bundle.css' ) )
		);
		wp_enqueue_style(
			'migration-style',
			get_theme_file_uri( '/dist/migration.css' ),
			array(),
			filemtime( get_theme_file_path( '/dist/migration.css' ) )
		);
	}
);

/**
 * Add primary menu.
 */
add_action(
	'init',
	function() {
		register_nav_menu( 'primary', __( 'The Primary Menu' ) );
	}
);

/**
 * Add support for featured images.
 */
add_theme_support( 'post-thumbnails' );

/**
 * Add class to menu items.
 */
add_filter(
	'nav_menu_css_class',
	function( $classes, $item, $args ) {
		$kontext_classes = array();
		$classes[]       = 'Header-item';
		if ( 0 < count( array_intersect( array( 'current-menu-item', 'current-menu-parent' ), $classes ) ) ) {
			$classes[] = 'is-selected ';
		}

		return $classes;
	},
	1,
	3
);

function the_kontext_category() {
	$categories     = get_the_category();
	$first_category = array_shift( $categories );
	if ( $first_category ) {
		echo esc_html( $first_category->name );
	}
}

function the_kontext_authors( $bylines ) {
	foreach ( $bylines as $index => $byline ) {
		echo '<span class="Byline-person">';
		if ( 1 < count( $bylines ) && 0 !== $index ) {
			echo ( count( $bylines ) - 1 === $index ) ? ' & ' : ', ';
		}
		echo '<a href="' . esc_url( home_url( "/author/{$byline->slug}" )  ) . '">' . esc_html( $byline->display_name ) . '</a>';
		echo '</span>';
	}
	echo esc_html( $output );
}

function kontext_has_thumbnail() {
	global $post;
	$blocks      = parse_blocks( $post->post_content );
	$first_block = array_shift( $blocks );
	return ! ( 'core/image' === $first_block['blockName'] );
}

add_filter( 'bylines_use_native_block_editor_meta_box', '__return_true' );
remove_filter( 'term_link', array( 'Bylines\Content_Model', 'filter_term_link' ), 10, 3 );
remove_filter( 'manage_edit-byline_columns', array( 'Bylines\Byline_Editor', 'filter_manage_edit_byline_columns' ) );

add_action(
	'after_setup_theme',
	function() {
		add_image_size( 'kontext-thumb', 1080, 512, true );
		add_image_size( 'kontext-grid', 920, 592, true );
	}
);

add_filter(
	'bylines_editor_fields',
	function( $fields ) {
		unset( $fields['user_url'] );
		$fields['user_image'] = array(
			'label' => 'Profilbild',
			'type'  => 'image',
		);
		$fields['user_role']  = array(
			'label' => 'Role',
			'type'  => 'text',
		);
		return $fields;
	}
);

function kontext_theme_color( $color = null, $post_id = null ) {
	$object = get_queried_object();
	if ( null !== $post_id ) {
		$object = get_post( $post_id );
	}

	$r = 0;
	$g = 0;
	$b = 0;
	if ( $color ) {
		if ( is_a( $object, 'WP_Term' ) ) {
			$primary_color   = get_term_meta( $object->term_id, "{$color}_color", true );
			list($r, $g, $b) = sscanf( $primary_color, '#%02x%02x%02x' );
		}
		if ( is_a( $object, 'WP_Post' ) ) {
			$categories     = get_the_category();
			$first_category = array_shift( $categories );
			if ( $first_category ) {
				$primary_color   = get_term_meta( $first_category->term_id, "{$color}_color", true );
				list($r, $g, $b) = sscanf( $primary_color, '#%02x%02x%02x' );
			}
		}
	}
	echo esc_html( "$r, $g, $b" );
}

/**
 * Registers the kicker meta field
 */
add_action(
	'init',
	function(): void {
		register_meta(
			'post',
			'kontext_kicker',
			array(
				'show_in_rest'      => true,
				'type'              => 'string',
				'single'            => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => fn(): bool => current_user_can( 'edit_posts' ),
			)
		);
	}
);

function the_kontext_kicker( $post_id = null ) {
	if ( null === $post_id ) {
		$post_id = get_the_id();
	}
	$kicker = get_post_meta( $post_id, 'kontext_kicker', true );
	if ( $kicker ) {
		echo "<span class=\"Card-type\">{$kicker}:</span>";
	}
}

add_action(
	'init',
	function() {
		add_post_type_support( 'page', 'excerpt' );
	}
);

add_action(
	'wp_footer',
	function() {
		get_template_part( 'template-parts/content-grid-template' );
	}
);

/**
 * Add Support for PodBean Embed URLs.
 * Modified from https://core.trac.wordpress.org/ticket/31068#comment:12 to use newer oEmbed endpoint.
 */
add_filter(
	'oembed_providers',
	function ( $providers ) {
		$providers['https://oembed.libsyn.com/embed?item_id=*'] = [
			'https://oembed.libsyn.com?url=',
			false,
		];
		return $providers;
	}
);

/**
 * Add Support for PodBean Embed URLs.
 * Modified from https://core.trac.wordpress.org/ticket/31068#comment:12 to use newer oEmbed endpoint.
 */
add_filter(
	'oembed_providers',
	function ( $providers ) {
		$providers['https://kontextpress.libsyn.com/*'] = [
			'https://oembed.libsyn.com?url=',
			false,
		];
		return $providers;
	}
);

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );

/**
 * Remove title pre term.
 */
add_filter(
	'get_the_archive_title',
	function ( $title ) {
	if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {    
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_queried_object()->display_name . '</span>' ;
		} elseif ( is_tax() ) { //for custom post types.
			$title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}
		return $title;
	}
);
