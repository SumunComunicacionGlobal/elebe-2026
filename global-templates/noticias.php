<?php

$args = array(
	'post_type'				=> array('post', 'tribe_events'),
	'posts_per_page'		=> 4
);

$q = new WP_Query($args);
?>

<?php if ( $q->have_posts() ) { ?>

		<div class="row no-gutters noticias" id="seccion-noticias">

			<?php while ( $q->have_posts() ) { $q->the_post(); ?>

				<?php if ($q->current_post == 0) { ?>
				
					<div class="col-lg-6 bg-primary p-2 py-4 ultima-noticia text-white">

						<div class="noticia-inner">

							<h3 class="h2"><a class="text-white" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title( '', '' ); ?></a></h3>
							<?php the_excerpt(); ?>

						</div>

					</div>

				<?php } else {

					if ($q->current_post == 1) echo '<div class="col-lg-6 noticias-anteriores"><div class="row no-gutters">';
					?>
				
					<div class="col-md-6 p-2 py-4 noticia-anterior">

						<div class="noticia-inner">

							<h3 class="h5"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title( '', '' ); ?></a></h3>

						</div>

					</div>

					<?php if ($q->current_post == count($q->posts) - 1) { 

						$noticias_id = get_option( 'page_for_posts' );
						if ($noticias_id) { ?>

							<div class="col-md-6 p-2 py-4 accede-actualidad">

								<div class="noticia-inner">

									<div class="h2">
										<a href="<?php echo get_the_permalink( $noticias_id ); ?>" title="<?php _e( 'Más contenido de interés', 'elebe' ); ?>"><?php _e( 'Más contenido de interés', 'elebe' ); ?>
											
											<p class="mt-3">
												<?php echo get_flecha_svg(); ?>
											</p>
										</a>
									</div>

								</div>

							</div>

							<?php
						}

						?>
			

					</div>

				</div>

					<?php } ?>


				<?php } ?>

			<?php } ?>

		</div>

		<?php
		?>

<?php } ?>

<?php wp_reset_postdata(); ?>

