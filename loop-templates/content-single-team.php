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

	<div class="col-sm-6 col-md-4 mb-3">

		<div class="sticky-sidebar">

			<div class="sidebar__inner">

				<div class="wp-block-image is-style-lined mb-0">

					<?php echo get_the_post_thumbnail( $post->ID, 'medium_large', array('class' => 'mb-0 w-100') ); ?>

				</div>

			</div>

		</div>

	</div><!-- .col -->

	<div class="entry-content col-md-8 align-self-center">

		<div class="bg-light p-2 p-md-3 rounded-3 single-team-content">

			<header class="entry-header">

				<?php smn_breadcrumb(); ?>

				<?php the_title( '<h1 class="entry-title mb-0">', '</h1>' ); ?>

				<?php echo '<div class="text-muted small">' . wpautop( $post->post_excerpt ) . '</div>'; ?>

			</header>

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

			<?php echo smn_get_random_bubble(); ?>

		</div><!-- .bg-pale-pink -->

		<?php echo smn_get_random_bubble(); ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
