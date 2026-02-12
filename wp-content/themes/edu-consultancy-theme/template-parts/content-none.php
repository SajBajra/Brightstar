<?php
/**
 * Fallback template when no content is available.
 *
 * @package Edu_Consultancy
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title">
			<?php esc_html_e( 'Nothing Found', 'edu-consultancy' ); ?>
		</h1>
	</header>

	<div class="page-content">
		<p><?php esc_html_e( 'It seems we can’t find what you’re looking for.', 'edu-consultancy' ); ?></p>
	</div>
</section>

