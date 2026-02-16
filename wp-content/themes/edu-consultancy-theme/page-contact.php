<?php
/**
 * Template for Contact page.
 * Hero + breadcrumb + form (saved to Contact Submissions in admin) + image.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$contact_sent = isset( $_GET['contact_sent'] ) && '1' === $_GET['contact_sent'];
$contact_error = isset( $_GET['contact_error'] ) && '1' === $_GET['contact_error'];
?>

<main id="primary" class="site-main">
	<section class="edu-find-jobs-hero edu-page-hero edu-contact-hero" aria-label="<?php esc_attr_e( 'Contact', 'edu-consultancy' ); ?>">
		<div class="edu-find-jobs-hero__overlay"></div>
		<div class="edu-find-jobs-hero__inner">
			<nav class="edu-find-jobs-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'edu-consultancy' ); ?>">
				<ol class="edu-find-jobs-hero__breadcrumb-list">
					<li class="edu-find-jobs-hero__breadcrumb-item">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'edu-consultancy' ); ?></a>
					</li>
					<li class="edu-find-jobs-hero__breadcrumb-item edu-find-jobs-hero__breadcrumb-item--current" aria-current="page">
						<?php esc_html_e( 'Contact', 'edu-consultancy' ); ?>
					</li>
				</ol>
			</nav>
			<h1 class="edu-find-jobs-hero__title"><?php esc_html_e( 'Contact', 'edu-consultancy' ); ?></h1>
			<p class="edu-find-jobs-hero__description"><?php esc_html_e( 'Have a support question? Get in touch.', 'edu-consultancy' ); ?></p>
		</div>
	</section>

	<div class="edu-container">
		<div class="edu-contact-content">
			<div class="edu-contact-content__form-wrap">
				<?php if ( $contact_sent ) : ?>
					<div class="edu-contact-message edu-contact-message--success" role="alert">
						<?php esc_html_e( 'Thank you! Your message has been sent. We will get back to you soon.', 'edu-consultancy' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $contact_error ) : ?>
					<div class="edu-contact-message edu-contact-message--error" role="alert">
						<?php esc_html_e( 'Something went wrong or required fields were missing. Please try again.', 'edu-consultancy' ); ?>
					</div>
				<?php endif; ?>

				<form class="edu-contact-form" method="post" action="">
					<?php wp_nonce_field( Edu_Theme_Contact_Form::NONCE_ACTION, 'edu_contact_nonce' ); ?>
					<input type="hidden" name="edu_contact_submit" value="1" />

					<p class="edu-contact-form__row">
						<label for="contact_name"><?php esc_html_e( 'Name', 'edu-consultancy' ); ?> <span class="required">*</span></label>
						<input type="text" id="contact_name" name="contact_name" class="edu-contact-form__input" required />
					</p>
					<p class="edu-contact-form__row">
						<label for="contact_email"><?php esc_html_e( 'Email', 'edu-consultancy' ); ?> <span class="required">*</span></label>
						<input type="email" id="contact_email" name="contact_email" class="edu-contact-form__input" required />
					</p>
					<p class="edu-contact-form__row">
						<label for="contact_phone"><?php esc_html_e( 'Phone Number', 'edu-consultancy' ); ?></label>
						<input type="tel" id="contact_phone" name="contact_phone" class="edu-contact-form__input" />
					</p>
					<p class="edu-contact-form__row">
						<label for="contact_message"><?php esc_html_e( 'Message', 'edu-consultancy' ); ?> <span class="required">*</span></label>
						<textarea id="contact_message" name="contact_message" class="edu-contact-form__input edu-contact-form__textarea" rows="5" required></textarea>
					</p>
					<p class="edu-contact-form__row edu-contact-form__submit">
						<button type="submit" class="edu-btn-primary"><?php esc_html_e( 'Send Message', 'edu-consultancy' ); ?></button>
					</p>
				</form>
			</div>
			<aside class="edu-contact-content__side">
				<div class="edu-contact-content__image">
					<img src="https://images.unsplash.com/photo-1423666639041-f56000c27a9a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="<?php esc_attr_e( 'Get in touch', 'edu-consultancy' ); ?>" loading="lazy" />
				</div>
				<div class="edu-contact-content__info">
					<h3 class="edu-contact-content__info-title"><?php esc_html_e( "Let's Chat", 'edu-consultancy' ); ?></h3>
					<p class="edu-contact-content__info-text"><?php esc_html_e( 'You can call us', 'edu-consultancy' ); ?></p>
					<p class="edu-contact-content__info-phone"><a href="tel:+97452455555">+974 5245 5555</a></p>
				</div>
			</aside>
		</div>
	</div>
</main>

<?php
get_footer();
