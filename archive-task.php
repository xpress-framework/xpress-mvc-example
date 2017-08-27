<?php
/**
 * The template for displaying archive tasks
 *
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header tasks-header">
				<h1 class="page-title"><?php _e( 'Tasks', 'twentyfifteen' ); ?></h1>
				<form action="<?php echo esc_url( xpress_mvc_get_route_permalink( 'new-task' ) );?>" method="GET">
					<button type="submit"><span class=""><?php _e( 'New', 'twentyfifteen' ); ?></span></button>
				</form>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'task' );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
