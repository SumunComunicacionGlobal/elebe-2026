<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('col-xl-3 hfeed-post' ); ?> id="post-<?php the_ID(); ?>">

	<div class="card bg-light h-100 position-relative">

			<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail', array('class' => 'card-img-top') ); ?>

			<div class="card-body">

				<div class="entry-content">


						<?php the_title( '<h2 class="h4">', '</h2>' ); ?>
						<?php if($post->post_excerpt != '') {
							echo '<p class="mb-2 text-muted small">'.$post->post_excerpt.'</p>';
						}
						echo '<a class="stretched-link fw-bold small" href="'.get_the_permalink().'">'.__( 'Conóceme', 'elebe' ).'</a>';

						?> 

				</div><!-- .entry-content -->

		</div><!-- .card-body -->

		<?php echo smn_get_random_arrow(); ?>

		<?php echo smn_get_random_bubble(); ?>

	</div>


</article><!-- #post-## -->
