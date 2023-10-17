<?php
/* AJAX action callback */
add_action( 'wp_ajax_reset_prl', 'reset_prl_ajax_callback' );
add_action( 'wp_ajax_nopriv_reset_prl', 'reset_prl_ajax_callback' );
/* Ajax Callback */
function reset_prl_ajax_callback () {
    $post_id = $_GET['post_id'];
    delete_post_meta($post_id, '_alphacommerz_page_section_layout');
    //http://tippproperty.belocal.today/wp-admin/post.php?post=16&action=edit
    $location = admin_url('/') . 'post.php?post=' . $post_id . '&action=edit';
    wp_redirect( $location, $status = 302 );
    exit; // required. to end AJAX request.
}
/* AJAX action callback */
add_action( 'wp_ajax_dummy', 'dummy_ajax_callback' );
add_action( 'wp_ajax_nopriv_dummy', 'dummy_ajax_callback' );
/* Ajax Callback */
function dummy_ajax_callback () {
    $post_id = $_POST['product'];
    $output = array();
	echo json_encode($output);
    exit; // required. to end AJAX request.
}
/* AJAX action callback */
add_action( 'wp_ajax_regenerate_captcha', 'regenerate_captcha_ajax_callback' );
add_action( 'wp_ajax_nopriv_regenerate_captcha', 'regenerate_captcha_ajax_callback' );
/* Ajax Callback */
function regenerate_captcha_ajax_callback () {
	echo json_encode(generateRandomString(8));
    exit; // required. to end AJAX request.
}
/* AJAX action callback */
add_action( 'wp_ajax_application_email_tracking', 'application_email_tracking_ajax_callback' );
add_action( 'wp_ajax_nopriv_application_email_tracking', 'application_email_tracking_ajax_callback' );
/* Ajax Callback */
function application_email_tracking_ajax_callback () {
    // var_dump($_POST);
    // die();
    global $wpdb;
    //SELECT COUNT(*) FROM wpky_job_applications WHERE job_id='2145' AND p_email='mostak.shahid@gmail.com'
    //SELECT COUNT(*) FROM {$wpdb->prefix}job_applications WHERE job_id='{$_POST['job_id']}' AND p_email='{$_POST['email']}'
    $application_count = $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}job_applications WHERE job_id='{$_GET['job_id']}' AND p_email='{$_GET['email']}'" );
    //echo json_encode($application_count);

    if ($application_count)
	echo 'false';
    else
    echo 'true'; 
    exit; // required. to end AJAX request.
}

