<?php
/**
 * Elementor widget: Start Your Application with Us Today – consultation booking form.
 * Replicates Interlace "Start Your Application" section with tabs, duration, and form.
 *
 * @package Edu_Consultancy
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Edu_Elementor_Widget_Consultation_Booking
 */
class Edu_Elementor_Widget_Consultation_Booking extends Widget_Base {

	public function get_name() {
		return 'edu-consultation-booking';
	}

	public function get_title() {
		return esc_html__( 'Consultation Booking (Start Your Application)', 'edu-consultancy' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return array( 'general' );
	}

	protected function register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore -- Elementor compatibility
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Start Your Application with Us Today', 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'   => esc_html__( 'Subtitle', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Whether you're planning to study abroad or migrate, we're here to help every step of the way.", 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'tab_1',
			array(
				'label'   => esc_html__( 'Tab 1 label', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Migration Consultation', 'edu-consultancy' ),
			)
		);
		$this->add_control(
			'tab_2',
			array(
				'label'   => esc_html__( 'Tab 2 label', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Education Consultation', 'edu-consultancy' ),
			)
		);
		$this->add_control(
			'tab_3',
			array(
				'label'   => esc_html__( 'Tab 3 label', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Take a Service', 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'form_heading',
			array(
				'label'   => esc_html__( 'Form heading', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Book A Consultation', 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'submit_text',
			array(
				'label'   => esc_html__( 'Submit button text', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Submit', 'edu-consultancy' ),
			)
		);

		$this->add_control(
			'disclaimer',
			array(
				'label'   => esc_html__( 'Disclaimer (below checkbox)', 'edu-consultancy' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'You will receive your consultation details via email or WhatsApp. If you have any questions, feel free to contact us.', 'edu-consultancy' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			array(
				'label' => esc_html__( 'Style', 'edu-consultancy' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .edu-consultation-booking__title',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Title color', 'edu-consultancy' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .edu-consultation-booking__title' => 'color: {{VALUE}};' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$title     = isset( $settings['title'] ) ? $settings['title'] : '';
		$subtitle  = isset( $settings['subtitle'] ) ? $settings['subtitle'] : '';
		$tab_1     = isset( $settings['tab_1'] ) ? $settings['tab_1'] : '';
		$tab_2     = isset( $settings['tab_2'] ) ? $settings['tab_2'] : '';
		$tab_3     = isset( $settings['tab_3'] ) ? $settings['tab_3'] : '';
		$form_heading = isset( $settings['form_heading'] ) ? $settings['form_heading'] : '';
		$submit_text  = isset( $settings['submit_text'] ) ? $settings['submit_text'] : __( 'Submit', 'edu-consultancy' );
		$disclaimer   = isset( $settings['disclaimer'] ) ? $settings['disclaimer'] : '';
		$widget_id  = 'edu-consultation-booking-' . $this->get_id();
		$nonce      = wp_create_nonce( Edu_Theme_Consultation_Booking::NONCE_ACTION );
		$ajax_url   = admin_url( 'admin-ajax.php' );
		?>
		<section class="edu-consultation-booking" id="<?php echo esc_attr( $widget_id ); ?>">
			<div class="edu-container">
				<?php if ( $title ) : ?>
					<h2 class="edu-consultation-booking__title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<?php if ( $subtitle ) : ?>
					<p class="edu-consultation-booking__subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>

				<div class="edu-consultation-booking__tabs" role="tablist">
					<button type="button" role="tab" aria-selected="true" data-tab="migration" class="edu-consultation-booking__tab is-active"><?php echo esc_html( $tab_1 ); ?></button>
					<button type="button" role="tab" aria-selected="false" data-tab="education" class="edu-consultation-booking__tab"><?php echo esc_html( $tab_2 ); ?></button>
					<button type="button" role="tab" aria-selected="false" data-tab="service" class="edu-consultation-booking__tab"><?php echo esc_html( $tab_3 ); ?></button>
				</div>

				<div class="edu-consultation-booking__durations">
					<span class="edu-consultation-booking__duration-label"><?php esc_html_e( 'Select Duration', 'edu-consultancy' ); ?></span>
					<div class="edu-consultation-booking__duration-options">
						<label><input type="radio" name="<?php echo esc_attr( $widget_id ); ?>_duration" value="5 MIN" /> 5 MIN</label>
						<label><input type="radio" name="<?php echo esc_attr( $widget_id ); ?>_duration" value="30 MIN" checked /> 30 MIN</label>
						<label><input type="radio" name="<?php echo esc_attr( $widget_id ); ?>_duration" value="60 MIN" /> 60 MIN</label>
						<label><input type="radio" name="<?php echo esc_attr( $widget_id ); ?>_duration" value="90 MIN" /> 90 MIN</label>
					</div>
				</div>

				<?php if ( $form_heading ) : ?>
					<h3 class="edu-consultation-booking__form-title"><?php echo esc_html( $form_heading ); ?></h3>
				<?php endif; ?>

				<form class="edu-consultation-booking__form" data-widget-id="<?php echo esc_attr( $widget_id ); ?>" action="<?php echo esc_url( $ajax_url ); ?>" method="post">
					<input type="hidden" name="action" value="edu_submit_consultation_booking" />
					<input type="hidden" name="nonce" value="<?php echo esc_attr( $nonce ); ?>" />
					<input type="hidden" name="booking_tab" class="edu-consultation-booking__input-tab" value="migration" />

					<div class="edu-consultation-booking__row edu-consultation-booking__row--two">
						<p class="edu-consultation-booking__field">
							<label for="<?php echo esc_attr( $widget_id ); ?>_first_name"><?php esc_html_e( 'First Name', 'edu-consultancy' ); ?> *</label>
							<input type="text" id="<?php echo esc_attr( $widget_id ); ?>_first_name" name="first_name" required />
						</p>
						<p class="edu-consultation-booking__field">
							<label for="<?php echo esc_attr( $widget_id ); ?>_last_name"><?php esc_html_e( 'Last Name', 'edu-consultancy' ); ?> *</label>
							<input type="text" id="<?php echo esc_attr( $widget_id ); ?>_last_name" name="last_name" required />
						</p>
					</div>
					<div class="edu-consultation-booking__row edu-consultation-booking__row--two">
						<p class="edu-consultation-booking__field">
							<label for="<?php echo esc_attr( $widget_id ); ?>_email"><?php esc_html_e( 'Email', 'edu-consultancy' ); ?> *</label>
							<input type="email" id="<?php echo esc_attr( $widget_id ); ?>_email" name="email" required />
						</p>
						<p class="edu-consultation-booking__field">
							<label for="<?php echo esc_attr( $widget_id ); ?>_phone"><?php esc_html_e( 'Phone Number', 'edu-consultancy' ); ?> *</label>
							<input type="tel" id="<?php echo esc_attr( $widget_id ); ?>_phone" name="phone" required />
						</p>
					</div>
					<div class="edu-consultation-booking__row">
						<p class="edu-consultation-booking__field">
							<label for="<?php echo esc_attr( $widget_id ); ?>_consultation_type"><?php esc_html_e( 'Consultation Type', 'edu-consultancy' ); ?> *</label>
							<select id="<?php echo esc_attr( $widget_id ); ?>_consultation_type" name="consultation_type" required>
								<option value=""><?php esc_html_e( 'Choose Type', 'edu-consultancy' ); ?></option>
								<option value="Study Visa"><?php esc_html_e( 'Study Visa', 'edu-consultancy' ); ?></option>
								<option value="PR Visa"><?php esc_html_e( 'PR Visa', 'edu-consultancy' ); ?></option>
								<option value="Family Visa"><?php esc_html_e( 'Family Visa', 'edu-consultancy' ); ?></option>
								<option value="Employer sponsored visa"><?php esc_html_e( 'Employer sponsored visa', 'edu-consultancy' ); ?></option>
							</select>
						</p>
					</div>
					<div class="edu-consultation-booking__row edu-consultation-booking__row--two">
						<p class="edu-consultation-booking__field">
							<label for="<?php echo esc_attr( $widget_id ); ?>_available_date"><?php esc_html_e( 'Select your available date', 'edu-consultancy' ); ?> *</label>
							<input type="date" id="<?php echo esc_attr( $widget_id ); ?>_available_date" name="available_date" required />
						</p>
						<p class="edu-consultation-booking__field">
							<label for="<?php echo esc_attr( $widget_id ); ?>_preferred_method"><?php esc_html_e( 'Preferred Method', 'edu-consultancy' ); ?> *</label>
							<select id="<?php echo esc_attr( $widget_id ); ?>_preferred_method" name="preferred_method" required>
								<option value=""><?php esc_html_e( 'Select Preferred Method', 'edu-consultancy' ); ?></option>
								<option value="Request A Callback"><?php esc_html_e( 'Request A Callback', 'edu-consultancy' ); ?></option>
								<option value="Office Visit"><?php esc_html_e( 'Office Visit', 'edu-consultancy' ); ?></option>
							</select>
						</p>
					</div>
					<div class="edu-consultation-booking__row edu-consultation-booking__row--two">
						<p class="edu-consultation-booking__field">
							<label for="<?php echo esc_attr( $widget_id ); ?>_preferred_branch"><?php esc_html_e( 'Preferred Branches', 'edu-consultancy' ); ?> *</label>
							<select id="<?php echo esc_attr( $widget_id ); ?>_preferred_branch" name="preferred_branch" required>
								<option value=""><?php esc_html_e( 'Select Preferred Branches', 'edu-consultancy' ); ?></option>
								<option value="Adelaide"><?php esc_html_e( 'Adelaide', 'edu-consultancy' ); ?></option>
								<option value="Brisbane"><?php esc_html_e( 'Brisbane', 'edu-consultancy' ); ?></option>
								<option value="Perth"><?php esc_html_e( 'Perth', 'edu-consultancy' ); ?></option>
								<option value="Sydney"><?php esc_html_e( 'Sydney', 'edu-consultancy' ); ?></option>
								<option value="Bali"><?php esc_html_e( 'Bali', 'edu-consultancy' ); ?></option>
								<option value="Cambodia"><?php esc_html_e( 'Cambodia', 'edu-consultancy' ); ?></option>
								<option value="Nepal"><?php esc_html_e( 'Nepal', 'edu-consultancy' ); ?></option>
								<option value="Japan"><?php esc_html_e( 'Japan', 'edu-consultancy' ); ?></option>
							</select>
						</p>
						<p class="edu-consultation-booking__field">
							<label for="<?php echo esc_attr( $widget_id ); ?>_visit_time"><?php esc_html_e( 'Select visit Time', 'edu-consultancy' ); ?></label>
							<input type="time" id="<?php echo esc_attr( $widget_id ); ?>_visit_time" name="visit_time" />
						</p>
					</div>
					<div class="edu-consultation-booking__row">
						<p class="edu-consultation-booking__field">
							<label for="<?php echo esc_attr( $widget_id ); ?>_message"><?php esc_html_e( "Anything specific you'd like to know?", 'edu-consultancy' ); ?></label>
							<textarea id="<?php echo esc_attr( $widget_id ); ?>_message" name="message" rows="3"></textarea>
						</p>
					</div>
					<div class="edu-consultation-booking__row">
						<p class="edu-consultation-booking__field edu-consultation-booking__agree">
							<label>
								<input type="checkbox" name="agree" value="1" required />
								<?php esc_html_e( 'Consultation details via email or WhatsApp', 'edu-consultancy' ); ?> *
							</label>
							<?php if ( $disclaimer ) : ?>
								<span class="edu-consultation-booking__disclaimer"><?php echo esc_html( $disclaimer ); ?></span>
							<?php endif; ?>
						</p>
					</div>
					<div class="edu-consultation-booking__row edu-consultation-booking__message" aria-live="polite"></div>
					<div class="edu-consultation-booking__row edu-consultation-booking__row--submit">
						<button type="submit" class="edu-btn-primary edu-consultation-booking__submit"><?php echo esc_html( $submit_text ); ?></button>
					</div>
				</form>
			</div>
			<script>
			(function(){
				var w = document.getElementById('<?php echo esc_js( $widget_id ); ?>');
				if (!w) return;
				var tabs = w.querySelectorAll('.edu-consultation-booking__tab');
				var inputTab = w.querySelector('.edu-consultation-booking__input-tab');
				tabs.forEach(function(t){
					t.addEventListener('click', function(){
						tabs.forEach(function(x){ x.classList.remove('is-active'); x.setAttribute('aria-selected','false'); });
						t.classList.add('is-active'); t.setAttribute('aria-selected','true');
						if (inputTab) inputTab.value = t.getAttribute('data-tab');
					});
				});
				var form = w.querySelector('.edu-consultation-booking__form');
				var durationRadios = w.querySelectorAll('input[name="<?php echo esc_js( $widget_id ); ?>_duration"]');
				form.addEventListener('submit', function(e){
					e.preventDefault();
					var msgEl = w.querySelector('.edu-consultation-booking__message');
					var btn = w.querySelector('.edu-consultation-booking__submit');
					var durationVal = '';
					durationRadios.forEach(function(r){ if(r.checked) durationVal = r.value; });
					var fd = new FormData(form);
					fd.append('duration', durationVal);
					msgEl.textContent = '';
					msgEl.className = 'edu-consultation-booking__row edu-consultation-booking__message';
					if(btn) btn.disabled = true;
					fetch(form.action, { method: 'POST', body: fd, credentials: 'same-origin' })
						.then(function(r){ return r.json(); })
						.then(function(data){
							if (data.success) {
								msgEl.textContent = data.data && data.data.message ? data.data.message : '<?php echo esc_js( __( 'Thank you! Your request has been submitted.', 'edu-consultancy' ) ); ?>';
								msgEl.classList.add('edu-consultation-booking__message--success');
								form.reset();
							} else {
								msgEl.textContent = data.data && data.data.message ? data.data.message : '<?php echo esc_js( __( 'Something went wrong. Please try again.', 'edu-consultancy' ) ); ?>';
								msgEl.classList.add('edu-consultation-booking__message--error');
							}
							if(btn) btn.disabled = false;
						})
						.catch(function(){
							msgEl.textContent = '<?php echo esc_js( __( 'Something went wrong. Please try again.', 'edu-consultancy' ) ); ?>';
							msgEl.classList.add('edu-consultation-booking__message--error');
							if(btn) btn.disabled = false;
						});
				});
			})();
			</script>
		</section>
		<?php
	}
}
