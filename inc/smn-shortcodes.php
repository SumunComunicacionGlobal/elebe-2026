<?php 

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function contenido_pagina($atts) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
				'imagen'	=> 'no',
				'dominio'	=> false,

		), $atts)	
	);
	if ($dominio) {
		$api_url = $dominio . '/wp-json/wp/v2/pages/' . $id;
		$data = wp_remote_get( $api_url );
		$data_decode = json_decode( $data['body'] );

		// echo '<pre>'; print_r($data_decode); echo '</pre>';

		$content = $data_decode->content->rendered;
		return $content;
	} else {
		if ( 0 != $id) {
			$content_post = get_post($id);
			$content = $content_post->post_content;
			$content = '<div class="post-content-container">'.apply_filters('the_content', $content) .'</div>';
			if ('si' == $imagen) {
				$content = '<div class="entry-thumbnail">'.get_the_post_thumbnail($id, 'full') . '</div>' . $content;
			}
			return $content;
		}
	}
}
add_shortcode('contenido_pagina','contenido_pagina');

function home_url_shortcode() {
	return get_home_url();
}
add_shortcode('home_url','home_url_shortcode');

function theme_url_shortcode() {
	return get_stylesheet_directory_uri();
}
add_shortcode('theme_url','theme_url_shortcode');

function uploads_url_shortcode() {
	$upload_dir = wp_upload_dir();
	$uploads_url = $upload_dir['baseurl'];
	return $uploads_url;
}
add_shortcode('uploads_url','uploads_url_shortcode');

function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');

function term_link_sh( $atts ) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
		), $atts)	
	);
	$id = intval($id);
	return get_term_link( $id );
}
add_shortcode('cat_link', 'term_link_sh');

function post_link_sh( $atts ) {
	extract( shortcode_atts(
		array(
				'id' 	=> 0,
		), $atts)	
	);
	$id = intval($id);
	return get_the_permalink( $id );
}
add_shortcode('post_link', 'post_link_sh');

// Link Sumun
function link_sumun( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'texto' => 'Diseño web: Sumun.net',
			'url'	=> 'https://sumun.net',
		), $atts )
	);

    $link = '<a href="'.$url.'" target="_blank" rel="noopener noreferrer">'.$texto.'</a>';
    if (is_front_page()) {
        return $link;
    }
    return $texto;
}
add_shortcode( 'link_sumun', 'link_sumun' );

function paginas_hijas() {
	global $post;
	if ( is_post_type_hierarchical( $post->post_type ) /*&& '' == $post->post_content */) {
		$args = array(
			'post_type'			=> array($post->post_type),
			'posts_per_page'	=> -1,
			'post_status'		=> 'publish',
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC',
			'post_parent'		=> $post->ID,
		);
		$r = '';
		$query = new WP_Query($args);
		if ($query->have_posts() ) {
			$r .= '<div class="contenido-adicional mt-5">';
			// $r .= '<ul>';
			while($query->have_posts() ) {
				$query->the_post();
				// $r .= '<li>';
					$r .= '<a class="btn btn-primary btn-lg me-4 mb-2 pagina-hija" href="'.get_permalink( get_the_ID() ).'" title="'.get_the_title().'" role="button" aria-pressed="false">'.get_the_title().'</a>';
				$r .= '</li>';
			}
			// $r .= '</ul>';
			// $r .= '</div>';
		} elseif(0 != $post->post_parent) {
			wp_reset_postdata();
			$current_post_id = get_the_ID();
			$args['post_parent'] = $post->post_parent;
			$query = new WP_Query($args);
			if ($query->have_posts() && $query->found_posts > 1 ) {
				$r .= '<div class="contenido-adicional">';
				while($query->have_posts() ) {
					$query->the_post();
					$color = get_post_meta( get_the_ID(), 'color', true );
					if (!$color) $color = 'primary';

					if ($current_post_id == get_the_ID()) {
						$r .= '<span class="btn btn-'.$color.' btn-sm me-2 mb-2">'.get_the_title().'</span>';
					} else {
						$r .= '<a class="btn btn-outline-'.$color.' btn-sm me-2 mb-2" href="'.get_permalink( get_the_ID() ).'" title="'.get_the_title().'" role="button" aria-pressed="false">'.get_the_title().'</a>';
					}
				}
				$r .= '</div>';
			}
		}
		wp_reset_postdata();
		return $r;
	}
}
add_shortcode( 'paginas_hijas', 'paginas_hijas' );

add_filter('the_content', 'mostrar_paginas_hijas', 100);
function mostrar_paginas_hijas($content) {
	global $post;
	if (is_admin() || !is_singular() || !in_the_loop() || is_front_page() ) return $content;
	global $post;
	if ( 1 == get_post_meta( $post->ID, 'ocultar_paginas_hijas', true )) return $content;
	if (has_shortcode( $post->post_content, 'paginas_hijas' )) return $content;

	return $content . paginas_hijas();

}

function get_redes_sociales() {

	$r = '';
	
    $redes_sociales = array(
        'email' => 'envelope',
        'whatsapp' => 'whatsapp',
        'linkedin' => 'linkedin',
        'twitter' => 'twitter',
        'facebook' => 'facebook',
        'instagram' => 'instagram',
        'youtube' => 'youtube',
        'skype' => 'skype',
        'pinterest' => 'pinterest',
        'flickr' => 'flickr',
        'blog' => 'rss',
    );
    $r .= '<div class="redes-sociales">';

    foreach ($redes_sociales as $red => $fa_class) {
    	$url = get_theme_mod( $red, '' );
    	if( '' != $url) {
	    	$r .= '<a href="'.$url.'" target="_blank" rel="nofollow" title="'.sprintf( __( 'Abrir %s en otra pestaña', 'sumun' ), $red ).'"><span class="red-social '.$red.' fa fa-'.$fa_class.'"></span></a>';
    	}
    }

    // $r .= '<span class="follow-us">' . __( 'Síguenos', 'sumun' ) . '</span>';

    $r .= '</div>';

    return $r;

}
add_shortcode( 'redes_sociales', 'get_redes_sociales' );

function get_info_basica_privacidad() {

	$r = '';
	
	$text = get_theme_mod( 'info_privacidad_formularios', '' );
	if( '' != $text) {
		$r .= '<div class="info-basica-privacidad">';
	    	$r .= wpautop( $text );
		$r .= '</div>';
	}

    return $r;

}
add_shortcode( 'info_basica_privacidad', 'get_info_basica_privacidad' );

function sitemap() {
	$pt_args = array(
		'has_archive'		=> true,
	);
	$pts = get_post_types( $pt_args );
	// if (isset($pts['rl_gallery'])) unset $pts['rl_gallery'];
	$pts = array_merge( array('page'), $pts, array('post') );
	$r = '';

	foreach ($pts as $pt) {
		$pto = get_post_type_object( $pt );
		$taxonomies = get_object_taxonomies( $pt );

		$posts_args = array(
				'post_type'			=> $pt,
				'posts_per_page'	=> -1,
				'orderby'			=> 'menu_order',
				'order'				=> 'asc',
		);

		$posts_q = new WP_Query($posts_args);
		if ($posts_q->have_posts()) {

			$r .= '<h3 class="mt-3">'.$pto->labels->name.'</h3>';
			if ($taxonomies) {
				foreach ($taxonomies as $tax) {
					$terms = get_terms( array('taxonomy' => $tax) );
					foreach ($terms as $term) {
						$r .= '<a href="'.get_term_link( $term ).'" class="btn btn-dark btn-sm me-1 mb-1" role="button" aria-pressed="false">'.$term->name.'</a>';
					}
				}
			}

			while ($posts_q->have_posts()) { $posts_q->the_post();
				$r .= '<a href="'.get_the_permalink().'" class="btn btn-outline-primary btn-sm me-1 mb-1" role="button" aria-pressed="false">'.get_the_title().'</a>';
			}
		}

		wp_reset_postdata();
	}

	return $r;
}
add_shortcode( 'sitemap', 'sitemap' );

function listado_posts( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'post_type' => 'post',
			'taxonomy'	=> false,
			'posts_per_page'	=> -1,
			'row'		=> true,
		), $atts )
	);

	$r = '';

	$args = array(
		'post_type'			=> $post_type,
		'posts_per_page'	=> $posts_per_page,
	);

	if ($taxonomy) {
		$terms = get_terms( array(
			'taxonomy'		=> $taxonomy,
		) );
		if ($terms) {
			foreach ($terms as $term) {
				$args['tax_query'] = array(
					array(
						'taxonomy'			=> $taxonomy,
						'terms'				=> $term->term_id,
					)
				);

				$q = new WP_Query($args);
				if ($q->have_posts()) {
					$r .= '<h3>'.$term->name.'</h3>';
					if ($row) $r .= '<div class="row">';

					while ($q->have_posts()) { $q->the_post();
						ob_start();
						get_template_part( 'loop-templates/content', $post_type );
						$r .= ob_get_clean();
					}

					if ($row) $r .= '</div>';
				}
			}
		}
	} else {
		$q = new WP_Query($args);
		if ($q->have_posts()) {

			if ($row) $r .= '<div class="row">';
			
			while ($q->have_posts()) { $q->the_post();
				ob_start();
				get_template_part( 'loop-templates/content', $post_type );
				$r .= ob_get_clean();
			}

			if ($row) $r .= '</div>';
		}
	}




    return $r;
}
add_shortcode( 'listado_posts', 'listado_posts' );


function cursos_shortcode( $atts ) {

	$post_type = 'curso';
	if ( class_exists( 'woocommerce' ) ) {
		$post_type = 'product';
	}
	// Attributes
	extract( shortcode_atts(
		array(
			'post_type' 	=> $post_type,
			'plan'			=> false,
			'destacados'	=> false,
			'columnas'		=> 3,
		), $atts )
	);



	$r = '';

	$args = array(
		'post_type'			=> $post_type,
		'posts_per_page'	=> -1,
	);

	$tax_query = array();

	if($plan) {
		$tax_query[] = array(
			'taxonomy'			=> 'plan',
			'field'				=> 'slug',
			'terms'				=> $plan,
		);
 	}

	$meta_query = array();

 	if($destacados) {
 		if ( class_exists( 'woocommerce') ) {
			$tax_query[] = array(
				'taxonomy'			=> 'product_visibility',
				'field'				=> 'name',
				'terms'				=> 'featured',
				'operator'			=> 'IN',
			);
 		} else {
	 		$meta_query[] = array (
	 			'key'		=> 'destacado',
	 			'value'		=> '1',
	 			'type'		=> 'BINARY',
	 		);
	 	}
 	}

 	if (!empty($tax_query)) {
 		$args['tax_query'] = $tax_query;
 	}

 	if (!empty($meta_query)) {
 		$args['meta_query'] = $meta_query;
 	}

	global $q;
	$q = new WP_Query($args);
	if ($q->have_posts()) {

		$post_type_template = $post_type;
		if ('product' == $post_type) $post_type_template = 'curso';


		$r .= '<div class="row">';
		
		while ($q->have_posts()) { $q->the_post();
				ob_start();
				get_template_part( 'loop-templates/content', $post_type_template );
				$r .= ob_get_clean();
		}

		$r .= '</div>';
	}

	wp_reset_postdata();


    return $r;
}
add_shortcode( 'cursos', 'cursos_shortcode' );

function testimonios( $atts ) {
// function testimonios() {
	// Attributes
	extract( shortcode_atts(
		array(
			'categoria' 		=> false,
		), $atts )
	);

	if ($categoria) set_query_var( 'categoria_testimonio', $categoria );
	ob_start();
	get_template_part( 'global-templates/carousel-testimonios' );
	$r = ob_get_clean();

	return $r;
}
add_shortcode( 'testimonios', 'testimonios' );


function llamada_a_la_accion( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'titulo' 		=> '',
			'contenido'		=> '',
			'enlace'		=> false,
			'enlace_id'		=> false,
		), $atts )
	);

	$url = false;
	$post_type = 'page';

	if ($enlace_id && is_numeric($enlace_id)) {
		$url = get_the_permalink( $enlace_id );
		$post_type = get_post_type( $enlace_id );
	} else {
		$url = $enlace;
	}

	$fake_post_id = -99; // negative ID, to avoid clash with a valid post
	$fake_post = new stdClass();
	$fake_post->ID = $fake_post_id;
	$fake_post->post_author = 1;
	$fake_post->post_date = current_time( 'mysql' );
	$fake_post->post_date_gmt = current_time( 'mysql', 1 );
	$fake_post->post_title = $titulo;
	$fake_post->post_content = $contenido;
	$fake_post->post_excerpt = $contenido;
	$fake_post->post_status = 'publish';
	$fake_post->comment_status = 'closed';
	$fake_post->ping_status = 'closed';
	$fake_post->post_name = 'fake-page-' . rand( 1, 99999 ); // append random number to avoid clash
	$fake_post->post_type = $post_type;
	$fake_post->filter = 'raw'; // important!

	$wp_fake_post = new WP_Post( $fake_post );
	wp_cache_add( $fake_post_id, $wp_fake_post, 'posts' );

	$r = '';

	// $args = array(
	// 	'post__in'      => array($fake_post_id),
	// 	'post_type'		=> 'any',
	// );
	// $query = new WP_Query( $args );

	global $post;
	$post = $wp_fake_post;
	
	// echo '<pre>'; print_r($post); echo '</pre>';

	// if ($query->have_posts()) {
	// 	while ($query->have_posts()) { $query->the_post();
			ob_start();
			include(locate_template( 'loop-templates/content.php' ) );
			// get_template_part( 'loop-templates/content' );
			$r .= ob_get_clean();
	// 	}
	// }
	wp_reset_postdata();

	return $r;

}
add_shortcode( 'llamada_a_la_accion', 'llamada_a_la_accion' );

function taxonomia_shortcode( $atts ) {
	// Attributes
	extract( shortcode_atts(
		array(
			'taxonomy' 		=> 'modalidad',
			'hide_empty'	=> false,
			'post_type'		=> false,
		), $atts )
	);

	$terms = get_terms(
		array(
			'taxonomy'		=> $taxonomy,
			'hide_empty'	=> $hide_empty,
		)
	);

	if ($terms) {

		$r = '';

		foreach ($terms as $term) {
			$color = 'primary';
			if ('modalidad' == $taxonomy || 'product_cat' == $taxonomy ) {
				$color = get_field('color', $term);
			}
			$r .= '<a href="'.get_term_link( $term, $taxonomy ).'" class="btn btn-'.$color.' btn-lg not-arrow me-4 mb-3" title="'.$term->name.'">'.$term->name.'</a>';
		}

		if ($post_type) {
			$r .= '<a href="'.get_post_type_archive_link( $post_type ).'" class="btn btn-outline-primary btn-lg me-4 mb-3" title="'.__( 'Ver todo', 'elebe' )	.'">'.__( 'Ver todo', 'elebe' )	.'</a>';
		}

		return $r;
	}

}
add_shortcode( 'taxonomia', 'taxonomia_shortcode' );

function modalidades_shortcode( $atts ) {
	// Attributes
	extract( shortcode_atts(
		array(
			'taxonomy' 		=> 'product_cat',
			'hide_empty'	=> false,
		), $atts )
	);

	$terms = get_terms(
		array(
			'taxonomy'		=> $taxonomy,
			'hide_empty'	=> $hide_empty,
		)
	);

	if ($terms) {

		$r = '';

		$r .= '<div class="row my-1">';

		foreach ($terms as $term) {
			$color = 'primary';
			if ('modalidad' == $taxonomy || 'product_cat' == $taxonomy ) {
				$color = get_field('color', $term);
			}
			$r .= '<div class="col-sm-6 col-md-4 col-xl-3 mb-5">';
				$r .= '<div class="card h-100">';
					$r .= '<div class="card-body entry-content">';
						$r .= '<a href="'.get_term_link( $term, $taxonomy ).'" title="'.$term->name.'"><h2 class="card-title has-'.$color.'-color">'.$term->name.'</h2></a>';
						if(!is_404()) $r .= '<div class="term-description">' . term_description( $term, $taxonomy ) . '</div>';
					$r .= '</div>';
				$r .= '</div>';
			$r .= '</div>';
		}

		$r .= '</div>';

		return $r;
	}

}
add_shortcode( 'modalidades', 'modalidades_shortcode' );

function sumun_shortcode_subcategorias() {
	ob_start();
	get_template_part( 'global-templates/subcategories' );
	$r = ob_get_clean();

	return $r;
}
add_shortcode( 'subcategorias', 'sumun_shortcode_subcategorias' );

function sumun_shortcode_blog() {
	ob_start();
	get_template_part( 'global-templates/blog' );
	$r = ob_get_clean();

	return $r;
}
add_shortcode( 'blog', 'sumun_shortcode_blog' );

function sumun_shortcode_noticias() {
	ob_start();
	get_template_part( 'global-templates/noticias' );
	$r = ob_get_clean();

	return $r;
}
add_shortcode( 'noticias', 'sumun_shortcode_noticias' );

function sumun_shortcode_casos_de_exito() {
	ob_start();
	get_template_part( 'global-templates/casos-de-exito' );
	$r = ob_get_clean();

	return $r;
}
add_shortcode( 'casos_de_exito', 'sumun_shortcode_casos_de_exito' );

add_shortcode( 'breadcrumb', 'smn_get_breadcrumb' );
add_shortcode( 'breadcrumbs', 'smn_get_breadcrumb' );