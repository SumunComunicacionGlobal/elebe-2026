<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Añadir logo kit digital en el footer
// add_action( 'wp_footer', 'smn_logos_kit_digital' );
function smn_logos_kit_digital() {
    // check if is widgets admin page
    if ( is_admin() && isset( $_GET['page'] ) && $_GET['page'] === 'widgets.php' ) {
        return;
    }

    echo '<div class="text-center py-3 container">
        <img src="' . esc_url( get_stylesheet_directory_uri() . '/img/logos-kit-digital-web.png' ) . '" alt="'.__( 'Logos Kit Digital', 'smn' ).'">
    </div>';
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function understrap_posted_on() {

    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    }
    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );
    echo $time_string; // WPCS: XSS OK.

}



/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function understrap_entry_footer() {
	// Hide category and tag text for pages.
	if ( is_singular( 'post') ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'understrap' ) );
		if ( $categories_list && understrap_categorized_blog() ) {
			/* translators: %s: Categories of current post */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'understrap' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'understrap' ) );
		if ( $tags_list ) {
			/* translators: %s: Tags of current post */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'understrap' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	} else {

        $taxonomies = get_cursos_taxonomies();

        $tax_footer = '';

        foreach ($taxonomies as $taxonomy) {
            if (substr($taxonomy, 0, 3) !== 'pa_'){
                $list = get_the_term_list( get_the_ID(), $taxonomy, '', ', ', '' );
                if ($list) {
                    $tax_obj = get_taxonomy( $taxonomy );
                    $tax_footer .= '<div class="col-6 col-sm-4 mb-1">';
                        $tax_footer .= '<div class="item">';
                            $tax_footer .= '<div class="label">'.$tax_obj->labels->singular_name.'</div>';
                            $tax_footer .= '<div class="value cat-links">'. $list .'</div>';
                        $tax_footer .= '</div>';
                    $tax_footer .= '</div>';
                }
            }
        }
        if ('' != $tax_footer) {
            echo '<div class="row mt-5">'.$tax_footer.'</div>';
        }

	}
	// if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
	// 	echo '<span class="comments-link">';
	// 	comments_popup_link( esc_html__( 'Leave a comment', 'understrap' ), esc_html__( '1 Comment', 'understrap' ), esc_html__( '% Comments', 'understrap' ) );
	// 	echo '</span>';
	// }
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'understrap' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

function smn_get_breadcrumb() {

	if ( is_front_page() ) return false;

	ob_start();

	if(function_exists('bcn_display')) {
		echo '<div class="breadcrumb" typeof="BreadcrumbList" vocab="https://schema.org/">';
			echo '<div class="breadcrumb-inner">';
				bcn_display();
			echo '</div>';
		echo '</div>';
	} elseif ( function_exists( 'rank_math_the_breadcrumbs') ) {
		echo '<div class="breadcrumb">';
			echo '<div class="breadcrumb-inner">';
				rank_math_the_breadcrumbs(); 
			echo '</div>';
		echo '</div>';
	} elseif ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb( '<div id="breadcrumbs" class="breadcrumb"><div class="breadcrumb-inner">','</div></div>' );
	}

	$r = ob_get_clean();

	if ( $r ) {
		return '<div class="breadcrumb-wrapper py-1">' . $r . '</div>';
	}

}

function smn_breadcrumb() {
	
	$r = smn_get_breadcrumb();

	if ( $r ) {
		echo '<div class="container">';
			echo $r;
		echo '</div>';
	}

}

function smn_get_navbar_class() {

	$navbar_class = 'bg-primary navbar-dark';

	if ( is_singular() ) {

		$navbar_bg = get_post_meta( get_the_ID(), 'navbar_bg', true );

		switch ($navbar_bg) {
			case 'navbar-light':
				$navbar_class = 'bg-light navbar-light';
				break;

			case 'transparent':
				$navbar_class = 'navbar-dark';
				break;
			
			default:
				$navbar_class = 'bg-primary navbar-dark';
			break;
		}
	}

	return $navbar_class;

}

function get_flecha_svg() {
        $r = '<svg width="62px" height="23px" viewBox="0 0 62 23" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <!-- Generator: Sketch 55.2 (78181) - https://sketchapp.com -->
        <title>flecha-derecha-w</title>
        <desc>Created with Sketch.</desc>
        <g id="Welcome" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Desktop-HD" transform="translate(-307.000000, -1153.000000)" fill="#000000">
                <g id="arrow-down" transform="translate(338.500000, 1164.500000) rotate(-90.000000) translate(-338.500000, -1164.500000) translate(327.000000, 1133.000000)">
                    <path class="flecha" d="M20.795,51.489 L12.936,58.662 L12.936,1.42108547e-14 L10.404,1.42108547e-14 L10.404,58.756 L2.052,51.474 L-4.79616347e-14,52.408 L10.644,61.687 L10.645,61.686 C10.802,61.823 11.025,61.929 11.293,61.981 C11.822,62.086 12.397,61.961 12.712,61.674 L22.879,52.393 L20.795,51.489 Z"></path>
                </g>
            </g>
        </g>
    </svg>';

    return $r;
}



function get_colores() {
    $colores = array(
        array(
            'name'  => __( 'Primary #A1163B', 'sumun-admin' ),
            'slug'  => 'primary',
            'color' => '#A1163B',
        ),
        array(
            'name'  => __( 'Secondary #F9BB0B', 'sumun-admin' ),
            'slug'  => 'secondary',
            'color' => '#F9BB0B',
        ),
        array(
            'name'  => __( 'Black #010101', 'sumun-admin' ),
            'slug'  => 'black',
            'color' => '#010101',
        ),
        array(
            'name'  => __( 'Light #dadada', 'sumun-admin' ),
            'slug'  => 'light',
            'color' => '#dadada',
        ),
        array(
            'name'  => __( 'White #ffffff', 'sumun-admin' ),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
        array(
            'name'  => __( 'Rosa palo #F1DADE', 'sumun-admin' ),
            'slug'  => 'pale-pink',
            'color' => '#F1DADE',
        ),
        array(
            'name'  => __( 'Coral oscuro #EB5759', 'sumun-admin' ),
            'slug'  => 'dark-coral',
            'color' => '#EB5759',
        ),
        array(
            'name'  => __( 'Fucsia #d9304d', 'sumun-admin' ),
            'slug'  => 'fucsia',
            'color' => '#d9304d',
        ),
        array(
            'name'  => __( 'Amarillo #ffe000', 'sumun-admin' ),
            'slug'  => 'yellow',
            'color' => '#ffe000',
        ),
        array(
            'name'  => __( 'Camel #d5a100', 'sumun-admin' ),
            'slug'  => 'camel',
            'color' => '#d5a100',
        ),
        array(
            'name'  => __( 'Marrón #9d771f', 'sumun-admin' ),
            'slug'  => 'brown',
            'color' => '#9d771f',
        ),
        array(
            'name'  => __( 'Cyan #97c4d7', 'sumun-admin' ),
            'slug'  => 'cyan',
            'color' => '#97c4d7',
        ),
        array(
            'name'  => __( 'Rosa claro #e6ae9c', 'sumun-admin' ),
            'slug'  => 'pink',
            'color' => '#e6ae9c',
        ),
        array(
            'name'  => __( 'Azul oscuro #102f47', 'sumun-admin' ),
            'slug'  => 'dark-blue',
            'color' => '#102f47',
        ),
        array(
            'name'  => __( 'Azul #5175b9', 'sumun-admin' ),
            'slug'  => 'blue',
            'color' => '#5175b9',
        ),
        array(
            'name'  => __( 'Verde #75be81', 'sumun-admin' ),
            'slug'  => 'green',
            'color' => '#75be81',
        ),
        array(
            'name'  => __( 'Ámbar #efd459', 'sumun-admin' ),
            'slug'  => 'amber',
            'color' => '#efd459',
        ),
        array(
            'name'  => __( 'Verde mar #6da8a5', 'sumun-admin' ),
            'slug'  => 'sea-green',
            'color' => '#6da8a5',
        ),        
    );

    return $colores;
}

function get_colores_value( $key = 'slug' ) {
    $colores = get_colores();
    $values = array();
    foreach ($colores as $color) {
        $values[] = $color[$key];
    }

    return $values;
}

function get_random_color( $key = 'slug' ) {
    $values = get_colores_value();
    $quitar = array('white', 'light');
    $values = array_diff($values, $quitar);
    return $values[array_rand($values)];
}

function acf_load_color_field_choices( $field ) {
    
    $field['choices'] = array();
    $choices = get_colores_value();
    $remove = array('light', 'white', 'pale-pink', 'yellow');
    $choices = array_diff($choices, $remove);
    if( is_array($choices) ) {
        
        foreach( $choices as $choice ) {
            
            $field['choices'][ $choice ] = $choice;
            
        }
        
    }

    // return the field
    return $field;
}
add_filter('acf/load_field/name=color', 'acf_load_color_field_choices');

// add_action( 'after_setup_theme', 'editor_color_palette' );
// function editor_color_palette() {

//     $colores = get_colores();
//     add_theme_support( 'editor-color-palette', $colores );
// }