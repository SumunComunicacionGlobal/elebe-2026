<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
global $q, $wp_query;
if (isset($q)) {
	$current_post = $q->current_post + 1;
} else {
	$current_post = $wp_query->current_post + 1;
}
$current_post = sprintf('%02d', $current_post);
// $color = get_random_color();
$color = 'black';

$tax = 'modalidad';
if (class_exists('woocommerce')) $tax = 'product_cat';
// $modalidades = wp_get_object_terms( get_the_ID(), $tax );
// if ($modalidades) {
// 	$color = get_field('color', $modalidades[0]);
// }
$primary_term_product_id = yoast_get_primary_term_id($tax);
$primary_term = get_term( $primary_term_product_id );
if ($primary_term_product_id) {
	$color = get_field('color', $primary_term);
}

$columnas = get_query_var( 'columnas', 2 );
if (is_woocommerce()) {
	global $woocommerce_loop;
	$columnas = $woocommerce_loop['columns'];
}

switch ($columnas) {
	case 6:
		$col_class = 'col-lg-2 col-md-4';
		break;
	case 4:
		$col_class = 'col-lg-3 col-md-6';
		break;
	case 3:
		$col_class = 'col-lg-4 col-md-6';
		break;
	
	default:
		$col_class = 'col-lg-6';
		break;
}


?>

<article <?php post_class('curso-destacado '.$col_class.' mb-4'); ?> id="post-<?php the_ID(); ?>">

	<div class="card">

		<div class="card-body entry-content">


				<?php
				echo '<a href="'.get_the_permalink().'">';
					the_title( '<h2 class="h3 card-title has-'.$color.'-color">', '</h2>' );
				echo '</a>';
				
				// show product cats as badges
				$product_cats = get_the_terms( get_the_ID(), 'product_cat' );
				if ( $product_cats && ! is_wp_error ( $product_cats ) ){
					echo '<div class="mb-1">';
					foreach ( $product_cats as $product_cat ) {
						$cat_color = get_field('color', $product_cat);
						if (empty($cat_color)) {
							$cat_color = 'primary';
						}
						echo '<a href="'.get_term_link( $product_cat ).'" class="badge badge-pill text-white me-1 mb-1 bg-'.$cat_color.'">'.esc_html( $product_cat->name ).'</a>';
					}
					echo '</div>';
				}

				?>

		</div><!-- .entry-content -->

	</div>

</article><!-- #post-## -->
