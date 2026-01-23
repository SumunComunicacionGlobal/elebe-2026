<?php 

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_post_type_support( 'page', 'excerpt' );
// add_action( 'init', 'sumun_settings', 1000 );
function sumun_settings() {  
    // register_taxonomy_for_object_type('category', 'page');  
}


if ( ! function_exists('custom_post_type_slide') ) {

// Register Custom Post Type
function custom_post_type_slide() {

	$labels = array(
		'name'                  => _x( 'Slides', 'Post Type General Name', 'sumun-admin' ),
		'singular_name'         => _x( 'Slide', 'Post Type Singular Name', 'sumun-admin' ),
		'menu_name'             => __( 'Slides', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Slides', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nueva Slide', 'sumun-admin' ),
		'new_item'              => __( 'Nueva Slide', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Slide', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Slide', 'sumun-admin' ),
		'view_item'             => __( 'Ver Slide', 'sumun-admin' ),
		'view_items'            => __( 'Ver Slide', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Slides', 'sumun-admin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 3,
		'menu_icon'             => 'dashicons-slides',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest' 			=> true,
		'taxonomies'			=> array(),
	);
	register_post_type( 'slide', $args );

}
add_action( 'init', 'custom_post_type_slide', 0 );

}



if ( ! function_exists('custom_post_type_team') ) {

// Register Custom Post Type
function custom_post_type_team() {

	$labels = array(
		'name'                  => _x( 'Miembros del equipo', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Miembro del equipo', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Miembros del equipo', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Miembros del equipo', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nuevo Miembro del equipo', 'sumun-admin' ),
		'new_item'              => __( 'Nuevo Miembro del equipo', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Miembro del equipo', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Miembro del equipo', 'sumun-admin' ),
		'view_item'             => __( 'Ver Miembro del equipo', 'sumun-admin' ),
		'view_items'            => __( 'Ver Miembro del equipo', 'sumun-admin' ),
		'featured_image'		=> __( 'Foto', 'sumun-admin' ),
		'set_featured_image'	=> __( 'Establecer Foto', 'sumun-admin' ),
		'remove_featured_image'	=> __( 'Quitar Foto', 'sumun-admin' ),
		'use_featured_image'	=> __( 'Usar como Foto', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Miembros del equipo', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'editor', 'excerpt', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-id',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest' 			=> true,
		'taxonomies'			=> array('area', 'cargo'),
	);
	register_post_type( 'team', $args );

}
add_action( 'init', 'custom_post_type_team', 0 );

}

if ( ! function_exists('custom_post_type_testimonio') ) {

// Register Custom Post Type
function custom_post_type_testimonio() {

	$labels = array(
		'name'                  => _x( 'Testimonios', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Testimonio', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Testimonios', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Testimonios', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nuevo Testimonio', 'sumun-admin' ),
		'new_item'              => __( 'Nuevo Testimonio', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Testimonio', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Testimonio', 'sumun-admin' ),
		'view_item'             => __( 'Ver Testimonio', 'sumun-admin' ),
		'view_items'            => __( 'Ver Testimonio', 'sumun-admin' ),
		'featured_image'		=> __( 'Foto de perfil', 'sumun-admin' ),
		'set_featured_image'	=> __( 'Establecer Foto de perfil', 'sumun-admin' ),
		'remove_featured_image'	=> __( 'Quitar Foto de perfil', 'sumun-admin' ),
		'use_featured_image'	=> __( 'Usar como Foto de perfil', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Testimonios', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'custom-fields', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 23,
		'menu_icon'             => 'dashicons-format-quote',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'taxonomies'			=> array('categoria_testimonio'),
	);
	register_post_type( 'testimonio', $args );

}
add_action( 'init', 'custom_post_type_testimonio', 0 );

}

if ( ! function_exists('custom_post_curso') ) {

// Register Custom Post Type
function custom_post_curso() {

	$labels = array(
		'name'                  => _x( 'Cursos', 'Post Type General Name', 'sumun' ),
		'singular_name'         => _x( 'Curso', 'Post Type Singular Name', 'sumun' ),
		'menu_name'             => __( 'Cursos', 'sumun-admin' ),
		'name_admin_bar'        => __( 'Cursos', 'sumun-admin' ),
		'add_new'               => __( 'Añadir nuevo Curso', 'sumun-admin' ),
		'new_item'              => __( 'Nuevo Curso', 'sumun-admin' ),
		'edit_item'             => __( 'Editar Curso', 'sumun-admin' ),
		'update_item'           => __( 'Actualizar Curso', 'sumun-admin' ),
		'view_item'             => __( 'Ver Curso', 'sumun-admin' ),
		'view_items'            => __( 'Ver Curso', 'sumun-admin' ),
		'featured_image'		=> __( 'Imagen destacada', 'sumun-admin' ),
		'set_featured_image'	=> __( 'Establecer Imagen destacada', 'sumun-admin' ),
		'remove_featured_image'	=> __( 'Quitar Imagen destacada', 'sumun-admin' ),
		'use_featured_image'	=> __( 'Usar como Imagen destacada', 'sumun-admin' ),
	);
	$args = array(
		'label'                 => __( 'Cursos presenciales', 'sumun' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 33,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		// 'taxonomies'			=> array('eb_course_cat', 'cat_curso'),
		'taxonomies'			=> array('cat_curso', 'idioma', 'modalidad', 'tipo', 'nivel', 'plan', 'horario', 'fecha_inicio'),
	);
	// register_post_type( 'curso', $args );

}
add_action( 'init', 'custom_post_curso', 10 );

}

if ( ! function_exists('custom_taxonomy_modalidad') ) {

// Register Custom Taxonomy
function custom_taxonomy_modalidad() {

	$labels = array(
		'name'                       => _x( 'Modalidades', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Modalidad', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Modalidades', 'sumun-admin' ),
		'all_items'                  => __( 'Todas las Modalidades', 'sumun-admin' ),
		'parent_item'                => __( 'Modalidad superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Modalidad superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nueva Modalidad', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nueva Modalidad', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar Modalidad', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar Modalidad', 'sumun-admin' ),
		'view_item'                  => __( 'Ver Modalidad', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar Modalidades con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Modalidades', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'sumun-admin' ),
		'popular_items'              => __( 'Modalidades populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar Modalidad', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay Modalidades', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de Modalidades', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Modalidades', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'modalidad', array( 'curso', 'eb_course'/*, 'product'*/ ), $args );

}
// add_action( 'init', 'custom_taxonomy_modalidad', 10 );

}

if ( ! function_exists('custom_taxonomy_tipo_de_curso') ) {

// Register Custom Taxonomy
function custom_taxonomy_tipo_de_curso() {

	$labels = array(
		'name'                       => _x( 'Tipos de curso', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Tipo de curso', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Tipos de curso', 'sumun-admin' ),
		'all_items'                  => __( 'Todos los Tipos de curso', 'sumun-admin' ),
		'parent_item'                => __( 'Tipo de curso superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Tipo de curso superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nuevo Tipo de curso', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Tipo de curso', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar Tipo de curso', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar Tipo de curso', 'sumun-admin' ),
		'view_item'                  => __( 'Ver Tipo de curso', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar Tipos de curso con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Tipos de curso', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'sumun-admin' ),
		'popular_items'              => __( 'Tipos de curso populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar Tipo de curso', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay Tipos de curso', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de Tipos de curso', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Tipos de curso', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'tipo', array( 'curso', 'eb_course'/*, 'product'*/ ), $args );

}
// add_action( 'init', 'custom_taxonomy_tipo_de_curso', 10 );

}

if ( ! function_exists('custom_taxonomy_idioma') ) {

// Register Custom Taxonomy
function custom_taxonomy_idioma() {

	$labels = array(
		'name'                       => _x( 'Idiomas', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Idioma', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Idiomas', 'sumun-admin' ),
		'all_items'                  => __( 'Todos los Idiomas', 'sumun-admin' ),
		'parent_item'                => __( 'Idioma superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Idioma superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nuevo Idioma', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Idioma', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar Idioma', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar Idioma', 'sumun-admin' ),
		'view_item'                  => __( 'Ver Idioma', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar Idiomas con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Idiomas', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'sumun-admin' ),
		'popular_items'              => __( 'Idiomas populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar Idioma', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay Idiomas', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de Idiomas', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Idiomas', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'idioma', array( 'curso', 'eb_course', 'product' ), $args );

}
add_action( 'init', 'custom_taxonomy_idioma', 10 );

}

if ( ! function_exists('custom_taxonomy_nivel') ) {

// Register Custom Taxonomy
function custom_taxonomy_nivel() {

	$labels = array(
		'name'                       => _x( 'Niveles', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Nivel', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Niveles', 'sumun-admin' ),
		'all_items'                  => __( 'Todos los Niveles', 'sumun-admin' ),
		'parent_item'                => __( 'Nivel superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Nivel superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nuevo Nivel', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Nivel', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar Nivel', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar Nivel', 'sumun-admin' ),
		'view_item'                  => __( 'Ver Nivel', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar Niveles con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Niveles', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'sumun-admin' ),
		'popular_items'              => __( 'Niveles populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar Nivel', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay Niveles', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de Niveles', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Niveles', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'nivel', array( 'curso', 'eb_course'/*, 'product'*/ ), $args );

}
// add_action( 'init', 'custom_taxonomy_nivel', 10 );

}

if ( ! function_exists('custom_taxonomy_horario') ) {

// Register Custom Taxonomy
function custom_taxonomy_horario() {

	$labels = array(
		'name'                       => _x( 'Horarios', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Horario', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Horarios', 'sumun-admin' ),
		'all_items'                  => __( 'Todos los Horarios', 'sumun-admin' ),
		'parent_item'                => __( 'Horario superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Horario superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nuevo Horario', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Horario', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar Horario', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar Horario', 'sumun-admin' ),
		'view_item'                  => __( 'Ver Horario', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar Horarios con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Horarios', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'sumun-admin' ),
		'popular_items'              => __( 'Horarios populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar Horario', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay Horarios', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de Horarios', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Horarios', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'horario', array( 'curso', 'eb_course'/*, 'product'*/ ), $args );

}
// add_action( 'init', 'custom_taxonomy_horario', 10 );

}



if ( ! function_exists('custom_taxonomy_fecha_inicio') ) {

// Register Custom Taxonomy
function custom_taxonomy_fecha_inicio() {

	$labels = array(
		'name'                       => _x( 'Fechas de inicio', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Fecha de inicio', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Fechas de inicio', 'sumun-admin' ),
		'all_items'                  => __( 'Todas las Fechas de inicio', 'sumun-admin' ),
		'parent_item'                => __( 'Fecha de inicio superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Fecha de inicio superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nueva Fecha de inicio', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nueva Fecha de inicio', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar Fecha de inicio', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar Fecha de inicio', 'sumun-admin' ),
		'view_item'                  => __( 'Ver Fecha de inicio', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar Fechas de inicio con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Fechas de inicio', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'sumun-admin' ),
		'popular_items'              => __( 'Fechas de inicio populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar Fecha de inicio', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay Fechas de inicio', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de Fechas de inicio', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Fechas de inicio', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'fecha_inicio', array( 'curso', 'eb_course'/*, 'product'*/ ), $args );

}
// add_action( 'init', 'custom_taxonomy_fecha_inicio', 10 );

}

if ( ! function_exists('custom_taxonomy_plan') ) {

// Register Custom Taxonomy
function custom_taxonomy_plan() {

	$labels = array(
		'name'                       => _x( 'Planes', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Plan', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Planes', 'sumun-admin' ),
		'all_items'                  => __( 'Todos los Planes', 'sumun-admin' ),
		'parent_item'                => __( 'Plan superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Plan superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nuevo Plan', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Plan', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar Plan', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar Plan', 'sumun-admin' ),
		'view_item'                  => __( 'Ver Plan', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar Planes con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Planes', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'sumun-admin' ),
		'popular_items'              => __( 'Planes populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar Plan', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay Planes', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de Planes', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Planes', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'plan', array( 'curso', 'eb_course', 'product' ), $args );

}
add_action( 'init', 'custom_taxonomy_plan', 10 );

}

if ( ! function_exists('custom_taxonomy_area') ) {

// Register Custom Taxonomy
function custom_taxonomy_area() {

	$labels = array(
		'name'                       => _x( 'Áreas', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Área', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Áreas', 'sumun-admin' ),
		'all_items'                  => __( 'Todas las Áreas', 'sumun-admin' ),
		'parent_item'                => __( 'Área superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Área superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nuevo Área', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Área', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar Área', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar Área', 'sumun-admin' ),
		'view_item'                  => __( 'Ver Área', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar Áreas con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Áreas', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'sumun-admin' ),
		'popular_items'              => __( 'Áreas populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar Área', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay Áreas', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de Áreas', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Áreas', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'area', array( 'team' ), $args );

}
add_action( 'init', 'custom_taxonomy_area', 10 );

}

if ( ! function_exists('custom_taxonomy_categoria_testimonio') ) {

// Register Custom Taxonomy
function custom_taxonomy_categoria_testimonio() {

	$labels = array(
		'name'                       => _x( 'Categorías de testimonios', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Categoría de testimonios', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Categorías de testimonios', 'sumun-admin' ),
		'all_items'                  => __( 'Todas las Categorías de testimonios', 'sumun-admin' ),
		'parent_item'                => __( 'Categoría de testimonios superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Categoría de testimonios superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nueva Categoría de testimonios', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nueva Categoría de testimonios', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar Categoría de testimonios', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar Categoría de testimonios', 'sumun-admin' ),
		'view_item'                  => __( 'Ver Categoría de testimonios', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar Categorías con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Categorías', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre las más usadas', 'sumun-admin' ),
		'popular_items'              => __( 'Categorías de testimonios populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar Categoría de testimonios', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay Categorías', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de Categorías', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Categorías', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'categoria_testimonio', array( 'testimonio' ), $args );

}
add_action( 'init', 'custom_taxonomy_categoria_testimonio', 10 );

}


if ( ! function_exists('custom_taxonomy_cargo') ) {

// Register Custom Taxonomy
function custom_taxonomy_cargo() {

	$labels = array(
		'name'                       => _x( 'Cargos', 'Taxonomy General Name', 'sumun' ),
		'singular_name'              => _x( 'Cargo', 'Taxonomy Singular Name', 'sumun' ),
		'menu_name'                  => __( 'Cargos', 'sumun-admin' ),
		'all_items'                  => __( 'Todos los Cargos', 'sumun-admin' ),
		'parent_item'                => __( 'Cargo superior', 'sumun-admin' ),
		'parent_item_colon'          => __( 'Cargo superior:', 'sumun-admin' ),
		'new_item_name'              => __( 'Nuevo Cargo', 'sumun-admin' ),
		'add_new_item'               => __( 'Añadir nuevo Cargo', 'sumun-admin' ),
		'edit_item'                  => __( 'Editar Cargo', 'sumun-admin' ),
		'update_item'                => __( 'Actualizar Cargo', 'sumun-admin' ),
		'view_item'                  => __( 'Ver Cargo', 'sumun-admin' ),
		'separate_items_with_commas' => __( 'Separar Cargos con comas', 'sumun-admin' ),
		'add_or_remove_items'        => __( 'Añadir o quitar Cargos', 'sumun-admin' ),
		'choose_from_most_used'      => __( 'Elegir de entre los más usados', 'sumun-admin' ),
		'popular_items'              => __( 'Cargos populares', 'sumun-admin' ),
		'search_items'               => __( 'Buscar Cargo', 'sumun-admin' ),
		'not_found'                  => __( 'No encontrado', 'sumun-admin' ),
		'no_terms'                   => __( 'No hay Cargos', 'sumun-admin' ),
		'items_list'                 => __( 'Lista de Cargos', 'sumun-admin' ),
		'items_list_navigation'      => __( 'Navegación de la lista de Cargos', 'sumun-admin' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'cargo', array( 'team' ), $args );

}
add_action( 'init', 'custom_taxonomy_cargo', 10 );

}


function wpb_change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'portfolio_page' == $screen->post_type ) {
          $title = 'Título del proyecto';
     } elseif  ( 'slide' == $screen->post_type ) {
          $title = 'Título de la slide';
     } elseif  ( 'team' == $screen->post_type ) {
          $title = 'Nombre y apellidos';
     } elseif  ( 'testimonio' == $screen->post_type ) {
          $title = 'Nombre';
     }
  
     return $title;
}
add_filter( 'enter_title_here', 'wpb_change_title_text' );

// ADD NEW COLUMN
add_filter('manage_posts_columns', 'sumun_columns_head');
add_filter('manage_pages_columns', 'sumun_columns_head');
add_action('manage_posts_custom_column', 'sumun_columns_content', 10, 2);
add_action('manage_pages_custom_column', 'sumun_columns_content', 10, 2);
function sumun_columns_head($defaults) {
	// $defaults = array('featured_image' => 'Imagen') + $defaults;
    // $defaults['featured_image'] = 'Imagen';
    $defaults['excerpt'] = 'Resumen';

    return $defaults;
}
function add_modalidad_columns( $columns ) {
    $columns['color'] = __( 'Color', 'sumun-admin' );
    return $columns;
}
add_filter( 'manage_edit-modalidad_columns', 'add_modalidad_columns' );
add_filter( 'manage_edit-product_cat_columns', 'add_modalidad_columns' );

function add_modalidad_column_content( $content, $column_name, $term_id ) {
    $term = get_term( $term_id );
    switch ($column_name) {
        case 'color':
        	echo get_field('color', $term);
            break;
        default:
            break;
    }
    return $content;
}
add_filter( 'manage_modalidad_custom_column', 'add_modalidad_column_content', 10, 3 );
add_filter( 'manage_product_cat_custom_column', 'add_modalidad_column_content', 10, 3 );


function sumun_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
    	echo '<div style="height:100px;">' . get_the_post_thumbnail( $post_ID, array(80,80) ) . '</div>';

    }
    if ($column_name == 'excerpt') {
    	$post = get_post($post_ID);
    	if ('' != $post->post_excerpt) {
	    	echo $post->post_excerpt;
    	} else {
    		echo '<b>'.__( 'El resumen está vacío', 'sumun-admin' ).'</b><br>';
    		echo '<b>'.__( 'Contenido', 'sumun-admin' ) . '</b>: ' . wp_trim_words( $post->post_content, 35, '...' );
    	}
    }
}