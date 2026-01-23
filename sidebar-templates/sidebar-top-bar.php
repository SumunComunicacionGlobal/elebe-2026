<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if (is_active_sidebar( 'top-bar' )) { ?>
    
    <div id="wrapper-top-bar" class="top-bar">

        <div class="row">
            <?php dynamic_sidebar( 'top-bar' ); ?>
        </div>

    </div>

<?php } ?>

