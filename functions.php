<?php
/**
 * Kontext Press functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kontext
 */

require 'editor/blocks/kicker/kicker.php';
require 'editor/blocks/messages/messages.php';
require 'editor/blocks/message/message.php';

/**
 * Enqueue scripts and styles.
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_script(
			'bundle-script',
			get_theme_file_uri( '/dist/kontext.js' ),
			array( 'wp-util' ),
			filemtime( get_theme_file_path( '/dist/kontext.js' ) ),
			true
		);
		wp_enqueue_style(
			'bundle-style',
			get_theme_file_uri( '/dist/bundle.css' ),
			array(),
			filemtime( get_theme_file_path( '/dist/bundle.css' ) )
		);
		wp_enqueue_style(
			'tailwind-style',
			get_theme_file_uri( '/tailwind.css' ),
			array(),
			filemtime( get_theme_file_path( '/tailwind.css' ) )
		);
		wp_enqueue_style(
			'font-awsome-style',
			get_theme_file_uri( '/dist/fontawesome-free/css/all.css' ),
			array(),
			filemtime( get_theme_file_path( '/dist/fontawesome-free/css/all.css' ) )
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
		register_nav_menu( 'secondary', __( 'The Secondary Menu' ) );
	}
);

/**
 * Add support for featured images.
 */
add_theme_support( 'post-thumbnails' );

/**
 * Outputs the first category of the object.
 */
function the_kontext_category() {
	$categories     = get_the_category();
	$first_category = array_shift( $categories );
	if ( $first_category ) {
		echo esc_html( $first_category->name );
	}
}

/**
 * Outputs the authors.
 *
 * @param array $bylines The Bylines of a post.
 */
function the_kontext_authors( $bylines ) {
	foreach ( $bylines as $index => $byline ) {
		echo '<span class="Byline-person">';
		if ( 1 < count( $bylines ) && 0 !== $index ) {
			echo ( count( $bylines ) - 1 === $index ) ? ' & ' : ', ';
		}
		echo '<a href="' . esc_url( home_url( "/author/{$byline->slug}" ) ) . '">' . esc_html( $byline->display_name ) . '</a>';
		echo '</span>';
	}
}

/**
 * Outputs the thumbnail.
 */
function kontext_has_thumbnail() {
	global $post;
	$blocks      = parse_blocks( $post->post_content );
	$first_block = array_shift( $blocks );
	return ! ( 'core/image' === $first_block['blockName'] );
}

add_filter( 'bylines_use_native_block_editor_meta_box', '__return_true' );
remove_filter( 'term_link', array( 'Bylines\Content_Model', 'filter_term_link' ), 10, 3 );
remove_filter( 'manage_edit-byline_columns', array( 'Bylines\Byline_Editor', 'filter_manage_edit_byline_columns' ) );

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

/**
 * Outputs the kontext theme colors.
 *
 * @param any $color   The colors hex value.
 * @param any $post_id The post id.
 */
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
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
);

/**
 * Outputs the kicker.
 *
 * @param any $post_id The post id.
 */
function the_kontext_kicker( $post_id = null ) {
	if ( null === $post_id ) {
		$post_id = get_the_id();
	}
	$kicker = get_post_meta( $post_id, 'kontext_kicker', true );
	if ( $kicker ) {
		echo wp_kses_post( "<span class=\"Card-type\">{$kicker}:</span>" );
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
 * Add Support for libsyn Embed URLs.
 * Modified from https://core.trac.wordpress.org/ticket/31068#comment:12 to use newer oEmbed endpoint.
 */
add_filter(
	'oembed_providers',
	function ( $providers ) {
		$providers['https://directory.libsyn.com/episode/index/show/*'] = array(
			'https://oembed.libsyn.com?url=',
			false,
		);
		return $providers;
	}
);

/**
 * Add Support for libsyn Embed URLs.
 * Modified from https://core.trac.wordpress.org/ticket/31068#comment:12 to use newer oEmbed endpoint.
 */
add_filter(
	'oembed_providers',
	function ( $providers ) {
		$providers['https://oembed.libsyn.com/embed?item_id=*'] = array(
			'https://oembed.libsyn.com?url=',
			false,
		);
		return $providers;
	}
);

/**
 * Add Support for libsyn Embed URLs.
 * Modified from https://core.trac.wordpress.org/ticket/31068#comment:12 to use newer oEmbed endpoint.
 */
add_filter(
	'oembed_providers',
	function ( $providers ) {
		$providers['https://kontextpress.libsyn.com/*'] = array(
			'https://oembed.libsyn.com?url=',
			false,
		);
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
			$title = '<span class="vcard">' . get_queried_object()->display_name . '</span>';
		} elseif ( is_tax() ) {
			// for custom post types.
			$title = single_term_title( '', false );
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}
		return $title;
	}
);

// Adds parent div to iframes.
add_filter(
	'the_content',
	function( $content ) {
		return str_replace(
			array(
				'<iframe',
				'</iframe>',
			),
			array(
				'<div class="iframe-container"><iframe',
				'</iframe></div>',
			),
			$content
		);
	}
);

// Adds class to youtube embeds.
add_filter(
	'embed_oembed_html',
	function( $html ) {
		if ( strpos( $html, 'youtube.com' ) !== false || strpos( $html, 'youtu.be' ) !== false ) {
			return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
		} else {
			return $html;
		}
	},
	10,
	1
);

// Adds class to ifram element.
add_filter(
	'embed_oembed_html',
	function( $code ) {
		return str_replace( '<iframe', '<iframe class="embed-responsive-item" ', $code );
	}
);

// Adding the Open Graph in the Language Attributes.
add_filter(
	'language_attributes',
	function( $output ) {
		return $output . ' xmlns:og="https://opengraphprotocol.org/schema/" xmlns:fb="https://www.facebook.com/2008/fbml"';
	}
);

// Lets add Open Graph Meta Info.
add_action(
	'wp_head',
	function() {
		global $post;
		if ( ! is_singular() ) {
			return;
		}
		echo wp_kses_post( "<!-- Begin Open Graph Tags -->\n" );
		echo wp_kses_post( '<meta property="og:url" content="' . get_permalink() . '" />' . "\n" );
		echo wp_kses_post( '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '" />' . "\n" );
		echo wp_kses_post( '<meta property="og:type" content="article" />' . "\n" );
		echo wp_kses_post( '<meta property="og:title" content="' . get_the_title() . '" />' . "\n" );
		echo wp_kses_post( '<meta property="og:description" content="' . wp_strip_all_tags( get_the_excerpt(), true ) . '" />' . "\n" );

		if ( has_post_thumbnail( $post->ID ) ) {
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			$args          = array(
				'w'    => '1200',
				'h'    => '630',
				'fit'  => 'crop',
				'crop' => 'faces',
			);
			$imgix_url     = imgix_url( $thumbnail_src[0], $args );
			echo wp_kses_post( '<meta property="og:image" content="' . esc_url( $imgix_url ) . '" />' );
		}
		echo wp_kses_post( "\n<!-- End Open Graph Tags -->\n" );
	},
	5
);

/**
 * Adds own content to post REST API result.
 */
add_filter(
	'rest_prepare_post',
	function( $data, $post ) {
		if ( is_admin() ) {
			return $data;
		}
		// Adds featured image url.
		$featured_image_id  = $data->data['featured_media'];
		$featured_image_url = wp_get_attachment_image_src( $featured_image_id, 'full' );

		if ( $featured_image_url ) {
			$image_url                        = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			$args                             = array(
				'w'    => '696',
				'h'    => '596',
				'fit'  => 'crop',
				'crop' => 'faces',
			);
			$imgix_url                        = imgix_url( $featured_image_url[0], $args );
			$data->data['featured_image_url'] = $imgix_url;
		}

		// Adds kicker.
		$categories     = get_the_category( $post->ID );
		$first_category = array_shift( $categories );
		if ( $first_category ) {
			$data->data['kicker'] = $first_category->name;
		}

		// Remove tags from excerpt.
		$post_excerpt = $data->data['excerpt'];
		if ( $post_excerpt ) {
			$data->data['excerpt'] = wp_strip_all_tags( $post_excerpt['rendered'] );
		}

		// Add readable dates.
		$data->data['date_i18n'] = date_i18n( get_option( 'date_format' ), $data->data['date_gmt'] );

		// Add bylines.
		$bylines = get_bylines( $post->ID );
		foreach ( $bylines as $byline ) {
			$image_url               = wp_get_attachment_image_url( $byline->user_image, 'full' );
			$args                    = array(
				'w'    => '100',
				'h'    => '100',
				'fit'  => 'crop',
				'crop' => 'faces',
			);
			$imgix_url               = imgix_url( $image_url, $args );
			$byline_array            = array(
				'display_name' => $byline->display_name,
				'byline_url'   => ( $image_url ) ? $imgix_url : false,
			);
			$data->data['bylines'][] = $byline_array;
		}

		// Remove content.
		unset( $data->data['content'] );

		return $data;
	},
	10,
	2
);
