<?php 

function get_cursos_taxonomies() {
    if (class_exists('woocommerce')) {
        $taxonomies = array(
            'idioma',
            'product_cat',
            // 'product_tag',
            'pa_fecha-de-inicio',
            'pa_horario',
            'pa_nivel'
        );
    } else {
        $taxonomies = array(
            'idioma',
            'modalidad',
            // 'tipo',
            'horario',
            'nivel'
        );
    }

    return $taxonomies;
}

function get_cursos_post_type() {
    $post_type = 'curso';
    if (class_exists('woocommerce')) {
        $post_type = 'product';
    }
}



// function rclr_query_string($q) {
//     foreach (get_taxonomies(array(), 'objects') as $taxonomy => $t) {
//         if ($t->query_var && !empty($q[$t->query_var])) {
//             if (is_array($q[$t->query_var])) {
//                 $q[$t->query_var] = implode(',', $q[$t->query_var]);
//             }
//         }
//     }
//     return $q;
// }

// add_filter('request', 'rclr_query_string', 1);

