<?php
/**
 * Template part for displaying single byline
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kontext
 */

get_header();

$byline       = get_queried_object();
$byline_image = get_term_meta( $byline->term_id, 'user_image', true );
$byline_email = get_term_meta( $byline->term_id, 'user_email', true );
?>

<article class="u-container">
	<header class="View-pushDown">
		<div class="Intro Intro--center Intro--narrow">
			<h1 class="Intro-title"><?php the_archive_title(); ?></h1>
			<div class="Intro-body">
				<div>
					<a href="mailto:<?php echo esc_html( $byline_email ); ?>"><?php echo esc_html( $byline_email ); ?></a>
				</div>
			</div>
			<figure class="Intro-figure">
				<?php echo wp_get_attachment_image( $byline_image, 'full' ); ?>
			</figure>
		</div>
	</header>
	<div class="Text Text--article">
		<p><?php the_archive_description(); ?></p>
	</div>
</article>

<?php
get_footer();
