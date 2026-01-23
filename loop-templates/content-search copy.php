<?php
/**
 * Search results partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('search-loop'); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php
		$post_type = get_post_type();
		$pto = get_post_type_object( $post_type );

		the_title(
			sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h3>'
		);

		echo '<span class="post-type-name">'.$pto->labels->singular_name.'</span>';

		?>

	</header><!-- .entry-header -->

</article><!-- #post-## -->
