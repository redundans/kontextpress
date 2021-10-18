<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kontext
 */

get_header();
?>

<div class="u-container">
	<?php
	if ( have_posts() ) {
		// Load posts loop.
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', 'post' );
		}
	}
	get_template_part( 'template-parts/content', 'readmore' );
	?>
</div>

<?php
get_footer();
