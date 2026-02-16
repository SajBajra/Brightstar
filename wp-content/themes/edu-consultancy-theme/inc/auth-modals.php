<?php
/**
 * Custom login and register modals (AJAX + markup).
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Edu_Theme_Auth_Modals {

	const LOGIN_NONCE  = 'edu_login_modal';
	const REGISTER_NONCE = 'edu_register_modal';

	/**
	 * Hook registration.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
		add_action( 'wp_footer', array( __CLASS__, 'render_modals' ), 5 );
		add_action( 'wp_ajax_edu_modal_login', array( __CLASS__, 'ajax_login' ) );
		add_action( 'wp_ajax_nopriv_edu_modal_login', array( __CLASS__, 'ajax_login' ) );
		add_action( 'wp_ajax_edu_modal_register', array( __CLASS__, 'ajax_register' ) );
		add_action( 'wp_ajax_nopriv_edu_modal_register', array( __CLASS__, 'ajax_register' ) );
	}

	/**
	 * Enqueue modal script and localize.
	 *
	 * @return void
	 */
	public static function enqueue_assets() {
		if ( is_user_logged_in() ) {
			return;
		}
		$version = defined( 'EDU_THEME_VERSION' ) ? EDU_THEME_VERSION : wp_get_theme()->get( 'Version' );
		wp_enqueue_script(
			'edu-auth-modals',
			trailingslashit( EDU_THEME_URI ) . 'assets/js/auth-modals.js',
			array(),
			$version,
			true
		);
		wp_localize_script(
			'edu-auth-modals',
			'eduAuthModals',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'login_nonce' => wp_create_nonce( self::LOGIN_NONCE ),
				'register_nonce' => wp_create_nonce( self::REGISTER_NONCE ),
				'redirect' => esc_url( home_url( '/' ) ),
				'strings' => array(
					'error_generic' => __( 'Something went wrong. Please try again.', 'edu-consultancy' ),
					'login_success' => __( 'Login successful. Redirecting…', 'edu-consultancy' ),
					'register_success' => __( 'Registration successful. Redirecting…', 'edu-consultancy' ),
				),
			)
		);
	}

	/**
	 * Output login and register modal markup in footer.
	 *
	 * @return void
	 */
	public static function render_modals() {
		if ( is_user_logged_in() ) {
			return;
		}
		$redirect = isset( $_GET['redirect_to'] ) ? esc_url_raw( wp_unslash( $_GET['redirect_to'] ) ) : home_url( '/' );
		?>
		<div id="edu-login-modal" class="edu-modal" aria-hidden="true" role="dialog" aria-labelledby="edu-login-modal-title">
			<div class="edu-modal__backdrop" data-close></div>
			<div class="edu-modal__box">
				<button type="button" class="edu-modal__close" data-close aria-label="<?php esc_attr_e( 'Close', 'edu-consultancy' ); ?>">&times;</button>
				<h2 id="edu-login-modal-title" class="edu-modal__title"><?php esc_html_e( 'Login', 'edu-consultancy' ); ?></h2>
				<form class="edu-modal-form edu-login-form" data-action="edu_modal_login" method="post">
					<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect ); ?>" />
					<p class="edu-modal-form__row">
						<label for="edu-login-username"><?php esc_html_e( 'Username or Email', 'edu-consultancy' ); ?></label>
						<input type="text" id="edu-login-username" name="log" required autocomplete="username" />
					</p>
					<p class="edu-modal-form__row">
						<label for="edu-login-password"><?php esc_html_e( 'Password', 'edu-consultancy' ); ?></label>
						<input type="password" id="edu-login-password" name="pwd" required autocomplete="current-password" />
					</p>
					<p class="edu-modal-form__row edu-modal-form__message" aria-live="polite"></p>
					<p class="edu-modal-form__row edu-modal-form__actions">
						<button type="submit" class="edu-btn-primary"><?php esc_html_e( 'Login', 'edu-consultancy' ); ?></button>
					</p>
					<p class="edu-modal-form__row edu-modal-form__switch">
						<?php esc_html_e( "Don't have an account?", 'edu-consultancy' ); ?>
						<button type="button" class="edu-modal-form__link edu-modal-switch" data-modal="register"><?php esc_html_e( 'Register', 'edu-consultancy' ); ?></button>
					</p>
				</form>
			</div>
		</div>

		<div id="edu-register-modal" class="edu-modal" aria-hidden="true" role="dialog" aria-labelledby="edu-register-modal-title">
			<div class="edu-modal__backdrop" data-close></div>
			<div class="edu-modal__box">
				<button type="button" class="edu-modal__close" data-close aria-label="<?php esc_attr_e( 'Close', 'edu-consultancy' ); ?>">&times;</button>
				<h2 id="edu-register-modal-title" class="edu-modal__title"><?php esc_html_e( 'Register', 'edu-consultancy' ); ?></h2>
				<form class="edu-modal-form edu-register-form" data-action="edu_modal_register" method="post">
					<p class="edu-modal-form__row">
						<label for="edu-register-username"><?php esc_html_e( 'Username', 'edu-consultancy' ); ?></label>
						<input type="text" id="edu-register-username" name="username" required autocomplete="username" />
					</p>
					<p class="edu-modal-form__row">
						<label for="edu-register-email"><?php esc_html_e( 'Email', 'edu-consultancy' ); ?></label>
						<input type="email" id="edu-register-email" name="email" required autocomplete="email" />
					</p>
					<p class="edu-modal-form__row">
						<label for="edu-register-password"><?php esc_html_e( 'Password', 'edu-consultancy' ); ?></label>
						<input type="password" id="edu-register-password" name="password" required autocomplete="new-password" minlength="6" />
					</p>
					<p class="edu-modal-form__row edu-modal-form__message" aria-live="polite"></p>
					<p class="edu-modal-form__row edu-modal-form__actions">
						<button type="submit" class="edu-btn-primary"><?php esc_html_e( 'Register', 'edu-consultancy' ); ?></button>
					</p>
					<p class="edu-modal-form__row edu-modal-form__switch">
						<?php esc_html_e( 'Already have an account?', 'edu-consultancy' ); ?>
						<button type="button" class="edu-modal-form__link edu-modal-switch" data-modal="login"><?php esc_html_e( 'Login', 'edu-consultancy' ); ?></button>
					</p>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * AJAX login handler.
	 *
	 * @return void
	 */
	public static function ajax_login() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), self::LOGIN_NONCE ) ) {
			wp_send_json_error( array( 'message' => __( 'Security check failed.', 'edu-consultancy' ) ), 400 );
		}
		$log = isset( $_POST['log'] ) ? sanitize_text_field( wp_unslash( $_POST['log'] ) ) : '';
		$pwd = isset( $_POST['pwd'] ) ? $_POST['pwd'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$redirect = isset( $_POST['redirect_to'] ) ? esc_url_raw( wp_unslash( $_POST['redirect_to'] ) ) : home_url( '/' );

		if ( empty( $log ) || empty( $pwd ) ) {
			wp_send_json_error( array( 'message' => __( 'Please enter username and password.', 'edu-consultancy' ) ), 400 );
		}

		$result = wp_signon(
			array(
				'user_login'    => $log,
				'user_password' => $pwd,
				'remember'      => ! empty( $_POST['remember'] ),
			),
			is_ssl()
		);

		if ( is_wp_error( $result ) ) {
			wp_send_json_error( array( 'message' => $result->get_error_message() ), 400 );
		}

		wp_send_json_success( array( 'redirect' => $redirect ) );
	}

	/**
	 * AJAX register handler.
	 *
	 * @return void
	 */
	public static function ajax_register() {
		if ( ! get_option( 'users_can_register' ) ) {
			wp_send_json_error( array( 'message' => __( 'Registration is currently disabled.', 'edu-consultancy' ) ), 400 );
		}
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), self::REGISTER_NONCE ) ) {
			wp_send_json_error( array( 'message' => __( 'Security check failed.', 'edu-consultancy' ) ), 400 );
		}

		$username = isset( $_POST['username'] ) ? sanitize_user( wp_unslash( $_POST['username'] ), true ) : '';
		$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$password = isset( $_POST['password'] ) ? $_POST['password'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

		if ( empty( $username ) || empty( $email ) || strlen( $password ) < 6 ) {
			wp_send_json_error( array( 'message' => __( 'Please fill all fields. Password must be at least 6 characters.', 'edu-consultancy' ) ), 400 );
		}

		if ( ! is_email( $email ) ) {
			wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'edu-consultancy' ) ), 400 );
		}

		$user_id = wp_create_user( $username, $password, $email );
		if ( is_wp_error( $user_id ) ) {
			wp_send_json_error( array( 'message' => $user_id->get_error_message() ), 400 );
		}

		// Log the user in.
		wp_set_current_user( $user_id );
		wp_set_auth_cookie( $user_id, true );

		wp_send_json_success( array( 'redirect' => home_url( '/' ) ) );
	}
}
