<?php
/**
 * Template part for displaying homepage content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package manchesteroutsourcing
 */

$page_id = get_the_ID();
$slug = $post->post_name;
$currentID = get_the_ID();
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>

<div class="page__top page--<?php echo $slug; ?>" style="background-image:url(<?php echo $url; ?>);">
	<div class="bg"></div>
	<div class="contain">
		<div class="page__breadcrumbs">
			<?php if ( is_page() && $post->post_parent ) : ?>
				<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
			<?php endif; ?>
		</div>
		<div class="page__title">
			<h2><?php the_title(); ?></h2>
			<?php if(is_page('venture-building')) : ?>
			<p>Merging your ideas with your experience</p>
			<a href="#content__top"><button class="button button--start">Get Started</button></a>
			<?php endif; ?>
		</div>
	</div>
</div>

<div id="content__top"></div>
<div class="main__content">
	<div class="contain">
		<?php the_content(); ?>
	</div>
	<?php if(is_page('outsourcing')) : ?>
	<div class="testimonals-area">
		<div class="col">
			<div class="col6 col--leftfull col--testimonials">
				<div class="testimonials">
					<ul>
						<li>
							<div class="testimonial__content">
								<p>“Connex Solutions capabilities are unique in this industry. In addition to a superior product and cost effective solution, the level of support, customer service and responsiveness has been outstanding.”</p>
								<p class="author">Ross Gale - Manchester Outsourcing</p>
							</div>
						</li>
						<li>Another slide</li>
						<li>My last slide</li>
					</ul>
				</div>
				<a href="" class="absolute"><button class="button button--read button--card">More endorsements</button></a>
			</div>
			<div class="col6 col--rightfull col--bespoke">
				<div class="bespoke__content">
					<h4>Looking for bespoke?</h4>
					<p>We understand that outsourcing is not a one size fits all solution, that’s why we’ll take the time to get to know your business.</p>
				</div>
				<a href="" class="absolute"><button class="button button--read button--card">What we do</button></a>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if ( $post->post_parent === 85 ) : ?>
	<div class="related-pages related-pages--contain">
		<div class="contain">
			<h3>Related Pages</h3>
			<p>Some related pages which may be of interest to you.</p>
			
			<div class="col col--pages">
			<?php
			    $args = array( 
			    	'post_type'=> 'page', 
			    	'numberposts' => 4, 
			    	'orderby'=> 'rand',
			    	'post__not_in' => array($currentID),
			    	'taxonomy' => 'category',
                        'field' => 'slug',
                        'term' => 'outsourcing'
			    );
			    $postslist = get_posts( $args );
			    foreach ($postslist as $post) :  setup_postdata($post);
			    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
			    $thumb_url = $thumb['0']; 
			?>

				<div class="col3">
					<div class="page__image" style="background: url('<?php echo $thumb_url; ?>');background-size:cover;background-position: center;background-repeat:no-repeat;"></div>
					<div class="page__title">
						<?php the_title( sprintf( '<h5><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>
					</div>
				</div>

			<?php
				endforeach; 
				wp_reset_postdata();
			?>
			</div>

		</div>
	</div>
	<?php endif; ?>
</div>

<?php if ( $post->post_parent === 85 ) : ?>
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
							<label class="title">Interested in...</label>
							<span class="input__wrap input__select__wrap">
								<select name="interest" class="input__select">
									<option value="contact-centres">Contact Centres</option>
									<option value="business-services">Business Services</option>
									<option value="dialler-solutions">Dialler Solutions</option>
									<option value="venture-building">Venture Building</option>
								</select>
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
<?php endif; ?>

<?php if (is_page( array('about-us', 'venture-building'))  ): ?>
<div class="main__cta">
	<div class="contain">
		<div class="col">
			<div class="col6">
				<h2>Get in touch with us</h2>
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
<?php endif; ?>