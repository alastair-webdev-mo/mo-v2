<?php
/**
 * Template part for displaying homepage content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package manchesteroutsourcing
 */


$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$hero_title = get_field('hero_title');
$hero_text = get_field('hero_text');
$hero_leading = get_field('hero_leading_text');
?>

<div class="hero">
	<video poster="/wp-content/uploads/2017/04/poster.png" id="bgvid" playsinline autoplay muted loop>
		<source src="/wp-content/uploads/2017/04/hero.webm" type="video/webm">
		<source src="/wp-content/uploads/2017/04/hero.mp4" type="video/mp4">
	</video>
	<div class="contain">
		<div class="hero__wrapper hero__wrapper--home">
			<div class="hero__content">
				<h2><?php echo $hero_title; ?></h2>
				<p><?php echo $hero_text; ?></p>
				<a href="#content__top"><button class="button button--start">Get started</button></a>
			</div>
			<div class="hero__bottom">
				<div class="hero__bottom--shadow"></div>
				<div class="col col--flex col--nomargin">
					<div class="col6 hero__opt hero__opt--o">
						<a href="/outsourcing/" class="link__opt"></a>
						<div class="opt__header">
							<h4>01</h4>
						</div>
						<div class="opt__products">
							<h4>Outsourcing</h4>
							<ul>
								<li>Contact Centre</li>
								<li>Business Services</li>
								<li>Dialler Solutions</li>
							</ul>
						</div>
					</div>
					<div class="col6 hero__opt hero__opt--v">
						<a href="/venture-building" class="link__opt"></a>
						<div class="opt__header">
							<h4>02</h4>
						</div>
						<div class="opt__products">
							<h4>Venture Building</h4>
							<ul>
								<li>Sell us your pitch</li>
								<li>Current successes</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="content__top"></div>
<div class="main__content">
	<div class="contain">
		<?php the_content(); ?>
	</div>
</div>

<div class="main__cta">
	<div class="contain">
		<div class="col">
			<div class="col6">
				<h2>Talk to us</h2>
				<p>All businesses have a story to tell. Some are tales of exciting opportunities and consistent progress; others are of ups and downs and learning the hard way.</p>
			</div>
			<div class="col6">
				<form class="form form--validation form--contain" action="" method="POST">
					<div class="form__wrapper">
						<fieldset>
							<label class="title">Full name</label>
							<span class="input__wrap">
								<input type="text" id="name" class="input__field" placeholder="What's your full name?" name="full-name" required>
							</span>
						</fieldset>
						<fieldset>
							<label class="title">Company</label>
							<span class="input__wrap">
								<input type="text" id="company" class="input__field" placeholder="Your company..." name="company" required>
							</span>
						</fieldset>
						<fieldset>
							<label class="title">Email address</label>
							<span class="input__wrap">
								<input type="email" id="email" class="input__field" placeholder="Your email address..." name="email" required>
							</span>
						</fieldset>
						<fieldset>
							<label class="title">Phone</label>
							<span class="input__wrap">
								<input type="tel" id="phone" class="input__field input__phone" placeholder="Best number to contact you on..." name="phone" required>
							</span>
						</fieldset>
						<span class="submit">
							<button class="button button--blue form__submit" name="submit">Start your journey <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
						</span>
						<span class="opt">
							<fieldset> 
								<span class="input__wrap input__wrap--checkbox">
									<input type="checkbox" name="optIn" class="input__check">
									<label for="check" class="input__label--check">
										<span>This tick indicates your consent to receive contact from one of our trusted funeral planning experts to discuss your wishes and requirements by telephone, email or SMS.</span>
									</label>
								</span>
							</fieldset>
						</span>								
					</div>
					<div id="form-messages"></div>
				</form>
			</div>
		</div>
	</div>
</div>