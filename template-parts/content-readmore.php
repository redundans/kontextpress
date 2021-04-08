<?php
/**
 * Template part for read more content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kontext
 */

?>

<div class="Text Text--full">
	<h2 class="Text-section">Fortsätt läsa</h2>
</div>

<div class="Grid">
	<?php
		$args   = array(
			'posts_per_page'      => 3,
			'ignore_sticky_posts' => 1,
		);
		$grid_query = new WP_Query( $args );

		if ( $grid_query->have_posts() ) {

			// Load posts loop.
			while ( $grid_query->have_posts() ) {
				$grid_query->the_post();
				echo '<div class="Grid-cell u-md-size1of2 u-lg-size1of3">';
				get_template_part( 'template-parts/content', 'grid' );
				echo '</div>';
			}

		}
	?>
</div>