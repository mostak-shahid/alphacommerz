<?php
function add_slug_body_class( $classes ) {
    global $post;
    if (@$post && isset( $post )){
        if ($post->post_type == 'page' ) {
            $classes[] = $post->post_type . '-' . $post->post_name;
        } else {
            $classes[] = $post->post_type . '-archive';
        }
    }
    
    if ( is_user_logged_in() ) {
        $classes[] = 'logged-in-user';
    } else {
        $classes[] = 'guest-user';
    }
    /*if ( is_product() ) {
        global $product;
        $prefix = ($product->get_stock_quantity()>1)?'more-then-one':'less-then-one';
        $classes[] = $prefix .'-product-available';
    }*/
    if (taxonomy_exists( 'product_cat' ) && !is_shop()) {
        $term = get_queried_object();
        $term_id = (@$term)?$term->term_id:0;
        $termchildren = get_term_children( $term_id, 'product_cat' );
        if (sizeof($termchildren)) {
            $classes[] = 'mos-product-cat-parent';
        } else {
            $classes[] = 'mos-product-cat-landing';
        }
        
    }
    //$classes[] = "theme-default";
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

function mos_excerpt_more($more) {
    //global $post;
    //return ' <a class="moretag btn btn-primary" href="'. get_permalink($post->ID) . '">Read More »</a>'; //Change to suit your needs
    return ''; //Change to suit your needs
} 
add_filter( 'excerpt_more', 'mos_excerpt_more' );

function mos_excerpt_length($length){ 
    return 20; 
} 
add_filter('excerpt_length', 'mos_excerpt_length');

function back_to_top_fnc () {
    global $alphacommerz_options;
    if ($alphacommerz_options['misc-back-top']) :
    ?>
    <a href="javascript:void(0)" class="scrollup" style="display: none;"><img width="40" height="40" src="<?php echo get_template_directory_uri() ?>/images/icon_top.png" alt="Back To Top"></a>
    <?php 
    endif;
}
add_action( 'action_below_footer', 'back_to_top_fnc', 10, 1 );


add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    return $content;
});
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

// Disable WordPress sanitization to allow more than just $allowedtags from /wp-includes/kses.php.
remove_filter( 'pre_user_description', 'wp_filter_kses' );
// Add sanitization for WordPress posts.
add_filter( 'pre_user_description', 'wp_filter_post_kses' );




function mos_job_apply_form_submit(){
	if ( isset( $_POST['mos_job_apply_form_field'] ) && wp_verify_nonce( $_POST['mos_job_apply_form_field'], 'mos_job_apply_form_action' ) ) {	
        //var_dump($_POST);
        $aq = [];
        $err = 0;
        if ($_POST["full_name"]) {
            $full_name = sanitize_text_field(wp_unslash($_POST["full_name"]));
            if (!preg_match("/^[a-zA-Z -']*$/",$full_name)) {
                $err++;
            }
        } else {
            $err++;
        } 
        if ($_POST["email"]) {
            $email = sanitize_text_field(wp_unslash($_POST["email"]));
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $err++;
            }
        } else {
            $err++;
        } 
        if ($_POST["phone"]) {
            $phone = sanitize_text_field(wp_unslash($_POST["phone"]));
        } else {
            $err++;
        } 
        if ($_POST["cover_latter"]) {
            $cover_latter = sanitize_text_field(wp_unslash($_POST["cover_latter"]));
        } else {
            $err++;
        } 
        if ($_POST["aq"] && sizeof($_POST["aq"])) {
            foreach($_POST["aq"] as $key=>$value){
                $aq[$key][0] = sanitize_text_field(wp_unslash($value[0]));
                $aq[$key][1] = sanitize_text_field(wp_unslash($value[1]));
            }
        }
        if ($_POST["job_id"]) {
            $job_id = sanitize_text_field(wp_unslash($_POST["job_id"]));
        } else {
            $err++;
        } 
        if ($_POST["job_title"]) {
            $job_title = sanitize_text_field(wp_unslash($_POST["job_title"]));
        } else {
            $err++;
        } 
        if ($_FILES['cv']['name']) { 
            $file_name = $_FILES['cv']['name'];
            $file_temp = $_FILES['cv']['tmp_name'];
            $file_size = $_FILES['cv']['size'];
            $file_type = $_FILES['cv']['type']; // "application/pdf"
            if ($file_type != "application/pdf") {
                $err++;
            }
            $upload_dir = wp_upload_dir();
            $file_data = file_get_contents( $file_temp );
            $filename = basename( $file_name );
            $filetype = wp_check_filetype($file_name);
            $filename = time().'.'.$filetype['ext'];

            if ( wp_mkdir_p( $upload_dir['path'] ) ) {
              $file = $upload_dir['path'] . '/' . $filename;
            }
            else {
              $file = $upload_dir['basedir'] . '/' . $filename;
            }

            file_put_contents( $file, $file_data );
            $wp_filetype = wp_check_filetype( $filename, null );
            $attachment = array(
              'post_mime_type' => $wp_filetype['type'],
              'post_title' => sanitize_file_name( $filename ),
              'post_content' => '',
              'post_status' => 'inherit'
            );
            $attach_id = wp_insert_attachment( $attachment, $file );
        } else {
            $err++;
        }
        $mos_job_expired = carbon_get_post_meta( $job_id, 'mos_job_expired' );
        $diff = date_diff( date_create(date('Y-m-d')), date_create($mos_job_expired));
        if (!$err && $diff->format("%R") == "+") {
            global $wpdb;
            $table_name = $wpdb->prefix.'job_applications';
            $wpdb->insert(
                $table_name,
                array(
                    'job_id' => $job_id,
                    'job_title' => $job_title,
                    'p_name' => $full_name,
                    'p_email' => $email,
                    'p_phone' => $phone,
                    'p_cover_letter' => $cover_latter,
                    'p_cv' => wp_get_attachment_url( $attach_id ),
                    'p_additional_info' => json_encode($aq),
                    'application_status' => 'pending',
                    'date' => date('Y-m-d'),
                ),
            );
            wp_redirect( home_url($_POST['_wp_http_referer'].'?application=completed') );
            die(); 
        }
        
	}
}
add_action('init', 'mos_job_apply_form_submit');