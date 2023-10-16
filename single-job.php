<?php 
get_header();
$post_id = get_the_ID();
$mos_job_expired = carbon_get_post_meta( $post_id, 'mos_job_expired' );
$mos_additional_questions = carbon_get_post_meta( $post_id, 'mos_additional_questions' );
$diff = date_diff( date_create(date('Y-m-d')), date_create($mos_job_expired));

$job_category_list = wp_get_post_terms( $post_id, 'job_category' );
$job_type_list = wp_get_post_terms( $post_id, 'job_type' );
$job_location_list = wp_get_post_terms( $post_id, 'job_location' );

?>

<section class="blog-single-wrapper">
    <div class="row-wrapper">
        <div class="row">
            <div class="col-lg-8">
                <article id="<?php echo get_post_type() ?>-<?php echo $post_id ?>" <?php post_class( 'single-blog' ); ?> itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
                    <div class="entry-header">
                        <h1 class="blog-title" itemprop="headline"><?php echo get_the_title() ?></h1>
                        <div class="mos-job-expiry-details">
                            <strong>Expired on:</strong> 
                            <span class="mos-job-expiration-content">
                                <?php if ($diff->format("%R") == "+") : ?>
                                    <?php //echo $mos_job_expired ?>
                                    <?php echo date("F j, Y", strtotime($mos_job_expired)) ?>
                                <?php else : ?>
                                    Expired
                                <?php endif?>
                            </span>
                        </div>
                    </div>
                    <div class="blog-info">
                        <div class="blog-intro"><?php the_content()?></div>
                        <div class="mos-job-specification-wrapper">
                            <?php if ($job_category_list && sizeof($job_category_list)) : ?>
                            <div class="mos-job-specification-item mos-job-specification-job-category">
                                <i class="fa fa-briefcase"></i>
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
                            <?php endif?>
                            <?php if ($job_type_list && sizeof($job_type_list)) : ?>
                            <div class="mos-job-specification-item mos-job-specification-job-type">
                                <i class="fa fa-adjust"></i>
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
                            <?php endif?>
                            <?php if ($job_location_list && sizeof($job_location_list)) : ?>
                            <div class="mos-job-specification-item mos-job-specification-job-location">
                                <i class="fa fa-location-arrow"></i>
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
                            <?php endif?>
                            <div class="mos-job-specification-item mos-job-specification-deadline">
                                <i class="fa fa-calendar"></i>
                                <span class="mos-job-specification-label"><strong>Deadline: </strong></span>
                                <span class="mos-job-specification-term">
                                <?php if ($diff->format("%R") == "+") : ?>
                                    <?php echo date("F j, Y", strtotime($mos_job_expired)) ?>
                                <?php else : ?>
                                    Expired
                                <?php endif?>
                                </span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-lg-4">
                <div class="application-form-wrapper sticky-xl-top border p-4" style="top: 80px">
                <?php if ($diff->format("%R") == "+") : ?>
                    <h2>Apply for this position	</h2>
                    <form id="jobApplicationForm" action="" method="post" enctype="multipart/form-data">
                        <?php wp_nonce_field( 'mos_job_apply_form_action', 'mos_job_apply_form_field' ); ?>
                        <div class="form-group mb-3">
                            <label for="full_name" class="form-label">Full name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo @$_POST['full_name'] ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo @$_POST['email'] ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo @$_POST['phone'] ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="cover_latter" class="form-label">Cover Letter <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="cover_latter" name="cover_latter" rows="3"><?php echo @$_POST['cover_latter'] ?></textarea>
                        </div>
                        <div class="form-group mb-3 cv-wrapper position-relative">
                            <label for="cv">Upload CV/Resume <span class="text-danger">*</span></label>
                            <div>Allowed Type(s): .pdf, .doc, .docx</div>
                            <input type="file" class="form-control cv-file" id="cv" name="cv" accept=".pdf, .doc, .docx">
                        </div>
                        <?php if ($mos_additional_questions && sizeof($mos_additional_questions)) : ?>
                            <?php foreach($mos_additional_questions as $key=>$question) : ?>
                                
                                <div class="form-group mb-3">
                                    <label for="aq_<?php echo $key ?>" class="form-label"><?php echo $question['question'] ?> <?php if (@$question['required']) : ?><span class="text-danger">*</span><?php endif?></label>
                                    <input type="hidden" class="form-control" id="aq_<?php echo $key ?>" name="aq[<?php echo $key ?>][0]" value="<?php echo $question['question'] ?>">
                                    <input type="text" class="form-control" id="aq_<?php echo $key ?>" name="aq[<?php echo $key ?>][1]" <?php if (@$question['required']) : ?>required<?php endif?> value="<?php echo @$_POST['aq'][$key][1] ?>">
                                </div>
                            <?php endforeach;?>
                        <?php endif?>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <input type="hidden" name="job_id" value="<?php echo get_the_ID() ?>">
                            <input type="hidden" name="job_title" value="<?php echo get_the_title() ?>">
                        </div>
                    </form>
                <?php else : ?>
                    <h4 class="m-0">Sorry! This job has expired.</h4>
                <?php endif?>
                
                </div>
            </div>
        </div>
    </div>

</section>


<?php get_footer() ?>
<?php if ($diff->format("%R") == "+") : ?>
<script>
	jQuery(document).ready(function ($) {
		//$('input[type="file"].awsm-job-form-control').parent().addClass('awsm-form-file-control-group');
		$('input[type="file"].cv-file').change(function(e){
			$(this).parent().addClass('file-uploaded');
			$('.mos-file-info').remove();
			//console.log(e.target.files[0]);
            var fileName = e.target.files[0].name;
			var fileType = e.target.files[0].type;			
			var fileSize = e.target.files[0].size;
            //alert('The file "' + fileName +  '" has been selected, type is  "' + fileType +  '" and size is ' + fileSize);
            $(this).closest('.form-group').after('<p class="mos-file-info mt-2 py-1 px-2 rounded-pill d-flex justify-content-between align-items-center"><span>' + fileName +  '</span> <i class="fa fa-trash mos-remove-file"></i></p>');
			$(this).siblings('label').html('File Dropped Successfully!');
        });
		$('body').on('click', '.mos-remove-file', function (){
        	$('input[type="file"].cv-file').val(''); 
			$(this).closest('.mos-file-info').siblings('.form-group').removeClass('file-uploaded');
			$(this).closest('.mos-file-info').siblings('.form-group').find('label').html('Cover Letter <span class="text-danger">*</span>');
			$(this).closest('.mos-file-info').remove();
    	});

        
		/*$.validator.setDefaults( {
			submitHandler: function () {
				alert( "submitted!" );
			}
		} );*/
        $.validator.addMethod(
          "regex",
          function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
          },
          "Please check your input."
        );
        
        $( "#jobApplicationForm" ).validate( {
            rules: {                                         
                full_name: {
                    required: true,
                    minlength: 2,
                    regex: "^[a-zA-Z -']*$"
                },        
                email: {
                    required: true,
                    email: true,
                    /*remote: {
                        url: mos_ajax_object.ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
                        type:"POST",
                        dataType:"json",
                        data: {
                            'action': 'registration_email_tracking',
                            emails: function(){
                                return $('#signupForm :input[name="email"]').val();
                            }
                        }
                    }*/
                },  
                phone: "required", 
                cover_latter: "required", 
                cv: {
                    required: true,
                    regex: "^.+(.doc|.docx|.DOC|.DOCX|.pdf|.PDF)$"
                }
            },
            messages: {
//                registration_certificate: {
//                    required: "Please enter your registration certificate file",
//                    accept: "Please enter a PDF file"
//                },
                full_name: {
                    required: "Please enter a First name",
                    minlength: "Your First name must consist of at least 2 characters",
                    regex: "You can use only alphabets"
                },
                email: {                    
                    required: "Please enter your email",
                    email: "Please enter a valid email",
                    //remote: "This email has been taken already"
                },   
                phone: "please enter your Phone",
                cover_latter: "please enter something about you",
                cv: {
                    required: "Please enter your cv",
                    regex: "Only pdf, doc and docx file is allowed"
                }
            },
            errorElement: "div",
            errorPlacement: function ( error, element ) {
                // Add the `help-block` class to the error element
                error.addClass( "invalid-feedback" );

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                //element.parents( ".col-sm-5" ).addClass( "has-feedback" );
                element.addClass( "is-invalid" );

                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.parent( "label" ) );
                } else {
                    error.insertAfter( element );
                }

                // Add the span element, if doesn't exists, and apply the icon classes to it.
//                if ( !element.next( "span" )[ 0 ] ) {
//                    $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
//                }
            },
            success: function ( label, element ) {
                // Add the span element, if doesn't exists, and apply the icon classes to it.
                // if ( !$( element ).next( "span" )[ 0 ] ) {
                //     $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
                // }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
                //$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                //$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
            },
            unhighlight: function ( element, errorClass, validClass ) {
                $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
                //$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                //$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
            }
        } );
        
        /*$('.mos-registration-form').submit(function(e){
            e.preventDefault();		
            var form = $(this);
            console.log(mos_ajax_object.ajaxurl);
            
            var form_data = $(this).serialize();
            $(this).find('.btn-mos-registration').html('Requesting...').prop( "disabled", true );
            //console.log(form_data);
            $.ajax({
                url: frontend_ajax_object.ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
                type:"POST",
                dataType:"json",
                data: {
                    'action': 'registration_tracking',
                    'form_data' : form_data,
                },
                success: function(result){
                    if(result.validation){
                        form.removeClass('was-validated');               
                    } else {
                        form.find('.btn-mos-registration').html('Try Again').prop( "disabled", false );
                    }
                },
                error: function(errorThrown){
                    console.log(errorThrown);
                    form.find('.btn-mos-registration').html('Try Again').prop( "disabled", false );
                }
            });
            
        });*/
        
    });
</script>
<?php endif?>