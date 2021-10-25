<?php
/**
 * Template part for displaying cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kontext
 */

global $cards_query;
?>

<article class="Card Card--horizontal Card--interactive <?php echo ( 0 === $cards_query->current_post % 2 ) ?: 'Card--reverse'; ?> Card--dark" style="--Card-theme-color: <?php kontext_theme_color( 'secondary', get_the_ID() ); ?>">
	<figure class="Card-figure u-hoverTriggerTarget">
		<?php
			$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			$args      = [
				'w'  => '1080',
				'h' => '512',
				'fit' => 'fit',
				'crop' => 'faces',
			];
			$imgix_url = imgix_url( $image_url, $args );
			echo "<img src='{$imgix_url}' class='Card-image'>";
		?>
	</figure>
	<div class="Card-content ">
		<div class="Card-body">
			<time datetime="<?php the_date( 'Y-m-d' ); ?>" class="Card-meta"><?php the_time( 'j F Y' ); ?></time>
			<h3 class="Card-title">
				<span>
					<?php the_kontext_kicker(); ?>
					<?php the_title(); ?>
				</span>
			</h3>
			<?php if ( has_excerpt() ) : ?>
				<p class="Card-text">
					<?php echo esc_html( get_the_excerpt() ); ?>
				</p>
			<?php endif; ?>
			<div class="Card-footer">
				<?php
				$bylines = get_bylines();
				if ( $bylines ) :
					?>
					<div class="Byline <?php echo ( 1 < count( $bylines ) ) ? 'Byline--multiple' : ''; ?>">
						<div class="Byline-content">
							<a href="<?php echo esc_url( $byline->user_url ); ?>" class="Byline-content">
								<div class="Byline-figure">
									<?php
									foreach ( $bylines as $byline ) :
										if ( $byline->user_image ) :
											$image_url = wp_get_attachment_image_url( $byline->user_image, 'full' );
											$args      = [
												'w'  => '100',
												'h' => '100',
												'fit' => 'crop',
												'crop' => 'faces',
											];
											$imgix_url = imgix_url( $image_url, $args );
											echo "<img src='{$imgix_url}' class='Byline-thumbnail'>";
										endif;
									endforeach;
									?>
								</div> 
								<div class="Byline-text">
									<span>
										<span class="Byline-person">
											<?php the_kontext_authors( $bylines ); ?>
										</span>
									</span>
								</div>
							</a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<a class="Card-link" href="<?php the_permalink(); ?>"> 
			<span class="u-hiddenVisually">Läs mere</span>
		</a>
	</div>
</article>
