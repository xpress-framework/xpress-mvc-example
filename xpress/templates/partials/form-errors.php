<?php
/**
 * The template for rendering tasks form errors.
 *
 */

global $xpress_viewmodel;
?>

<?php if ( ! empty( $xpress_viewmodel->get_errors() ) ) : foreach ( $xpress_viewmodel->get_errors() as $field => $error ) : ?>

	<span class="error error-icon"><? echo esc_html( $error ); ?></span>

<?php endforeach; endif; ?>
