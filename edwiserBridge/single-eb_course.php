<?php

/**
 * The template for displaying all single moodle courses.
 */
namespace app\wisdmlabs\edwiserBridge;

$wrapper_args = array();

$eb_template = get_option('eb_template');
if (isset($eb_template['single_enable_right_sidebar']) && $eb_template['single_enable_right_sidebar'] === 'yes') {
    $wrapper_args['enable_right_sidebar'] = true;
    $wrapper_args['parentcss'] = '';
} else {
    $wrapper_args['enable_right_sidebar'] = false;
    $wrapper_args['parentcss'] = 'width:100%;';
}
$wrapper_args['sidebar_id'] = isset($eb_template['single_right_sidebar']) ? $eb_template['single_right_sidebar'] : '';

$template_loader = new EbTemplateLoader(
    edwiserBridgeInstance()->getPluginName(),
    edwiserBridgeInstance()->getVersion()
);

$container = get_theme_mod( 'understrap_container_type' );

?>

<?php get_header(); ?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

            <main class="site-main" id="main">

                <?php do_action('eb_before_single_course'); ?>
                <?php

                $ebShrtcodeWrapper =  new EbShortcodeMyCourses();

                while (have_posts()) :
                    the_post();
                    $template_loader->wpGetTemplatePart('content-single', get_post_type());

                    $ebShrtcodeWrapper->generateRecommendedCourses();
                    comments_template();
                endwhile;
                ?>

                <?php do_action('eb_after_single_course'); ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check -->
            <?php get_template_part( 'global-templates/right-sidebar-check' ); ?>


        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #single-wrapper -->


<?php

if (file_exists(get_template_directory_uri().'/sidebar.php')) {
    get_sidebar();
}
?>
<?php

get_footer();
