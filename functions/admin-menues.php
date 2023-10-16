<?php
/*
add_submenu_page( 
    string $parent_slug, 
    string $page_title, 
    string $menu_title, 
    string $capability, 
    string $menu_slug, 
    callable $callback = '', 
    int|float $position = null 
)
*/

/**
 * Adds a submenu page under a custom post type parent.
 */
/*
function mos_admin_pages_settings_init() {
    add_submenu_page(
        'edit.php?post_type=job',
        __( 'Applications', 'textdomain' ),
        __( 'Applications', 'textdomain' ),
        'manage_options',
        'job-applications',
        'job_application_page_callback'
    );
    add_submenu_page(
        'edit.php?post_type=job',
        __( 'Settings', 'textdomain' ),
        __( 'Settings', 'textdomain' ),
        'manage_options',
        'job-settings',
        'job_settings_page_callback'
    );
}
add_action( 'admin_init', 'mos_admin_pages_settings_init' );

function job_application_page_callback() { 
    ?>
    <div class="wrap">
        <h1><?php _e( 'Applications', 'textdomain' ); ?></h1>
        <p><?php _e( 'Helpful stuff here', 'textdomain' ); ?></p>
    </div>
    <?php
}
function job_settings_page_callback() { 
    ?>
    <div class="wrap">
        <h1><?php _e( 'Settings', 'textdomain' ); ?></h1>
        <p><?php _e( 'Helpful stuff here', 'textdomain' ); ?></p>
    </div>
    <?php
}*/
function mos_plugin_options_page() {
    
	add_submenu_page( 
        'edit.php?post_type=job', 
        'Applications', 
        'Applications', 
        'manage_options', 
        'job-applications', 
        'job_applications_page_callback' 
    );
    
	add_submenu_page( 
        'edit.php?post_type=job', 
        'Settings', 
        'Settings', 
        'manage_options', 
        'job-settings', 
        'job_settings_page_callback' 
    );
}
add_action( 'admin_menu', 'mos_plugin_options_page' );

function job_applications_page_callback() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error( 'mos_plugin_messages', 'mos_plugin_message', __( 'Settings Saved', 'mos_plugin' ), 'updated' );
	}
	settings_errors( 'mos_plugin_messages' );
	?>
	<div class="wrap mos-plugin-wrapper">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
		<?php
		//settings_fields( 'mos_plugin' );
		//do_settings_sections( 'mos_plugin' );
		submit_button( 'Save Settings' );
		?>
		</form>
	</div>
	<?php
}

function job_settings_page_callback() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error( 'mos_plugin_messages', 'mos_plugin_message', __( 'Settings Saved', 'mos_plugin' ), 'updated' );
	}
	settings_errors( 'mos_plugin_messages' );
	?>
	<div class="wrap mos-plugin-wrapper">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
		<?php
		//settings_fields( 'mos_plugin' );
		//do_settings_sections( 'mos_plugin' );
		submit_button( 'Save Settings' );
		?>
		</form>
	</div>
	<?php
}