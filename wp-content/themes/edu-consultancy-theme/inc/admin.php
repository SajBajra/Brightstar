<?php
/**
 * Admin customisations: dashboard widgets, meta boxes, exports.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Admin {

	/**
	 * Initialise admin hooks.
	 *
	 * @return void
	 */
	public static function init() {
		if ( is_admin() ) {
			add_action( 'wp_dashboard_setup', array( __CLASS__, 'register_dashboard_widgets' ) );
			add_action( 'add_meta_boxes', array( __CLASS__, 'add_consultation_meta_boxes' ) );
			add_action( 'save_post_consultations', array( __CLASS__, 'save_consultation_meta' ) );
			add_action( 'admin_post_edu_export_consultations', array( __CLASS__, 'export_consultations_csv' ) );
		}
	}

	/**
	 * Register dashboard widgets.
	 *
	 * @return void
	 */
	public static function register_dashboard_widgets() {
		wp_add_dashboard_widget(
			'edu_consultations_overview',
			esc_html__( 'Consultations Overview', 'edu-consultancy' ),
			array( __CLASS__, 'render_consultations_overview_widget' )
		);
	}

	/**
	 * Render consultations dashboard widget.
	 *
	 * @return void
	 */
	public static function render_consultations_overview_widget() {
		$count_obj = wp_count_posts( 'consultations' );
		$total     = isset( $count_obj->publish ) ? (int) $count_obj->publish : 0;

		$recent = get_posts(
			array(
				'post_type'      => 'consultations',
				'post_status'    => 'publish',
				'posts_per_page' => 5,
				'orderby'        => 'date',
				'order'          => 'DESC',
			)
		);

		$export_url = wp_nonce_url(
			admin_url( 'admin-post.php?action=edu_export_consultations' ),
			'edu_export_consultations',
			'edu_export_nonce'
		);
		?>
		<p><strong><?php esc_html_e( 'Total Consultations:', 'edu-consultancy' ); ?></strong> <?php echo esc_html( (string) $total ); ?></p>

		<?php if ( ! empty( $recent ) ) : ?>
			<ul>
				<?php foreach ( $recent as $consultation ) : ?>
					<li>
						<a href="<?php echo esc_url( get_edit_post_link( $consultation->ID ) ); ?>">
							<?php echo esc_html( get_the_title( $consultation ) ); ?>
						</a>
						<span> &mdash; <?php echo esc_html( get_the_date( '', $consultation ) ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p><?php esc_html_e( 'No consultations yet.', 'edu-consultancy' ); ?></p>
		<?php endif; ?>

		<p>
			<a class="button button-primary" href="<?php echo esc_url( $export_url ); ?>">
				<?php esc_html_e( 'Export Consultations CSV', 'edu-consultancy' ); ?>
			</a>
		</p>
		<?php
	}

	/**
	 * Add lead status meta box.
	 *
	 * @return void
	 */
	public static function add_consultation_meta_boxes() {
		add_meta_box(
			'edu-consultation-lead-status',
			esc_html__( 'Lead Status', 'edu-consultancy' ),
			array( __CLASS__, 'render_lead_status_meta_box' ),
			'consultations',
			'side',
			'default'
		);
	}

	/**
	 * Render lead status meta box.
	 *
	 * @param WP_Post $post Post object.
	 *
	 * @return void
	 */
	public static function render_lead_status_meta_box( $post ) {
		wp_nonce_field( 'edu_save_consultation_meta', 'edu_consultation_meta_nonce' );

		$current_status = get_post_meta( $post->ID, 'edu_lead_status', true );
		if ( empty( $current_status ) ) {
			$current_status = 'new';
		}

		$statuses = array(
			'new'       => esc_html__( 'New', 'edu-consultancy' ),
			'contacted' => esc_html__( 'Contacted', 'edu-consultancy' ),
			'converted' => esc_html__( 'Converted', 'edu-consultancy' ),
		);
		?>
		<p>
			<label for="edu_lead_status_field" class="screen-reader-text">
				<?php esc_html_e( 'Lead Status', 'edu-consultancy' ); ?>
			</label>
			<select name="edu_lead_status" id="edu_lead_status_field">
				<?php foreach ( $statuses as $value => $label ) : ?>
					<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_status, $value ); ?>>
						<?php echo esc_html( $label ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php
	}

	/**
	 * Save consultation meta.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	public static function save_consultation_meta( $post_id ) {
		if ( ! isset( $_POST['edu_consultation_meta_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['edu_consultation_meta_nonce'] ) ), 'edu_save_consultation_meta' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['edu_lead_status'] ) ) {
			$allowed  = array( 'new', 'contacted', 'converted' );
			$status   = sanitize_text_field( wp_unslash( $_POST['edu_lead_status'] ) );
			$status   = in_array( $status, $allowed, true ) ? $status : 'new';
			update_post_meta( $post_id, 'edu_lead_status', $status );
		}
	}

	/**
	 * Export consultations to CSV.
	 *
	 * @return void
	 */
	public static function export_consultations_csv() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have permission to export this data.', 'edu-consultancy' ) );
		}

		if ( ! isset( $_GET['edu_export_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['edu_export_nonce'] ) ), 'edu_export_consultations' ) ) {
			wp_die( esc_html__( 'Security check failed.', 'edu-consultancy' ) );
		}

		$filename = 'consultations-' . gmdate( 'Y-m-d-H-i-s' ) . '.csv';

		header( 'Content-Type: text/csv; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=' . $filename );

		$output = fopen( 'php://output', 'w' );

		if ( false === $output ) {
			exit;
		}

		// CSV header row.
		fputcsv(
			$output,
			array(
				'ID',
				'Title',
				'Date',
				'Full Name',
				'Email',
				'Phone',
				'Interested Country',
				'Interested Service',
				'Message',
				'Lead Status',
			)
		);

		$consultations = get_posts(
			array(
				'post_type'      => 'consultations',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'date',
				'order'          => 'DESC',
			)
		);

		foreach ( $consultations as $consultation ) {
			$meta = get_post_meta( $consultation->ID );

			$row = array(
				$consultation->ID,
				get_the_title( $consultation ),
				get_the_date( 'Y-m-d H:i:s', $consultation ),
				isset( $meta['edu_full_name'][0] ) ? $meta['edu_full_name'][0] : '',
				isset( $meta['edu_email'][0] ) ? $meta['edu_email'][0] : '',
				isset( $meta['edu_phone'][0] ) ? $meta['edu_phone'][0] : '',
				isset( $meta['edu_interested_country'][0] ) ? $meta['edu_interested_country'][0] : '',
				isset( $meta['edu_interested_service'][0] ) ? $meta['edu_interested_service'][0] : '',
				isset( $meta['edu_message'][0] ) ? $meta['edu_message'][0] : '',
				isset( $meta['edu_lead_status'][0] ) ? $meta['edu_lead_status'][0] : 'new',
			);

			// Escape all values for CSV.
			$row = array_map( 'wp_strip_all_tags', $row );
			fputcsv( $output, $row );
		}

		fclose( $output );
		exit;
	}
}

