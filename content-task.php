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
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
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
