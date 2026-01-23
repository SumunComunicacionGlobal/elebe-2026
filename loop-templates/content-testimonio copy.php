<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$colors = array(
	'primary',
	'dark-coral',
	'fucsia',
	'camel',
	'brown',
	'cyan',
	'dark-blue',
	'blue',
	'green',
	'sea-green',
);
$color = $colors[array_rand($colors)];
$bg_color_class = 'has-'.$color.'-background-color';
?>


<article <?php post_class($bg_color_class); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

		<div class="testimonio-content">
			<?php the_content(); ?>
		</div>
	
		<?php the_title( '<p class="testimonio-nombre">', '</p>' ); ?>


	</div><!-- .entry-content -->

</article><!-- #post-## -->

