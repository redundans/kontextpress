<?php
/**
 * The header for Kontext Press theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kontext
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
	<title><?php wp_title(); ?></title>
	<link rel="shortcut icon" href="<?php echo esc_url( get_theme_file_uri( '/dist/favicon.ico' ) ); ?>">
	<link rel="apple-touch-icon" href="<?php echo esc_url( get_theme_file_uri( '/dist/icon.png' ) ); ?>">
	<?php if ( is_front_page() ) : ?>
		<!-- HTML Meta Tags -->
		<title><?php wp_title(); ?></title>
		<meta name="title" content="<?php bloginfo( 'name' ); ?>">
		<meta name="description" content="<?php bloginfo( 'description' ); ?>">

		<!-- Facebook Meta Tags -->
		<meta property="og:url" content="<?php bloginfo( 'url' ); ?>">
		<meta property="og:type" content="website">
		<meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
		<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
		<meta property="og:image" content="<?php echo esc_url( get_theme_file_uri( '/dist/socialmedia.jpg' ) ); ?>">

		<meta property="twitter:card" content="summary_large_image">
		<meta property="twitter:url" content="<?php bloginfo( 'url' ); ?>">
		<meta property="twitter:title" content="<?php bloginfo( 'name' ); ?>">
		<meta property="twitter:description" content="<?php bloginfo( 'description' ); ?>">
		<meta property="twitter:image" content="<?php echo esc_url( get_theme_file_uri( '/dist/socialmedia.jpg' ) ); ?>">

		<!-- Meta Tags Generated via https://www.opengraph.xyz -->
	<?php endif; ?>
</head>
<body <?php body_class( 'View' ); ?> style="--theme-color-primary: <?php kontext_theme_color( 'primary' ); ?>; --theme-color-secondary: <?php kontext_theme_color( 'secondary' ); ?>;">
	<?php if ( is_single() ) : ?>
	<div class="progress-container">
		<div class="progressbar" id="scrollprogress"></div>
	</div>
	<?php endif; ?>
	<header class="Header" id="header">
		<div id="search-container" class="mx-auto font-serif text-base md:text-menu my-12 hidden">
			<form action="/" class="flex flex-row gap-10">
				<div class="flex-grow">
					<input class="w-full bg-transparent" type="search" name="s" value="<?= get_search_query(); ?>" placeholder="Sök">
				</div>
				<ul class="flex flex-row gap-10">
					<li><span class="cursor-pointer search-toggle"><i class="fas fa-times w-5"></i></span></li>
				</ul>
			</form>
		</div>
		<div id="nav-container" class="mx-auto font-serif text-base md:text-menu my-12">
			<div class="flex flex-row justify-between">
				<div class="flex flex-col md:flex-row justify-between gap-12">
					<div class="w-52">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<svg viewBox="0 0 479 68"><g fill="currentColor" fill-rule="evenodd"><path d="M14.4393 1.1337V32.4h8.7272L42.5541 1.1337h14.5987L36.5171 33.4703 58.5945 66.888H43.2751L23.157 34.8h-8.7177v32.088H1.1928V1.1337zM117.0782 34.0109c0-11.5297-6.4884-21.5283-20.185-21.5283-13.1564 0-20.095 10.269-20.095 21.5283 0 11.3496 5.2263 21.5276 20.0052 21.5276 13.4264 0 20.2748-10.0883 20.2748-21.5276zm-53.3465 0c0-18.1052 12.2552-33.7777 33.1615-33.7777 21.9874 0 33.2513 15.4024 33.2513 33.7777 0 18.1948-11.9846 33.7776-33.341 33.7776-23.3394 0-33.0718-15.3126-33.0718-33.7776zM160.8747 66.888h-13.2458V1.1337h13.066l28.5655 59.9022V1.1337h13.2465V66.888h-13.0657L160.8747 6.8955zM219.8105 1.1337h51.725v11.9799h-19.5548V66.888h-13.2468V13.1136h-18.9234V1.1337M338.2183 1.1337v11.9799h-36.1347V32.4h29.1968v2.4h-29.1968v19.5675h36.1347V66.888h-49.3819V1.1337zM374.4469 32.8399L353.1796 1.0436h15.6807l14.148 21.8878 14.2355-21.8878h14.6891L390.847 32.4794l22.7969 34.4086h-15.859l-15.3178-23.9598-15.4117 23.9598h-15.2271l22.6186-34.0481M426.0809 1.1337h51.7279v11.9799h-19.5563V66.888h-13.2472V13.1136h-18.9244V1.1337"></path></g></svg>
						</a>
					</div>
					<?php
						wp_nav_menu(
							array(
								'container'       => 'nav',
								'container_class' => '',
								'menu_class'      => 'flex flex-row gap-8 whitespace-nowrap',
								'theme_location'  => 'primary'
							)
						);
					?>
				</div>
				<?php
					wp_nav_menu(
						array(
							'container'       => 'nav',
							'container_class' => '',
							'menu_class'      => 'flex flex-row gap-8 whitespace-nowrap',
							'theme_location'  => 'secondary'
						)
					);
				?>
			</div>
		</div>
	</header>
	<main class="View-main">
