<?php
/**
 * Custom roles and capabilities for job portal.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Roles {

	/**
	 * Init hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_roles_and_caps' ), 5 );
	}

	/**
	 * Register custom roles and assign capabilities.
	 *
	 * @return void
	 */
	public static function register_roles_and_caps() {
		// Job Seeker role.
		if ( ! get_role( 'job_seeker' ) ) {
			add_role(
				'job_seeker',
				esc_html__( 'Job Seeker', 'edu-consultancy' ),
				array(
					'read'         => true,
					'upload_files' => true,
				)
			);
		}

		// Employer role.
		if ( ! get_role( 'employer' ) ) {
			add_role(
				'employer',
				esc_html__( 'Employer', 'edu-consultancy' ),
				array(
					'read'         => true,
					'upload_files' => true,
				)
			);
		}

		// Assign capabilities to roles for Jobs and Job Applications.
		$employer = get_role( 'employer' );
		$admin    = get_role( 'administrator' );

		$job_caps = array(
			'read_job',
			'read_private_jobs',
			'edit_job',
			'edit_jobs',
			'edit_published_jobs',
			'publish_jobs',
			'delete_job',
			'delete_jobs',
			'delete_published_jobs',
		);

		$application_caps = array(
			'read_job_application',
			'read_private_job_applications',
			'edit_job_application',
			'edit_job_applications',
			'edit_published_job_applications',
			'publish_job_applications',
			'delete_job_application',
			'delete_job_applications',
			'delete_published_job_applications',
		);

		if ( $employer instanceof WP_Role ) {
			foreach ( $job_caps as $cap ) {
				$employer->add_cap( $cap );
			}

			// Employers can view and manage applications related to their jobs.
			foreach ( $application_caps as $cap ) {
				$employer->add_cap( $cap );
			}
		}

		// Ensure administrators always have full capabilities.
		if ( $admin instanceof WP_Role ) {
			foreach ( array_merge( $job_caps, $application_caps ) as $cap ) {
				$admin->add_cap( $cap );
			}
		}
	}
}

