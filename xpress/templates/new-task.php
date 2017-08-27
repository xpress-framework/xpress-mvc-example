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
				<h1 class="page-title"><?php _e( 'New Task', 'twentyfifteen' ); ?></h1>
			</header><!-- .page-header -->

			<article>
				<form action="<?php esc_attr_e( xpress_mvc_get_route_permalink( 'create-task' ) );?>" method="POST" class="task type-task hentry">
					<div class="entry-content">
						<input type="text" name="title" placeholder="Enter task here...">

						<?php get_template_part( 'xpress/templates/partials/form-errors', 'task' ); ?>

					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<button type="submit">Create</button>
					</footer><!-- .entry-footer -->
				</form>
			</article><!-- #post-## -->
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
