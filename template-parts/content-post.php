<?php
/**
 * Template part for post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kontext
 */

?>

<header class="View-pushDown">
	<div class="Intro Intro--center  ">
		<span class="Intro-tagline"><?php the_kontext_category(); ?></span> 
		<h1 class="Intro-title"><?php the_title(); ?></h1>
		<?php if ( has_excerpt() ) : ?>
		<div class="Intro-body">
			<div>
				<?php the_excerpt(); ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="Intro-meta">
			<?php
			$bylines = get_bylines();
			if ( $bylines ) :
				?>
				<div class="Byline <?php echo ( 1 < count( $bylines ) ) ? 'Byline--multiple' : ''; ?>">
					<div class="Byline-content">
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
										?>
										<?php
									endif;
								endforeach;
								?>
							</div> 
							<div class="Byline-text">
								<span>
									<?php the_kontext_authors( $bylines ); ?>
								</span>
							</div>
						<span> 
							<span class="Byline-divider">–</span>
							<time datetime="<?php the_date( 'Y-m-d' ); ?>" class="u-inlineBlock"><?php the_time( 'j F Y' ); ?></time>
						</span>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( kontext_has_thumbnail() ) : ?>
			<figure class="Intro-figure">
				<?php the_post_thumbnail( 'full' ); ?>
				<figcaption class="Intro-figcaption">
					<?php the_post_thumbnail_caption(); ?>
				</figcaption>
			</figure>
		<?php endif; ?>
	</div>
</header>

<div class="Article-content">
	<?php the_content(); ?>
	<p class="meta">
		<?php the_tags(); ?>
	</p>
</div>

<div class="u-narrow">
	<hr class="u-sizeFull">
</div>

<div class="Donate u-narrow">
	<h3 class="Donate-title">
		<span class="Donate-first">Säkra Kontexts journalistik!</span>
		<br/>
		Varje krona räknas!
	</h3>
	<p class="Donate-body">
		Swisha till: <span><button title="Klicka för att kopiera" data-oncopy="Kopierat!" data-input="swish-article" class="u-textCopy">1236 2121 79</button><input id="swish-article" readonly="readonly" value="1236 2121 79" class="u-hiddenVisually"></span>
	</p>
	<div class="Donate-icon"></div>
</div>
