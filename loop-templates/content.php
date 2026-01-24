<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'hfeed-post' ); ?> id="post-<?php the_ID(); ?>">

	<div class="card bg-light border-0">	

		<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'card-img-top' ) ); ?>

		<div class="card-body">

			<header class="entry-header">

				<?php if ( 'post' === get_post_type() ) : ?>

					<div class="entry-meta">
						<?php understrap_posted_on(); ?>
					</div><!-- .entry-meta -->

				<?php endif; ?>

				<?php
				the_title(
					sprintf( '<h2 class="h5 entry-title"><a class="stretched-link" href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
					'</a></h2>'
				);
				?>

			</header><!-- .entry-header -->

			<div class="entry-content">

				<?php
				the_excerpt();
				understrap_link_pages();
				?>

			</div><!-- .entry-content -->

			<footer class="entry-footer">

				<?php understrap_entry_footer(); ?>

			</footer><!-- .entry-footer -->

		</div><!-- .card-body -->

	</div><!-- .card -->

</article><!-- #post-## -->
