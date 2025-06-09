<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>

<div class="main-nav-buttons d-flex align-items-center">
    <?php echo do_shortcode( '[xoo_wsc_cart]' ); ?>

    <?php 
        $my_account_id = get_option('woocommerce_myaccount_page_id');
        $my_account_link = get_permalink( $my_account_id );
        $my_account_title = get_the_title( $my_account_id );
    ?>

    <a class="nav-link main-nav-account-button text-white bg-dark rounded-pill p-1" href="<?php echo $my_account_link; ?>" title="<?php echo $my_account_title; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/user-icon.svg" alt="<?php $my_account_title; ?>" width="20" height="20"></a>
    <a class="nav-link main-nav-search-button bg-dark rounded-pill p-1" href="#search-collapse" data-bs-toggle="collapse" aria-expanded="false" aria-controls="search-collapse" title="<?php echo __( 'Search' ); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/search.svg" alt="<?php echo __( 'Search' ); ?>" width="20" height="20"></a>

</div>
