<?php 

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Homogeneiza el breakpoint de WC con el de WP
add_filter( 'woocommerce_style_smallscreen_breakpoint', function() {
    return '782px'; 
});

// Desactivar marcas
add_action( 'init', function() {
    update_option( 'wc_feature_woocommerce_brands_enabled', 'no' );
} );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

remove_filter( 'woocommerce_loop_add_to_cart_link', 'understrap_loop_add_to_cart_link' );
 
// replace woocommerce breadcrumbs with smn_breadcrumb
function woocommerce_breadcrumb() {
    smn_breadcrumb();
}

// remove loop product category count mark
add_filter( 'woocommerce_subcategory_count_html', '__return_null' );

add_filter( 'woocommerce_product_review_comment_form_args', 'smn_review_form_args' );
function smn_review_form_args( $args ) {

    foreach( $args['fields'] as $key => $field_html ) {
        $args['fields'][$key] = str_replace( 
            array(
                '<input ', 
                '<textarea ',
            ),
            array(
                '<input class="form-control" ', 
                '<textarea class="form-control" ', 
            ),
        $field_html );
    }

    return $args;
}

// remove the subcategories from the product loop
remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );

// add subcategories before the product loop (yet after catalog_ordering and result_count -> see priority 40)
add_action( 'woocommerce_before_shop_loop', 'smn_show_product_subcategories', 40 );

function smn_show_product_subcategories() {
    $subcategories = woocommerce_maybe_show_product_subcategories();
        if ($subcategories) {
          echo '<div class="row subcategories">',$subcategories,'</div>';
    }
}






add_filter( 'woocommerce_price_trim_zeros', '__return_true' );
add_filter( 'woocommerce_product_subcategories_hide_empty', '__return_false' );

add_action( 'after_setup_theme', function() {
  remove_theme_support( 'wc-product-gallery-zoom' );
  remove_theme_support( 'wc-product-gallery-lightbox' );
  // remove_theme_support( 'wc-product-gallery-slider' );
}, 20);

add_filter( 'woocommerce_single_product_image_thumbnail_html', function( $html ) {
  // Remove anchor tags from the product image HTML
  return preg_replace( '/<a[^>]*>(.*?)<\/a>/is', '$1', $html );
}, 20 );

/**
 * Change the placeholder image
 */
add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
function custom_woocommerce_placeholder_img_src( $src ) {
  if (is_admin()) return $src;

  if (is_singular( 'product' )) {
    $term_principal_id = false;
    $terms = wp_get_post_terms( get_the_ID(), 'product_cat', array('fields' => 'ids') );
    if (count($terms) > 1) {
      if (class_exists('WPSEO_Primary_Term')) {
        $term_principal_id = yoast_get_primary_term_id('product_cat', get_the_ID());
      }
    } elseif(count($terms) == 1) {
      $term_principal_id = $terms[0];
    }
    if ($term_principal_id) {
      $thumbnail_id = get_term_meta( $term_principal_id, 'thumbnail_id', true );
      if( $thumbnail_id ) $src = wp_get_attachment_url( $thumbnail_id );
    }
  }
  // $upload_dir = wp_upload_dir();
  // $uploads = untrailingslashit( $upload_dir['baseurl'] );
  // $src = get_course_random_image_url();
   
  return $src;
}

// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'elebe_woocommerce_template_single_excerpt', 20 );
function elebe_woocommerce_template_single_excerpt() {
  global $product;

  the_content();
  do_action( 'woocommerce_product_additional_information', $product );
  echo '<div class="entry-footer">';
    understrap_entry_footer();
  echo '</div>';
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 15 );



// Remove description tab
add_filter( 'woocommerce_product_tabs', 'elebe_remove_description_tab', 11 );
function elebe_remove_description_tab( $tabs ) {
 
  unset( $tabs['description'] );
  unset( $tabs['additional_information'] );
  return $tabs;
 
}

function sumun_woocommerce_taxonomy_args_product_tag( $array ) {
    $array['hierarchical'] = true;
    return $array;
};
add_filter( 'woocommerce_taxonomy_args_product_tag', 'sumun_woocommerce_taxonomy_args_product_tag', 10, 1 );

function translate_woocommerce($translation, $text, $domain) {
    if ($domain == 'woocommerce') {
        switch ($text) {
            case 'SKU':
                $translation = __( 'Código', 'elebe' );
                break;
            case 'SKU:':
                $translation = __( 'Código:', 'elebe' );
                break;
            case 'Billing details':
                $translation = __( 'Datos de matriculación y facturación', 'elebe' );
                break;
            // case 'Proceed to checkout':
            //     $translation = __( 'Finalizar matriculación', 'elebe' );
            //     break;
            // case 'Your order':
            //     $translation = __( 'Tus matrículas', 'elebe' );
            //     break;
        }
    }
    return $translation;
}
add_filter('gettext', 'translate_woocommerce', 10, 3);

add_filter( 'woocommerce_product_related_products_heading', 'elebe_titulo_cursos_relacionados' );
function elebe_titulo_cursos_relacionados( $title ) {
  return __( 'Sie könnten auch interessiert sein an', 'elebe' );
}


add_action( 'woocommerce_product_options_general_product_data', 'enable_virtual_option' );
function enable_virtual_option(){
?>

        <script>

            (function($){
                $('input[name=_virtual]').prop('checked', true);
            })(jQuery);

            jQuery(document).on('woocommerce_variations_loaded', function(event) { 
                jQuery('input.variable_is_virtual').prop('checked', true);
            }); 

        </script>

        <?php

}

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text', 10, 2 );
function woocommerce_custom_single_add_to_cart_text( $var, $instance ) {
  if ($instance->is_type( PWGC_PRODUCT_TYPE_SLUG )) {
    return __( 'Gutschein kaufen', 'elebe' );
  } elseif('yes' == get_post_meta( get_the_ID(), '_alg_wc_product_open_pricing_enabled', true )) {
    return __( 'Pagar', 'elebe' ); 
  }
  return __( 'Matricúlate', 'elebe' ); 

}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text', 10, 2 );  
function woocommerce_custom_product_add_to_cart_text( $var, $instance ) {
    return __( 'Matricúlate', 'elebe' ); 
}

// Vendido individualmente por defecto
function default_no_quantities( $individually, $product ){
$individually = true;
return $individually;
}
add_filter( 'woocommerce_is_sold_individually', 'default_no_quantities', 10, 2 );

add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'elebe_dropdown_variation_attribute_options', 10, 1);
function elebe_dropdown_variation_attribute_options($args) {
  $args['class'] = 'custom-select';
  return $args;
}

/* Customize Product Categories Labels */
add_filter( 'woocommerce_taxonomy_args_product_cat', 'custom_wc_taxonomy_args_product_cat' );
function custom_wc_taxonomy_args_product_cat( $args ) {
  $args['label'] = __( 'Modalidades', 'woocommerce' );
  $args['labels'] = array(
        'name'        => __( 'Modalidades', 'woocommerce' ),
        'singular_name'   => __( 'Modalidad', 'woocommerce' ),
        'menu_name'     => _x( 'Modalidades', 'Admin menu name', 'woocommerce' ),
        'search_items'    => __( 'Buscar Modalidades', 'woocommerce' ),
        'all_items'     => __( 'Todas las Modalidades', 'woocommerce' ),
        'parent_item'     => __( 'Modalidad superior', 'woocommerce' ),
        'parent_item_colon' => __( 'Modalidad superior:', 'woocommerce' ),
        'edit_item'     => __( 'Editar Modalidad', 'woocommerce' ),
        'update_item'     => __( 'Actualizar Modalidad', 'woocommerce' ),
        'add_new_item'    => __( 'Añadir nueva Modalidad', 'woocommerce' ),
        'new_item_name'   => __( 'Nombre de la nueva modalidad', 'woocommerce' )
  );

  return $args;
}
// add_filter( 'woocommerce_taxonomy_args_product_cat', 'custom_wc_taxonomy_label_product_cat' );
function custom_wc_taxonomy_label_product_cat( $args ) {
  $args['label'] = 'My Categories';
  $args['labels'] = array(
        'name'        => 'Mis Modalidades',
        'singular_name'   => 'Mis Modalidades',
        'menu_name'     => 'Mis Modalidades'
  );

  return $args;
}
// add_action( 'init', 'custom_wc_product_cat_label' );
function custom_wc_product_cat_label() {
    global $wp_taxonomies;

    if ( isset( $wp_taxonomies['product_cat'] ) ) {
      $cat = $wp_taxonomies['product_cat'];
      $cat->label = 'Mis Modalidades';
      $cat->labels->singular_name = 'Mi Modalidad';
      $cat->labels->name = $cat->label;
      $cat->labels->menu_name = $cat->label;
  }

}
/* Customize Product Tags Labels */
add_filter( 'woocommerce_taxonomy_args_product_tag', 'custom_wc_taxonomy_args_product_tag' );
function custom_wc_taxonomy_args_product_tag( $args ) {
  $args['label'] = __( 'Product Tags', 'woocommerce' );
  $args['labels'] = array(
      'name'        => __( 'Tipos', 'woocommerce' ),
      'singular_name'   => __( 'Tipo', 'woocommerce' ),
        'menu_name'     => _x( 'Tipos', 'Admin menu name', 'woocommerce' ),
      'search_items'    => __( 'Buscar Tipos', 'woocommerce' ),
      'all_items'     => __( 'Todos los Tipos', 'woocommerce' ),
      'parent_item'     => __( 'Tipo superior', 'woocommerce' ),
      'parent_item_colon' => __( 'Tipo superior:', 'woocommerce' ),
      'edit_item'     => __( 'Editar Tipo', 'woocommerce' ),
      'update_item'     => __( 'Actualizar Tipo', 'woocommerce' ),
      'add_new_item'    => __( 'Añadir nuevo Tipo', 'woocommerce' ),
      'new_item_name'   => __( 'Nombre del nuevo Tipo', 'woocommerce' )
  );

  return $args;
}
// add_filter( 'woocommerce_taxonomy_args_product_tag', 'custom_wc_taxonomy_label_product_tag' );
function custom_wc_taxonomy_label_product_tag( $args ) {
  $args['label'] = 'Mi tipo';
  $args['labels'] = array(
      'name'        => 'Mi tipo',
      'singular_name'   => 'Mi tipo',
        'menu_name'     => 'Mi tipo'
  );

  return $args;
}
// add_action( 'init', 'custom_wc_product_tag_label' );
function custom_wc_product_tag_label() {
    global $wp_taxonomies;

    if ( isset( $wp_taxonomies['product_tag'] ) ) {
      $cat = $wp_taxonomies['product_tag'];
      $cat->label = 'Mi tipo';
      $cat->labels->singular_name = 'Mi tipo';
      $cat->labels->name = $cat->label;
      $cat->labels->menu_name = $cat->label;
  }

}

// add_action( 'woocommerce_after_add_to_cart_button', 'mostrar_boton_moodle_en_productos' );
function mostrar_boton_moodle_en_productos() {
  // global $post;
  // $product_options = get_post_meta( $post->ID, 'product_options', true );
  // if ($product_options && isset($product_options['moodle_course_id'])) {
  //   $moodle_course_id = $product_options['moodle_course_id'];
  //   $moodle_course_url = EB_ACCESS_URL.'/course/view.php?id='.$moodle_course_id;
  //     echo get_elebe_course_button( $moodle_course_url );
  // }

  if ( is_user_logged_in() ) {
    global $product;
    $product_visibility = $product->get_catalog_visibility();
    if ('search' != $product_visibility && 'hidden' != $product_visibility ) {
      $url = get_permalink( get_option('woocommerce_myaccount_page_id') );
      $url = wc_get_account_endpoint_url( 'my-account-courses' );
      echo '<a href="' . $url . '" class="btn btn-primary btn-lg ms-2">'.__( 'Mis cursos', 'elebe' ).'</a>';
    }
  }

}


// Product archive
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_filter( 'woocommerce_subcategory_count_html', 'wc_filter_woocommerce_subcat_count_html', 10, 2 );
function wc_filter_woocommerce_subcat_count_html( $mark_class_count_category_count_mark, $category ) {
$mark_class_count_category_count_mark = ' <mark class="count">' . $category->count . '</mark>';
return $mark_class_count_category_count_mark;
};

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
  function loop_columns() {
    return 3;
  }
}

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
  function jk_related_products_args( $args ) {
  $args['posts_per_page'] = 4;
  $args['columns'] = 4;
  return $args;
}

remove_action( 'woocommerce_no_products_found', 'wc_no_products_found', 10 );
add_action( 'woocommerce_no_products_found', 'elebe_no_products_found', 10 );
function elebe_no_products_found() {
  get_template_part( 'loop-templates/content', 'none' );
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 16 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'elebe_wc_onsale', 10, 2);
function elebe_wc_onsale( $html, $post_thumbnail_id ) {
  $search = '<figure class="woocommerce-product-gallery__wrapper">';
  // ob_start();
  $onsale = woocommerce_show_product_sale_flash();
  // $onsale = ob_get_clean();

  $html = str_replace($search, $onsale . $search, $html );
  return $html;
}


// CAMPOS CHECKOUT 
// Adding a custom checkout date field
add_filter( 'woocommerce_billing_fields', 'add_birth_date_billing_field', 20, 1 );
function add_birth_date_billing_field($billing_fields) {

    $billing_fields['billing_gender'] = array(
      'type'        => 'radio',
      'label'       => __('Género', 'elebe'),
      'class'       => array('form-row-wide'),
      'options'     => array(
        'male'   => __('Hombre', 'elebe'),
        'female' => __('Mujer', 'elebe'),
        'other'  => __('Otro', 'elebe', 'otro género'),
      ),
      'priority'    => 24,
      'required'    => true,
      'clear'       => true,
    );
    $billing_fields['billing_birth_date'] = array(
      'type'        => 'date',
      'label'       => __('Fecha de nacimiento (solo necesario para menores de edad o para la "Bildungskarenz")', 'elebe' ).')',
      //'class'       => array('form-row-wide'),
      'priority'    => 25,
      'required'    => false,
      'clear'       => true,
    );
    $billing_fields['billing_father_name'] = array(
        'type'        => 'text',
        'label'       => __('Nombre completo del padre o tutor legal (necesario si eres menor de edad)', 'elebe'),
        'class'       => array(),
        'priority'    => 26,
        'required'    => false,
        'clear'       => true,
    );
    $billing_fields['billing_mother_name'] = array(
        'type'        => 'text',
        'label'       => __('Nombre completo de la madre o tutora legal (necesario si eres menor de edad)', 'elebe'),
        'class'       => array('form-row-wide'),
        'priority'    => 26,
        'required'    => false,
        'clear'       => true,
    );
    // $billing_fields['billing_vat'] = array(
    //     'type'        => 'text',
    //     'label'       => __('VAT/NIF', 'elebe'),
    //     'class'       => array('form-row-wide'),
    //     'priority'    => 27,
    //     'required'    => true,
    //     'clear'       => true,
    // );
    return $billing_fields;
}

/**
 * Add checkbox field to the checkout
 **/
add_action('woocommerce_before_checkout_billing_form', 'my_custom_checkout_field');
function my_custom_checkout_field( $checkout ) {
 
    echo '<div id="renuncia-prolongacion">';
      // echo '<h3>'.__('My Checkbox: ').'</h3>';
   
      woocommerce_form_field( 'renuncia_prolongacion', array(
          'type'          => 'checkbox',
          // 'class'         => array('input-checkbox'),
          'label'         => __('Renuncio expresamente a la prolongación del curso (necesario para la "Bildungskarenz")', 'elebe'),
          'label_class'   => array('has-medium-font-size'),
          'required'  => false,
          ), $checkout->get_value( 'renuncia_prolongacion' ));
 
    echo '</div>';
}
 
/**
 * Update the order meta with field value
 **/
add_action('woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta');
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ($_POST['renuncia_prolongacion']) update_post_meta( $order_id, 'renuncia_prolongacion', esc_attr($_POST['renuncia_prolongacion']));
}


add_action( 'woocommerce_admin_order_data_after_billing_address', 'edit_woocommerce_checkout_page', 10, 1 );
function edit_woocommerce_checkout_page($order){
    global $post_id;
    $order = new WC_Order( $post_id );
    echo '<p><strong>'.__('Género').':</strong> ' . get_post_meta($order->get_id(), '_billing_gender', true ) . '</p>';
    echo '<p><strong>'.__('Fecha de nacimiento').':</strong> ' . get_post_meta($order->get_id(), '_billing_birth_date', true ) . '</p>';

    $renuncia = get_post_meta($order->get_id(), 'renuncia_prolongacion', true );
    if($renuncia == 1) {
      $renuncia = __( 'Sí', 'elebe' );
    } else {
      $renuncia = __( 'No', 'elebe' );
    }
     echo '<p><strong>'.__('Renuncia a la prolongación del curso', 'elebe-admin').':</strong> ' . $renuncia . '</p>';
    
    echo '<p><strong>'.__('Nombre del padre').':</strong> ' . get_post_meta($order->get_id(), '_billing_father_name', true ) . '</p>';
    echo '<p><strong>'.__('Nombre de la madre').':</strong> ' . get_post_meta($order->get_id(), '_billing_mother_name', true ) . '</p>';
}


// Check customer age
add_action('woocommerce_checkout_process', 'check_birth_date');
function check_birth_date() {
    if( isset($_POST['billing_birth_date']) && ! empty($_POST['billing_birth_date']) ){
        // Get customer age from birthdate
        $age = date_diff(date_create($_POST['billing_birth_date']), date_create('now'))->y;

        // Checking age and display an error notice avoiding checkout (and emptying cart)
        if( $age < 18 ){
            // wc_add_notice( __( "Al ser menor de edad necesitamos el nombre de tus padres o tutores legales","elebe" ), "error" );

            // WC()->cart->empty_cart(); // <== Empty cart (optional)
        }
    }
}

add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); 
function woo_custom_order_button_text() {
    return __( 'Realizar matrícula', 'elebe' ); 
}

add_action( 'wp_footer', 'autorrellenar_tarjeta_regalo' );
function autorrellenar_tarjeta_regalo() {
  $gift = get_query_var( 'gift' );
  $ref = get_query_var( 'ref' );
  echo $gift . $ref;
  ?>
  <script>
    <?php if ($gift) { ?>
      jQuery('select#gift-card-amount option[value="<?php echo $gift . ' €'; ?>"]').attr('selected', true);
    <?php } ?>
    <?php if ($ref) { ?>
      jQuery('#pwgc-message').html("<?php echo $ref; ?>");
    <?php } ?>

    // var queryString = window.location.search;
    // var urlParams = new URLSearchParams(queryString);
    // if ( urlParams.has('gift') ) {
    //   var optionValue = urlParams.get('gift') + ' €';
    //   $('select#gift-card-amount option[value="'+optionValue+'"]').attr('selected', true);
    // }
    // if ( urlParams.has('gift') ) {
    //   var ref = urlParams.get('ref');
    //   $('#pwgc-message').html(ref);
    // }
  </script>
  <?php
}

function get_elebe_carrito() {

  $r = '';
  if (!WC()->cart->is_empty()) {  
    $r .= '<a href="'.wc_get_cart_url().'" class="navbar-toggler navbar-cart" title="'.__( 'Cart', 'woocommerce' ).' / '.__( 'Completar matrícula', 'elebe' ).'"><span class="navbar-toggler-icon navbar-cart-icon"></span></a>';
  }
  return $r;
}
function elebe_carrito() {
  echo get_elebe_carrito();
}

add_action( 'template_redirect', 'redireccionar_edwiser_a_woocommerce' );
function redireccionar_edwiser_a_woocommerce() {

     if (current_user_can('manage_options')) return;

    if ( is_post_type_archive( 'eb_course' ) || is_tax('eb_course_cat') || is_singular( 'eb_course' ) ) {
      $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
      wp_redirect( $shop_page_url );
      die;
    }


    // if (current_user_can('manage_options')) {
    //   global $post;
    //   $post_meta = get_post_meta( $post->ID );
    //   echo '<pre>'; print_r( $post_meta  ); echo '</pre>';
    //  }

}

add_action( 'template_redirect', 'redireccionar_edwiser_mi_cuenta' );
function redireccionar_edwiser_mi_cuenta() {

  $dpath = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if ($dpath == site_url('/user-account') ) {
    $url = get_permalink( get_option('woocommerce_myaccount_page_id') );
    wp_redirect( $url );
    die;
  }
}

/*
 * Step 1. Add Link (Tab) to My Account menu
 */
add_filter ( 'woocommerce_account_menu_items', 'elebe_mis_cursos_link', 40 );
function elebe_mis_cursos_link( $menu_links ){
 
  $menu_links = array_slice( $menu_links, 0, 1, true ) 
  + array( 'my-account-courses' => __( 'Mis cursos online', 'elebe' ) )
  + array_slice( $menu_links, 1, NULL, true );
 
  return $menu_links;
 
}
/*
 * Step 2. Register Permalink Endpoint
 */
add_action( 'init', 'elebe_add_endpoint' );
function elebe_add_endpoint() {
 
  // WP_Rewrite is my Achilles' heel, so please do not ask me for detailed explanation
  add_rewrite_endpoint( 'my-account-courses', EP_PAGES );
 
}
/*
 * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
 */
add_action( 'woocommerce_account_my-account-courses_endpoint', 'elebe_my_account_endpoint_content' );
function elebe_my_account_endpoint_content() {
 
  echo do_shortcode( '[eb_my_courses user_id="" my_courses_wrapper_title="" recommended_courses_wrapper_title="" number_of_recommended_courses="4" my_courses_progress="1" ]' );
 
}
/*
 * Step 4
 */
// Go to Settings > Permalinks and just push "Save Changes" button.

add_filter( 'woocommerce_form_field_args', 'elebe_wc_form_field_args', 20, 3 );
function elebe_wc_form_field_args( $args, $key, $value = null ) {
    // Start field type switch case.
    switch ( $args['type'] ) {

      case 'checkbox':
        // echo '<pre>'; print_r($args); echo '</pre>';
        // $args['class'] = array( 'custom-control', 'custom-checkbox' );
        // $args['label_class'] = array( 'custom-control-label' );
        // $args['input_class'] = array( 'custom-control-input', 'input-lg' );
        $args['class'][] = 'form-check-wrapper form-check-wrapper-checkbox';
        $args['label_class'] = array('');
        $args['input_class'] = array('form-check-input');
        break;

      case 'radio':
        $classes = $args['class'];
        $args['class'][] = 'form-check-wrapper form-check-wrapper-radio';
        $args['label_class'] = array('');
        $args['input_class'] = array('form-check-input');
        break;
    } // end switch ($args).
    
    
    return $args;
  }

/* Remove the default WooCommerce 3 JSON/LD structured data */
function remove_output_structured_data() {
  remove_action( 'wp_footer', array( WC()->structured_data, 'output_structured_data' ), 10 ); // This removes structured data from all frontend pages
  remove_action( 'woocommerce_email_order_details', array( WC()->structured_data, 'output_email_structured_data' ), 30 ); // This removes structured data from all Emails sent by WooCommerce
}
add_action( 'init', 'remove_output_structured_data' );

/* Move archive description under products loop */
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 5 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_product_archive_description', 5 );

add_action( 'woocommerce_before_subcategory_title', function( $category ) {

$color_slug = get_field( 'color', 'product_cat_' . $category->term_id );

echo '<div class="category-image-wrapper">';
    echo '<div class="category-circle bg-' . esc_attr( $color_slug ) . '"></div>';
    echo '<div class="wp-block-image is-style-lined">';
}, 9 );

add_action( 'woocommerce_before_subcategory_title', function( $category ) {
    
    $color_slug = get_field( 'color', 'product_cat_' . $category->term_id );

    echo '</div>';
    echo '<div class="category-icon bg-' . esc_attr( $color_slug ) . '"></div>';
  echo '</div>';
}, 11 );

// Add an image wrapper around the product thumbnail in the product loop
add_action( 'woocommerce_before_shop_loop_item_title', function() {
    echo '<div class="product-image-wrapper">';
}, 9 );
add_action( 'woocommerce_before_shop_loop_item_title', function() {
    echo '</div>';
}, 11 );