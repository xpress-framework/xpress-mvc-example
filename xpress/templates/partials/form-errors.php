<?php
/**
 * The template for rendering tasks form errors.
 *
 */

global $xpress_viewmodel;
?>

<? if ( isset( $xpress_viewmodel['errors'] ) ) : foreach ( $xpress_viewmodel['errors'] as $error ) : ?>

	<span class="error error-icon"><? echo esc_html( $error ); ?></span>

<?php endforeach; endif; ?>
