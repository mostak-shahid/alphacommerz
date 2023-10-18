<?php
$mos_job_company_name = carbon_get_theme_option( 'mos_job_company_name' )?carbon_get_theme_option( 'mos_job_company_name' ):get_bloginfo( 'name' );
$mos_job_layout = carbon_get_theme_option( 'mos_job_layout' );
$mos_job_layout_noc = ($mos_job_layout == 'grid')?carbon_get_theme_option( 'mos_job_layout_noc' ):'col-12';
$mos_job_layout_noj = carbon_get_theme_option( 'mos_job_layout_noj' );
$mos_job_no_job_text = carbon_get_theme_option( 'mos_job_no_job_text' );
$mos_job_hide_expired_jobs = carbon_get_theme_option( 'mos_job_hide_expired_jobs' );
$mos_job_metas = carbon_get_theme_option( 'mos_job_metas' );
?>
<?php get_header() ?>
<?php the_content() ?>
<section class="job-listing <?php echo $mos_job_layout ?>-layout <?php echo ($mos_job_layout_noc)?$mos_job_layout_noc:1 ?>-grid py-5">
<?php
$args = array(
    'post_type' => 'job',
    'posts_per_page' => ($mos_job_layout_noj)?$mos_job_layout_noj:10,
);
if ($mos_job_hide_expired_jobs == 'yes') {
    $args['meta_query'] = array(
        /*array(
            'key' => 'event_date',
            'value' => array(date('d/m/Y'), date('d/m/Y', strtotime('28 days'))),
            'compare' => 'BETWEEN',
            'type' => 'DATE'
        ),*/
        array(
            'key'     => '_mos_job_expired',
            'value'   => date("Y-m-d"),
            'compare' => '>=',
            'type'    => 'DATE'
        ),
    );
}
$query = new WP_Query( $args );
?>
<?php if ( $query->have_posts() ) : ?>
	<div class="mos-jobs row">
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php
        $post_id = get_the_ID();

        $mos_job_min_education = carbon_get_post_meta( $post_id, 'mos_job_min_education' );
        $mos_job_min_experience = carbon_get_post_meta( $post_id, 'mos_job_min_experience' );
        $mos_job_expired = carbon_get_post_meta( $post_id, 'mos_job_expired' );
        $mos_job_vacancy = carbon_get_post_meta( $post_id, 'mos_job_vacancy' );
        $mos_job_gender = carbon_get_post_meta( $post_id, 'mos_job_gender' );
        $mos_job_min_age = carbon_get_post_meta( $post_id, 'mos_job_min_age' );
        $mos_job_salary = carbon_get_post_meta( $post_id, 'mos_job_salary' );

        $job_category_list = wp_get_post_terms( $post_id, 'job_category' );
        $job_type_list = wp_get_post_terms( $post_id, 'job_type' );
        $job_location_list = wp_get_post_terms( $post_id, 'job_location' );
        $diff = date_diff( date_create(date('Y-m-d')), date_create($mos_job_expired));
        ?>
		<div class="mos-job job-unit position-relative border rounded-4 p-4 bg-light mb-4 <?php echo $mos_job_layout_noc ?>">
            <h4 class="job-title"><?php echo esc_html( get_the_title() ) ?></h4>
            <?php if (@$mos_job_metas && sizeof($mos_job_metas)) : ?>
                <div class="mos-job-specification-wrapper">                        
                    
                <?php foreach($mos_job_metas as $job_meta) : ?>                    
                    <?php if($job_meta == 'company') :?>
                        <h5 class="company-title"><?php echo $mos_job_company_name ?></h5>

                    <div class="mos-job-specification-item mos-job-specification-job-published">                            
                        <span class="mos-job-specification-label"><strong>Published on: </strong></span>
                        <span class="mos-job-specification-term">
                            <?php echo get_the_date( "F j, Y" );?>
                        </span> 
                    </div>
                    <?php elseif ($job_meta == 'vacancy' && $mos_job_vacancy) : ?>
                    <div class="mos-job-specification-item mos-job-specification-job-vacancy">                            
                        <span class="mos-job-specification-label"><strong>Vacancy: </strong></span>
                        <span class="mos-job-specification-term">
                            <?php echo $mos_job_vacancy;?>
                        </span> 
                    </div>
                    <?php elseif ($job_meta == 'gender' && $mos_job_gender) : ?>
                    <div class="mos-job-specification-item mos-job-specification-job-gender">                            
                        <span class="mos-job-specification-label"><strong>Gender: </strong></span>
                        <span class="mos-job-specification-term">
                            <?php echo $mos_job_gender;?>
                        </span> 
                    </div>
                    <?php elseif ($job_meta == 'salary' && $mos_job_salary) : ?>
                    <div class="mos-job-specification-item mos-job-specification-job-salary">                            
                        <span class="mos-job-specification-label"><strong>Salary: </strong></span>
                        <span class="mos-job-specification-term">
                            <?php echo $mos_job_salary;?>
                        </span> 
                    </div>
                    <?php elseif ($job_meta == 'age' && $mos_job_min_age) : ?>
                    <div class="mos-job-specification-item mos-job-specification-job-age">                            
                        <span class="mos-job-specification-label"><strong>Age: </strong></span>
                        <span class="mos-job-specification-term">
                            <?php echo $mos_job_min_age;?>
                        </span> 
                    </div>
                    <?php elseif ($job_meta == 'category' && $job_category_list && sizeof($job_category_list)) : ?>
                    <div class="mos-job-specification-item mos-job-specification-job-category">                            
                        <span class="mos-job-specification-label"><strong>Job Category: </strong></span>
                        <span class="mos-job-specification-term">
                            <?php 
                            foreach($job_category_list as $job_category){
                                $job_category_arr[] = $job_category->name;
                            }
                            echo implode(", ",$job_category_arr);
                            ?>
                        </span> 
                    </div>
                    <?php elseif ($job_meta == 'type' && $job_type_list && sizeof($job_type_list)) : ?>
                    <div class="mos-job-specification-item mos-job-specification-job-type">                            
                        <span class="mos-job-specification-label"><strong>Job Type: </strong></span>
                        <span class="mos-job-specification-term">
                            <?php 
                            foreach($job_type_list as $job_type){
                                $job_type_arr[] = $job_type->name;
                            }
                            echo implode(", ",$job_type_arr);
                            ?>
                        </span>
                    </div>
                    <?php elseif ($job_meta == 'location' && $job_location_list && sizeof($job_location_list)) : ?>
                    <div class="mos-job-specification-item mos-job-specification-job-location">                            
                        <span class="mos-job-specification-label"><strong>Job Location: </strong></span>
                        <span class="mos-job-specification-term">                                    
                            <?php 
                            foreach($job_location_list as $job_location){
                                $job_location_arr[] = $job_location->name;
                            }
                            echo implode(", ",$job_location_arr);
                            ?>
                        </span> 
                    </div>
                    <?php elseif ($job_meta == 'education' && $mos_job_min_education) : ?>
                    <div class="mos-job-specification-item mos-job-specification-job-education">                            
                        <span class="mos-job-specification-label"><strong>Educational Requirements: </strong></span>
                        <span class="mos-job-specification-term"><?php echo $mos_job_min_education ?></span> 
                    </div>
                    <?php elseif ($job_meta == 'experience' && $mos_job_min_experience) : ?>
                    <div class="mos-job-specification-item mos-job-specification-job-experience">                            
                        <span class="mos-job-specification-label"><strong>Experience: </strong></span>
                        <span class="mos-job-specification-term"><?php echo $mos_job_min_experience ?></span> 
                    </div>
                    <?php elseif ($job_meta == 'deadline') : ?>
                    <div class="mos-job-specification-item mos-job-specification-deadline">                            
                        <span class="mos-job-specification-label"><strong>Deadline: </strong></span>
                        <span class="mos-job-specification-term">
                        <?php if ($diff->format("%R") == "+") : ?>
                            <?php echo date("F j, Y", strtotime($mos_job_expired)) ?>
                        <?php else : ?>
                            Expired
                        <?php endif?>
                        </span>
                    </div>
                    <?php endif?> 
                <?php endforeach?>
                </div>
            <?php endif?>        
            <span class="btn bg-theme-secondary text-white d-inline-block mt-3">More Details</span>
            <a href="<?php echo get_the_permalink() ?>" class="hidden-link">Read more about <?php echo get_the_title() ?></a>
        </div>
    <?php endwhile;?>
	</div>
<?php else : ?>
	<h4 class="text-center m-0"><?php echo ($mos_job_no_job_text)?$mos_job_no_job_text:'Currently no job is available'?></h4>
<?php endif;
wp_reset_postdata();
?>
</section>
<?php get_footer() ?>