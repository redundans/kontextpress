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
				<h1 class="Intro-title"><?php echo bloginfo( 'name' ); ?>
			</h1>
			<div class="Intro-body">
				<div>
					<p><?php echo bloginfo( 'description' ); ?></p>
				</div>
			</div>
		</header>
		<div>
			<?php
				$args        = array(
					'posts_per_page'      => 5,
					'ignore_sticky_posts' => 1,
				);
				$cards_query = new WP_Query( $args );
				if ( $cards_query->have_posts() ) {
					// Load posts loop.
					while ( $cards_query->have_posts() ) {
						$cards_query->the_post();
						get_template_part( 'template-parts/content', 'card' );
					}
				}
				?>
		</div>
		<?php echo do_shortcode( '[ajax_load_more id="2490196919" container_type="div" css_classes="Grid" post_type="post" posts_per_page="15" offset="5" scroll="false" transition="none" transition_container="false" button_label="Visa fler" button_loading_label="Laddar fler..." button_done_label="Inga fler poster..."]' ); ?>
	</div>
<?php
get_footer();
