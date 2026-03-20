<?php
/**
 * Custom hooks.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'wpcf7_form_tag', 'smn_wpcf7_form_control_class', 10, 2 );
function smn_wpcf7_form_control_class( $scanned_tag, $replace ) {

   $excluded_types = array(
        'acceptance',
        'checkbox',
        'radio',
   );

   if ( in_array( $scanned_tag['type'], $excluded_types ) ) return $scanned_tag;

   switch ($scanned_tag['type']) {
    case 'submit':
        $scanned_tag['options'][] = 'class:btn';
        $scanned_tag['options'][] = 'class:btn-primary';
        break;
    
    default:
        $scanned_tag['options'][] = 'class:form-control';
        break;
   }
   
   return $scanned_tag;
}

add_action( 'loop_start', 'archive_loop_start', 10 );
function archive_loop_start( $query ) {

    if ( ( class_exists('woocommerce') && is_woocommerce() ) || isset( $query->query['ignore_row'] ) && $query->query['ignore_row'] ) return false;
    
    if ( ( isset( $query->query['add_row'] ) && $query->query['add_row'] ) || ( is_archive() || is_home() || is_search() ) ) {
        echo '<div class="row">';
    }
}

add_action( 'loop_end', 'archive_loop_end', 10 );
function archive_loop_end( $query ) {

    if ( ( class_exists('woocommerce') && is_woocommerce() ) || isset( $query->query['ignore_row'] ) && $query->query['ignore_row'] ) return false;

    if ( ( isset( $query->query['add_row'] ) && $query->query['add_row'] ) || ( is_archive() || is_home() || is_search() ) ) {
        echo '</div>';
    }
}

add_filter( 'body_class', 'smn_body_classes' );
function smn_body_classes( $classes ) {

    if ( is_page() ) {

        $navbar_bg = get_post_meta( get_the_ID(), 'navbar_bg', true );
        if ( 'transparent' == $navbar_bg ) {
            $classes[] = 'navbar-transparent';
        }

        $cmplz_pages = array(
            get_option('cmplz_privacy-statement_custom_page'),
            get_option('cmplz_impressum_custom_page'),
            get_option('cmplz_disclaimer_custom_page')
        );

        if (in_array(get_the_ID(), $cmplz_pages)) {
            $classes[] = 'cmplz-document';
        }
        
    } else {

    }

    return $classes;
}


add_filter( 'post_class', 'bootstrap_post_class', 10, 3 );
function bootstrap_post_class( $classes, $class, $post_id ) {

    if ( class_exists('woocommerce') && is_woocommerce() ) return $classes;

    if ( is_archive() || is_home() || is_search() || in_array( 'hfeed-post', $class ) ) {
        $classes[] = COL_CLASSES . ' stretch-linked-block'; 
    }

    return $classes;
}

add_filter( 'understrap_site_info_content', 'site_info_do_shortcode' );
function site_info_do_shortcode( $site_info ) {
    return do_shortcode( $site_info );
}

add_action( 'wp_body_open', 'top_anchor');
function top_anchor() {
    echo '<div id="top"></div>';
}

add_action( 'wp_footer', 'back_to_top' );
function back_to_top() {
    echo '<a href="#top" class="back-to-top"></a>';
}

function es_blog() {

    if( is_singular('post') || is_category() || is_tag() || ( is_home() && !is_front_page() ) ) {
        return true;
    }

    return false;
}

add_filter( 'theme_mod_understrap_sidebar_position', 'cargar_sidebar');
function cargar_sidebar( $valor ) {
    if ( es_blog() ) {
        $valor = 'right';
    } elseif (is_post_type_archive( 'curso' ) || ( is_tax() && 'curso' === get_post_type() ) ) {
        $valor = 'left';
    } elseif( is_archive() && is_woocommerce() ) {
        $valor = 'left';
    }
    return $valor;
}


function smn_nav_menu_submenu_css_class( $classes, $args, $depth ) {

    if ( !$args->walker && 'primary' === $args->theme_location ) {
        $classes[] = 'dropdown-menu';
        // $classes[] = 'collapse';
    }

    return $classes;

}
add_filter( 'nav_menu_submenu_css_class', 'smn_nav_menu_submenu_css_class', 10, 3 );

function smn_add_menu_item_classes( $classes, $item, $args ) {

    // echo '<pre>'; print_r($args); echo '<pre>';
 
    if ( !$args->walker && 'primary' === $args->theme_location ) {
        $classes[] = "nav-item";

        if( in_array( 'current-menu-item', $classes ) ) {
            $classes[] = "active";
        }

        if ( in_array( 'menu-item-has-children', $classes ) ) {
            $classes[] = 'dropdown';
        }
    
    }
 
    return $classes;
}
add_filter( 'nav_menu_css_class' , 'smn_add_menu_item_classes' , 10, 4 );

function smn_add_menu_link_classes( $atts, $item, $args ) {

    if ( !$args->walker && 'primary' == $args->theme_location ) {

    // echo '<pre>'; print_r($atts); echo '<pre>';

    if ( 0 == $item->menu_item_parent ) {
            $atts['class'] = 'nav-link';
        } else {
            $atts['class'] = 'dropdown-item';
        }
    }

    if ( in_array( 'menu-item-has-children', $item->classes ) ) {
        if ( isset( $atts['class'] ) ) $atts['class'] .= ' dropdown-toggle';
    }

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'smn_add_menu_link_classes', 10, 3 );

add_filter('nav_menu_item_args', function ($args, $item, $depth) {

    if ( !$args->walker && 'primary' == $args->theme_location ) {
        
        $args->link_after  = '<span class="sub-menu-toggler"></span>';

    }
    return $args;
}, 10, 3);

add_filter( 'parse_tax_query', 'smn_do_not_include_children_in_product_cat_archive' );
function smn_do_not_include_children_in_product_cat_archive( $query ) {
    if ( 
        ! is_admin() 
        && $query->is_main_query()
        && $query->is_tax( 'product_cat' )
    ) {
        $query->tax_query->queries[0]['include_children'] = 0;
    }
}

add_filter( 'the_tags', 'cat_list_como_botones', 10, 1 );
add_filter( 'the_category', 'cat_list_como_botones', 10, 1 );
function cat_list_como_botones($thelist) {
    $r = str_replace('<a ', '<a class="btn btn-secondary btn-sm" ', $thelist );
    return $r;
}

add_filter( 'next_post_link', 'post_navigation_como_botones', 10, 1 );
add_filter( 'previous_post_link', 'post_navigation_como_botones', 10, 1 );
function post_navigation_como_botones($output) {
    $r = str_replace('<a ', '<a class="btn btn-outline-primary mb-3" ', $output );
    return $r;
}

function getRefererPage( $form_tag ) {
    if ( isset($_SERVER['HTTP_REFERER']) && $form_tag['name'] == 'referer-page' ) {
        $form_tag['values'][] = htmlspecialchars($_SERVER['HTTP_REFERER']);
    }
    return $form_tag;
}
if ( !is_admin() ) {
    add_filter( 'wpcf7_form_tag', 'getRefererPage' );
}

function get_campos_acf( $fields = array(), $columnas = false ) {
    if (!$fields) {
        $fields = get_field_objects();
    }
    if( $fields ) {
        unset($fields['url_del_curso_en_moodle']);
        unset($fields['destacado']);

        $r = ($columnas) ? '<div class="fields row my-1">' : '<div class="fields inline">';

            foreach($fields as $field){

                // echo '<pre>'; print_r($field); echo '</pre>';

                if ($field['value'] ) {

                    $item = '';
                    $value = '';

                    if ($columnas) $item .= '<div class="col-sm-6 col-md-4 mb-2">';

                            $item .= '<div class="item">';
                                $item .= '<div class="label">';
                                    $item .= $field['label'];
                                $item .= '</div>';

                                $item .= '<div class="value">';

                                    if(isset($field['prepend'])) $item .= $field['prepend'].' ';
                                    if(isset($field['choices'])){
                                        if(is_array($field['value'])){
                                            $newarray = array();
                                            foreach($field['value'] as $value){
                                                $newarray[] = $field['choices'][$value];
                                            }
                                            $value .= implode(',',$newarray);
                                        } else {
                                            $value .= $field['choices'][$field['value']];
                                        }
                                    } else { 
                                        if(isset($field['sub_fields']) ){
                                            foreach ($field['sub_fields'] as $sub_field) {
                                                if ('' != $field['value'][$sub_field['name']])
                                                    $value .= '<div>' . $sub_field['label'] . ': ' . $field['value'][$sub_field['name']] . '</div>';
                                            }
                                        } else {
                                            $value .= $field['value']; 
                                        }
                                    }

                                    // echo $value;

                                    if ('' != $value) {
                                        $item .= $value;
                                        if(isset($field['append'])) $item .= ' '.$field['append'];
                                                    $item .= '</div>'; // .value

                                                $item .= '</div>'; // .item

                                        if ($columnas) $item .= '</div>'; // .col
                                        $r .= $item;
                                    }



                }

            }

        $r .= '</div>'; // .row

        return $r;

    }

    return false;
}


add_filter('the_content', 'mostrar_todos_los_campos_acf');
function mostrar_todos_los_campos_acf($content) {
    if (is_admin()) return $content;
    if (!is_singular('course') && !is_singular( 'product' )) return $content;

    $campos = get_campos_acf( false, true );

    if($campos) return $content . $campos;

    return $content;
}

// add_filter('the_excerpt', 'get_campos_resumen_curso');
function get_campos_resumen_curso( $content ) {
    if (is_admin()) return $content;
    if (!is_singular('course') && !is_singular( 'product' )) return $content;

    $fields = get_field_objects();
    // echo '<pre>'; print_r($fields); echo '</pre>';
    $selected_fields = array(
        $fields['precio'],
        $fields['fecha_inicio'],
    );

    $campos = get_campos_acf( $selected_fields );

    return $content . $campos;
}


add_filter('the_content', 'mostrar_botones_curso');
function mostrar_botones_curso($content) {
    if (is_admin()) return $content;
    if ( is_singular( 'curso' ) ) {

        $r = '';

        $r .= '<div id="collapse-group">';

            // $r .= get_elebe_inscripcion_button();

            $url_moodle = get_post_meta( get_the_ID(), 'url_del_curso_en_moodle', true );
            if ($url_moodle) {
                $r .= get_elebe_course_button( $url_moodle );
            }

            $r .= get_elebe_mas_info_button();

            $r .= get_elebe_inscripcion_form();

            $r .= get_elebe_mas_info_form();

        $r .= '</div>';

        return $r . $content;
    }

    return $content;
}

add_filter('the_content', 'mostrar_botones_curso_product');
function mostrar_botones_curso_product($content) {
    if (is_admin()) return $content;
    if ( is_singular( 'product' ) ) {

        $r = '';

        $r .= '<div id="collapse-group">';

            $r .= get_elebe_mas_info_button();

            $r .= get_elebe_mas_info_form();

        $r .= '</div>';

        return $r . $content;
    }

    return $content;
}

add_action( 'loop_start', 'elebe_loop_start' );
function elebe_loop_start( $query ){
    if( is_archive() && get_post_type() == 'curso' ) {
        echo '<div class="row">';
    }
}

add_action( 'loop_end', 'elebe_loop_end' );
function elebe_loop_end( $query ){
    if( is_archive() && get_post_type() == 'curso' ) {
        echo '</div>';
    }
}

add_action('wp_head', function() {
    if (is_front_page()) {
        $texto_bocadillo = get_field('texto_bocadillo_home', 'option');
        if (!empty($texto_bocadillo)) {
            echo '<style>
                .bocadillo-home {
                    content: "' . esc_attr( $texto_bocadillo ) . '";
                }
            </style>';
        }
    }
});