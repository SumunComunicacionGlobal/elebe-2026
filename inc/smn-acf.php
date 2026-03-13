<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


add_action('acf/init', 'sumun_init_block_types');
function sumun_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a block.
        acf_register_block_type(array(
            'name'              => 'team',
            'title'             => __('Equipo', 'sumun-admin'),
            'description'       => __('Muestra a los miembros del equipo'),
            'render_template'   => 'loop-templates/blocks/team.php',
            'category'          => 'embed',
            'icon'              => 'id',
            'keywords'          => array( 'team', 'equipo', 'persona', 'people' ),
        ));
    }
}		