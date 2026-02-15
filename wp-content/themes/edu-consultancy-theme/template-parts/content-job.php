<?php
/**
 * Template part for displaying a single job card in loops.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$job_id          = get_the_ID();
$company_name    = get_post_meta( $job_id, 'edu_company_name', true );
$location        = get_post_meta( $job_id, 'edu_location', true );
$salary_min      = get_post_meta( $job_id, 'edu_salary_min', true );
$salary_max      = get_post_meta( $job_id, 'edu_salary_max', true );
$legacy_range    = get_post_meta( $job_id, 'edu_salary_range', true );
$featured_job    = get_post_meta( $job_id, 'edu_featured_job', true );
$experience      = get_post_meta( $job_id, 'edu_experience_required', true );
$visa_sponsor    = get_post_meta( $job_id, 'edu_visa_sponsorship', true );
$featured_badge  = ( '1' === $featured_job ) ? '<span class="edu-badge edu-badge--featured">' . esc_html__( 'Featured', 'edu-consultancy' ) . '</span>' : '';
$visa_label      = ( 'yes' === $visa_sponsor ) ? esc_html__( 'Visa Sponsorship Available', 'edu-consultancy' ) : '';
$job_type_terms  = get_the_terms( $job_id, 'job_type' );
$job_type_labels = $job_type_terms && ! is_wp_error( $job_type_terms ) ? wp_list_pluck( $job_type_terms, 'name' ) : array();
$company_logo_id = (int) get_post_meta( $job_id, 'edu_company_logo_id', true );
$company_logo    = $company_logo_id ? wp_get_attachment_image_url( $company_logo_id, 'thumbnail' ) : '';

$salary_range = '';
if ( '' !== $salary_min || '' !== $salary_max ) {
	if ( '' !== $salary_min && '' !== $salary_max ) {
		$salary_range = trim( $salary_min ) . ' - ' . trim( $salary_max );
	} elseif ( '' !== $salary_min ) {
		$salary_range = trim( $salary_min );
	} else {
		$salary_range = trim( $salary_max );
	}
} elseif ( $legacy_range ) {
	$salary_range = $legacy_range;
}
?>

<article <?php post_class( 'edu-card edu-job-card' ); ?>>
	<header class="edu-job-card__header">
		<?php if ( has_post_thumbnail( $job_id ) || $company_logo ) : ?>
			<div class="edu-job-card__media">
				<?php
				if ( has_post_thumbnail( $job_id ) ) {
					echo get_the_post_thumbnail( $job_id, 'medium', array( 'class' => 'edu-job-card__image' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} elseif ( $company_logo ) {
					echo '<img class="edu-job-card__image edu-job-card__image--logo" src="' . esc_url( $company_logo ) . '" alt="' . esc_attr( $company_name ? $company_name : get_the_title() ) . '"/>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
			</div>
		<?php endif; ?>

		<h3 class="edu-job-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<?php if ( $featured_badge ) : ?>
			<?php echo $featured_badge; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php endif; ?>
	</header>

	<div class="edu-job-card__meta">
		<?php if ( $company_name ) : ?>
			<div class="edu-job-card__company"><?php echo esc_html( $company_name ); ?></div>
		<?php endif; ?>
		<?php if ( $location ) : ?>
			<div class="edu-job-card__location"><?php echo esc_html( $location ); ?></div>
		<?php endif; ?>
		<?php if ( $salary_range ) : ?>
			<div class="edu-job-card__salary"><?php echo esc_html( $salary_range ); ?></div>
		<?php endif; ?>
		<?php if ( ! empty( $job_type_labels ) ) : ?>
			<div class="edu-job-card__type"><?php echo esc_html( implode( ', ', $job_type_labels ) ); ?></div>
		<?php endif; ?>
	</div>

	<div class="edu-job-card__summary">
		<?php the_excerpt(); ?>
		<?php if ( $experience ) : ?>
			<p class="edu-job-card__experience"><?php esc_html_e( 'Experience:', 'edu-consultancy' ); ?> <?php echo esc_html( $experience ); ?></p>
		<?php endif; ?>
		<?php if ( $visa_label ) : ?>
			<p class="edu-job-card__visa"><?php echo esc_html( $visa_label ); ?></p>
		<?php endif; ?>
	</div>

	<footer class="edu-job-card__footer">
		<a class="edu-btn-primary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View & Apply', 'edu-consultancy' ); ?></a>
	</footer>
</article>
