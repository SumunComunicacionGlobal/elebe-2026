<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
* Crear panel de opciones en el customizador
*/
function sumun_new_customizer_settings($wp_customize) {
    // create settings section
    $wp_customize->add_panel('sumun_opciones', array(
        'title'         => __( 'Opciones de configuración', 'sumun-admin' ),
        'description'   => __( 'Opciones para este sitio web', 'sumun-admin' ),
        'priority'      => 1,
    ));

    $wp_customize->add_section('sumun_ajustes', array(
        'title'         => __( 'Otros ajustes', 'sumun-admin' ),
        'priority'      => 20,
        'panel'         => 'sumun_opciones',
    ));

    $wp_customize->add_setting('info_privacidad_formularios');
    $wp_customize->add_control( 'info_privacidad_formularios',   array(
        'type'      => 'textarea',
        'label'     => 'Información básica de privacidad para formularios',
        'description' => 'Esta información se puede reproducir en cualquier lugar con el shortcode [info_basica_privacidad].',
        'section'   => 'sumun_ajustes',
    ) );

}
add_action('customize_register', 'sumun_new_customizer_settings');
/***/
