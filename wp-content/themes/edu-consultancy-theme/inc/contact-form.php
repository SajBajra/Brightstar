<?php
/**
 * Contact page form: handle submission and save to Contact Submissions CPT.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Contact_Form {

	/**
	 * Form nonce action.
	 *
	 * @var string
	 */
	const NONCE_ACTION = 'edu_contact_form';

	/**
	 * Hook registration.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'template_redirect', array( __CLASS__, 'maybe_handle_submission' ) );
	}

	/**
	 * Process contact form POST if on contact page and nonce valid.
	 *
	 * @return void
	 */
	public static function maybe_handle_submission() {
		if ( ! is_singular( 'page' ) || ! isset( $_POST['edu_contact_submit'] ) ) {
			return;
		}

		$page = get_queried_object();
		if ( ! $page || 'contact' !== $page->post_name ) {
			return;
		}

		if ( ! isset( $_POST['edu_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['edu_contact_nonce'] ) ), self::NONCE_ACTION ) ) {
			wp_safe_redirect( add_query_arg( 'contact_error', '1', get_permalink( $page ) ) );
			exit;
		}

		$name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
		$email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
		$phone   = isset( $_POST['contact_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_phone'] ) ) : '';
		$message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

		if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
			wp_safe_redirect( add_query_arg( 'contact_error', '1', get_permalink( $page ) ) );
			exit;
		}

		$title = sprintf(
			/* translators: %s: sender name */
			__( 'Contact from %s', 'edu-consultancy' ),
			$name
		);

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'contact_submission',
				'post_title'  => $title,
				'post_status' => 'publish',
				'meta_input'  => array(
					'edu_contact_name'    => $name,
					'edu_contact_email'   => $email,
					'edu_contact_phone'   => $phone,
					'edu_contact_message' => $message,
				),
			),
			true
		);

		if ( is_wp_error( $post_id ) || 0 === $post_id ) {
			wp_safe_redirect( add_query_arg( 'contact_error', '1', get_permalink( $page ) ) );
			exit;
		}

		wp_safe_redirect( add_query_arg( 'contact_sent', '1', get_permalink( $page ) ) );
		exit;
	}
}
