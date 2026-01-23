<?php
/**
 * The template for displaying course archive content.
 */
//Variables
global $post;
$post_id = $post->ID;

// get currency
$payment_options = get_option('eb_paypal');
$currency = isset($payment_options['eb_paypal_currency']) ? $payment_options['eb_paypal_currency'] : 'USD';

$course_price_type = 'free';
$course_price = '0';
$short_description = '';

$course_options = get_post_meta($post_id, 'eb_course_options', true);
if (is_array($course_options)) {
    $course_price_type = (isset($course_options['course_price_type'])) ? $course_options['course_price_type'] : 'free';
    $course_price = (isset($course_options['course_price']) &&
            is_numeric($course_options['course_price'])) ?
            $course_options['course_price'] : '0';
    $course_closed_url = (isset($course_options['course_closed_url'])) ?
            $course_options['course_closed_url'] : '#';
    $short_description = (isset($course_options['course_short_description'])) ?
            $course_options['course_short_description'] : '';
}

if (is_numeric($course_price)) {
    if ($currency == 'USD') {
        $course_price_formatted = '$'.$course_price;
    } else {
        $course_price_formatted = $currency.' '.$course_price;
    }

    if ($course_price == 0) {
        $course_price_formatted = __('Free', 'eb-textdomain');
    }
}

$course_class = null;
$user_id = get_current_user_id();
$logged_in = !empty($user_id);
$enrollManag = app\wisdmlabs\edwiserBridge\edwiserBridgeInstance()->enrollmentManager();
$has_access = $enrollManag->userHasCourseAccess($user_id, $post->ID);

/*
 * To add class according to user access
 *
 */
if ($has_access) {
    $course_class = 'has-access';
    $h_title = __(sprintf('Click to access %s course', get_the_title(get_the_ID())), 'eb-textdomain');
} else {
    $course_class = 'no-access';
    $h_title = __(sprintf('Click to read more about %s course', get_the_title(get_the_ID())), 'eb-textdomain');
}

$course_id = $post_id;
//Shortcode eb_my_courses.


if (isset($is_eb_my_courses) && $is_eb_my_courses && isset($attr)) {
    $courseMang = app\wisdmlabs\edwiserBridge\edwiserBridgeInstance()->courseManager();
    $mdl_course_id = $courseMang->getMoodleCourseId($course_id);
    $moodle_user_id = get_user_meta(get_current_user_id(), 'moodle_user_id', true);

    if ($moodle_user_id != '' && function_exists("ebsso\generateMoodleUrl")) {
        $query = array(
            'moodle_user_id' => $moodle_user_id, //moodle user id
            'moodle_course_id' => $mdl_course_id,
        );
        $course_url = \ebsso\generateMoodleUrl($query);
    } else {
        $course_url = EB_ACCESS_URL.'/course/view.php?id='.$mdl_course_id;
    }

/*******   two way synch  *******/

    if ($moodle_user_id && isset($attr["my_courses_progress"]) && $attr["my_courses_progress"]) {
        $showProgress = 1;
        $courseProgressManager = new app\wisdmlabs\edwiserBridge\EbCourseProgress();
        $progressData = $courseProgressManager->getCourseProgress();
        $courseId = array_keys($progressData);

        if (in_array(get_the_ID(), $courseId)) {
            if ($progressData[get_the_ID()] == 0) {
                $progressClass = "start";
                $progressBtnDiv = "<a href='".esc_url($course_url)."' rel='bookmark' class='btn btn-primary btn-lg'>".__("START", "eb-textdomain")."</a>";
            } elseif ($progressData[get_the_ID()] > 0 && $progressData[get_the_ID()] < 100) {
                $progressClass = "resume";
                $progressWidth = $progressData[get_the_ID()];
                $progressBtnDiv = "<a href='".esc_url($course_url)."' rel='bookmark' class='btn btn-outline-primary d-block'>".__("RESUME", "eb-textdomain")."</a>";
            } else {
                $progressClass = "completed";
                $progressBtnDiv = "<a href='".esc_url($course_url)."' rel='bookmark' class='btn btn-primary d-block'>".__("COMPLETED", "eb-textdomain")."</a>";
            }
        }
    }
/**********************/


} else {
    $is_eb_my_courses = false;
    $course_url = get_permalink();
}

$color = 'primary';
$col_class = 'col-sm-6 col-lg-4 col-xl-3';
if ( is_account_page() ) {
    $col_class = 'col-lg-6 col-lg-4';
}
?>
<article id="<?php echo 'post-'.get_the_ID(); ?>" <?php post_class('curso-destacado '.$col_class.' mb-5 '.$course_class); ?> title="<?php echo $h_title; ?>">

    <div class="borde-color has-<?php echo $color; ?>-background-color"></div>

    <div class="card">

        <div class="card-body entry-content">


                <a href="<?php echo esc_url($course_url); ?>" rel="bookmark" class="wdm-course-thumbnail">
                    <?php the_title( '<h2 class="card-title has-'.$color.'-color">', '</h2>' ); ?>
                </a>

                <?php

                echo '<div class="wdm-caption">';

                if (!empty($short_description)) {
                    echo '<p class="entry-content">'.$short_description.'</p>';
                }
                // if ($post->post_type == 'eb_course' && !$is_eb_my_courses) {
                //     if ($course_price_type == 'paid' || $course_price_type == 'free') {
                //         echo '<div class="wdm-price '.$course_price_type.'">';
                //         echo $course_price_formatted;
                //         echo '</div>';
                //     }
                // }

                if (isset($showProgress) && $showProgress == 1) {
                    echo "<div class='eb-course-action-cont'>";
                    if (isset($progressClass) && $progressClass == "resume") {
                        echo "<div class='eb-course-action-progress-cont'>  <div class='eb-course-action-progress' style='width:".round($progressWidth)."%' ></div></div>";
                    }
                    if(isset($progressBtnDiv)) echo $progressBtnDiv;
                    echo "</div>";
                }



                echo '</div>'; //wdm-caption

                ?>


        </div>

    </div>





    <!-- .wdm-course-grid -->
</article><!-- #post -->
