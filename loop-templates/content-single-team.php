<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('row'); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header col-md-4">

		<div class="sticky-sidebar">

			<div class="sidebar__inner">

				<?php echo get_the_post_thumbnail( $post->ID, 'large', array('class' => 'mb-4 mt-3 rounded-circle') ); ?>

				<?php the_title( '<h1 class="entry-title mb-0">', '</h1>' ); ?>

				<?php echo '<div class="text-muted">' . wpautop( $post->post_excerpt ) . '</div>'; ?>

			</div>

		</div>

	</header><!-- .entry-header -->

	<div class="entry-content col-md-8">

		<?php the_content(); ?>

		<footer class="entry-footer">

			<?php understrap_entry_footer(); ?>

		</footer><!-- .entry-footer -->

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
