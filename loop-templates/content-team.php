<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('col-md-6 col-xl-4 mb-5'); ?> id="post-<?php the_ID(); ?>">

	<div class="card card-body h-100">

		<div class="row">

			<div class="col-4">

				<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail', array('class' => 'rounded-circle mb-3') ); ?>

			</div>

			<div class="col-8">

				<div class="entry-content">


						<?php the_title( '<h5 class="mb-0">', '</h5>' ); ?>
						<?php if($post->post_excerpt != '') {
							echo '<p class="mb-2 text-muted">'.$post->post_excerpt.'</p>';
						}
						echo '<a class="btn btn-outline-primary btn-sm" href="'.get_the_permalink().'">'.__( 'Conóceme', 'elebe' ).'</a>';

						?> 

				</div><!-- .entry-content -->

			</div>

		</div>

	</div>


</article><!-- #post-## -->
