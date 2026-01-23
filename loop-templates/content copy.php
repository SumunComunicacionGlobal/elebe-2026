<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$style = '';
if (has_post_thumbnail( get_the_ID() )) {
	$bg_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
	$style = 'style="background-image:url('.$bg_url.');"';
}
if (isset($url)) {
	$link = $url;
} else {
	$link = esc_url( get_permalink() );
}

?>

<article <?php post_class('solapado'); ?> id="post-<?php the_ID(); ?>">

	<div class="row no-gutters mb-5">

		<div class="col-lg-6 p-4 solapado-izq bg-cover" <?php echo $style; ?>>

			<div class="overlay"></div>

			<header class="entry-header">

				<?php
				the_title(
					sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', $link ),
					'<p>'.get_flecha_svg().'</p></a></h2>'
				);
				?>

			</header><!-- .entry-header -->

		</div>

		<div class="col-lg-6 p-4 pt-5 pb-0 solapado-dch">



			<div class="entry-content">

				<?php if ( 'post' == get_post_type() ) : ?>

					<div class="entry-meta">
						<?php understrap_posted_on(); ?>
					</div><!-- .entry-meta -->

				<?php endif; ?>

				<?php the_excerpt(); ?>

				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
						'after'  => '</div>',
					)
				);
				?>

				<p class="text-right"><a class="btn btn-primary btn-lg" href="<?php echo $link; ?>" title="<?php _e( 'Saber más', 'elebe' ); ?>"><?php _e( 'Saber más', 'elebe' ); ?></a></p>

			</div><!-- .entry-content -->

		</div>

	</div>

</article><!-- #post-## -->
