<?php

$args = array(
	'post_type'				=> array('post', 'tribe_events'),
	'posts_per_page'		=> 4
);

$q = new WP_Query($args);
?>

<?php if ( $q->have_posts() ) { ?>

	<section class="" id="seccion-noticias">


		<div class="row no-gutters noticias">

			<?php while ( $q->have_posts() ) { $q->the_post(); ?>

				<?php if ($q->current_post == 0) { 

					$img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
					?>
				
					<div class="col-lg-6 bg-cover p-5 ultima-noticia text-white" <?php if ($img_url) echo 'style="background-image:url('.$img_url.');"' ;?> >

						<div class="noticia-inner">

							<h3><a class="text-white" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title( '', '' ); ?></a></h3>
							<?php the_excerpt(); ?>

						</div>

					</div>

				<?php } else {

					if ($q->current_post == 1) echo '<div class="col-lg-6 noticias-anteriores"><div class="row no-gutters">';
					?>
				
					<div class="col-md-6 p-5 noticia-anterior">

						<div class="noticia-inner">

							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title( '', '' ); ?></a></h3>
							<?php 
							$excerpt = get_the_excerpt();
							$excerpt = str_replace(
								array(
									'<p><a class="read-more-arrow',
									get_flecha_svg(),
									'</a></p>'
								),
								array( 
									'<a class="read-more-arrow-box',
									'',
									'</a>'
								),
								$excerpt);

							echo $excerpt;
							?>

						</div>

					</div>

					<?php if ($q->current_post == count($q->posts) - 1) { 

						$noticias_id = get_option( 'page_for_posts' );
						if ($noticias_id) { ?>

							<div class="col-md-6 p-5 accede-actualidad">

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


	</section>

<?php } ?>

<?php wp_reset_postdata(); ?>

