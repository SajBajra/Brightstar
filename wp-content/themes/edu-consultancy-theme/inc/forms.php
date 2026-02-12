<?php
/**
 * Front-end forms (no plugin dependency).
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Forms {

	/**
	 * Hook registration.
	 *
	 * @return void
	 */
	public static function init() {
		add_shortcode( 'edu_consultation_form', array( __CLASS__, 'render_consultation_form' ) );

		// AJAX handlers for consultation form.
		add_action( 'wp_ajax_edu_submit_consultation', array( __CLASS__, 'handle_consultation_submission' ) );
		add_action( 'wp_ajax_nopriv_edu_submit_consultation', array( __CLASS__, 'handle_consultation_submission' ) );
	}

	/**
	 * Render the free consultation form.
	 *
	 * @return string
	 */
	public static function render_consultation_form() {
		$ajax_url = admin_url( 'admin-ajax.php' );
		$nonce    = wp_create_nonce( 'edu_consultation_nonce' );

		ob_start();
		?>
		<form class="edu-consultation-form" method="post" action="<?php echo esc_url( $ajax_url ); ?>">
			<input type="hidden" name="action" value="edu_submit_consultation" />
			<input type="hidden" name="edu_nonce" value="<?php echo esc_attr( $nonce ); ?>" />

			<div>
				<label for="edu_full_name"><?php esc_html_e( 'Full Name', 'edu-consultancy' ); ?> *</label>
				<input type="text" id="edu_full_name" name="full_name" required />
			</div>

			<div>
				<label for="edu_email"><?php esc_html_e( 'Email', 'edu-consultancy' ); ?> *</label>
				<input type="email" id="edu_email" name="email" required />
			</div>

			<div>
				<label for="edu_phone"><?php esc_html_e( 'Phone', 'edu-consultancy' ); ?> *</label>
				<input type="tel" id="edu_phone" name="phone" required />
			</div>

			<div>
				<label for="edu_country"><?php esc_html_e( 'Interested Country', 'edu-consultancy' ); ?></label>
				<input type="text" id="edu_country" name="interested_country" />
			</div>

			<div>
				<label for="edu_service"><?php esc_html_e( 'Interested Service', 'edu-consultancy' ); ?></label>
				<input type="text" id="edu_service" name="interested_service" />
			</div>

			<div>
				<label for="edu_message"><?php esc_html_e( 'Message', 'edu-consultancy' ); ?></label>
				<textarea id="edu_message" name="message"></textarea>
			</div>

			<button type="submit" class="edu-btn-primary">
				<?php esc_html_e( 'Request Free Consultation', 'edu-consultancy' ); ?>
			</button>

			<div class="edu-consultation-message" aria-live="polite"></div>
		</form>
		<?php

		return (string) ob_get_clean();
	}

	/**
	 * Handle form submission (AJAX).
	 *
	 * @return void
	 */
	public static function handle_consultation_submission() {
		// Verify nonce.
		if ( ! isset( $_POST['edu_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['edu_nonce'] ) ), 'edu_consultation_nonce' ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Security check failed. Please refresh the page and try again.', 'edu-consultancy' ),
				),
				400
			);
		}

		// Sanitize fields.
		$full_name          = isset( $_POST['full_name'] ) ? sanitize_text_field( wp_unslash( $_POST['full_name'] ) ) : '';
		$email              = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$phone              = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
		$interested_country = isset( $_POST['interested_country'] ) ? sanitize_text_field( wp_unslash( $_POST['interested_country'] ) ) : '';
		$interested_service = isset( $_POST['interested_service'] ) ? sanitize_text_field( wp_unslash( $_POST['interested_service'] ) ) : '';
		$message            = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

		if ( empty( $full_name ) || empty( $email ) || empty( $phone ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Please fill in all required fields.', 'edu-consultancy' ),
				),
			 400
			);
		}

		// Create consultation post.
		$post_title = sprintf(
			/* translators: %s: client name */
			esc_html__( 'Consultation - %s', 'edu-consultancy' ),
			$full_name
		);

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'consultations',
				'post_title'  => $post_title,
				'post_status' => 'publish',
				'meta_input'  => array(
					'edu_full_name'          => $full_name,
					'edu_email'              => $email,
					'edu_phone'              => $phone,
					'edu_interested_country' => $interested_country,
					'edu_interested_service' => $interested_service,
					'edu_message'            => $message,
					'edu_lead_status'        => 'new',
				),
			)
		);

		if ( is_wp_error( $post_id ) || 0 === $post_id ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Something went wrong while saving your request. Please try again.', 'edu-consultancy' ),
				),
				500
			);
		}

		// Notify admin.
		$admin_email = get_option( 'admin_email' );
		if ( $admin_email && is_email( $admin_email ) ) {
			$subject = esc_html__( 'New Consultation Request', 'edu-consultancy' );

			$body_lines = array(
				__( 'New free consultation request received:', 'edu-consultancy' ),
				'',
				'Name: ' . $full_name,
				'Email: ' . $email,
				'Phone: ' . $phone,
				'Interested Country: ' . $interested_country,
				'Interested Service: ' . $interested_service,
				'Message: ' . $message,
				'',
				'Edit in dashboard: ' . get_edit_post_link( $post_id ),
			);

			$headers = array( 'Content-Type: text/plain; charset=UTF-8' );

			wp_mail(
				$admin_email,
				$subject,
				implode( "\n", array_map( 'wp_strip_all_tags', $body_lines ) ),
				$headers
			);
		}

		wp_send_json_success(
			array(
				'message' => esc_html__( 'Thank you! Your consultation request has been submitted.', 'edu-consultancy' ),
			)
		);
	}
}

