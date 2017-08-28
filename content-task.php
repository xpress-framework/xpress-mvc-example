<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<form action="<?php echo esc_url( xpress_mvc_get_route_permalink( 'update-task', array( 'slug' => $post->post_name ) ) );?>" method="POST">
			<input type="hidden" name="checked" value="<?php echo xpress_mvc_example_is_checked( $post ) ? 'false' : 'true';?>">
			<input type="hidden" name="title" value="<?php the_title();?>">
			<button type="submit"><span class="check-link <?php echo xpress_mvc_example_is_checked( $post ) ? 'checked-task' : '';?>"></span></button>
		</form>
		<?php the_title( sprintf( '<h2 class="entry-title">', '</h2>' ) ); ?>
	</header><!-- .entry-header -->

	<footer class="entry-footer">
		<form action="<?php echo esc_url( xpress_mvc_get_route_permalink( 'edit-task', array( 'slug' => $post->post_name ) ) );?>" method="GET">
			<button type="submit"><span class="edit-link"></span></button>
		</form>
		<form action="<?php echo esc_url( xpress_mvc_get_route_permalink( 'destroy-task', array( 'slug' => $post->post_name ) ) );?>" method="POST">
			<button type="submit"><span class="destroy-link"></span></button>
		</form>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
