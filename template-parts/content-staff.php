<?php
/**
 * Template part for staff
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kontext
 */

?>

<section>
	<div class="Text Text--full Text--center">
		<h2 class="Text-section Text-section--simple">Redaktionsmedlemmar</h2>
	</div>
	<div class="Grid">
		<?php
		$staff = get_editorial_staff();
		foreach ( $staff as $member ) {
			$byline_image = get_term_meta( $member->term_id, 'user_image', true );
			$byline_email = get_term_meta( $member->term_id, 'user_email', true );
			$byline_role  = get_term_meta( $member->term_id, 'user_role', true );
			?>
			<div class="Grid-cell u-md-size1of2 u-lg-size1of3 ">
				<article class="Card Card--interactive">
					<figure class="Card-figure"> <?php /* lade till klassen Card-figure som verkar saknas i din kod */ ?>
						<?php 
						if ( $byline_image ) {
							echo wp_get_attachment_image( $byline_image, 'staff-profile', false, array( 'class' => 'Card-image' ) ); 
						}
						?>
					</figure>
					<div class="Card-content ">
						<div class="Card-body">
							<h3 class="Card-title"><?php echo esc_html( $member->name ); ?></h3>
							<div class="Card-text">
								<p>
									<?php echo esc_html( $byline_role ); ?><br>
									<a href="mailto:<?php echo esc_attr( $byline_email ); ?>"><?php echo esc_html( $byline_email ); ?></a>
								</p>
							</div>
						</div>
						<a class="Card-link" href="<?php echo esc_url( home_url( "/author/{$member->slug}" ) ) ?>">
							<span class="u-hiddenVisually">Läs mer</span>
						</a>
					</div>
				</article>
			</div>
			<?php
		}
		?>
	</div>
</section>