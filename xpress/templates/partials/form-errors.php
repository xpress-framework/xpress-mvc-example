<?php
/**
 * The template for rendering tasks form errors.
 *
 */

global $xpress_viewmodel;
?>

<?php if ( isset( $xpress_viewmodel['errors']->error_data['rest_invalid_param']['params'] ) ) : foreach ( $xpress_viewmodel['errors']->error_data['rest_invalid_param']['params'] as $field => $error ) : ?>

	<span class="error error-icon"><? echo esc_html( $error ); ?></span>

<?php endforeach; endif; ?>
