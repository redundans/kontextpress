<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kontext
 */

get_header();
?>

<div class="u-container">
	<header class="View-pushDown">
		<div class="Intro">
			<h1 class="Intro-title">Sökresultat för "<?php echo get_search_query(); ?>"</h1>
		</div>
	</header>

	<div>

	<?php
	if ( have_posts() ) {
		// Load posts loop.
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', 'card' );
		}
	}
	?>

</div>

<?php
get_footer();
