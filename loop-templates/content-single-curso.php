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

	<header class="entry-header col-md-5">

		<div class="sticky-sidebar">

			<div class="sidebar__inner">

				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				<?php 
				if (has_post_thumbnail()) {

					echo get_the_post_thumbnail( $post->ID, 'large', array('class' => 'mb-5') ); 

				} else {

					echo '<img src="'.get_course_random_image_url().'" alt="'.get_the_title().'" title="'.get_the_title().'">';

				}
				?>

			</div>

		</div>

	</header><!-- .entry-header -->

	<div class="entry-content col-md-7">

		<!-- <div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div> --><!-- .entry-meta -->

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

		<footer class="entry-footer">

			<?php understrap_entry_footer(); ?>

		</footer><!-- .entry-footer -->

	</div><!-- .entry-content -->

</article><!-- #post-## -->
