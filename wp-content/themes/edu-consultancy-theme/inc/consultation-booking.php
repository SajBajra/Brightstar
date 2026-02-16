<?php
/**
 * Consultation booking form (Elementor "Start Your Application" widget) – AJAX handler.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Consultation_Booking {

	const NONCE_ACTION = 'edu_consultation_booking';

	/**
	 * Init.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'wp_ajax_edu_submit_consultation_booking', array( __CLASS__, 'ajax_submit' ) );
		add_action( 'wp_ajax_nopriv_edu_submit_consultation_booking', array( __CLASS__, 'ajax_submit' ) );
	}

	/**
	 * AJAX submit booking.
	 *
	 * @return void
	 */
	public static function ajax_submit() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), self::NONCE_ACTION ) ) {
			wp_send_json_error( array( 'message' => __( 'Security check failed.', 'edu-consultancy' ) ), 400 );
		}

		$first_name   = isset( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
		$last_name    = isset( $_POST['last_name'] ) ? sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) : '';
		$email        = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$phone        = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
		$consult_type = isset( $_POST['consultation_type'] ) ? sanitize_text_field( wp_unslash( $_POST['consultation_type'] ) ) : '';
		$duration     = isset( $_POST['duration'] ) ? sanitize_text_field( wp_unslash( $_POST['duration'] ) ) : '';
		$date         = isset( $_POST['available_date'] ) ? sanitize_text_field( wp_unslash( $_POST['available_date'] ) ) : '';
		$method       = isset( $_POST['preferred_method'] ) ? sanitize_text_field( wp_unslash( $_POST['preferred_method'] ) ) : '';
		$branch       = isset( $_POST['preferred_branch'] ) ? sanitize_text_field( wp_unslash( $_POST['preferred_branch'] ) ) : '';
		$time         = isset( $_POST['visit_time'] ) ? sanitize_text_field( wp_unslash( $_POST['visit_time'] ) ) : '';
		$message      = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
		$tab          = isset( $_POST['booking_tab'] ) ? sanitize_text_field( wp_unslash( $_POST['booking_tab'] ) ) : '';

		if ( empty( $first_name ) || empty( $last_name ) || empty( $email ) || empty( $phone ) ) {
			wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'edu-consultancy' ) ), 400 );
		}

		$title = sprintf(
			/* translators: 1: first name, 2: last name */
			__( 'Booking: %1$s %2$s', 'edu-consultancy' ),
			$first_name,
			$last_name
		);

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'consultation_booking',
				'post_title'  => $title,
				'post_status' => 'publish',
				'meta_input'  => array(
					'edu_booking_first_name'   => $first_name,
					'edu_booking_last_name'    => $last_name,
					'edu_booking_email'        => $email,
					'edu_booking_phone'        => $phone,
					'edu_booking_type'         => $consult_type,
					'edu_booking_duration'     => $duration,
					'edu_booking_date'         => $date,
					'edu_booking_method'       => $method,
					'edu_booking_branch'       => $branch,
					'edu_booking_time'         => $time,
					'edu_booking_message'      => $message,
					'edu_booking_tab'          => $tab,
				),
			),
			true
		);

		if ( is_wp_error( $post_id ) || 0 === $post_id ) {
			wp_send_json_error( array( 'message' => __( 'Could not save booking. Please try again.', 'edu-consultancy' ) ), 500 );
		}

		wp_send_json_success( array( 'message' => __( 'Thank you! Your consultation request has been submitted.', 'edu-consultancy' ) ) );
	}
}
