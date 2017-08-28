<?php
/**
 * The template for creating new tasks
 *
 */

get_header();

global $xpress_viewmodel;
?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="page-header tasks-header">
				<h1 class="page-title"><?php _e( 'Edit Task', 'twentyfifteen' ); ?></h1>
			</header><!-- .page-header -->

			<article>
				<form action="<?php echo esc_url( xpress_mvc_get_route_permalink( 'update-task', array( 'slug' => $xpress_viewmodel['task']->post_name ) ) );?>" method="POST" class="task type-task hentry">
					<div class="entry-content">
						<input type="hidden" name="checked" value="<?php echo xpress_mvc_example_is_checked( $xpress_viewmodel['task'] ) ? '1' : '';?>">
						<input type="text" name="title" placeholder="Enter task here..." value="<?php esc_attr_e( $xpress_viewmodel['task']->post_title );?>">

						<?php get_template_part( 'xpress/templates/partials/form-errors', 'task' ); ?>

					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<button type="submit">Save</button>
					</footer><!-- .entry-footer -->
				</form>
			</article><!-- #post-## -->
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
