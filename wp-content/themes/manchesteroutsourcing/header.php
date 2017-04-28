<?php
/**
 * The header for our theme.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="/ico/apple-touch-icon.png">
<link rel="icon" type="image/png" href="/ico/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/ico/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/ico/manifest.json">
<link rel="mask-icon" href="/ico/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">

<!-- Scripts -->
<script src="https://use.typekit.net/wmx0mwh.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<script src="https://use.fontawesome.com/3cf330e970.js"></script>

<!-- Analytics -->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if(is_page('homepage')) : ?>
<nav class="nav--home">
	<div class="nav__shadow"></div>
	<div class="contain">
		<div class="nav__wrapper nav__wrapper--home">
			<div class="nav__logo"><a href="<?php echo get_home_url(); ?>" class="abso__link"><img src="/wp-content/uploads/2017/04/logo__white@2x.png" width="120"></a></div>
			<div class="nav__menu"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?><div class="nav__searchbar"><?php get_search_form(); ?></div></div>
			<div class="nav__search"><a class="search"><i class="fa fa-fw fa-lg fa-search" aria-hidden="true"></i></a></div>
		</div>
	</div>
</nav>
<nav class="nav--fixed">
	<div class="contain">
		<div class="nav__wrapper">
			<div class="nav__logo"><a href="<?php echo get_home_url(); ?>" class="abso__link"><img src="/wp-content/uploads/2017/04/logo__white@2x.png" width="120"></a></div>
			<div class="nav__menu"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?></div>
			<div class="nav__search"><a class="search"><i class="fa fa-fw fa-lg fa-search" aria-hidden="true"></i></a></div>
			<div class="nav__searchbar"><?php get_search_form(); ?></div>
		</div>
	</div>
</nav>
<?php else : ?>
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
<nav class="nav--fixed">
	<div class="contain">
		<div class="nav__wrapper">
			<div class="nav__logo"><a href="<?php echo get_home_url(); ?>" class="abso__link"><img src="/wp-content/uploads/2017/04/logo__white@2x.png" width="120"></a></div>
			<div class="nav__menu"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?></div>
			<div class="nav__search"><a class="search"><i class="fa fa-fw fa-lg fa-search" aria-hidden="true"></i></a></div>
			<div class="nav__searchbar"><?php get_search_form(); ?></div>
		</div>
	</div>
</nav>
<?php endif; ?>
