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
				<form action="<?php echo esc_url( xpress_mvc_get_route_permalink( 'update-task', array( 'slug' => $xpress_viewmodel->slug ) ) );?>" method="POST" class="task type-task hentry">
					<div class="entry-content">
						<input type="hidden" name="_method" value="PATCH">
						<input type="hidden" name="completed" value="<?php echo xpress_mvc_example_is_checked( $xpress_viewmodel ) ? 'true' : 'false';?>">
						<input type="hidden" name="id" value="<?php esc_attr_e( $xpress_viewmodel->id );?>">
						<input type="text" name="title" placeholder="Enter task here..." value="<?php esc_attr_e( $xpress_viewmodel->title );?>">

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
