<?php
/**
 * The header for our theme.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Favicon -->
<link rel='icon' href='favicon.ico' type='image/x-icon' />
<link rel="icon" href="favicon-16.png" sizes="16x16" type="image/png">
<link rel="icon" href="favicon-32.png" sizes="32x32" type="image/png">
<link rel="icon" href="favicon-48.png" sizes="48x48" type="image/png">
<link rel="icon" href="favicon-62.png" sizes="62x62" type="image/png">
<link rel="icon" href="favicon-192.png" sizes="192x192" type="image/png">

<!-- Scripts -->
<script src="https://use.typekit.net/wmx0mwh.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<script src="https://use.fontawesome.com/3cf330e970.js"></script>

<!-- Analytics -->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<nav>
	<div class="contain">
		<div class="nav__wrapper">
			<div class="nav__logo"><a href="<?php echo get_home_url(); ?>" class="abso__link"><img src="/wp-content/uploads/2017/04/logo__white@2x.png" width="120"></a></div>
			<div class="nav__menu"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?></div>
			<div class="nav__search"><a class="search"><i class="fa fa-fw fa-lg fa-search" aria-hidden="true"></i></a></div>
			<div class="nav__searchbar"><?php get_search_form(); ?></div>
		</div>
	</div>
</nav>
