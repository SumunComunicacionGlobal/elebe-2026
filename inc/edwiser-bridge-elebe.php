<?php 
function get_elebe_course_button($url = '') {
    $r = '<a href="'.$url.'" class="btn btn-outline-primary btn-lg me-3 mb-3" target="_blank" rel="noopener noreferrer">'.__( 'Acceder a Moodle', 'elebe' ).'</a>';

    return $r;
}

function get_elebe_inscripcion_button() {
    $r = '<a class="btn btn-primary btn-lg me-3 mb-3" data-bs-toggle="collapse" href="#collapse-inscribete" role="button" aria-expanded="false" aria-controls="collapse-inscripcion">'.__( 'Solicitar inscripcion', 'elebe' ).'</a>';

    return $r;
}

function get_elebe_mas_info_button() {
    $r = '<p>';

    $r .= '<a class="mas-info" data-bs-toggle="collapse" href="#collapse-mas-info" role="button" aria-expanded="false" aria-controls="collpase-mas-info" title="' . __( 'Quiero más información', 'elebe' ).'">[+] ' . __( 'Quiero más información', 'elebe' ).'</a>';

    global $product;
    if( 'visible' == $product->get_catalog_visibility() ) {
        $mensaje_regalo = sprintf( __( 'Para que hagas el %s en elebe, o elijas el que más te guste.', 'elebe' ), get_the_title() );

        $url = get_the_permalink( TARJETA_REGALO_ID );
        $url = add_query_arg( array(
            'gift'      => $product->get_price(),
            'ref'       => $mensaje_regalo,
        ), $url);
        // set_query_var('gift', $product->get_price() );
        // set_query_var('ref', $mensaje_regalo );

        $r .= '<a class="mas-info ml-3 ms-3 text-blue" href="'. $url .'" title="' . get_the_permalink( TARJETA_REGALO_ID ) .'">[+] ' . __( 'Regálalo', 'elebe' ).'</a>';
    }
    
    $r .= '</p>';

    return $r;
}

function sm_register_query_vars( $vars ) {
    $vars[] = 'gift';
    $vars[] = 'ref';

    return $vars;
} 
add_filter( 'query_vars', 'sm_register_query_vars' );

function get_elebe_inscripcion_form() {

    $r = '';

    $r .= '<div class="collapse" id="collapse-inscribete" data-bs-parent="#collapse-group">';
        $r .= '<div class="card card-body mb-3">';
            $r .= do_shortcode( '[contact-form-7 id="334" title="Solicita la inscripción en este curso"]' );
        $r .= '</div>';
    $r .= '</div>';

    return $r;
}

function get_elebe_mas_info_form() {

    $r = '';

    $r .= '<div class="collapse" id="collapse-mas-info" data-bs-parent="#collapse-group">';
        $r .= '<div class="card card-body mb-3 pt-3 bg-light">';
            $r .= '<h3>' . __( '+ info', 'elebe' ) . ' - '.get_the_title().'</h3>';
            $r .= do_shortcode( '[contact-form-7 id="132" title="Formulario de contacto"]' );
        $r .= '</div>';
    $r .= '</div>';

    return $r;
}

// add_filter('eb_course_access_button', 'modificar_boton_course_access', 10, 2);
function modificar_boton_course_access($access_button, $access_params) {

    $r = '';
    // $r .= get_elebe_inscripcion_button();
    // $r .= get_elebe_course_button($access_params['access_course_url']);

    $r .= str_replace(array('wdm-btn', 'eb_join_button'), array('btn btn-primary btn-lg', 'elebe_eb_join_button'), $access_button);

    return $r;

}

// add_filter('eb_course_closed_button', 'modificar_boton_closed_course', 10, 2);
function modificar_boton_closed_course($closed_button, $closed_params) {

    $r = '<a class="btn btn-light btn-lg disabled" aria-disabled="true">'.__( 'Curso cerrado', 'elebe' ).'</a>';

    return $r;

}

// add_filter('eb_course_login_button', 'modificar_boton_take_course', 10, 2);
function modificar_boton_take_course($login_button, $login_url) {

    global $post;
    $moodle_course_id = get_post_meta( $post->ID, 'moodle_course_id', true );    
    $moodle_course_url = EB_ACCESS_URL.'/course/view.php?id='.$moodle_course_id;

    $r = get_elebe_inscripcion_button();
    $r .= get_elebe_course_button($moodle_course_url);
    return $r;
}

// add_filter('eb_course_free_button', 'modificar_boton_free_course', 10, 2);
function modificar_boton_free_course($free_button, $post_id) {

    $moodle_course_id = get_post_meta( $post_id, 'moodle_course_id', true );

    $moodle_course_url = EB_ACCESS_URL.'/course/view.php?id='.$moodle_course_id;

    $r = get_elebe_inscripcion_button();
    $r .= get_elebe_course_button($moodle_course_url);
    return $r;

}

// add_filter('eb_course_payment_button', 'modificar_boton_paid_course', 10, 2);
function modificar_boton_paid_course($paypal_button, $payment_params) {

    print_r($payment_params);
    $moodle_course_id = $payment_params['post']->ID;
    $moodle_course_url = EB_ACCESS_URL.'/course/view.php?id='.$moodle_course_id;

    $r = get_elebe_inscripcion_button();
    $r .= get_elebe_course_button($moodle_course_url);

    return $r;

}


function get_course_random_image_url($dir = 'uploads')
{
    $dir = get_stylesheet_directory() . '/img/course-random-image/';
    $files = glob($dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    $file = array_rand($files);
    $url = str_replace(get_stylesheet_directory(), get_stylesheet_directory_uri(), $files[$file]);
    return $url;
}

