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
        echo $r;
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
    //     $r = '<svg width="62px" height="23px" viewBox="0 0 62 23" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    //     <!-- Generator: Sketch 55.2 (78181) - https://sketchapp.com -->
    //     <title>flecha-derecha-w</title>
    //     <desc>Created with Sketch.</desc>
    //     <g id="Welcome" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    //         <g id="Desktop-HD" transform="translate(-307.000000, -1153.000000)" fill="#000000">
    //             <g id="arrow-down" transform="translate(338.500000, 1164.500000) rotate(-90.000000) translate(-338.500000, -1164.500000) translate(327.000000, 1133.000000)">
    //                 <path class="flecha" d="M20.795,51.489 L12.936,58.662 L12.936,1.42108547e-14 L10.404,1.42108547e-14 L10.404,58.756 L2.052,51.474 L-4.79616347e-14,52.408 L10.644,61.687 L10.645,61.686 C10.802,61.823 11.025,61.929 11.293,61.981 C11.822,62.086 12.397,61.961 12.712,61.674 L22.879,52.393 L20.795,51.489 Z"></path>
    //             </g>
    //         </g>
    //     </g>
    // </svg>';

    $r = '<svg width="106" height="31" id="Capa_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105.75 31.05">
                <g id="Capa_1-2" fill="var(--bs-primary)">
                    <path class="cls-1" d="M97.42,8.06c-.44-.46-.68-.74-.96-.98-1.25-1.09-2.51-2.16-3.75-3.26-.37-.33-.75-.66-1.06-1.04-.65-.81-.68-1.64-.13-2.26.56-.63,1.38-.7,2.25-.16.28.17.54.39.79.6,3.06,2.62,6.12,5.24,9.17,7.88.46.4.92.81,1.29,1.28,1.12,1.39.92,2.84-.53,3.85-.49.34-1.06.6-1.6.86-2.99,1.41-6,2.81-8.99,4.22-1.66.78-2.02.8-3.66.07-.13-1.46.74-2.33,1.91-2.94,2.06-1.06,4.16-2.05,6.24-3.07.47-.23.93-.47,1.35-.85-2.57-.99-5.17-1.31-7.76-.53-2.11.63-4.18,1.43-6.18,2.34-4.3,1.95-8.14,4.65-11.94,7.41-2.28,1.65-4.52,3.38-6.91,4.85-2.25,1.38-4.63,2.56-7.04,3.64-1.24.55-2.64.81-3.99,1-3.01.42-5.58-.58-7.52-2.91-.91-1.09-1.69-2.32-2.36-3.58-.83-1.55-1.48-3.2-2.23-4.8-.66-1.4-1.27-2.83-2.03-4.16-2.33-4.06-5.35-5.57-9.97-4.68-2.42.47-4.83,1.23-7.07,2.23-7.84,3.49-14.82,8.29-20.89,14.38-.47.47-.94.95-1.48,1.31-.59.4-1.26.4-1.83-.11-.56-.51-.65-1.17-.34-1.82.23-.49.57-.96.96-1.33,1.83-1.75,3.62-3.57,5.58-5.18,5.57-4.59,11.64-8.38,18.35-11.1,2.51-1.02,5.1-1.78,7.83-1.96,4.63-.3,8.34,1.36,10.92,5.23,1.03,1.55,1.85,3.26,2.67,4.94.98,1.98,1.77,4.05,2.8,6,2.25,4.24,4.64,5.23,9.13,3.5,2.45-.95,4.8-2.24,7.04-3.62,2.44-1.5,4.71-3.27,7.04-4.96,3.72-2.69,7.51-5.26,11.69-7.19,1.8-.83,3.66-1.55,5.52-2.23,2.1-.77,4.29-1.02,6.52-.88.3.02.61.02,1.19.03Z"/>
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

function smn_get_random_arrow() {

    $theme_dir = get_stylesheet_directory() . '/img/flechas';
    $theme_uri = get_stylesheet_directory_uri() . '/img/flechas';

    if ( is_dir( $theme_dir ) ) {
        $images = glob( $theme_dir . '/*.{jpg,jpeg,png,gif,svg,webp}', GLOB_BRACE );
        if ( $images && count( $images ) > 0 ) {
            $random_image = $images[ array_rand( $images ) ];
            // $image_url = $theme_uri . '/' . basename( $random_image );
            // $img_tag = '<img class="flecha-sobre-imagen" src="' . esc_url( $image_url ) . '" alt="'.__( 'Winker', 'elebe' ).'" class="random-arrow-image" />';
            $img_code = file_get_contents( $random_image );
            return '<span class="flecha-sobre-imagen">' . $img_code . '</span>';
        }
    }

    return false;
}

function smn_get_random_bubble() {
    $theme_dir = get_stylesheet_directory() . '/img/globos';
    $theme_uri = get_stylesheet_directory_uri() . '/img/globos';

    if ( is_dir( $theme_dir ) ) {
        $images = glob( $theme_dir . '/*.{jpg,jpeg,png,gif,svg,webp}', GLOB_BRACE );
        if ( $images && count( $images ) > 0 ) {
            $random_image = $images[ array_rand( $images ) ];
            $img_tag = '<img src="' . esc_url( $theme_uri . '/' . basename( $random_image ) ) . '" alt="'.__( 'Sprechblase', 'elebe' ).'" class="random-bubble-image" />';
            // $img_code = file_get_contents( $random_image );
            return '<span class="globo-sobre-imagen">' . $img_tag . '</span>';
        }

    }
}