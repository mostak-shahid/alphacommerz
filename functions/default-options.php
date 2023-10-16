<?php
function alphacommerz_settings_init() {
	register_setting( 'alphacommerz', 'alphacommerz_options' );
	add_settings_section('alphacommerz_section_top_nav', '', 'alphacommerz_section_top_nav_cb', 'alphacommerz');
	add_settings_section('alphacommerz_section_dash_start', '', 'alphacommerz_section_dash_start_cb', 'alphacommerz');

	add_settings_field( 'field_logo', __( 'Company Logo', 'alphacommerz' ), 'alphacommerz_field_logo_cb', 'alphacommerz', 'alphacommerz_section_dash_start', [ 'label_for' => 'company_logo', 'class' => 'alphacommerz_row' ] );	
	add_settings_field( 'field_name', __( 'Company Name', 'alphacommerz' ), 'alphacommerz_field_name_cb', 'alphacommerz', 'alphacommerz_section_dash_start', [ 'label_for' => 'company_name', 'class' => 'alphacommerz_row' ] );	
	add_settings_field( 'field_email', __( 'Company Email', 'alphacommerz' ), 'alphacommerz_field_email_cb', 'alphacommerz', 'alphacommerz_section_dash_start', [ 'label_for' => 'company_email', 'class' => 'alphacommerz_row' ] );	
	add_settings_field( 'field_phone', __( 'Company Phone', 'alphacommerz' ), 'alphacommerz_field_phone_cb', 'alphacommerz', 'alphacommerz_section_dash_start', [ 'label_for' => 'company_phone', 'class' => 'alphacommerz_row' ] );	
	add_settings_field( 'field_address', __( 'Company Address', 'alphacommerz' ), 'alphacommerz_field_address_cb', 'alphacommerz', 'alphacommerz_section_dash_start', [ 'label_for' => 'company_address', 'class' => 'alphacommerz_row' ] );	
	add_settings_field( 'field_invioce_prefix', __( 'Invoice Prefix', 'alphacommerz' ), 'alphacommerz_field_invioce_prefix_cb', 'alphacommerz', 'alphacommerz_section_dash_start', [ 'label_for' => 'invioce_prefix', 'class' => 'alphacommerz_row' ] );	

	add_settings_section('alphacommerz_section_dash_end', '', 'alphacommerz_section_end_cb', 'alphacommerz');
	
	add_settings_section('alphacommerz_section_scripts_start', '', 'alphacommerz_section_scripts_start_cb', 'alphacommerz');
	//add_settings_field( 'field_jquery', __( 'JQuery', 'alphacommerz' ), 'alphacommerz_field_jquery_cb', 'alphacommerz', 'alphacommerz_section_scripts_start', [ 'label_for' => 'jquery', 'class' => 'alphacommerz_row' ] );
	//add_settings_field( 'field_bootstrap', __( 'Bootstrap', 'alphacommerz' ), 'alphacommerz_field_bootstrap_cb', 'alphacommerz', 'alphacommerz_section_scripts_start', [ 'label_for' => 'bootstrap', 'class' => 'alphacommerz_row' ] );
	//add_settings_field( 'field_css', __( 'Custom Css', 'alphacommerz' ), 'alphacommerz_field_css_cb', 'alphacommerz', 'alphacommerz_section_scripts_start', [ 'label_for' => 'alphacommerz_css' ] );
	//add_settings_field( 'field_js', __( 'Custom Js', 'alphacommerz' ), 'alphacommerz_field_js_cb', 'alphacommerz', 'alphacommerz_section_scripts_start', [ 'label_for' => 'alphacommerz_js' ] );
	add_settings_section('alphacommerz_section_scripts_end', '', 'alphacommerz_section_end_cb', 'alphacommerz');

}
add_action( 'admin_init', 'alphacommerz_settings_init' );

function get_alphacommerz_active_tab () {
	$output = array(
		'option_prefix' => admin_url() . "/options-general.php?page=alphacommerz_settings&tab=",
		//'option_prefix' => "?post_type=p_file&page=alphacommerz_settings&tab=",
	);
	if (isset($_GET['tab'])) $active_tab = $_GET['tab'];
	elseif (isset($_COOKIE['plugin_active_tab'])) $active_tab = $_COOKIE['plugin_active_tab'];
	else $active_tab = 'dashboard';
	$output['active_tab'] = $active_tab;
	return $output;
}
function alphacommerz_section_top_nav_cb( $args ) {
	$data = get_alphacommerz_active_tab ();
	?>
    <ul class="nav nav-tabs">
        <li class="tab-nav <?php if($data['active_tab'] == 'dashboard') echo 'active';?>"><a data-id="dashboard" href="<?php echo $data['option_prefix'];?>dashboard">Dashboard</a></li>
        <li class="tab-nav <?php if($data['active_tab'] == 'scripts') echo 'active';?>"><a data-id="scripts" href="<?php echo $data['option_prefix'];?>scripts">Advanced CSS, JS</a></li>
    </ul>
	<?php
}
function alphacommerz_section_dash_start_cb( $args ) {
	$data = get_alphacommerz_active_tab ();
  global $alphacommerz_options;
	?>
	<div id="mos-invoice-dashboard" class="tab-con <?php if($data['active_tab'] == 'dashboard') echo 'active';?>">
		<?php var_dump($alphacommerz_options) ?>

	<?php
}
function alphacommerz_section_scripts_start_cb( $args ) {
	$data = get_alphacommerz_active_tab ();
	?>
	<div id="mos-invoice-scripts" class="tab-con <?php if($data['active_tab'] == 'scripts') echo 'active';?>">
	<?php
}
function alphacommerz_field_logo_cb( $args ) {
	global $alphacommerz_options;
	?>	
	<div class="input-group">
	<input name="alphacommerz_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="regular-text mos_uploaded_image" value="<?php echo isset( $alphacommerz_options[ $args['label_for'] ] ) ? esc_html_e($alphacommerz_options[$args['label_for']]) : '';?>">
	<input class="mos_upload_image_button button" type="button" value="Upload Logo" />
	</div>
	<img class="company-logo" src="<?php echo isset( $alphacommerz_options[ $args['label_for'] ] ) ? esc_html_e($alphacommerz_options[$args['label_for']]) : '';?>" alt="">
	
	<?php
}
function alphacommerz_field_name_cb( $args ) {
	global $alphacommerz_options;
	?>	
	<div class="input-group">
	<input name="alphacommerz_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="regular-text" value="<?php echo isset( $alphacommerz_options[ $args['label_for'] ] ) ? esc_html_e($alphacommerz_options[$args['label_for']]) : '';?>">
	</div>
	<?php
}
function alphacommerz_field_email_cb( $args ) {
	global $alphacommerz_options;
	?>	
	<div class="input-group">
	<input name="alphacommerz_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="regular-text" value="<?php echo isset( $alphacommerz_options[ $args['label_for'] ] ) ? esc_html_e($alphacommerz_options[$args['label_for']]) : '';?>">
	</div>
	<?php
}
function alphacommerz_field_phone_cb( $args ) {
	global $alphacommerz_options;
	?>	
	<div class="input-group">
	<input name="alphacommerz_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="regular-text" value="<?php echo isset( $alphacommerz_options[ $args['label_for'] ] ) ? esc_html_e($alphacommerz_options[$args['label_for']]) : '';?>">
	</div>
	<?php
}
function alphacommerz_field_address_cb( $args ) {
	global $alphacommerz_options;
	?>
	<textarea name="alphacommerz_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $alphacommerz_options[ $args['label_for'] ] ) ? esc_html_e($alphacommerz_options[$args['label_for']]) : '';?></textarea>
	<?php
}
function alphacommerz_field_invioce_prefix_cb( $args ) {
	global $alphacommerz_options;
	?>	
	<div class="input-group">
	<input name="alphacommerz_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="regular-text" value="<?php echo isset( $alphacommerz_options[ $args['label_for'] ] ) ? esc_html_e($alphacommerz_options[$args['label_for']]) : '';?>">
	</div>
	<?php
}
function alphacommerz_field_jquery_cb( $args ) {
	global $alphacommerz_options;
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"><input name="alphacommerz_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="1" <?php echo isset( $alphacommerz_options[ $args['label_for'] ] ) ? ( checked( $alphacommerz_options[ $args['label_for'] ], 1, false ) ) : ( '' ); ?>><?php esc_html_e( 'Yes I like to add JQuery from Plugin.', 'alphacommerz' ); ?></label>
	<?php
}
function alphacommerz_field_bootstrap_cb( $args ) {
	global $alphacommerz_options;
	?>
	<label for="<?php echo esc_attr( $args['label_for'] ); ?>"><input name="alphacommerz_options[<?php echo esc_attr( $args['label_for'] ); ?>]" type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" value="1" <?php echo isset( $alphacommerz_options[ $args['label_for'] ] ) ? ( checked( $alphacommerz_options[ $args['label_for'] ], 1, false ) ) : ( '' ); ?>><?php esc_html_e( 'Yes I like to add JQuery from Plugin.', 'alphacommerz' ); ?></label>
	<?php
}
function alphacommerz_field_css_cb( $args ) {
	global $alphacommerz_options;
	?>
	<textarea name="alphacommerz_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $alphacommerz_options[ $args['label_for'] ] ) ? esc_html_e($alphacommerz_options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("alphacommerz_css"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function alphacommerz_field_js_cb( $args ) {
	global $alphacommerz_options;
	?>
	<textarea name="alphacommerz_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" rows="10" class="regular-text"><?php echo isset( $alphacommerz_options[ $args['label_for'] ] ) ? esc_html_e($alphacommerz_options[$args['label_for']]) : '';?></textarea>
	<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("alphacommerz_js"), {
      lineNumbers: true,
      mode: "text/css",
      extraKeys: {"Ctrl-Space": "autocomplete"}
    });
	</script>
	<?php
}
function alphacommerz_section_end_cb( $args ) {
	$data = get_alphacommerz_active_tab ();
	?>
	</div>
	<?php
}


function alphacommerz_options_page() {
	add_menu_page( 'Theme Options', 'Theme Options', 'manage_options', 'alphacommerz-options', 'alphacommerz_options_page_html' );
	//add_submenu_page( 'alphacommerz', 'Invoice Company Settings', 'Company Settings', 'manage_options', 'alphacommerz_settings', 'alphacommerz_admin_page' );
}
add_action( 'admin_menu', 'alphacommerz_options_page' );

function alphacommerz_options_page_html() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error( 'alphacommerz_messages', 'alphacommerz_message', __( 'Settings Saved', 'alphacommerz' ), 'updated' );
	}
	settings_errors( 'alphacommerz_messages' );
	?>
	<div class="wrap mos-invoice-wrapper">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
		<?php
		settings_fields( 'alphacommerz' );
		do_settings_sections( 'alphacommerz' );
		submit_button( 'Save Settings' );
		?>
		</form>
	</div>
	<?php
}