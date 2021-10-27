<?php
/**
 * The search template file
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

$search = get_query_var( 's' );

?>
	<div class="u-container">
		<header class="View-pushDown">
			<div class="Intro">
				<h1 class="Intro-title"><?php echo sprintf( esc_html__( 'Sökresultat för &#8220;%s&#8221; ', 'kontext' ), get_search_query() ); ?>
			</h1>
		</header>
		<div>
			<?php
				$args        = array(
					'posts_per_page'      => 4,
					's'                   => $search,
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

		<div id="loadmore-output" class="Grid">
			<?php
				$args        = array(
					'posts_per_page' => 15,
					's'              => $search,
					'offset'         => 5,
				);
				$cards_query = new WP_Query( $args );
				if ( $cards_query->have_posts() ) {
					// Load posts loop.
					while ( $cards_query->have_posts() ) {
						$cards_query->the_post();
						get_template_part( 'template-parts/content', 'grid' );
					}
				}
				?>
			
		</div>
		<?php if ( $cards_query->found_posts > 19 ) : ?>
			<div class="u-textCenter"><a href="#" id="loadmore" data-offset="20" data-search="<?php echo $search; ?>" class="View-pagination">Visa fler</a></div>
		<?php endif; ?>

	</div>
<?php
get_footer();
