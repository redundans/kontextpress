<?php
/**
 * Template part for displaying grid cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kontext
 */

global $wp_query;
?>

<div class="Grid-cell u-md-size1of2 u-lg-size1of3">
	<article class="Card Card--interactive">
		<figure class="Card-figure u-hoverTriggerTarget">
			<?php
				$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
				$args      = [
					'w'  => '696',
					'h' => '596',
					'fit' => 'crop',
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
						<span class="Card-type"><?php the_kontext_category(); ?>:</span>
						<?php the_title(); ?>
					</span>
				</h3>
				<p class="Card-text">
					<?php echo esc_html( get_the_excerpt() ); ?>
				</p>
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
				<span class="u-hiddenVisually">Läs mer</span>
			</a>
		</div>
	</article>
</div>
