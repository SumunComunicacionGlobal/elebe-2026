<?php
/**
 * Hero setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php
$args = array(
	'post_type'			=> 'slide',
	'posts_per_page'	=> -1,
	'orderby'			=> 'menu_order',
	'order'				=> 'ASC',

);

$q = new WP_Query($args);

if ($q->have_posts()) {

	$indicators = '';

	echo '<div id="slider-home" class="carousel slide d-none d-md-block" data-bs-ride="carousel" data-bs-interval="7000">';
		echo '<div class="carousel-inner">';

			while( $q->have_posts() ) {
				$q->the_post();
				$slide_actual = $q->current_post;
				$num_slide_actual = $slide_actual + 1;
				$class_active = '';
				if ($slide_actual == 0) {
					$class_active = 'active';
				}

				echo '<div class="carousel-item bg-cover '.$class_active.'">';
					echo '<div class="slide-wrapper">';
						echo '<div class="container">';
							echo '<div class="slide-content-wrapper">';
								// the_title( '<div class="slide-title">', '</div>');
									echo '<div class="row">';
										echo '<div class="col-md-5 slide-content align-self-center">';
											the_content();
										echo '</div>';
										echo '<div class="col-md-7 align-self-center text-center">';
											the_post_thumbnail( 'medium_large', array('class' => 'imagen-slide') );
										echo '</div>';
									echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';

				echo '</div>';

				$indicators .= '<li data-bs-target="#slider-home" data-bs-slide="next" class="'.$class_active.'">'.$num_slide_actual.'/'.$q->found_posts.'</li>';
			}

		echo '</div>';
		
		if ( '' != $indicators ) {
			echo '<ol class="carousel-indicators container">';
				echo $indicators;
			echo '</ol>';
		}
		/* echo '  <a class="carousel-control-prev" href="#slider-home" role="button" data-bs-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#slider-home" role="button" data-bs-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>'; */

		echo '<div class="carousel-flechas container">';
			echo '<a href="#slider-home" role="button" data-bs-slide="next">';
				echo '<svg width="159px" height="19px" viewBox="0 0 159 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				        <g id="slide" transform="translate(0.000000, -23.000000)" fill="#A0173B">
				            <g id="Group-3">
				                <path d="M147.1266,23.8934 L146.0356,25.4744 L154.6776,31.4374 L-0.0004,31.4374 L-0.0004,33.3574 L154.7916,33.3574 L146.0186,39.6944 L147.1426,41.2514 L158.3236,33.1754 C158.4876,33.0554 158.6146,32.8864 158.6786,32.6834 C158.8036,32.2824 158.6526,31.8454 158.3066,31.6064 L147.1266,23.8934 Z" id="Fill-2"></path>
				            </g>
				        </g>
				    </g>
				</svg>';
			echo '</a>';
		echo '</div>';


	echo '</div>';

	?>
	<script>
		jQuery('.slide-content a').addClass('btn btn-primary btn-lg').attr('role', 'button');
	</script>
	<?php 

	wp_reset_postdata();
}
