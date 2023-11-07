<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'mos_job_theme_options');
function mos_job_theme_options() {
Container::make( 'theme_options', 'Settings' )
    ->set_page_parent( 'edit.php?post_type=job' )
    ->add_fields( array(
        Field::make( 'association', 'mos_job_listing_page', __( 'Job listing page' ) )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'page',
            )
        ))
        ->set_max(1),  
        Field::make( 'text', 'mos_job_company_name', __( 'Company Name' ) ),
        Field::make( 'text', 'mos_job_hr_email', __( 'Hr Email' ) ),
        Field::make( 'text', 'mos_job_no_job_text', __( 'Default \'No Jobs\' message' ) )
        ->set_default_value('Currently no job is available'),
        Field::make('radio', 'mos_job_layout', __('Layout of job listing page'))
        ->set_options(array(
            'list' => 'List view',
            'grid' => 'Grid view',
        ))
        ->set_default_value('list'),
        Field::make('select', 'mos_job_layout_noc', __('Number of column'))
        ->set_options(array(
            'col-lg-6' => '2 Columns',
            'col-lg-4' => '3 Columns',
            'col-lg-3' => '4 Columns',
            'col-lg-2' => '6 Columns',
        ))
        ->set_default_value('col-lg-3')
        ->set_required( true )                
        ->set_conditional_logic(array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos_job_layout',
                'value' => 'grid', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        )), 

        Field::make( 'text', 'mos_job_layout_noj', __( 'Listings per page' ) ) 
        ->set_attribute( 'type', 'number' )
        ->set_default_value('10')
        ->set_required( true ),           
        Field::make('radio', 'mos_job_hide_expired_jobs', __('Hide expired jobs from listing page'))
        ->set_options(array(
            'yes' => 'Yes',
            'no' => 'No',
        ))
        ->set_default_value('yes'),
        Field::make( "multiselect", "mos_job_filters", "Job Filters for listing page" )
        ->add_options( array(
            's' => 'Keyword',
            'category' => 'Job Category',
            'type' => 'Job Type',
            'location' => 'Job Location',
        ) ),
        Field::make( "multiselect", "mos_job_metas", "Job Details for listing page" )
        ->add_options( array(
            'published' => 'Published on',
            'company' => 'Company Name',
            'vacancy' => 'Vacancy',
            'gender' => 'Gender',
            'salary' => 'Salary',
            'age' => 'Age',
            'category' => 'Job Category',
            'type' => 'Job Type',
            'location' => 'Job Location',
            'education' => 'Educational Requirements',
            'experience' => 'Experience',
            'deadline' => 'Deadline',
        ) ),
		Field::make( 'rich_text', 'mos_job_before_content', __( 'Content before listing' ) ),
		Field::make( 'rich_text', 'mos_job_after_content', __( 'Content after listing' ) ),
    ) );
}

function mos_plugin_options_page() {
    
	/*add_submenu_page( 
        'edit.php?post_type=job', 
        'Applications', 
        'Applications', 
        'manage_options', 
        'job-applications', 
        'job_applications_page_callback' 
    );*/
    
	add_submenu_page( 
        'edit.php?post_type=job', 
        'Settings', 
        'Settings', 
        'manage_options', 
        'job-settings', 
        'job_settings_page_callback' 
    );
}
//add_action( 'admin_menu', 'mos_plugin_options_page' );


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