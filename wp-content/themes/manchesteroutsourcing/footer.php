<?php
/**
 * The template for displaying the footer.
 */
?>

<footer>
	<div class="contain">
		<div class="footer__menu">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</div>
		<div class="footer__logo">
			<a href="<?php echo get_home_url(); ?>" class="abso__link"><img src="/wp-content/uploads/2017/04/logo__white@2x.png" width="120"></a>
		</div>
	</div>
</footer>


<?php wp_footer(); ?>

</body>
</html>
