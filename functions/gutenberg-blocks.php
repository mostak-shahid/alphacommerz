<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;
add_action('carbon_fields_register_fields', 'mos_gutenberg_blocks');
include_once ABSPATH . 'wp-admin/includes/plugin.php';
function mos_gutenberg_blocks() {
    global $animations;
    $animation_options = [''=>'Select Animation'];
    foreach($animations as $key => $value) {
        //echo $key;
        if ($key != 'Back exits' && $key != 'Bouncing exits' && $key != 'Fading exits' && $key != 'Rotating exits' && $key != 'Zooming exits' && $key != 'Sliding exits') {
            foreach($value as $animation) {
                $animation_options[$animation] = $animation;
            }
        }
    }
    /*
    //Base Block start
    Block::make(__('Base Block'))
    ->add_tab(__('Content'), array(
        Field::make('text', 'mos_block_title', __('Title')),
    ))
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_block_wrapper_class', __('Wrapper Class')),
        Field::make('text', 'mos_block_title_class', __('Title Class')),
        Field::make('complex', 'mos_block_background', __('Background'))
        ->set_max(1)
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('color', 'background-color', __('Background Color')),
            Field::make('image', 'background-image', __('Background Image')),
            Field::make('select', 'background-position', __('Background Position'))
            ->set_options(array(
                'top left' => 'Top Left',
                'top center' => 'Top Center',
                'top right' => 'Top Right',
                'center left' => 'Center Left',
                'center center' => 'Center Center',
                'center right' => 'Center Right',
                'bottom left' => 'Bottom left',
                'bottom center' => 'Bottom Center',
                'bottom right' => 'Bottom Right',
            ))
            ->set_default_value('top left'),
            Field::make('select', 'background-size', __('Background Size'))
            ->set_options(array(
                'cover' => 'cover',
                'contain' => 'contain',
                'auto' => 'auto',
                'inherit' => 'inherit',
                'initial' => 'initial',
                'revert' => 'revert',
                'revert-layer' => 'revert-layer',
                'unset' => 'unset',
            ))
            ->set_default_value('cover'),
            //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
            Field::make('select', 'background-repeat', __('Background Repeat'))
            ->set_options(array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat',
                'initial' => 'initial',
                'inherit' => 'inherit',
            ))
            ->set_default_value('repeat'),
            Field::make('select', 'background-attachment', __('Background Attachment'))
            ->set_options(array(
                'scroll' => 'Scroll',
                'fixed' => 'Fixed',
            ))
            ->set_default_value('scroll'),
        )),
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_block_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag'),
        Field::make('textarea', 'mos_block_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {        
        $id = 'element-'.time().rand(1000, 9999);
    ?>
        <div id="<?php echo $id ?>" class="mos-block-wrapper <?php echo @$fields['mos_block_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
        <div class="title <?php echo @$fields['mos_block_title_class']; ?>"><?php echo $fields['mos_block_title'] ?></div>
        </div>        
        <?php if(@$fields['mos_block_style']) : ?>
        <style><?php echo str_replace("selector",'#'.$id,$fields['mos_block_style']); ?></style>
        <?php endif?>
        
        <style>            
            <?php echo '#'.$id ?> {
                <?php if (@$fields['mos_block_background'][0]['background-color']) : ?>
                    background-color: <?php echo $fields['mos_block_background'][0]['background-color'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_block_background'][0]['background-image']) : ?>
                    background-image: url(<?php echo wp_get_attachment_url($fields['mos_block_background'][0]['background-image']) ?>);
                <?php endif?>
                <?php if (@$fields['mos_block_background'][0]['background-position']) : ?>
                    background-position: <?php echo $fields['mos_block_background'][0]['background-position'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_block_background'][0]['background-size']) : ?>
                    background-size: <?php echo $fields['mos_block_background'][0]['background-size'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_block_background'][0]['background-repeat']) : ?>
                    background-repeat: <?php echo $fields['mos_block_background'][0]['background-repeat'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_block_background'][0]['background-attachment']) : ?>
                    background-attachment: <?php echo $fields['mos_block_background'][0]['background-attachment'] ?>;
                <?php endif?>
            }
        </style>
        <?php if(@$fields['mos_block_script']) : ?>
        <script><?php echo $fields['mos_block_script']; ?></script>
        <?php endif?>
    <?php
    }); 
    //Base Block end
    */
    //Accordion Block start
    Block::make(__('Accordion Block'))
    ->add_tab(__('Content'), array(
        Field::make('complex', 'mos_accordion_list', __('Accordions'))
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('rich_text', 'desc', __('Intro')),
        )),
    ))
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_accordion_wrapper_class', __('Wrapper Class')),
        Field::make('text', 'mos_accordion_title_class', __('Title Class')),
        Field::make('text', 'mos_accordion_desc_class', __('Intro Class')),
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_accordion_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag'),
        Field::make('textarea', 'mos_accordion_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {        
        $id = 'element-'.time().rand(1000, 9999);
        if (@$fields['mos_accordion_list'] && sizeof($fields['mos_accordion_list'])) :
    ?>
        <div id="<?php echo $id ?>" class="mos-accordion-block-wrapper <?php echo @$fields['mos_accordion_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
            <?php foreach($fields['mos_accordion_list'] as $accordion) : ?>
                <div id="<?php echo $accordion['_id'] ?>" class="accordion-unit">
                   <h4 class="accordion-title <?php echo @$fields['mos_accordion_title_class']; ?>"><?php echo $accordion['title'] ?></h4>
                   <div class="accordion-desc <?php echo @$fields['mos_accordion_desc_class']; ?>"><?php echo $accordion['desc'] ?></div>
                </div>
            <?php endforeach?>
        </div>        
        <?php if(@$fields['mos_accordion_style']) : ?>
        <style><?php echo str_replace("selector",'#'.$id,$fields['mos_accordion_style']); ?></style>
        <?php endif?>
        <?php if(@$fields['mos_accordion_script']) : ?>
        <script><?php echo $fields['mos_accordion_script']; ?></script>
        <?php endif?>
    <?php
        endif;
    }); 
    //Accordion Block end
    //Video Block start
    Block::make(__('Video Block'))
    ->add_tab(__('Content'), array(
        Field::make( 'image', 'mos_video_block_poster', 'Poster' )
        ->set_value_type( 'url' )
        ->set_required( true ),
        Field::make('select', 'mos_video_block_type', __('Video Type'))
        ->set_options(array(
            'inline' => 'Self Hosted',
            'iframe' => 'Embeded',
        ))
        ->set_default_value('inline'),   
        
        Field::make('text', 'mos_video_block_iframe_link', __('Video Link'))
        ->set_attribute( 'type', 'url' )
        ->set_required( true )
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos_video_block_type',
                'value' => 'iframe', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        )),
        
        Field::make( 'file', 'mos_video_block_inline_link', 'Video Link' )
        ->set_type( 'video' )
        ->set_required( true )
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos_video_block_type',
                'value' => 'inline', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        )),
    ))
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_video_block_wrapper_class', __('Wrapper Class')),
        Field::make('text', 'mos_video_block_title_class', __('Title Class')),        
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_video_block_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag'),
        Field::make('textarea', 'mos_video_block_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {        
        $id = 'element-'.time().rand(1000, 9999);
    ?>
        <div id="<?php echo $id ?>" class="mos-video-wrapper position-relative mos-video-block-wrapper <?php echo @$fields['mos_video_block_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
        
            <?php if (@$fields['mos_video_block_poster']) :?>
                <div class="image-wrap"><img src="<?php echo $fields['mos_video_block_poster'] ?>" class="img-fluid"></div>
            <?php endif?>              
            <?php if (@$fields['mos_video_block_type'] == 'iframe') :?>
                <a href="#" class="hidden-link mos-video-activator" data-url="<?php echo @$fields['mos_video_block_iframe_link'] ?>" data-type="<?php echo @$fields['mos_video_block_type'] ?>">Open Video</a>                  
                <div class="video-wrap video-iframe-wrap ratio ratio-16x9"><iframe src="" allowfullscreen></iframe></div>
            <?php else : ?>                
                <a href="#" class="hidden-link mos-video-activator" data-url="<?php echo wp_get_attachment_url(@$fields['mos_video_block_inline_link']) ?>" data-type="<?php echo @$fields['mos_video_block_type'] ?>">Open Video</a>                 
                <div class="video-wrap video-inline-wrap"><video src="" class="object-fit-fill" autoplay controls></video></div>
            <?php endif?>
            
        </div>        
        <?php if(@$fields['mos_video_block_style']) : ?>
        <style><?php echo str_replace("selector",'#'.$id,$fields['mos_video_block_style']); ?></style>
        <?php endif?>
        <?php if(@$fields['mos_video_block_script']) : ?>
        <script><?php echo $fields['mos_video_block_script']; ?></script>
        <?php endif?>
    <?php
    }); 
    //Video Block end
    
    //Posts Block start
    Block::make(__('Posts Block'))
    ->add_tab(__('Content'), array(
        Field::make('text', 'mos_posts_block_nop', __('Number of post'))
        ->set_attribute( 'type', 'number' )
        ->set_attribute( 'min', 1 ),
    ))
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_posts_block_wrapper_class', __('Wrapper Class')),
        Field::make('complex', 'mos_posts_block_background', __('Background'))
        ->set_max(1)
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('color', 'background-color', __('Background Color')),
            Field::make('image', 'background-image', __('Background Image')),
            Field::make('select', 'background-position', __('Background Position'))
            ->set_options(array(
                'top left' => 'Top Left',
                'top center' => 'Top Center',
                'top right' => 'Top Right',
                'center left' => 'Center Left',
                'center center' => 'Center Center',
                'center right' => 'Center Right',
                'bottom left' => 'Bottom left',
                'bottom center' => 'Bottom Center',
                'bottom right' => 'Bottom Right',
            ))
            ->set_default_value('top left'),
            Field::make('select', 'background-size', __('Background Size'))
            ->set_options(array(
                'cover' => 'cover',
                'contain' => 'contain',
                'auto' => 'auto',
                'inherit' => 'inherit',
                'initial' => 'initial',
                'revert' => 'revert',
                'revert-layer' => 'revert-layer',
                'unset' => 'unset',
            ))
            ->set_default_value('cover'),
            //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
            Field::make('select', 'background-repeat', __('Background Repeat'))
            ->set_options(array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat',
                'initial' => 'initial',
                'inherit' => 'inherit',
            ))
            ->set_default_value('repeat'),
            Field::make('select', 'background-attachment', __('Background Attachment'))
            ->set_options(array(
                'scroll' => 'Scroll',
                'fixed' => 'Fixed',
            ))
            ->set_default_value('scroll'),
        )),
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_posts_block_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag'),
        Field::make('textarea', 'mos_posts_block_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {        
        $id = 'element-'.time().rand(1000, 9999);
    ?>
        <div id="<?php echo $id ?>" class="mos-posts-block-wrapper <?php echo @$fields['mos_posts_block_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
            
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => (@$fields['mos_posts_block_nop'])?$fields['mos_posts_block_nop']:'-1',
                'ignore_sticky_posts' => 1
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : ?>
                <div class="mos-posts-grid gap-30">
                <?php $n = 0;?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <?php $categories = get_the_category();?>
                    <div class="post-unit position-relative six <?php  echo (!$n)?"merge-three-rows featured-post":"" ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a class="part-media" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                    <?php endif; ?>
                        <div class="part-text">
                            <div class="wrapper">
                            <?php if ($categories && sizeof($categories)) : ?>
                                <?php foreach( $categories as $category ) {
                                    echo sprintf( 
                                        '<a class="post-category" href="%1$s" alt="%2$s">%3$s</a>',
                                        esc_url( get_category_link( $category->term_id ) ),
                                        esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                                        esc_html( $category->name )
                                    );
                                }  ?>
                            <?php endif; ?>
                            <a class="post-title" href="<?php the_permalink(); ?>"><h4><?php echo esc_html( get_the_title() )?></h4></a>
                            <span class="post-entry-date"><?php echo get_the_date(); ?></span>
                            </div>
                        </div>
                        
                    </div>
                    <?php $n++ ?>
                <?php endwhile; ?>
                </div>
            <?php endif;
            wp_reset_postdata();
            ?>
        </div>        
        <?php if(@$fields['mos_posts_block_style']) : ?>
        <style><?php echo str_replace("selector",'#'.$id,$fields['mos_posts_block_style']); ?></style>
        <?php endif?>
        
        <style>            
            <?php echo '#'.$id ?> {
                <?php if (@$fields['mos_posts_block_background'][0]['background-color']) : ?>
                    background-color: <?php echo $fields['mos_posts_block_background'][0]['background-color'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_posts_block_background'][0]['background-image']) : ?>
                    background-image: url(<?php echo wp_get_attachment_url($fields['mos_posts_block_background'][0]['background-image']) ?>);
                <?php endif?>
                <?php if (@$fields['mos_posts_block_background'][0]['background-position']) : ?>
                    background-position: <?php echo $fields['mos_posts_block_background'][0]['background-position'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_posts_block_background'][0]['background-size']) : ?>
                    background-size: <?php echo $fields['mos_posts_block_background'][0]['background-size'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_posts_block_background'][0]['background-repeat']) : ?>
                    background-repeat: <?php echo $fields['mos_posts_block_background'][0]['background-repeat'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_posts_block_background'][0]['background-attachment']) : ?>
                    background-attachment: <?php echo $fields['mos_posts_block_background'][0]['background-attachment'] ?>;
                <?php endif?>
            }
        </style>
        <?php if(@$fields['mos_posts_block_script']) : ?>
        <script><?php echo $fields['mos_posts_block_script']; ?></script>
        <?php endif?>
    <?php
    }); 
    //Posts Block end
    //Counter Block start
    Block::make(__('Counter Block'))
    ->add_tab(__('Content'), array(
        Field::make('text', 'mos_counter_block_prefix', __('Prefix')),
        Field::make('text', 'mos_counter_block_number', __('Number'))
        ->set_attribute( 'type', 'number' )
        ->set_attribute( 'min', 1 ),
        Field::make('text', 'mos_counter_block_suffix', __('Suffix')),
    ))
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_counter_block_wrapper_class', __('Wrapper Class')),
        Field::make('complex', 'mos_counter_block_background', __('Background'))
        ->set_max(1)
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('color', 'background-color', __('Background Color')),
            Field::make('image', 'background-image', __('Background Image')),
            Field::make('select', 'background-position', __('Background Position'))
            ->set_options(array(
                'top left' => 'Top Left',
                'top center' => 'Top Center',
                'top right' => 'Top Right',
                'center left' => 'Center Left',
                'center center' => 'Center Center',
                'center right' => 'Center Right',
                'bottom left' => 'Bottom left',
                'bottom center' => 'Bottom Center',
                'bottom right' => 'Bottom Right',
            ))
            ->set_default_value('top left'),
            Field::make('select', 'background-size', __('Background Size'))
            ->set_options(array(
                'cover' => 'cover',
                'contain' => 'contain',
                'auto' => 'auto',
                'inherit' => 'inherit',
                'initial' => 'initial',
                'revert' => 'revert',
                'revert-layer' => 'revert-layer',
                'unset' => 'unset',
            ))
            ->set_default_value('cover'),
            //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
            Field::make('select', 'background-repeat', __('Background Repeat'))
            ->set_options(array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat',
                'initial' => 'initial',
                'inherit' => 'inherit',
            ))
            ->set_default_value('repeat'),
            Field::make('select', 'background-attachment', __('Background Attachment'))
            ->set_options(array(
                'scroll' => 'Scroll',
                'fixed' => 'Fixed',
            ))
            ->set_default_value('scroll'),
        )),
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_counter_block_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag'),
        Field::make('textarea', 'mos_counter_block_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {        
        $id = 'element-'.time().rand(1000, 9999);
    ?>
        <div id="<?php echo $id ?>" class="mos-counter-block-wrapper <?php echo @$fields['mos_counter_block_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
            <span class="prefix"><?php echo $fields['mos_counter_block_prefix'] ?></span>
            <span class="counter"><?php echo $fields['mos_counter_block_number'] ?></span>
            <span class="suffix"><?php echo $fields['mos_counter_block_suffix'] ?></span>
        </div>        
        <?php if(@$fields['mos_counter_block_style']) : ?>
        <style><?php echo str_replace("selector",'#'.$id,$fields['mos_counter_block_style']); ?></style>
        <?php endif?>
        
        <style>            
            <?php echo '#'.$id ?> {
                <?php if (@$fields['mos_counter_block_background'][0]['background-color']) : ?>
                    background-color: <?php echo $fields['mos_counter_block_background'][0]['background-color'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_counter_block_background'][0]['background-image']) : ?>
                    background-image: url(<?php echo wp_get_attachment_url($fields['mos_counter_block_background'][0]['background-image']) ?>);
                <?php endif?>
                <?php if (@$fields['mos_counter_block_background'][0]['background-position']) : ?>
                    background-position: <?php echo $fields['mos_counter_block_background'][0]['background-position'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_counter_block_background'][0]['background-size']) : ?>
                    background-size: <?php echo $fields['mos_counter_block_background'][0]['background-size'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_counter_block_background'][0]['background-repeat']) : ?>
                    background-repeat: <?php echo $fields['mos_counter_block_background'][0]['background-repeat'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_counter_block_background'][0]['background-attachment']) : ?>
                    background-attachment: <?php echo $fields['mos_counter_block_background'][0]['background-attachment'] ?>;
                <?php endif?>
            }
        </style>
        <?php if(@$fields['mos_counter_block_script']) : ?>
        <script><?php echo $fields['mos_counter_block_script']; ?></script>
        <?php endif?>
    <?php
    }); 
    //Counter Block end
    //Card Block start
    Block::make(__('Card Block'))
    ->add_tab(__('Content'), array(
        Field::make('text', 'mos_card_title', __('Title')),
        Field::make('rich_text', 'mos_card_desc', __('Intro')),
        Field::make('text', 'mos_card_button_title', __('Button Title')),
        Field::make('text', 'mos_card_button_url', __('Button URL')),
        Field::make( 'image', 'mos_card_image', __( 'Image' ) ),
        Field::make('text', 'mos_card_icon', __('Icon Class')),
        Field::make('textarea', 'mos_card_svg', __('SVG')),
    ))
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_card_wrapper_class', __('Wrapper Class')),
        Field::make('text', 'mos_card_title_class', __('Title Class')),
        Field::make('text', 'mos_card_intro_class', __('Intro Class')),
        Field::make('text', 'mos_card_button_class', __('Button Class')),
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_card_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag, you can use selector tag to target the parent element'),
        Field::make('textarea', 'mos_card_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {        
        $id = 'element-'.time().rand(1000, 9999);
    ?>
        <div id="<?php echo $id ?>" class="mos-card-wrapper <?php echo @$fields['mos_card_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
            <div class="media-part">
                <?php if(@$fields['mos_card_image']) : ?>
                    <div class="img-part">
                        <?php echo wp_get_attachment_image( $fields['mos_card_image'], "full", "", array( "class" => "img-fluid" ) );  ?>
                    </div>
                <?php endif?>                 
                <?php if (@$fields['mos_card_svg']) : ?>
                    <span class="svg"><?php echo @$fields['mos_card_svg']; ?></span>
                <?php endif?>
                <?php if (@$fields['mos_card_icon']) : ?>
                    <i class="icon <?php echo @$fields['mos_card_icon']; ?>"></i>
                <?php endif?>
            </div> 
            <div class="text-part">
                <?php if(@$fields['mos_card_title']) : ?><div class="title <?php echo @$fields['mos_card_title_class']; ?>"><?php echo $fields['mos_card_title'] ?></div><?php endif?>
                <?php if(@$fields['mos_card_desc']) : ?><div class="intro <?php echo @$fields['mos_card_intro_class']; ?>"><?php echo do_shortcode($fields['mos_card_desc']); ?></div><?php endif?>
        
                <?php if(@$fields['mos_card_button_title'] && @$fields['mos_card_button_url']) : ?>
                    <div class="is-layout-flex wp-block-buttons">
                        <div class="wp-block-button"><a href="<?php echo $fields['mos_card_button_url'] ?>" class="wp-block-button__link wp-element-button <?php echo @$fields['mos_card_button_class']; ?>"><?php echo $fields['mos_card_button_title'] ?></a></div>
                    </div>
                <?php endif?>
            </div>
        </div>        
        <?php if(@$fields['mos_card_style']) : ?>
            <style><?php echo str_replace("selector",'#'.$id,$fields['mos_card_style']); ?></style>
        <?php endif?>
        <?php if(@$fields['mos_card_script']) : ?>
            <script><?php echo $fields['mos_card_script']; ?></script>
        <?php endif?>
    <?php
    }); 
    //Card Block end    
    //Section Title Block start
    Block::make(__('Section Title Block'))        
    ->add_tab( __( 'Scripts' ), array(
        Field::make('textarea', 'mos_sec_style', __('Style'))
        ->set_help_text( 'Please write your custom css without style tag, you can target the parent element with "selector" tag' )
        ->set_classes('css-editor'),
        Field::make('textarea', 'mos_sec_script', __('Script'))
        ->set_help_text( 'Please write your custom script without script tag' )        
        ->set_classes('js-editor'),
    ))  
    ->add_tab( __( 'Content' ), array(
        Field::make('text', 'mos_sec_subtitle', __('Sub Title')),
        Field::make('text', 'mos_sec_title', __('Main Title')),
        Field::make('textarea', 'mos_sec_desc', __('Intro')),
        Field::make('text', 'mos_sec_button_title', __('Button Title')),
        Field::make('text', 'mos_sec_button_url', __('Button URL')),
        Field::make( 'image', 'mos_sec_image', __( 'Image' ) ),
    ))
    ->add_tab( __( 'Style' ), array(
        Field::make( 'select', 'mos_sec_text_align', __( 'Text Alignment' ) )
        ->set_options( array(
            'text-start' => 'Left',
            'text-center' => 'Center',
            'text-end' => 'Right',
        )),
        Field::make('text', 'mos_sec_class', __('Section Class')),
        Field::make('text', 'mos_sec_subtitle_class', __('Sub Title Class')),
        Field::make('text', 'mos_sec_title_class', __('Main Title Class')),
        Field::make('text', 'mos_sec_intro_class', __('Intro Class')),
        Field::make('text', 'mos_sec_button_class', __('Button Class')),
        Field::make('text', 'mos_sec_image_class', __('Button Class')),
    ))
    ->add_tab( __( 'Animation' ), array(
        
        Field::make( 'separator', 'mos_sec_subtitle_animation_separator', __( 'Sub Title' ) ),
        Field::make( 'select', 'mos_sec_subtitle_animation_option', __( 'Animation' ) )
        ->add_options( $animation_options),
        Field::make('text', 'mos_sec_subtitle_animation_delay', __('Animation Delay'))
        ->set_default_value('0')
        ->set_help_text( 'Please add animation delay, unit will be ms.' ),
        
        Field::make( 'separator', 'mos_sec_title_animation_separator', __( 'Main Title' ) ),
        Field::make( 'select', 'mos_sec_title_animation_option', __( 'Animation' ) )
        ->add_options( $animation_options),
        Field::make('text', 'mos_sec_title_animation_delay', __('Animation Delay'))
        ->set_default_value('0')
        ->set_help_text( 'Please add animation delay, unit will be ms.' ),
        
        Field::make( 'separator', 'mos_sec_desc_animation_separator', __( 'Intro' ) ),
        Field::make( 'select', 'mos_sec_desc_animation_option', __( 'Animation' ) )
        ->add_options( $animation_options),
        Field::make('text', 'mos_sec_desc_animation_delay', __('Animation Delay'))
        ->set_default_value('0')
        ->set_help_text( 'Please add animation delay, unit will be ms.' ),
        
        Field::make( 'separator', 'mos_sec_btn_animation_separator', __( 'Button' ) ),
        Field::make( 'select', 'mos_sec_btn_animation_option', __( 'Animation' ) )
        ->add_options( $animation_options),
        Field::make('text', 'mos_sec_btn_animation_delay', __('Animation Delay'))
        ->set_default_value('0')
        ->set_help_text( 'Please add animation delay, unit will be ms.' ),
        
        Field::make( 'separator', 'mos_sec_image_animation_separator', __( 'Image' ) ),
        Field::make( 'select', 'mos_sec_image_animation_option', __( 'Animation' ) )
        ->add_options( $animation_options),
        Field::make('text', 'mos_sec_image_animation_delay', __('Animation Delay'))
        ->set_default_value('0')
        ->set_help_text( 'Please add animation delay, unit will be ms.' ),
    ))      
        
    /*->add_fields(array(
        Field::make('text', 'mos_sec_subtitle', __('Section Name')),
        Field::make('text', 'mos_sec_title', __('Section TagLine')),
        Field::make('text', 'mos_sec_desc', __('Section Intro')),
    ))*/
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        $id = 'element-'.time().rand(1000, 9999);
        ?>
        <div id="<?php echo $id ?>" class="section-heading <?php echo @$fields['mos_sec_text_align']; ?> <?php echo @$fields['mos_sec_class']; ?> <?php echo @$attributes['className']; ?>">
            <div class="text-part">
            <?php if(@$fields['mos_sec_subtitle']) : ?><h6 class="sub-title <?php echo @$fields['mos_sec_subtitle_class']; ?> wow <?php echo @$fields['mos_sec_subtitle_animation_option'] ?>" data-wow-delay="<?php echo @$fields['mos_sec_subtitle_animation_delay'] ?>ms"><?php echo do_shortcode($fields['mos_sec_subtitle']); ?></h6><?php endif?>
            
            <?php if(@$fields['mos_sec_title']) : ?><h2 class="title <?php echo @$fields['mos_sec_title_class']; ?> wow <?php echo @$fields['mos_sec_title_animation_option'] ?>" data-wow-delay="<?php echo @$fields['mos_sec_title_animation_delay'] ?>ms"><?php echo do_shortcode($fields['mos_sec_title']); ?></h2><?php endif?>
            
            <?php if(@$fields['mos_sec_desc']) : ?><div class="intro <?php echo @$fields['mos_sec_intro_class']; ?> wow <?php echo @$fields['mos_sec_desc_animation_option'] ?>" data-wow-delay="<?php echo @$fields['mos_sec_desc_animation_delay'] ?>ms"><?php echo do_shortcode($fields['mos_sec_desc']); ?></div><?php endif?>
            
            <?php if(@$fields['mos_sec_button_title'] && @$fields['mos_sec_button_url']) : ?>
            <div class="common-btn <?php echo @$fields['mos_sec_button_class']; ?> wow <?php echo @$fields['mos_sec_button_animation_option'] ?>" data-wow-delay="<?php echo @$fields['mos_sec_button_animation_delay'] ?>ms">
                <a href="<?php echo do_shortcode($fields['mos_sec_button_url'])?>" class="fill-btn fw-semi-bold text-gray_1 lh-20 text-decoration-none bg-flourescent_blue radius-4 d-inline-flex align-items-center gap-2">
                    <span><?php echo do_shortcode($fields['mos_sec_button_title'])?></span>
                    <span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.5117 8.82164L10.9342 5.24414L9.75591 6.42247L12.5001 9.16664H4.16675V10.8333H12.5001L9.75591 13.5775L10.9342 14.7558L14.5117 11.1783C14.8242 10.8658 14.9997 10.4419 14.9997 9.99997C14.9997 9.55803 14.8242 9.13419 14.5117 8.82164Z" fill="#002448"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <?php endif?>
            </div>    
            <?php if(@$fields['mos_sec_image']) : ?>
                <div class="img-part <?php echo @$fields['mos_sec_image_class']; ?> wow <?php echo @$fields['mos_sec_image_animation_option'] ?>" data-wow-delay="<?php echo @$fields['mos_sec_image_animation_delay'] ?>ms">
                    <?php echo wp_get_attachment_image( $fields['mos_sec_image'], "full", "", array( "class" => "img-fluid" ) );  ?>
                </div>
            <?php endif?>   
        </div>
        <?php if(@$fields['mos_sec_style']) : ?>
        <style><?php echo str_replace("selector",'#'.$id,$fields['mos_sec_style']); ?></style>
        <?php endif?>
        <?php if(@$fields['mos_sec_script']) : ?>
        <script><?php echo $fields['mos_sec_script']; ?></script>
        <?php endif?>
        <?php
    }); 
    //Section Title Block end
    
    //Icon List Block start
    Block::make(__('Icon List Block'))
    ->set_icon('editor-ul')
    ->add_tab(__('Content'), array(
        Field::make('complex', 'mos_icon_list_items', __('Icon List'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title'))
            ->set_required( true ),
            Field::make('rich_text', 'intro', __('Intro')),
            Field::make('image', 'image', __('Image')),
            Field::make('text', 'icon', __('Icon Class')),
            Field::make('textarea', 'svg', __('SVG')),
            Field::make('text', 'link', __('Link'))
            ->set_attribute( 'type', 'url' ),
            Field::make( 'select', 'target', __( 'Target' ) )
            ->set_options( array(
                '0' => 'None',
                '_blank' => '_blank',
                '_self' => '_self',
                '_parent' => '_parent',
                '_top' => '_top',
            ))
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %>
            <% } %>
        ')
        ->set_collapsed(true),
    ))
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_icon_list_block_wrapper_class', __('Wrapper Class')),
        Field::make( 'checkbox', 'mos_icon_list_block_hide_title', 'Hide Title' )
    ))      
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_icon_list_block_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag, you can use selector tag to target the parent element'),
        Field::make('textarea', 'mos_icon_list_block_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    )) 
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        if (@$fields['mos_icon_list_items'] && sizeof($fields['mos_icon_list_items'])) {
            $id = 'element-'.time().rand(1000, 9999);
        ?>
            <div id="<?php echo $id ?>" class="mos-icon-list-wrapper <?php echo @$fields['mos_icon_list_block_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
                <?php foreach($fields['mos_icon_list_items'] as $item) : ?>
                    <div class="unit position-relative">
                    <?php if (@$item['title'] && !@$fields['mos_icon_list_block_hide_title']) : ?>
                        <span class="title"><?php echo $item['title'] ?></span>
                    <?php endif?>
                    <?php if (@$item['svg']) : ?>
                        <span class="svg"><?php echo @$item['svg']; ?></span>
                    <?php endif?>
                    <?php if (@$item['icon']) : ?>
                        <i class="icon <?php echo @$item['icon']; ?>"></i>
                    <?php endif?>                    
                    <?php if(@$item['image']) : ?>
                        <div class="image">
                            <?php echo wp_get_attachment_image( $item['image'], "full", "", array( "class" => "img-fluid" ) );  ?>
                        </div>
                    <?php endif?>
                    <?php if (@$item['intro']) : ?>
                        <div class="intro"><?php echo @$item['intro']; ?></div>
                    <?php endif?>
                    <?php if (@$item['link']) : ?>
                        <a href="<?php echo @$item['link']; ?>" class="hidden-link" <?php echo (@$item['target'])?'target="'.$item['target'].'"':''; ?>>Read More</a>
                    <?php endif?>
                    </div>
                <?php endforeach?>
            </div>
            <?php if(@$fields['mos_icon_list_block_style']) : ?>
            <style><?php echo str_replace("selector",'#'.$id,$fields['mos_icon_list_block_style']); ?></style>
            <?php endif?>
            <?php if(@$fields['mos_icon_list_block_script']) : ?>
            <script><?php echo $fields['mos_icon_list_block_script']; ?></script>
            <?php endif?>
        <?php
        }
    }); 
    //Icon List Block end
    
    //Image Slider Block start
    Block::make(__('Image Slider Block'))
    ->set_icon('images-alt2')
    ->add_tab(__('Content'), array(
        Field::make('complex', 'mos_image_slider_items', __('Items'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('text', 'url', __('Link'))
            ->set_attribute( 'type', 'url' ),
            Field::make('image', 'image', __('Image'))
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %>
            <% } %>
        ')
        ->set_collapsed(true),
    ))
    ->add_tab(__('Slider Settings'), array(
        Field::make('text', 'mos_image_slider_desktop_count', __('Desktop Items'))
        ->set_attribute( 'type', 'number' )
        ->set_attribute( 'min', 1 )
        ->set_default_value(3),
        Field::make('text', 'mos_image_slider_tab_count', __('Tab Items'))
        ->set_attribute( 'type', 'number' )
        ->set_attribute( 'min', 1 )
        ->set_default_value(2),
        Field::make('text', 'mos_image_slider_mobile_count', __('Mobile Items'))
        ->set_attribute( 'type', 'number' )
        ->set_attribute( 'min', 1 )
        ->set_default_value(1),
        Field::make( 'checkbox', 'mos_image_slider_show_nav', __('Show Nav')),
        Field::make( 'checkbox', 'mos_image_slider_show_dots', __('Show Dots')),
        Field::make( 'checkbox', 'mos_image_slider_autoplay', __('Autoplay')),
        Field::make( 'checkbox', 'mos_image_slider_hover_pause', __('Hover Pause')),
        Field::make('text', 'mos_image_slider_autoplay_timeout', __('Autoplay Time'))
        ->set_attribute( 'type', 'number' )
        ->set_default_value(3000),
    ))  
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_image_slider_wrapper_class', __('Wrapper Class')),  
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_image_slider_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag, you can use selector tag to target the parent element'),
        Field::make('textarea', 'mos_image_slider_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        if (@$fields['mos_image_slider_items'] && sizeof($fields['mos_image_slider_items'])) :
            $id = 'element-'.time().rand(1000, 9999);
        ?>
            <div id="<?php echo $id ?>" class="mos-image-slider-wrapper <?php echo @$fields['mos_image_slider_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
                <div class="mos-slider mos-owl-carousel owl-carousel owl-theme" data-carousel-options='{
                    "nav":<?php echo (@$fields['mos_image_slider_show_nav'])?"true":"false" ?>,
                    "dots":<?php echo (@$fields['mos_image_slider_show_dots'])?"true":"false" ?>,
                    "autoplay":<?php echo (@$fields['mos_image_slider_autoplay'])?"true":"false" ?>,
                    "autoplayTimeout":"<?php echo (@$fields['mos_image_slider_autoplay_timeout'])?$fields['mos_image_slider_autoplay_timeout']:3000 ?>",
                    "autoplayHoverPause":<?php echo (@$fields['mos_image_slider_hover_pause'])?"true":"false" ?>,
                    "responsive":{
                        "0":{
                            "items":"<?php echo (@$fields['mos_image_slider_mobile_count'])?$fields['mos_image_slider_mobile_count']:1 ?>"
                        },
                        "600":{
                            "items":"<?php echo (@$fields['mos_image_slider_tab_count'])?$fields['mos_image_slider_tab_count']:2 ?>"
                        },
                        "1000":{
                            "items":"<?php echo (@$fields['mos_image_slider_desktop_count'])?$fields['mos_image_slider_desktop_count']:3 ?>"
                        }
                    }
                }'>
                    <?php foreach($fields['mos_image_slider_items'] as $key => $slider) : ?>                        
                        <?php if (@$slider['image']) : ?>
                            <div class="item item-<?php echo $key ?>">
                                <div class="wrapper position-relative">
                                    <?php echo wp_get_attachment_image( $slider['image'], "full", "", array( "class" => "img-responsive img-fluid" ) );?>
                                    <?php if (@$slider['url']) : ?>
                                        <a href="<?php echo $slider['url'] ?>" class="hidden-link">Read more</a>
                                    <?php endif?>
                                </div>
                            </div>
                        <?php endif?>
                    <?php endforeach?>
                </div>
            </div>
            <?php if(@$fields['mos_image_slider_style']) : ?>
            <style><?php echo str_replace("selector",'#'.$id,$fields['mos_image_slider_style']); ?></style>
            <?php endif?>
            <?php if(@$fields['mos_image_slider_script']) : ?>
            <script><?php echo $fields['mos_image_slider_script']; ?></script>
            <?php endif?>
        <?php
        endif;
    }); 
    //Image Slider Block end

    //Slider Block start
    Block::make(__('Slider Block'))
    ->set_icon('images-alt2')
    ->add_tab(__('Content'), array(
        Field::make('complex', 'mos_slider_items', __('Items'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('rich_text', 'intro', __('Intro')),
            Field::make('image', 'image', __('Image')),
            Field::make('image', 'image-2', __('Image 2')),
            Field::make('complex', 'buttons', __('Buttons'))
            ->add_fields(array(
                Field::make('text', 'title', __('Title')),
                Field::make('text', 'url', __('Link'))
                ->set_attribute( 'type', 'url' ),
            ))
            ->set_header_template('
                <% if (title) { %>
                    <%- title %>
                <% } %>
            ')
            ->set_collapsed(true),

        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %>
            <% } %>
        ')
        ->set_collapsed(true),
    ))
    ->add_tab(__('Slider Settings'), array(
        Field::make('text', 'mos_slider_desktop_count', __('Desktop Items'))
        ->set_attribute( 'type', 'number' )
        ->set_attribute( 'min', 1 )
        ->set_default_value(3),
        Field::make('text', 'mos_slider_tab_count', __('Tab Items'))
        ->set_attribute( 'type', 'number' )
        ->set_attribute( 'min', 1 )
        ->set_default_value(2),
        Field::make('text', 'mos_slider_mobile_count', __('Mobile Items'))
        ->set_attribute( 'type', 'number' )
        ->set_attribute( 'min', 1 )
        ->set_default_value(1),
        Field::make( 'checkbox', 'mos_slider_show_nav', __('Show Nav')),
        Field::make( 'checkbox', 'mos_slider_show_dots', __('Show Dots')),
        Field::make( 'checkbox', 'mos_slider_autoplay', __('Autoplay')),
        Field::make( 'checkbox', 'mos_slider_hover_pause', __('Hover Pause')),
        Field::make('text', 'mos_slider_autoplay_timeout', __('Autoplay Time'))
        ->set_attribute( 'type', 'number' )
        ->set_default_value(3000),
    ))  
    ->add_tab(__('Style'), array(
        Field::make( 'select', 'mos_slider_title_element', __( 'Title Tag' ) )
        ->set_options( array(
            'h1' => 'H1 tag',
            'h2' => 'H2 tag',
            'h3' => 'H3 tag',
            'h4' => 'H4 tag',
            'h5' => 'H5 tag',
            'h6' => 'H6 tag',
            'p' => 'P tag',
            'div' => 'DIV tag',
        ))
        ->set_default_value('h3'),  

        Field::make('text', 'mos_slider_wrapper_class', __('Wrapper Class')),
        Field::make('text', 'mos_slider_title_class', __('Title Class')),
        Field::make('text', 'mos_slider_intro_class', __('Intro Class')),    
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_slider_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag, you can use selector tag to target the parent element'),
        Field::make('textarea', 'mos_slider_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        if (@$fields['mos_slider_items'] && sizeof($fields['mos_slider_items'])) :
            $id = 'element-'.time().rand(1000, 9999);
        ?>
            <div id="<?php echo $id ?>" class="mos-slider-wrapper <?php echo @$fields['mos_slider_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
                <div class="mos-slider mos-owl-carousel owl-carousel owl-theme" data-carousel-options='{
                    "nav":<?php echo (@$fields['mos_slider_show_nav'])?"true":"false" ?>,
                    "dots":<?php echo (@$fields['mos_slider_show_dots'])?"true":"false" ?>,
                    "autoplay":<?php echo (@$fields['mos_slider_autoplay'])?"true":"false" ?>,
                    "autoplayTimeout":"<?php echo (@$fields['mos_slider_autoplay_timeout'])?$fields['mos_slider_autoplay_timeout']:3000 ?>",
                    "autoplayHoverPause":<?php echo (@$fields['mos_slider_hover_pause'])?"true":"false" ?>,
                    "responsive":{
                        "0":{
                            "items":"<?php echo (@$fields['mos_slider_mobile_count'])?$fields['mos_slider_mobile_count']:1 ?>"
                        },
                        "600":{
                            "items":"<?php echo (@$fields['mos_slider_tab_count'])?$fields['mos_slider_tab_count']:2 ?>"
                        },
                        "1000":{
                            "items":"<?php echo (@$fields['mos_slider_desktop_count'])?$fields['mos_slider_desktop_count']:3 ?>"
                        }
                    }
                }'>
                    <?php foreach($fields['mos_slider_items'] as $key => $slider) : ?>
                        <div class="item item-<?php echo $key ?>">
                            <div class="wrapper">
                                <div class="text-part">
                                    <?php if (@$slider['title']) : ?>
                                        <<?php echo $fields['mos_slider_title_element'] ?> class="title <?php echo @$fields['mos_slider_title_class']; ?>"><?php echo $slider['title'] ?></<?php echo $fields['mos_slider_title_element'] ?>>
                                    <?php endif?>
                                    <?php if (@$slider['intro']) : ?>
                                        <div class="intro <?php echo @$fields['mos_slider_intro_class'];?>"><?php echo do_shortcode($slider['intro']) ?></div>
                                    <?php endif?>
                                    <?php if (@$slider['buttons'] && sizeof($slider['buttons'])) : ?>
                                        <?php foreach($slider['buttons'] as $id=>$button) : ?>
                                            <?php if (@$button['title'] && @$button['url']) : ?>
                                            <div class="is-layout-flex wp-block-buttons wp-block-buttons-<?php echo $id ?>">
                                                <div class="wp-block-button"><a href="<?php echo $button['url'] ?>" class="wp-block-button__link wp-element-button"><?php echo $button['title'] ?></a></div>
                                            </div>
                                            <?php endif?>
                                        <?php endforeach?>
                                    <?php endif?>
                                </div>
                                <div class="media-part">
                                    <?php if (@$slider['image']) : ?>
                                        <div class="image-1 <?php echo @$fields['mos_slider_image_class'];?>"><?php echo wp_get_attachment_image( $slider['image'], "full", "", array( "class" => "img-responsive img-fluid" ) );?></div>
                                    <?php endif?>
                                    <?php if (@$slider['image-2']) : ?>
                                        <div class="image-2 <?php echo @$fields['mos_slider_image_class'];?>"><?php echo wp_get_attachment_image( $slider['image-2'], "full", "", array( "class" => "img-responsive img-fluid" ) );?></div>
                                    <?php endif?>
                                </div>
                            </div>                           
                        </div>
                    <?php endforeach?>
                </div>
            </div>
            <?php if(@$fields['mos_slider_style']) : ?>
            <style><?php echo str_replace("selector",'#'.$id,$fields['mos_slider_style']); ?></style>
            <?php endif?>
            <?php if(@$fields['mos_slider_script']) : ?>
            <script><?php echo $fields['mos_slider_script']; ?></script>
            <?php endif?>
        <?php
        endif;
    }); 
    
    //Team Block start
    Block::make(__('Team Block'))
    ->set_icon('admin-users')
    ->add_tab(__('Content'), array(
        Field::make( 'image', 'mos_team_block_image', 'Image' )
        ->set_value_type( 'url' )
        ->set_required( true ),
        Field::make('text', 'mos_team_block_name', __('Name'))
        ->set_required( true ),
        Field::make('text', 'mos_team_block_designation', __('Designation')),
        Field::make('text', 'mos_team_block_link', __('Link'))
        ->set_attribute( 'type', 'url' ),
        Field::make( 'rich_text', 'mos_team_block_intro', 'Intro' )
    ))
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_team_block_wrapper_class', __('Wrapper Class')),
        Field::make('text', 'mos_team_block_title_class', __('Title Class')),
        Field::make('text', 'mos_team_block_degination_class', __('Degination Class')),
        Field::make('text', 'mos_team_block_content_class', __('Content Class')),

        Field::make( 'color', 'mos_team_block_title_color', 'Title Color' ),
        Field::make( 'color', 'mos_team_block_degination_color', 'Degination Color' ),
        Field::make( 'color', 'mos_team_block_content_color', 'Content Color' ),

        Field::make('complex', 'mos_team_block_background', __('Background'))
        ->set_max(1)
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('color', 'background-color', __('Background Color')),
            Field::make('image', 'background-image', __('Background Image')),
            Field::make('select', 'background-position', __('Background Position'))
            ->set_options(array(
                'top left' => 'Top Left',
                'top center' => 'Top Center',
                'top right' => 'Top Right',
                'center left' => 'Center Left',
                'center center' => 'Center Center',
                'center right' => 'Center Right',
                'bottom left' => 'Bottom left',
                'bottom center' => 'Bottom Center',
                'bottom right' => 'Bottom Right',
            ))
            ->set_default_value('top left'),
            Field::make('select', 'background-size', __('Background Size'))
            ->set_options(array(
                'cover' => 'cover',
                'contain' => 'contain',
                'auto' => 'auto',
                'inherit' => 'inherit',
                'initial' => 'initial',
                'revert' => 'revert',
                'revert-layer' => 'revert-layer',
                'unset' => 'unset',
            ))
            ->set_default_value('cover'),
            //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
            Field::make('select', 'background-repeat', __('Background Repeat'))
            ->set_options(array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat',
                'initial' => 'initial',
                'inherit' => 'inherit',
            ))
            ->set_default_value('repeat'),
            Field::make('select', 'background-attachment', __('Background Attachment'))
            ->set_options(array(
                'scroll' => 'Scroll',
                'fixed' => 'Fixed',
            ))
            ->set_default_value('scroll'),
        )),
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_team_block_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag'),
        Field::make('textarea', 'mos_team_block_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {        
        $id = 'element-'.time().rand(1000, 9999);
    ?>
        <div id="<?php echo $id ?>" class="mos-team-block-wrapper single-team-member <?php echo @$fields['mos_team_block_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"  style="<?php if (@$fields['mos_team_block_content_color']) echo 'color:'.$fields['mos_team_block_content_color'] ?>">                 
            <div class="team-member-photo">
                <img src="<?php echo $fields['mos_team_block_image'] ?>" alt="<?php echo $fields['mos_team_block_name'] ?>">
                <?php if (@$fields['mos_team_block_link']) : ?>
                    <a class="view-full-size" href="<?php echo $fields['mos_team_block_link'] ?>" target="_blank" rel="noopener"><span>Know more</span></a>
                <?php endif?>
            </div>            
            <div class="team-member-details">                    
                <?php if (@$fields['mos_team_block_link']) : ?>
                    <a href="<?php echo $fields['mos_team_block_link'] ?>" target="_blank" rel="noopener">
                        <h4 class="<?php echo @$fields['mos_team_block_title_class']; ?>" style="<?php if (@$fields['mos_team_block_title_color']) echo 'color:'.$fields['mos_team_block_title_color'] ?>"><?php echo $fields['mos_team_block_name'] ?></h4>
                    </a>
                <?php else : ?>
                    <h4 class="<?php echo @$fields['mos_team_block_title_class']; ?>" style="<?php if (@$fields['mos_team_block_title_color']) echo 'color:'.$fields['mos_team_block_title_color'] ?>"><?php echo $fields['mos_team_block_name'] ?></h4>
                <?php endif?>

                <?php if (@$fields['mos_team_block_designation']) : ?>
                <span class="caps_small <?php echo @$fields['mos_team_block_degination_class']; ?>" style="<?php if (@$fields['mos_team_block_degination_color']) echo 'color:'.$fields['mos_team_block_degination_color'] ?>"><?php echo $fields['mos_team_block_designation']?></span>
                <?php endif?>

                <?php if (@$fields['mos_team_block_intro']) : ?>
                <div class="team-member-short-description <?php echo @$fields['mos_team_block_content_class']; ?>"><?php echo $fields['mos_team_block_intro']?></div>
                <?php endif?>
            </div>
        </div>        
        <?php if(@$fields['mos_team_block_style']) : ?>
        <style><?php echo str_replace("selector",'#'.$id,$fields['mos_team_block_style']); ?></style>
        <?php endif?>
        
        <style>            
            <?php echo '#'.$id ?> {
                <?php if (@$fields['mos_team_block_background'][0]['background-color']) : ?>
                    background-color: <?php echo $fields['mos_team_block_background'][0]['background-color'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_team_block_background'][0]['background-image']) : ?>
                    background-image: url(<?php echo wp_get_attachment_url($fields['mos_team_block_background'][0]['background-image']) ?>);
                <?php endif?>
                <?php if (@$fields['mos_team_block_background'][0]['background-position']) : ?>
                    background-position: <?php echo $fields['mos_team_block_background'][0]['background-position'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_team_block_background'][0]['background-size']) : ?>
                    background-size: <?php echo $fields['mos_team_block_background'][0]['background-size'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_team_block_background'][0]['background-repeat']) : ?>
                    background-repeat: <?php echo $fields['mos_team_block_background'][0]['background-repeat'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_team_block_background'][0]['background-attachment']) : ?>
                    background-attachment: <?php echo $fields['mos_team_block_background'][0]['background-attachment'] ?>;
                <?php endif?>
            }
        </style>
        <?php if(@$fields['mos_team_block_script']) : ?>
        <script><?php echo $fields['mos_team_block_script']; ?></script>
        <?php endif?>
    <?php
    }); 
    //Team Block end
    //Chart Block start
    Block::make(__('Chart Block'))
    ->set_icon('chart-pie')
    ->add_tab(__('Content'), array(
        Field::make('text', 'mos_chart_block_value', __('Value'))        
        ->set_attribute('type', 'number')
        ->set_required( true ),
    ))
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_chart_block_wrapper_class', __('Wrapper Class')),
        Field::make('text', 'mos_chart_block_radius', __('Radius'))        
        ->set_attribute('type', 'number'),
        Field::make('text', 'mos_chart_block_thickness', __('Thickness'))        
        ->set_attribute('type', 'number'),
        Field::make('text', 'mos_chart_block_padding', __('Padding'))        
        ->set_attribute('type', 'number'),
        Field::make( 'color', 'mos_chart_block_color', 'Color' ),
        Field::make( 'color', 'mos_chart_block_bg', 'Background Color' ),
        Field::make('complex', 'mos_chart_block_background', __('Background'))
        ->set_max(1)
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('color', 'background-color', __('Background Color')),
            Field::make('image', 'background-image', __('Background Image')),
            Field::make('select', 'background-position', __('Background Position'))
            ->set_options(array(
                'top left' => 'Top Left',
                'top center' => 'Top Center',
                'top right' => 'Top Right',
                'center left' => 'Center Left',
                'center center' => 'Center Center',
                'center right' => 'Center Right',
                'bottom left' => 'Bottom left',
                'bottom center' => 'Bottom Center',
                'bottom right' => 'Bottom Right',
            ))
            ->set_default_value('top left'),
            Field::make('select', 'background-size', __('Background Size'))
            ->set_options(array(
                'cover' => 'cover',
                'contain' => 'contain',
                'auto' => 'auto',
                'inherit' => 'inherit',
                'initial' => 'initial',
                'revert' => 'revert',
                'revert-layer' => 'revert-layer',
                'unset' => 'unset',
            ))
            ->set_default_value('cover'),
            //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
            Field::make('select', 'background-repeat', __('Background Repeat'))
            ->set_options(array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat',
                'initial' => 'initial',
                'inherit' => 'inherit',
            ))
            ->set_default_value('repeat'),
            Field::make('select', 'background-attachment', __('Background Attachment'))
            ->set_options(array(
                'scroll' => 'Scroll',
                'fixed' => 'Fixed',
            ))
            ->set_default_value('scroll'),
        )),
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_chart_block_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag'),
        Field::make('textarea', 'mos_chart_block_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {        
        $id = 'element-'.time().rand(1000, 9999);
    ?>
        <div id="<?php echo $id ?>" class="mos-chart-wrapper position-relative <?php echo @$fields['mos_chart_block_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
        <div    data-donutty 
                <?php if (@$fields['mos_chart_block_value']) : ?> data-value="<?php echo $fields['mos_chart_block_value']?>" <?php endif?>
                <?php if (@$fields['mos_chart_block_color']) :  ?> data-color="<?php echo $fields['mos_chart_block_color']?>" <?php endif?> 
                <?php if (@$fields['mos_chart_block_radius']) :  ?> data-radius="<?php echo $fields['mos_chart_block_radius']?>" <?php endif?> 
                <?php if (@$fields['mos_chart_block_thickness']) :  ?> data-thickness="<?php echo $fields['mos_chart_block_thickness']?>" <?php endif?>
                <?php if (@$fields['mos_chart_block_padding']) :  ?> data-padding="<?php echo $fields['mos_chart_block_padding']?>" <?php endif?>
                <?php if (@$fields['mos_chart_block_bg']) :  ?> data-bg="<?php echo $fields['mos_chart_block_bg']?>" <?php endif?>
        ></div>
        </div>        
        <?php if(@$fields['mos_chart_block_style']) : ?>
        <style><?php echo str_replace("selector",'#'.$id,$fields['mos_chart_block_style']); ?></style>
        <?php endif?>
        
        <style>            
            <?php echo '#'.$id ?> {
                <?php if (@$fields['mos_chart_block_background'][0]['background-color']) : ?>
                    background-color: <?php echo $fields['mos_chart_block_background'][0]['background-color'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_chart_block_background'][0]['background-image']) : ?>
                    background-image: url(<?php echo wp_get_attachment_url($fields['mos_chart_block_background'][0]['background-image']) ?>);
                <?php endif?>
                <?php if (@$fields['mos_chart_block_background'][0]['background-position']) : ?>
                    background-position: <?php echo $fields['mos_chart_block_background'][0]['background-position'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_chart_block_background'][0]['background-size']) : ?>
                    background-size: <?php echo $fields['mos_chart_block_background'][0]['background-size'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_chart_block_background'][0]['background-repeat']) : ?>
                    background-repeat: <?php echo $fields['mos_chart_block_background'][0]['background-repeat'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_chart_block_background'][0]['background-attachment']) : ?>
                    background-attachment: <?php echo $fields['mos_chart_block_background'][0]['background-attachment'] ?>;
                <?php endif?>
            }
        </style>
        <?php if(@$fields['mos_chart_block_script']) : ?>
        <script><?php echo $fields['mos_chart_block_script']; ?></script>
        <?php endif?>
    <?php
    }); 
    //Chart Block end
    //Popup Form Block start
    Block::make(__('Popup Form Block'))
    ->add_tab(__('Content'), array(
        Field::make('text', 'mos_popup_form_btn_title', __('Button Title')),
        Field::make('text', 'mos_popup_form_shortcode', __('Form Shortcode')),
    ))
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_popup_form_wrapper_class', __('Wrapper Class')),
        Field::make('text', 'mos_popup_form_shortcode_class', __('Form Class')),
        //is-content-justification-right
        Field::make('complex', 'mos_popup_form_background', __('Background'))
        ->set_max(1)
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('color', 'background-color', __('Background Color')),
            Field::make('image', 'background-image', __('Background Image')),
            Field::make('select', 'background-position', __('Background Position'))
            ->set_options(array(
                'top left' => 'Top Left',
                'top center' => 'Top Center',
                'top right' => 'Top Right',
                'center left' => 'Center Left',
                'center center' => 'Center Center',
                'center right' => 'Center Right',
                'bottom left' => 'Bottom left',
                'bottom center' => 'Bottom Center',
                'bottom right' => 'Bottom Right',
            ))
            ->set_default_value('top left'),
            Field::make('select', 'background-size', __('Background Size'))
            ->set_options(array(
                'cover' => 'cover',
                'contain' => 'contain',
                'auto' => 'auto',
                'inherit' => 'inherit',
                'initial' => 'initial',
                'revert' => 'revert',
                'revert-layer' => 'revert-layer',
                'unset' => 'unset',
            ))
            ->set_default_value('cover'),
            //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
            Field::make('select', 'background-repeat', __('Background Repeat'))
            ->set_options(array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat',
                'initial' => 'initial',
                'inherit' => 'inherit',
            ))
            ->set_default_value('repeat'),
            Field::make('select', 'background-attachment', __('Background Attachment'))
            ->set_options(array(
                'scroll' => 'Scroll',
                'fixed' => 'Fixed',
            ))
            ->set_default_value('scroll'),
        )),
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_popup_form_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag'),
        Field::make('textarea', 'mos_popup_form_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {        
        $id = 'element-'.time().rand(1000, 9999);
    ?>
        <div class="wp-block-buttons">
            <div class="wp-block-button">
                <a href="#" class="wp-block-button__link wp-element-button" data-bs-toggle="modal" data-bs-target="#<?php echo $id ?>"><?php echo $fields['mos_popup_form_btn_title'] ?></a>
            </div>
        </div>
        <?php
        add_action('wp_footer', 
        function() use ( $attributes, $id, $fields ) { 
            generate_popup_form( $attributes, $id, $fields ); 
        });
        ?>      
        <?php if(@$fields['mos_popup_form_style']) : ?>
        <style><?php echo str_replace("selector",'#'.$id,$fields['mos_popup_form_style']); ?></style>
        <?php endif?>
        
        <style>            
            <?php echo '#'.$id ?> {
                <?php if (@$fields['mos_popup_form_background'][0]['background-color']) : ?>
                    background-color: <?php echo $fields['mos_popup_form_background'][0]['background-color'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_popup_form_background'][0]['background-image']) : ?>
                    background-image: url(<?php echo wp_get_attachment_url($fields['mos_popup_form_background'][0]['background-image']) ?>);
                <?php endif?>
                <?php if (@$fields['mos_popup_form_background'][0]['background-position']) : ?>
                    background-position: <?php echo $fields['mos_popup_form_background'][0]['background-position'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_popup_form_background'][0]['background-size']) : ?>
                    background-size: <?php echo $fields['mos_popup_form_background'][0]['background-size'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_popup_form_background'][0]['background-repeat']) : ?>
                    background-repeat: <?php echo $fields['mos_popup_form_background'][0]['background-repeat'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_popup_form_background'][0]['background-attachment']) : ?>
                    background-attachment: <?php echo $fields['mos_popup_form_background'][0]['background-attachment'] ?>;
                <?php endif?>
            }
        </style>
        <?php if(@$fields['mos_popup_form_script']) : ?>
        <script><?php echo $fields['mos_popup_form_script']; ?></script>
        <?php endif?>
    <?php
    }); 
    //Popup Form Block end

    //Tab Block start
    Block::make(__('Tab Block'))
    ->add_tab(__('Content'), array(        
        Field::make('complex', 'mos_tab_block_content', __('Tab Content'))
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('text', 'title', __('Title'))
            ->set_required( true ),            
            Field::make('rich_text', 'desc', __('Intro'))
            ->set_required( true ),
        ))        
        ->set_header_template('
            <% if (title) { %>
                <%- title %>
            <% } %>
        '),
    ))
    ->add_tab(__('Style'), array(
        Field::make('text', 'mos_tab_block_wrapper_class', __('Wrapper Class')),
        Field::make('text', 'mos_tab_block_nav_class', __('Nav Class')),
        Field::make('text', 'mos_tab_block_content_class', __('Content Class')),
        Field::make( 'select', 'mos_tab_block_type', __('Choose Options'))
        ->set_options( array(
            'horizontal'=>'Horizontal tabs',
            'vertical'=>'Vertical tabs',
        )),
        Field::make('complex', 'mos_tab_block_background', __('Background'))
        ->set_max(1)
        ->set_collapsed(true)
        ->add_fields(array(
            Field::make('color', 'background-color', __('Background Color')),
            Field::make('image', 'background-image', __('Background Image')),
            Field::make('select', 'background-position', __('Background Position'))
            ->set_options(array(
                'top left' => 'Top Left',
                'top center' => 'Top Center',
                'top right' => 'Top Right',
                'center left' => 'Center Left',
                'center center' => 'Center Center',
                'center right' => 'Center Right',
                'bottom left' => 'Bottom left',
                'bottom center' => 'Bottom Center',
                'bottom right' => 'Bottom Right',
            ))
            ->set_default_value('top left'),
            Field::make('select', 'background-size', __('Background Size'))
            ->set_options(array(
                'cover' => 'cover',
                'contain' => 'contain',
                'auto' => 'auto',
                'inherit' => 'inherit',
                'initial' => 'initial',
                'revert' => 'revert',
                'revert-layer' => 'revert-layer',
                'unset' => 'unset',
            ))
            ->set_default_value('cover'),
            //background-repeat: repeat|repeat-x|repeat-y|no-repeat|initial|inherit;
            Field::make('select', 'background-repeat', __('Background Repeat'))
            ->set_options(array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat',
                'initial' => 'initial',
                'inherit' => 'inherit',
            ))
            ->set_default_value('repeat'),
            Field::make('select', 'background-attachment', __('Background Attachment'))
            ->set_options(array(
                'scroll' => 'Scroll',
                'fixed' => 'Fixed',
            ))
            ->set_default_value('scroll'),
        )),
    )) 
    ->add_tab(__('Advanced'), array(
        Field::make('textarea', 'mos_tab_block_style', __('Style'))
        ->set_help_text('Please write your custom css without style tag'),
        Field::make('textarea', 'mos_tab_block_script', __('Script'))
        ->set_help_text('Please write your custom script without script tag'),
    ))  
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) {  
        if(@$fields['mos_tab_block_content'] && sizeof($fields['mos_tab_block_content'])) {      
        $id = 'element-'.time().rand(1000, 9999);
        /*
        horizontal attr:
        ul class =  justify-content-center, justify-content-end, nav-pills,  nav-underline, nav-pills nav-fill,  nav-pills nav-justified
        vertical attr: 
        container class = d-flex align-items-start
        ul class =  flex-column
        */
    ?>
        <div id="<?php echo $id ?>" class="mos-tab-block-wrapper <?php echo (@$fields['mos_tab_block_type'] == 'vertical')?'d-flex align-items-start':'' ?> <?php echo @$fields['mos_tab_block_wrapper_class']; ?> <?php echo @$attributes['className']; ?>">
            <ul class="nav <?php echo (@$fields['mos_tab_block_type'] == 'vertical')?'flex-column':'' ?> <?php echo @$fields['mos_tab_block_nav_class'] ?>" role="tablist" <?php echo (@$fields['mos_tab_block_type'] == 'vertical')?'aria-orientation="vertical"':'' ?>><!--class=" flex-column nav-pills" -->
            <?php foreach($fields['mos_tab_block_content'] as $index=>$item) :?>
                <li class="nav-item"><a class="nav-link <?php echo (!$index)?'active':''; ?>" id="unit-<?php echo $index ?>-tab" data-bs-toggle="pill" data-bs-target="#unit-<?php echo $index ?>" type="button" role="tab" aria-controls="unit-<?php echo $index ?>"><?php echo $item['title'] ?></a></li>           
            <?php endforeach?>
            </ul>
            <div class="tab-content <?php echo @$fields['mos_tab_block_content_class'] ?>" id="v-pills-tabContent">
                <?php foreach($fields['mos_tab_block_content'] as $index=>$item) :?>
                    <div class="tab-pane fade <?php echo (!$index)?'show active':'' ?>" id="unit-<?php echo $index ?>" role="tabpanel" aria-labelledby="unit-<?php echo $index ?>-tab" tabindex="0"><?php echo $item['desc'] ?></div>         
                <?php endforeach?>
            </div>
        </div>  
        <?php if(@$fields['mos_tab_block_style']) : ?>
        <style><?php echo str_replace("selector",'#'.$id,$fields['mos_tab_block_style']); ?></style>
        <?php endif?>
        
        <style>            
            <?php echo '#'.$id ?> {
                <?php if (@$fields['mos_tab_block_background'][0]['background-color']) : ?>
                    background-color: <?php echo $fields['mos_tab_block_background'][0]['background-color'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_tab_block_background'][0]['background-image']) : ?>
                    background-image: url(<?php echo wp_get_attachment_url($fields['mos_tab_block_background'][0]['background-image']) ?>);
                <?php endif?>
                <?php if (@$fields['mos_tab_block_background'][0]['background-position']) : ?>
                    background-position: <?php echo $fields['mos_tab_block_background'][0]['background-position'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_tab_block_background'][0]['background-size']) : ?>
                    background-size: <?php echo $fields['mos_tab_block_background'][0]['background-size'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_tab_block_background'][0]['background-repeat']) : ?>
                    background-repeat: <?php echo $fields['mos_tab_block_background'][0]['background-repeat'] ?>;
                <?php endif?>
                <?php if (@$fields['mos_tab_block_background'][0]['background-attachment']) : ?>
                    background-attachment: <?php echo $fields['mos_tab_block_background'][0]['background-attachment'] ?>;
                <?php endif?>
            }
        </style>
        <?php if(@$fields['mos_tab_block_script']) : ?>
        <script><?php echo $fields['mos_tab_block_script']; ?></script>
        <?php endif?>
    <?php
        }
    }); 
    //Tab Block end

    //Slider Block end
    if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

        //Product Categories Block start
        Block::make(__('Product Categories Block'))
        ->set_icon('open-folder')
        ->add_tab(__('Content'), array(
            Field::make( 'association', 'mos_product_categories_items', __( 'Select Categories' ) )
            ->set_types( array(
                array(
                    'type' => 'term',
                    'taxonomy' => 'product_cat',
                ),
            )),
        ))
        ->add_tab(__('Style'), array(
            Field::make('text', 'mos_product_categories_block_wrapper_class', __('Wrapper Class')),
            Field::make('text', 'mos_product_categories_block_unit_class', __('Unit Class')),
            Field::make('text', 'mos_product_categories_block_desktop_grid', __('Desktop Grid'))
            ->set_attribute('type', 'number')
            ->set_default_value(5),
            Field::make('text', 'mos_product_categories_block_tab_grid', __('Tab Grid'))
            ->set_attribute('type', 'number')
            ->set_default_value(3),
            Field::make('text', 'mos_product_categories_block_mobile_grid', __('Mobile Grid'))
            ->set_attribute('type', 'number')
            ->set_default_value(2),
        )) 
        ->add_tab(__('Advanced'), array(
            Field::make('textarea', 'mos_product_categories_block_style', __('Style'))
            ->set_help_text('Please write your custom css without style tag, you can use selector tag to target the parent element'),
            Field::make('textarea', 'mos_product_categories_block_script', __('Script'))
            ->set_help_text('Please write your custom script without script tag'),
        ))  
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
        if(@$fields['mos_product_categories_items'] && sizeof($fields['mos_product_categories_items'])) {
            $id = 'element-'.time().rand(1000, 9999);
            ?>
            <div id="<?php echo $id ?>" class="mos-product-categories-block-wrapper <?php echo @$fields['mos_product_categories_block_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
            <?php foreach($fields['mos_product_categories_items'] as $index=>$item) :?>
                <div class="unit position-relative unit-<?php echo $index ?> <?php echo @$fields['mos_product_categories_block_unit_class'] ?>">
                    <?php 
                    $term = get_term( (int)$item['id'] , 'product_cat' );
                    $link = get_term_link( (int)$item['id'], 'product_cat' );
                    $thumbnail_id = get_woocommerce_term_meta( (int)$item['id'], 'thumbnail_id', true );                            
                    ?>
                    <div class="part-img"><?php echo wp_get_attachment_image( $thumbnail_id, "full", "", array( "class" => "img-responsive img-fluid" ) ); ?></div>
                    <div class="part-text"><?php echo $term->name; ?></div>
                    <a href="<?php echo $link ?>" class="hidden-link">Read more about <?php echo $term->name; ?></a>
                </div>
            <?php endforeach;?>
            </div>
            <style>
                <?php echo '#'.$id ?> {
                    display: grid;
                    grid-template-columns: repeat(<?php echo (@$fields['mos_product_categories_block_desktop_grid'])?$fields['mos_product_categories_block_desktop_grid']:5 ?>, 1fr);
                    gap: 10px;
                }
                @media (max-width: 992px) {
                    <?php echo '#'.$id ?> {
                        grid-template-columns: repeat(<?php echo (@$fields['mos_product_categories_block_tab_grid'])?$fields['mos_product_categories_block_tab_grid']:3 ?>, 1fr);
                    }
                }
                @media (max-width: 576px) {
                    <?php echo '#'.$id ?> {
                        grid-template-columns: repeat(<?php echo (@$fields['mos_product_categories_block_mobile_grid'])?$fields['mos_product_categories_block_mobile_grid']:2 ?>, 1fr);
                    }
                }
            </style>
            <?php if(@$fields['mos_product_categories_block_style']) : ?>
                <style><?php echo str_replace("selector",'#'.$id,$fields['mos_product_categories_block_style']); ?></style>
            <?php endif?>
            <?php if(@$fields['mos_product_categories_block_script']) : ?>
            <script><?php echo $fields['mos_product_categories_block_script']; ?></script>
            <?php endif?>
            
            <?php
        }
        }); 
        //Product Categories Block end
        
        //Product Slider Block start
        Block::make(__('Product Slider Block'))
        ->set_icon('format-gallery')
        ->add_tab(__('Query'), array(
            Field::make( 'select', 'mos_product_slider_block_option', __('Choose Options'))
            ->set_options( array(
                'latest'=>'Latest Product',
                'toprated'=>'Top rated',
                'featured'=>'Featured',
                'bestselling'=>'Best Selling',
                'onsale'=>'On Sale',
                'bycategory'=>'By Category',
                'custom'=>'Custom Select',
            )),
            Field::make( 'association', 'mos_product_slider_block_category_items', __('Select Categories'))
            ->set_conditional_logic( array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'mos_product_slider_block_option',
                    'value' => 'bycategory', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ))
            ->set_types( array(
                array(
                    'type' => 'term',
                    'taxonomy' => 'product_cat',
                ),
            ))
            ->set_min(1)
            ->set_required( true ),
            Field::make( 'association', 'mos_product_slider_block_product_items', __('Select Products'))
            ->set_conditional_logic( array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'mos_product_slider_block_option',
                    'value' => 'custom', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ))
            ->set_types( array(
                array(
                    'type' => 'post',
                    'post_type' => 'product',
                ),
            ))
            ->set_min(1)
            ->set_required( true ),
            Field::make('text', 'mos_product_slider_block_nop', __('Product to show'))
            ->set_conditional_logic( array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'mos_product_slider_block_option',
                    'value' => 'custom', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '!=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            ))
            ->set_attribute( 'type', 'number' )
            ->set_attribute( 'min', '-1' ),
            Field::make( 'checkbox', 'mos_product_slider_block_hide_outofstock', __( 'Hide out of stock products' ) )
        ))
        ->add_tab(__('Slider Settings'), array(
            Field::make('text', 'mos_product_slider_block_desktop_count', __('Desktop Items'))
            ->set_attribute( 'type', 'number' )
            ->set_attribute( 'min', 1 )
            ->set_default_value(3),
            Field::make('text', 'mos_product_slider_block_tab_count', __('Tab Items'))
            ->set_attribute( 'type', 'number' )
            ->set_attribute( 'min', 1 )
            ->set_default_value(2),
            Field::make('text', 'mos_product_slider_block_mobile_count', __('Mobile Items'))
            ->set_attribute( 'type', 'number' )
            ->set_attribute( 'min', 1 )
            ->set_default_value(1),
            Field::make( 'checkbox', 'mos_product_slider_block_show_nav', __('Show Nav')),
            Field::make( 'checkbox', 'mos_product_slider_block_show_dots', __('Show Dots')),
            Field::make( 'checkbox', 'mos_product_slider_block_autoplay', __('Autoplay')),
            Field::make( 'checkbox', 'mos_product_slider_block_hover_pause', __('Hover Pause')),
            Field::make('text', 'mos_product_slider_block_autoplay_timeout', __('Autoplay Time'))
            ->set_attribute( 'type', 'number' )
            ->set_default_value(3000),
        )) 
        ->add_tab(__('Style'), array(
            Field::make('text', 'mos_product_slider_block_wrapper_class', __('Wrapper Class')),
            Field::make('text', 'mos_product_slider_block_unit_class', __('Unit Class')),
        )) 
        ->add_tab(__('Advanced'), array(
            Field::make('textarea', 'mos_product_slider_block_style', __('Style'))
            ->set_help_text('Please write your custom css without style tag, you can use selector tag to target the parent element'),
            Field::make('textarea', 'mos_product_slider_block_script', __('Script'))
            ->set_help_text('Please write your custom script without script tag'),
        ))  
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            
            $args = array(
                'post_status'    => 'publish',
                'post_type'      => 'product',
            );
            if (@$fields['mos_product_slider_block_nop']) $args['posts_per_page'] = $fields['mos_product_slider_block_nop'];
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = '_stock_status';
            $args['order'] = 'ASC';
            $args['meta_query']['relation'] = 'OR';
            if (@$fields['mos_product_slider_block_hide_outofstock']){
                $args['meta_query'] = array(
                    array(
                        'key' => '_stock_status',
                        'value' => 'instock'
                    )
                );
            }

            if (@$fields['mos_product_slider_block_option'] == 'toprated') {
                $args['meta_key'] = '_wc_average_rating';
                $args['orderby'] = 'meta_value_num';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
            } elseif (@$fields['mos_product_slider_block_option'] == 'featured') {
                $tax_query[] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN', // or 'NOT IN' to exclude feature products
                );
                $args['tax_query'] = $tax_query;
            } elseif (@$fields['mos_product_slider_block_option'] == 'bestselling') {            
                $args['meta_key'] = 'total_sales';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
            } elseif (@$fields['mos_product_slider_block_option'] == 'onsale') {
                $args['meta_query'] = array(
                    //'relation' => 'OR',
                    array( // Simple products type
                        'key'           => '_sale_price',
                        'value'         => 0,
                        'compare'       => '>',
                        'type'          => 'numeric'
                    ),
                    array( // Variable products type
                        'key'           => '_min_variation_sale_price',
                        'value'         => 0,
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
                );
            } elseif (@$fields['mos_product_slider_block_option'] == 'bycategory') {
                $args['tax_query']['relation'] = 'OR';
                foreach($fields['mos_product_slider_block_category_items'] as $cat) {
                    $cat_ids[] = $cat['id'];
                }            
                $args['tax_query']['cat'] = array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $cat_ids,
                );

            } elseif (@$fields['mos_product_slider_block_option'] == 'custom') {
                //'post__in' => array( 2, 5, 12, 14, 20 )
                foreach($fields['mos_product_slider_block_product_items'] as $product) {
                    $product_ids[] = $product['id'];
                }
                $args['post__in'] = $product_ids;
            }
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) {
                //var_dump($query);
                $id = 'element-'.time().rand(1000, 9999);
            ?>
                <div id="<?php echo $id ?>" class="mos-product-slider-block-wrapper <?php echo @$fields['mos_product_slider_block_wrapper_class']; ?> <?php echo @$attributes['className']; ?>"> 
                    <div class="products mos-slider mos-owl-carousel owl-carousel owl-theme" data-carousel-options='{
                        "nav":<?php echo (@$fields['mos_product_slider_block_show_nav'])?"true":"false" ?>,
                        "dots":<?php echo (@$fields['mos_product_slider_block_show_dots'])?"true":"false" ?>,
                        "autoplay":<?php echo (@$fields['mos_product_slider_block_autoplay'])?"true":"false" ?>,
                        "autoplayTimeout":"<?php echo (@$fields['mos_product_slider_block_autoplay_timeout'])?$fields['mos_product_slider_block_autoplay_timeout']:3000 ?>",
                        "autoplayHoverPause":<?php echo (@$fields['mos_product_slider_block_hover_pause'])?"true":"false" ?>,
                        "responsive":{
                            "0":{
                                "items":"<?php echo (@$fields['mos_product_slider_block_mobile_count'])?$fields['mos_product_slider_block_mobile_count']:1 ?>"
                            },
                            "600":{
                                "items":"<?php echo (@$fields['mos_product_slider_block_tab_count'])?$fields['mos_product_slider_block_tab_count']:2 ?>"
                            },
                            "1000":{
                                "items":"<?php echo (@$fields['mos_product_slider_block_desktop_count'])?$fields['mos_product_slider_block_desktop_count']:3 ?>"
                            }
                        }
                    }'>  
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            
                            <?php wc_get_template( 'content-product.php' ); ?>
                            
                        <?php endwhile?>  
                    </div>
                </div>
                <?php if(@$fields['mos_product_slider_block_style']) : ?>
                <style><?php echo str_replace("selector",'#'.$id,$fields['mos_product_slider_block_style']); ?></style>
                <?php endif?>
                <?php if(@$fields['mos_product_slider_block_script']) : ?>
                <script><?php echo $fields['mos_product_slider_block_script']; ?></script>
                <?php endif?>
            <?php
            }
            //wp_reset_postdata();
        }); 
        //Product Slider Block end

    } 
}