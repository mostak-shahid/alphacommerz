<?php
if (!function_exists('create_necessary_mos_job_applications_table')){
    function create_necessary_mos_job_applications_table () {
        global $wpdb;
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $charset_collate = $wpdb->get_charset_collate();
        
        $table_name = $wpdb->prefix.'job_applications';
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,   
            job_id bigint(20) UNSIGNED NOT NULL DEFAULT 0, 
            job_title varchar(255) DEFAULT '' NOT NULL,
            p_name varchar(255) DEFAULT '' NOT NULL,
            p_email varchar(255) DEFAULT '' NOT NULL,
            p_phone varchar(255) DEFAULT '' NOT NULL,
            p_cover_letter longtext NOT NULL,
            p_cv varchar(255) DEFAULT '' NOT NULL,
            p_additional_info longtext NOT NULL,
            application_status varchar(20) DEFAULT '' NOT NULL,
            date date DEFAULT '0000-00-00' NOT NULL,
            PRIMARY KEY  (ID)
        ) $charset_collate;";
        dbDelta( $sql );
    }
}
add_action('after_setup_theme', 'create_necessary_mos_job_applications_table');