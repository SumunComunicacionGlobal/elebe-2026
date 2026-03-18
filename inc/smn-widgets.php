<?php
/**
 * Declaring widgets
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/* Widget areas */

function understrap_widgets_init() {

    register_sidebar(
        array(
            'name'          => __( 'Top Bar', 'understrap' ),
            'id'            => 'top-bar',
            'description'   => __( 'Widget area for the top bar above the header', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="topbar-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Right Sidebar', 'understrap' ),
            'id'            => 'right-sidebar',
            'description'   => __( 'Right sidebar widget area', 'understrap' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Left Sidebar', 'understrap' ),
            'id'            => 'left-sidebar',
            'description'   => __( 'Left sidebar widget area', 'understrap' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );

    // register_sidebar(
    //     array(
    //         'name'          => __( 'Hero Slider', 'understrap' ),
    //         'id'            => 'hero',
    //         'description'   => __( 'Hero slider area. Place two or more widgets here and they will slide!', 'understrap' ),
    //         'before_widget' => '<div class="carousel-item">',
    //         'after_widget'  => '</div>',
    //         'before_title'  => '',
    //         'after_title'   => '',
    //     )
    // );

    // register_sidebar(
    //     array(
    //         'name'          => __( 'Hero Canvas', 'understrap' ),
    //         'id'            => 'herocanvas',
    //         'description'   => __( 'Full size canvas hero area for Bootstrap and other custom HTML markup', 'understrap' ),
    //         'before_widget' => '',
    //         'after_widget'  => '',
    //         'before_title'  => '',
    //         'after_title'   => '',
    //     )
    // );

    // register_sidebar(
    //     array(
    //         'name'          => __( 'Top Full', 'understrap' ),
    //         'id'            => 'statichero',
    //         'description'   => __( 'Full top widget with dynamic grid', 'understrap' ),
    //         'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
    //         'after_widget'  => '</div><!-- .static-hero-widget -->',
    //         'before_title'  => '<p class="widget-title">',
    //         'after_title'   => '</p>',
    //     )
    // );

    register_sidebar(
        array(
            'name'          => __( 'Footer Full', 'understrap' ),
            'id'            => 'footerfull',
            'description'   => __( 'Full sized footer widget 4 columns', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s col-md-6 col-lg-3">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Offcanvas', 'understrap' ),
            'id'            => 'offcanvas',
            'description'   => __( 'Widget area for the offcanvas menu or sidebar', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="offcanvas-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );

}

add_action( 'widgets_init', 'sumun_widgets_init', 20 );
function sumun_widgets_init() {
    
    register_sidebar(
        array(
            'name'          => __( 'Pre footer', 'understrap' ),
            'id'            => 'prefooter',
            'description'   => __( 'Aparece antes del Pie de Página Completo', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s col-12">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Copyright', 'understrap' ),
            'id'            => 'copyright',
            'description'   => __( 'Full sized footer widget with dynamic grid', 'understrap' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<p class="widget-title">',
            'after_title'   => '</p>',
        )
    );

}
/***/

/* Site info */
add_action( 'understrap_site_info', 'understrap_add_site_info' );

/**
 * Add site info content.
 */
function understrap_add_site_info() {
    if (is_active_sidebar( 'copyright' )) {
        echo '<div class="row">';
            dynamic_sidebar( 'copyright' );
        echo '</div>';
    }
}

/***/