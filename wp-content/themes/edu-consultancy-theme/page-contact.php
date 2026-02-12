<?php
/**
 * Contact page template.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$admin_email = get_option( 'admin_email' );
?>

<main id="primary" class="site-main">
	<section class="edu-section">
		<div class="edu-container">
			<header class="edu-section__header">
				<h1><?php the_title(); ?></h1>
				<p><?php esc_html_e( 'Get in touch for consultations, recruitment partnerships or general questions.', 'edu-consultancy' ); ?></p>
			</header>

			<div class="edu-grid edu-grid--2">
				<div>
					<div class="edu-card">
						<h2 class="edu-card__title"><?php esc_html_e( 'Contact Details', 'edu-consultancy' ); ?></h2>
						<p class="edu-card__meta">
							<?php
							if ( $admin_email ) {
								printf(
									/* translators: %s: admin email. */
									esc_html__( 'Email: %s', 'edu-consultancy' ),
									esc_html( $admin_email )
								);
							}
							?>
						</p>
						<p class="edu-card__meta">
							<?php esc_html_e( 'Phone: Add your contact number here', 'edu-consultancy' ); ?>
						</p>
						<p class="edu-card__meta">
							<?php esc_html_e( 'Office: Add your primary office address here', 'edu-consultancy' ); ?>
						</p>
					</div>
				</div>
				<div>
					<div class="edu-card">
						<h2 class="edu-card__title"><?php esc_html_e( 'Send us a message', 'edu-consultancy' ); ?></h2>
						<?php
						// Reuse consultation form for contact enquiries.
						echo do_shortcode( '[edu_consultation_form]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();

