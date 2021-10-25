<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kontext
 */

?>
	</main>
	<footer class="Footer" id="ncid-94ae" data-nanocomponent="ncid-94ae" data-onloadid3mlh3="o1">
		<div class="Footer-container u-container">
			<div class="Footer-col">
				<h2 class="Footer-title">Kontakt</h2>
				<ul class="Footer-list">
					<li class="Footer-item">
						<a href="mailto:info@kontextpress.se" class="Footer-link u-textNowrap">info@kontextpress.se</a>
					</li>
					<li class="Footer-item">
						<a href="/redaktionen" class="Footer-link">Kontakta redaktionen</a>
					</li>
				</ul>
			</div>
			<div class="Footer-col">
				<h2 class="Footer-title">Stöd oss</h2>
				<ul class="Footer-list">
					<li class="Footer-item">Bankgiro: 
						<button title="Klicka för att kopiera" data-oncopy="Kopierat!" data-input="bankgiro-footer" class="u-textCopy">5347-1249</button>
						<input id="bankgiro-footer" readonly="readonly" value="5347-1249" class="u-hiddenVisually">
					</li>
					<li class="Footer-item">Swish: 
						<button title="Klicka för att kopiera" data-oncopy="Kopierat!" data-input="swish-footer" class="u-textCopy">1236 2121 79</button>
						<input id="swish-footer" readonly="readonly" value="1236 2121 79" class="u-hiddenVisually">
					</li>
					<li class="Footer-item">
						<a href="/stod-oss" class="Footer-link">Vår finansering</a>
					</li>
				</ul>
			</div>
			<div class="Footer-col">
				<h2 class="Footer-title">Va i loopen</h2>
				<ul class="Footer-list">
					<li class="Footer-item">
						<a target="_blank" rel="noopener noreferrer" href="https://www.instagram.com/kontextpress/" class="Footer-link">Följ på Instagram</a>
					</li>
					<li class="Footer-item">
						<a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/kontextpress" class="Footer-link">Gilla på Facebook</a>
					</li>
					<li class="Footer-item">
						<a target="_blank" rel="noopener noreferrer" href="https://twitter.com/kontextpress" class="Footer-link">Följ på Twitter</a>
					</li>
				</ul>
			</div>
			<div class="Footer-col">
				<h2 class="Footer-title">Kontext Press</h2>
				<ul class="Footer-list">
					<li class="Footer-item">
						<a href="/om-oss" class="Footer-link">Om oss</a>
					</li>
					<li class="Footer-item">
						<a href="/redaktionen" class="Footer-link">Redaktionen</a>
					</li>
				</ul>
			</div>
			<div class="Footer-col">
				<h2 class="Footer-title">Övrigt</h2>
				<ul class="Footer-list">
					<li class="Footer-item">
						<a href="/cookies" class="Footer-link">Om cookies</a>
					</li>
				</ul>
			</div>
			<div class="Footer-col Footer-move">
				<h2 class="Footer-title">Ansvarig utgivare</h2>
				<ul class="Footer-list">
					<li class="Footer-item">
						<a href="/author/mireya-echeverria-quezada" class="Footer-link">Mireya Echeverría Quezada</a>
					</li>
				</ul>
			</div>
			<a href="/" rel="home" title="Till startsidan" class="Footer-logo">
				<svg viewBox="0 0 479 68" class="Footer-figure">
					<g fill="currentColor" fill-rule="evenodd">
						<path d="M14.4393 1.1337V32.4h8.7272L42.5541 1.1337h14.5987L36.5171 33.4703 58.5945 66.888H43.2751L23.157 34.8h-8.7177v32.088H1.1928V1.1337zM117.0782 34.0109c0-11.5297-6.4884-21.5283-20.185-21.5283-13.1564 0-20.095 10.269-20.095 21.5283 0 11.3496 5.2263 21.5276 20.0052 21.5276 13.4264 0 20.2748-10.0883 20.2748-21.5276zm-53.3465 0c0-18.1052 12.2552-33.7777 33.1615-33.7777 21.9874 0 33.2513 15.4024 33.2513 33.7777 0 18.1948-11.9846 33.7776-33.341 33.7776-23.3394 0-33.0718-15.3126-33.0718-33.7776zM160.8747 66.888h-13.2458V1.1337h13.066l28.5655 59.9022V1.1337h13.2465V66.888h-13.0657L160.8747 6.8955zM219.8105 1.1337h51.725v11.9799h-19.5548V66.888h-13.2468V13.1136h-18.9234V1.1337M338.2183 1.1337v11.9799h-36.1347V32.4h29.1968v2.4h-29.1968v19.5675h36.1347V66.888h-49.3819V1.1337zM374.4469 32.8399L353.1796 1.0436h15.6807l14.148 21.8878 14.2355-21.8878h14.6891L390.847 32.4794l22.7969 34.4086h-15.859l-15.3178-23.9598-15.4117 23.9598h-15.2271l22.6186-34.0481M426.0809 1.1337h51.7279v11.9799h-19.5563V66.888h-13.2472V13.1136h-18.9244V1.1337"></path>
					</g>
				</svg>
				<span class="Footer-copy">© Kontext Press</span>
			</a>
		</div>
	</footer>

	<script type="text/html" id="tmpl-grid-template">
		<div class="Grid-cell u-md-size1of2 u-lg-size1of3">
			<article class="Card Card--interactive">
				<figure class="Card-figure u-hoverTriggerTarget">
					<img src="{{{data.featured_image_url}}}" class='Card-image'>
				</figure>
				<div class="Card-content ">
					<div class="Card-body">
						<time datetime="{{{data.date_i18n}}}" class="Card-meta">{{{data.date_i18n}}}</time>
						<h3 class="Card-title">
							<span>
								<# if ( data.kicker ) { #>
								<span class="Card-type">{{data.kicker}}:</span>
								<# } #>
								{{data.title.rendered}}
							</span>
						</h3>
						<p class="Card-text">
							{{{data.excerpt}}}
						</p>
						<div class="Card-footer">
							<# if ( data.bylines ) { #>
								<div class="Byline {{ data.bylines.length !== 1 ?  'Byline-Multiple' : '' }}">
								<div class="Byline-content">
									<a href="#" class="Byline-content">
										<div class="Byline-figure">
											<# _.forEach( data.bylines, function ( byline, index ) { #>
												<img src="{{{byline.byline_url}}}" class='Byline-thumbnail'>
											<# }) #>
										</div> 
										<div class="Byline-text">
											<span>
												<span class="Byline-person">
													<# _.forEach( data.bylines, function ( byline, index ) { #><# if ( 1 < data.bylines.length && 0 !== index ) { #><# if ( data.bylines.length-1 === index ) { #> & <# } else { #>,<# } #><# } #> {{{byline.display_name}}}<# }) #>
												</span>
											</span>
										</div>
									</a>
								</div>
							</div>
							<# } #>
						</div>
					</div>
					<a class="Card-link" href="<?php the_permalink(); ?>"> 
						<span class="u-hiddenVisually">Läs mer</span>
					</a>
				</div>
			</article>
		</div>
	</script>

	<?php wp_footer(); ?>

</body>
</html>
