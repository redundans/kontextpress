<?php
/**
 * Template part for page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kontext
 */

?>

<header class="View-pushDown">
	<div class="Intro Intro--center ">
		<h1 class="Intro-title"><?php the_title(); ?></h1>
		<div class="Intro-body">
			<div>
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</header>

<div class="Text Text--article">
	<?php the_content(); ?>
</div>

<?php

$args = array(
	'post_type'      => 'page',
	'posts_per_page' => -1,
	'post_parent'    => get_the_ID(),
	'order'          => 'ASC',
	'orderby'        => 'menu_order',
);

$children = new WP_Query( $args );

if ( $children->have_posts() ) :
	?>
	<div class="u-wide">
		<div class="Grid Grid--blurbs">
		<?php
		while ( $children->have_posts() ) :
			$children->the_post();
			?>
				<div class="Grid-cell u-md-size1of2 ">
					<div class="Blurb u-aspect1-1">
						<div class="Blurb-content u-cover">
							<div class="Text">
								<h3 class="u-spaceT1"><?php the_title(); ?></h3>
								<?php the_excerpt(); ?>
								<svg viewBox="0 0 36 23" class="Blurb-icon">
									<g fill="none" fill-rule="evenodd" stroke="#FFF">
										<path d="M.756 11.5h33.275"></path>
										<path stroke-width="3" d="M27.429 22l6.784-10.5L27.429 1"></path>
									</g>
								</svg>
							</div>
							<a href="<?php the_permalink(); ?>" class="Blurb-link"> 
								<span class="u-hiddenVisually">Gå till sidan</span>
							</a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php
endif;
wp_reset_postdata();

