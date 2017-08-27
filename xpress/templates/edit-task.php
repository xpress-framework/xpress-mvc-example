<?php
/**
 * The template for creating new tasks
 *
 */

get_header();

global $xpress_viewmodel;
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article <?php post_class(); ?>>
				<header class="entry-header">
					<h1>Edit Task</h1>
				</header><!-- .entry-header -->
				<form action="<?php echo esc_url( xpress_mvc_get_route_permalink( 'update-task', array( 'slug' => $xpress_viewmodel['task']->post_name ) ) );?>" method="POST">
					<div class="entry-content">
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
