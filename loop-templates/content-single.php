<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php smn_breadcrumb(); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php 
		if ( has_post_thumbnail() ) {
			echo '<div class="wp-block-image is-style-lined d-inline-block mb-4">';
				echo get_the_post_thumbnail( $post->ID, 'large' );
			echo '</div>';
		} ?>

		<div class="entry-meta">
		
			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

		<?php
		the_content();
		understrap_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
