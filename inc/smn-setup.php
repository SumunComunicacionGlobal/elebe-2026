<?php
/**
 * Theme basic setup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
}

$content_width = 1140;
add_image_size( 'cabecera', 1250, 240, true );
add_theme_support('editor-styles');
add_filter( 'widget_text', 'do_shortcode');
add_filter( 'wpcf7_form_elements', 'do_shortcode' );
function understrap_wpdocs_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}

add_action( 'after_setup_theme', 'smn_setup', 20 );
function smn_setup() {

	register_nav_menus( array(
        'legal' => __( 'Páginas legales', 'smn-admin' ),
	) );

    add_theme_support( 'appearance-tools' );

}

function understrap_all_excerpts_get_more_link( $post_excerpt ) {
	if ( ! is_admin() ) {
        global $post;
        if ( !$post->post_excerpt ) {
            $post_excerpt = $post_excerpt . ' [...]';
        }

        if ( is_search() ) return $post_excerpt;

        if ('product' != $post->post_type && 'course' != $post->post_type ) {
            
            $post_excerpt .= '<p><a class="read-more-arrow" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">'.get_flecha_svg().'</a></p>';

        } else {

            $post_excerpt .= '<div class="wp-block-buttons">';
                $post_excerpt .= '<div class="wp-block-button is-style-arrow-link">';
                    $post_excerpt .= '<a class="wp-block-button__link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">';
                        $post_excerpt .= __( 'Read More...', 'understrap' );
                    $post_excerpt .= '</a>';
                $post_excerpt .= '</div>';
            $post_excerpt .= '</div>';

        }

    }

	return $post_excerpt;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function custom_excerpt_length( $length ) {
     return 18;
}

add_filter( 'get_the_archive_title', 'prefix_category_title' );
function prefix_category_title( $title ) {
    if ( is_tax() || is_category() || is_tag() ) {
        $title = single_term_title( '', false );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }

        global $wp_query;
    if ( $wp_query->tax_query->queries ) {
        $array_term_names = array();
        foreach ( $wp_query->tax_query->queries as $query ) {
            foreach ( $query['terms'] as $term_slug ) {
                $term = get_term_by( 'slug', $term_slug, $query['taxonomy'] );
                $array_term_names[] = $term->name;
            }
        }

        if ($array_term_names) {
            $title = implode(' + ', $array_term_names);
        }
    }

    return $title;
}

add_action( 'pre_get_posts', 'smn_pre_get_posts' );
function smn_pre_get_posts($query) {
    if (!$query->is_main_query() || is_admin() ) return;

    if (is_search()) {
        $query->set('posts_per_page', 24);
    }
}