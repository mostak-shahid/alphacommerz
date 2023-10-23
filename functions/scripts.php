<?php

function alphacommerz_enqueue_scripts() {
    wp_register_script('bootstrap.min', get_template_directory_uri() .  '/plugins/bootstrap-5.2.3/js/bootstrap.bundle.min.js', 'jquery');
    wp_enqueue_script( 'bootstrap.min' );  
    wp_register_style( 'bootstrap.min', get_template_directory_uri() .  '/plugins/bootstrap-5.2.3/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap.min' );  
    
    //D:\laragon\www\alpha-bd\wp-content\themes\alphacommerz\plugins\jquery-validation\dist\jquery.validate.min.js
    wp_register_script('jquery.validate.min', get_template_directory_uri() .  '/plugins/jquery-validation/dist/jquery.validate.min.js', 'jquery');
    wp_enqueue_script('jquery.validate.min');  

    wp_register_script('donutty', get_template_directory_uri() . '/plugins/donut-pie-ring-charts/donutty.js', 'jquery');
    wp_enqueue_script('donutty');

    if (carbon_get_theme_option( 'mos_plugin_jquery' ) == 'on') {
	   wp_enqueue_script('jquery');	
    }
    
    if (carbon_get_theme_option( 'mos_plugin_fontawesome' ) == 'on') {
        wp_register_style('font-awesome.min', get_template_directory_uri() . '/fonts/font-awesome-4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('font-awesome.min');
    }
    
    if (carbon_get_theme_option( 'mos_plugin_fancybox' ) == 'on') {
        wp_register_style('jquery.fancybox.min', get_template_directory_uri() . '/plugins/fancybox/fancyapps/fancybox.css');
        wp_enqueue_style('jquery.fancybox.min');
        wp_register_script('jquery.fancybox.min', get_template_directory_uri() . '/plugins/fancybox/fancyapps/fancybox.umd.js', 'jquery');
        wp_enqueue_script('jquery.fancybox.min');    
    }
    
    if (carbon_get_theme_option( 'mos_plugin_isotop' ) == 'on') {
        wp_register_script('isotope', get_template_directory_uri() . '/plugins/isotop/isotope.pkgd.js', 'jquery');
        wp_enqueue_script('isotope');    
    }
    
    if (carbon_get_theme_option( 'mos_plugin_jpages' ) == 'on') {
        wp_register_script('jPages.min', get_template_directory_uri() . '/plugins/jPages/jPages.min.js', 'jquery');
        wp_enqueue_script('jPages.min');
    }
    if (carbon_get_theme_option( 'mos_plugin_lazyload' ) == 'on') {
        wp_register_script('jquery.lazy.min', get_template_directory_uri() . '/plugins/jquery.lazy-master/jquery.lazy.min.js', 'jquery');
        wp_enqueue_script('jquery.lazy.min');
    }
    if (carbon_get_theme_option( 'mos_plugin_table_shrinker' ) == 'on') {
        wp_register_style('jquery.table-shrinker', get_template_directory_uri() . '/plugins/jquery.table-shrinker/jquery.table-shrinker.css');
        wp_enqueue_style('jquery.table-shrinker'); 
        wp_register_script('jquery.table-shrinker', get_template_directory_uri() . '/plugins/jquery.table-shrinker/jquery.table-shrinker.js', 'jquery');
        wp_enqueue_script( 'jquery.table-shrinker' );
    }
    if (carbon_get_theme_option( 'mos_plugin_owlcarousel' ) == 'on') {
        wp_register_style('owl.carousel.min', get_template_directory_uri() . '/plugins/owlcarousel/owl.carousel.min.css');
        wp_enqueue_style('owl.carousel.min'); 
        wp_register_style('owl.theme.default.min', get_template_directory_uri() . '/plugins/owlcarousel/owl.theme.default.min.css');
        wp_enqueue_style('owl.theme.default.min');       
        wp_register_script('owl.carousel.min', get_template_directory_uri() . '/plugins/owlcarousel/owl.carousel.min.js', 'jquery');
        wp_enqueue_script('owl.carousel.min');
    }
    if (carbon_get_theme_option( 'mos_plugin_slick' ) == 'on') {    
        wp_register_style( 'slick', get_template_directory_uri() . '/plugins/slick/slick/slick.css' );		
        wp_enqueue_style( 'slick' );
        wp_register_style( 'slick-theme', get_template_directory_uri() . '/plugins/slick/slick/slick-theme.css' );
        wp_enqueue_style( 'slick-theme' );	
        wp_register_script('slick', get_template_directory_uri() . '/plugins/slick/slick/slick.min.js', 'jquery');
        wp_enqueue_script( 'slick' );
    }
    if (carbon_get_theme_option( 'mos_plugin_wow' ) == 'on') {
        wp_register_script('wow.min', get_template_directory_uri() . '/plugins/wow/wow.min.js', 'jquery');
        wp_enqueue_script('wow.min');

        
    }
    if (carbon_get_theme_option( 'mos_plugin_animate' ) == 'on') {
        wp_register_style('animate', get_template_directory_uri() . '/plugins/wow/animate.min.css');	
        wp_enqueue_style('animate');	
    }
    if (carbon_get_theme_option( 'jquery_counterup' ) == 'on') {
        wp_register_script('waypoints.min', get_template_directory_uri() . '/plugins/jquery.counterup/waypoints.min.js', 'jquery');
        wp_enqueue_script('waypoints.min');
        wp_register_script('jquery.counterup.min', get_template_directory_uri() . '/plugins/jquery.counterup/jquery.counterup.min.js', 'jquery');
        wp_enqueue_script('jquery.counterup.min');
    }
    $additionals = carbon_get_theme_option( 'mos_plugin_additional' );
    if ($additionals && sizeof($additionals)) {
        $n = 1;
        foreach($additionals as $additional) {
            $prefix = '';
            $id = 'additional-file-'.$additional['type'].'-'.$n;
            if ($additional['from'] == 'parent') $prefix = get_template_directory_uri();
            elseif ($additional['from'] == 'child') $prefix = get_stylesheet_directory_uri();
            else $prefix = '';
            
            if ($additional['type'] == 'style') {
                wp_register_style( $id, $prefix . $additional['source'], '', '1.0.0' );
                wp_enqueue_style( $id );
            } else {
                wp_register_script($id, $prefix . $additional['source'], 'jquery');
                wp_enqueue_script( $id );                
            }
            $n++;
        }
    }
    
    wp_register_style( 'hc-offcanvas-nav', get_template_directory_uri() . '/plugins/hc-mobilenav/src/scss/hc-offcanvas-nav.css' );		
    wp_enqueue_style( 'hc-offcanvas-nav' );
    wp_register_style( 'hc-offcanvas-nav.carbon', get_template_directory_uri() . '/plugins/hc-mobilenav/src/scss/hc-offcanvas-nav.carbon.css' );		
    //wp_enqueue_style( 'hc-offcanvas-nav.carbon' );
    wp_register_script( 'hc-offcanvas-nav', get_template_directory_uri() . '/plugins/hc-mobilenav/dist/hc-offcanvas-nav.js', 'jquery', '', true );
    wp_enqueue_script( 'hc-offcanvas-nav' );

	wp_register_style( 'style', get_template_directory_uri() .  '/style.css', '', time());
	wp_enqueue_style( 'style' );
		
	wp_register_script('main.min', get_template_directory_uri() . '/js/main.js', 'jquery', '', true);
	wp_enqueue_script( 'main.min' );

}
add_action( 'wp_enqueue_scripts', 'alphacommerz_enqueue_scripts' );
function alphacommerz_admin_enqueue_scripts(){
    wp_enqueue_script('jquery');	
    /*Editor*/
    wp_enqueue_script( 'ace', get_template_directory_uri() . '/plugins/jquery-ace/ace/ace.js', array('jquery') );
    wp_enqueue_script( 'theme-twilight', get_template_directory_uri() . '/plugins/jquery-ace/ace/theme-twilight.js', array('jquery') );
    wp_enqueue_script( 'mode-html', get_template_directory_uri() . '/plugins/jquery-ace/ace/mode-html.js', array('jquery') );
    wp_enqueue_script( 'mode-css', get_template_directory_uri() . '/plugins/jquery-ace/ace/mode-css.js', array('jquery') );
    wp_enqueue_script( 'mode-javascript', get_template_directory_uri() . '/plugins/jquery-ace/ace/mode-javascript.js', array('jquery') );
    wp_enqueue_script( 'jquery-ace.min', get_template_directory_uri() . '/plugins/jquery-ace/jquery-ace.js', array('jquery') );
    /*Editor*/


	wp_register_style( 'font-awesome.min', get_template_directory_uri() . '/fonts/font-awesome-4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-awesome.min' );
	wp_register_style( 'custom-admin', get_template_directory_uri() . '/css/custom-admin.css' );
	wp_enqueue_style( 'custom-admin' );

	wp_enqueue_media();

    wp_enqueue_style('thickbox');
    wp_enqueue_script('thickbox');  
    
	wp_register_script('custom-admin', get_template_directory_uri() . '/js/custom-admin.js', 'jquery');
	wp_enqueue_script('custom-admin');


}
add_action( 'admin_enqueue_scripts', 'alphacommerz_admin_enqueue_scripts' );
function alphacommerz_common_enqueue_scripts(){
	wp_register_script('ajax', get_template_directory_uri() . '/js/ajax.js', 'jquery');
	wp_enqueue_script('ajax');
	wp_localize_script( 'ajax', 'mos_ajax_object',
		array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'alphacommerz_common_enqueue_scripts' );
add_action( 'wp_enqueue_scripts', 'alphacommerz_common_enqueue_scripts' );


add_action('wp_head', 'alphacommerz_header_scripts', 999);
function alphacommerz_header_scripts(){
    ?>    
    <style id="alphacommerz-custom-css-inline-css">
    :root {
        --mos-body-bg: <?php echo carbon_get_theme_option( 'mos_body_bg' )?carbon_get_theme_option( 'mos_body_bg' ):'#fff'?>;       
        --mos-primary-color: <?php echo carbon_get_theme_option( 'mos_primary_color' )?carbon_get_theme_option( 'mos_primary_color' ):'#00f5eb'?>;            
        --mos-secondary-color: <?php echo carbon_get_theme_option( 'mos_secondary_color' )?carbon_get_theme_option( 'mos_secondary_color' ):'#21fff6'?>;            
        --mos-content-color: <?php echo carbon_get_theme_option( 'mos_content_color' )?carbon_get_theme_option( 'mos_content_color' ):'#212529'?>;       
    } 
    <?php if (carbon_get_theme_option('mos-site-layout') == 'boxed-layout' && carbon_get_theme_option('mos-site-width')) : ?>
    .boxed-layout {
        width: 100%;
        max-width: <?php echo carbon_get_theme_option('mos-site-width') ?>px;
        margin-left: auto;
        margin-right: auto;
    } 
    <?php endif?> 

    body {
        background-color: <?php echo carbon_get_theme_option('mos_body_bg') ? 'var(--mos-body-bg)' : 'var(--bs-body-bg)' ?>;
        color: <?php echo carbon_get_theme_option('mos_content_color') ? 'var(--mos-content-color)' : 'var(--bs-body-color)' ?>;
    }

    <?php if(carbon_get_theme_option('mos_wrapper_bg') && carbon_get_theme_option('mos-site-layout') != 'wide-layout') : ?>
    #body-container {
        background-color: <?php echo carbon_get_theme_option('mos_wrapper_bg') ?>;
    }
    <?php endif?>
    
    a {color: <?php echo carbon_get_theme_option('mos_link_color') ? carbon_get_theme_option('mos_link_color') : 'var(--bs-link-color)' ?>;}
    a:hover {color: <?php echo carbon_get_theme_option('mos_link_hover_color') ? carbon_get_theme_option('mos_link_hover_color') : 'var(--bs-link-hover-color)' ?>;}
    .wp-block-button__link {
        <?php if(carbon_get_theme_option('mos_buttons_background_color')): ?>
        background-color: <?php echo carbon_get_theme_option('mos_buttons_background_color') ?>;
        <?php endif?>
        <?php if(carbon_get_theme_option('mos_buttons_text_color')): ?>
        color: <?php echo carbon_get_theme_option('mos_buttons_text_color') ?>;
        <?php endif?>
        <?php if(carbon_get_theme_option('mos_buttons_border_radius')): ?>
        border-radius: <?php echo carbon_get_theme_option('mos_buttons_border_radius') ?>;
        <?php endif?>
        <?php if(carbon_get_theme_option('mos_buttons_border_width')): ?>
        border-width: <?php echo carbon_get_theme_option('mos_buttons_border_width') ?>;
        <?php endif?>
        <?php if(carbon_get_theme_option('mos_buttons_padding')): ?>
        padding: <?php echo carbon_get_theme_option('mos_buttons_padding') ?>;
        <?php endif?>
    }
    .wp-block-button__link:hover {
        <?php if(carbon_get_theme_option('mos_buttons_background_color_hover')): ?>
        background-color: <?php echo carbon_get_theme_option('mos_buttons_background_color_hover') ?>;
        <?php endif?>
        <?php if(carbon_get_theme_option('mos_buttons_text_color_hover')): ?>
        color: <?php echo carbon_get_theme_option('mos_buttons_text_color_hover') ?>;
        <?php endif?>
    }
    </style>
    <?php
}
add_action('wp_footer', 'alphacommerz_footer_scripts', 999);
function alphacommerz_footer_scripts(){
    ?>    
    <script type="text/javascript" id="alphacommerz-custom-js-inline-js"> 
        <?php if (carbon_get_theme_option( 'mos_plugin_wow' ) == 'on') : ?>
        new WOW().init();
        <?php endif?>
        jQuery(document).ready(function($) {   
            //$(".donat-chart").Donutty();    

            var Nav = new hcOffcanvasNav("#mobile-nav", {
                disableAt: false,
                customToggle: ".toggle",
                levelOpen: "expand", //overlap, expand, false
                levelSpacing: 40,
                navTitle: "All Categories",
                levelTitles: true,
                levelTitleAsBack: true,
                pushContent: "#container",
                labelClose: false,
                position: "right", //left, right, top, bottom
                theme: "carbon",
                closeOnClick: true,
                disableBody: true,
                insertClose: true,
                insertBack: true,
            });
            <?php if (carbon_get_theme_option( 'mos_plugin_owlcarousel' ) == 'on') : ?>                 
                $('body').find('.mos-owl-carousel').each(function( e ) {            
                    var oc = $(this);
                    var ocOptions = oc.data('carousel-options');
                    var defaults = {
                        loop: true,
                        nav: false,
                        autoplay: true,
                    }
                    oc.owlCarousel($.extend(defaults, ocOptions));
                });            
            <?php endif?>
            <?php if (carbon_get_theme_option( 'mos_plugin_slick' ) == 'on') : ?>
                $('.mos-slick').slick();
            <?php endif?>
            <?php if (carbon_get_theme_option( 'jquery_counterup' ) == 'on') : ?>
                $('.counter').counterUp({
                    delay: 10,
                    time: 1000
                });
            <?php endif?>
            

        });
    </script>
    <?php 
}
