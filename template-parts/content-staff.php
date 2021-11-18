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
	<div class="Grid">
		<?php
		$staff = get_editorial_staff();
		foreach ( $staff as $member) {
			$byline_image     = get_term_meta( $member->term_id, 'user_image', true );
			$byline_image_url = wp_get_attachment_image_src( $byline_image, 'full' );
			$byline_email     = get_term_meta( $member->term_id, 'user_email', true );
			$byline_role     = get_term_meta( $member->term_id, 'user_role', true );
			$args             = array(
				'w'    => '400',
				'h'    => '257',
				'fit'  => 'crop',
				'crop' => 'faces',
			);
			$imgix_url        = imgix_url( $byline_image_url[0], $args );
			$byline_email     = get_term_meta( $byline->term_id, 'user_email', true );
			?>
			<div class="Grid-cell u-md-size1of2 u-lg-size1of3 ">
				<article class="Card Card--interactive">
					<figure class=>
						<img src="<?php echo esc_url( $imgix_url ); ?>">
					</figure>
					<div class="Card-content ">
						<div class="Card-body">
							<h3 class="Card-title">Jenny Nguyen</h3>
							<div class="Card-text">
								<p>
									<?php echo esc_html( $byline_role ); ?><br>
									<a href="mailto:<?php echo esc_html( $byline_email ); ?>"><?php echo esc_html( $byline_email ); ?></a>
								</p>
							</div>
						</div>
						<a class="Card-link" href="<?php echo esc_url( home_url( "/author/{$member->slug}" ) ) ?>">
							<span class="u-hiddenVisually">Läs mere</span>
						</a>
					</div>
				</article>
			</div>
			<?php
		}
		?>
	</div>
</section>