<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'mos_theme_options');
function mos_theme_options() {
    $basic_options_container = Container::make('theme_options', __('Theme Options'))
    ->set_icon('dashicons-admin-customizer')
    ->add_fields(array(
        Field::make('image', 'mos-logo', __('Logo'))
        ->set_default_value(get_template_directory_uri() . '/assets/img/logo.svg'),        
        Field::make('select', 'mos-site-layout', __('Site Layout'))
        ->set_options(array(
            'wide-layout' => 'Wide',
            'container-fluid' => 'Container Fluid',
            'container-xxl' => 'Container XXL',
            'container-xl' => 'Container XL',
            'container-md' => 'Container MD',
            'container-sm' => 'Container SM',
            'container' => 'Container',
            'boxed-layout' => 'Custom',
        ))
        ->set_default_value('wide'),  
        Field::make( 'text', 'mos-site-width', __( 'Site width (px)' ) )        
        ->set_conditional_logic(array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-site-layout',
                'value' => 'boxed-layout', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_attribute( 'type', 'number' )
        ->set_default_value('1200')
        ->set_required( true ),    
        Field::make( 'association', 'mos-header-layout', __( 'Select Header Layout' ) )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'layout',
            )
        ))
        ->set_max(1),  
        Field::make( 'association', 'mos-title-layout', __( 'Page Title Layout' ) )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'layout',
            )
        ))
        ->set_max(1),        
        Field::make( 'association', 'mos-footer-layout', __( 'Select Footer Layout' ) )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'layout',
            )
        ))
        ->set_max(1),
        Field::make( 'association', 'mos-404-page', __( 'Custom 404 page' ) )
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'page',
            )
        ))
        ->set_max(1),
    ));

    Container::make('theme_options', __('Style and Colors'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make('color', 'mos_body_bg', 'Body Background')
        //->set_palette(array('#FF0000', '#00FF00', '#0000FF'))
        ->set_alpha_enabled(true)
        ->set_help_text('Pick the color for body background, by default it is set to #ffffff. You can use this color in your css with var(--mos-body-bg)')
        ->set_default_value('#ffffff'),
        Field::make('color', 'mos_wrapper_bg', 'Wrapper Background')
        //->set_palette(array('#FF0000', '#00FF00', '#0000FF'))
        ->set_alpha_enabled(true)
        ->set_help_text('Pick the color for wrapper background for boxed layout, by default it is set to #ffffff.')
        ->set_default_value('#ffffff'),
        
        Field::make('color', 'mos_primary_color', 'Primary Color')
        ->set_help_text('Pick the primary color, by default it is set to #00f5eb. You can use this color in your css with var(--mos-primary-color)')
        ->set_default_value('#00f5eb'),
        
        Field::make('color', 'mos_secondary_color', 'Secondary Color')
        ->set_help_text('Pick the secondary color, by default it is set to #21fff6. You can use this color in your css with var(--mos-secondary-color)')
        ->set_default_value('#21fff6'),
        
        Field::make('color', 'mos_content_color', 'Content Color')
        ->set_help_text('Pick the content color, by default it is set to #212529. You can use this color in your css with var(--mos-content-color)')
        ->set_default_value('#212529'),
        Field::make('color', 'mos_link_color', 'Link Color')
        ->set_help_text('Pick the link color, by default it is set to #015ea5.')
        ->set_default_value('#015ea5'),
        Field::make('color', 'mos_link_hover_color', 'Link Hover Color')
        ->set_help_text('Pick the link hover color, by default it is set to #0a58ca.')
        ->set_default_value('#0a58ca'),

        /*
        Field::make('color', 'mos_success_color', 'Success Color')
        ->set_help_text('Pick the success color.'),

        Field::make('color', 'mos_custom_badge_color', 'Custom Badge Color')
        ->set_help_text('Pick the custom badge color.'),

        Field::make('color', 'mos_featured_badge_color', 'Featured Badge Color')
        ->set_help_text('Pick the featured badge color.'),

        Field::make('color', 'mos_backorders_badge_color', 'Backorders Badge Color')
        ->set_help_text('Pick the backorders  badge color.'),

        Field::make('color', 'mos_sale_badge_color', 'Sale Badge Color')
        ->set_help_text('Pick the sale badge color.')
        ->set_default_value('#77a464'),
        

        Field::make('color', 'mos_variants_badge_color', 'Variants Badge Color')
        ->set_help_text('Pick the variants badge color.'),

        Field::make('color', 'mos_price_badge_color', 'Price Color')
        ->set_help_text('Pick the price badge color.')
        ->set_default_value('#77a464'),
        */

        Field::make('color', 'mos_buttons_background_color', 'Buttons Background Color')
        ->set_help_text('Pick the buttons background color. by default it is set to #32373c.')
        ->set_default_value('#32373c'),

        Field::make('color', 'mos_buttons_background_color_hover', 'Buttons Background Color Hover')
        ->set_help_text('Pick the buttons background hover color.'),

        Field::make('color', 'mos_buttons_text_color', 'Buttons Text Color')
        ->set_help_text('Pick the buttons text color. by default it is set to #ffffff.')
        ->set_default_value('#ffffff'),

        Field::make('color', 'mos_buttons_text_color_hover', 'Buttons Text Color Hover')
        ->set_help_text('Pick the buttons text hover color.'),

        Field::make( 'text', 'mos_buttons_border_radius', __( 'Buttons Radius' ) )
        ->set_default_value('4px'),

        Field::make( 'text', 'mos_buttons_border_width', __( 'Buttons Border Width' ) )
        ->set_default_value('2px'),

        Field::make( 'text', 'mos_buttons_padding', __( 'Buttons Padding' ) )
        ->set_default_value('.667em 1.333em'),

        Field::make( 'text', 'mos_input_radious', __( 'Inputs Radius' ) )
        ->set_default_value('0px'),


    ));

    Container::make('theme_options', __('Scripts'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make('header_scripts', 'mos_header_script', __('Header Script'))
        ->set_classes('html-editor'),
        Field::make('footer_scripts', 'mos_footer_script', __('Footer Script'))
        ->set_classes('html-editor'),
    ));
    
    Container::make('theme_options', __('Theme Resourcess'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(       
        Field::make('radio', 'mos_plugin_jquery', __('Jquery'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('on'),

        Field::make('radio', 'mos_plugin_fontawesome', __('Font Awesome'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('on'),         

        Field::make('radio', 'mos_plugin_fancybox', __('Fancybox'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),

        Field::make('radio', 'mos_plugin_isotop', __('Isotop'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),

        Field::make('radio', 'mos_plugin_card_slider', __('Card Slider'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_jpages', __('jPages'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_lazyload', __('Lazy Load'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_table_shrinker', __('Table Shrinker'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_owlcarousel', __('Owl Carousel'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_slick', __('Slick Slider'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_wow', __('Wow'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_animate', __('Animate CSS'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),
        Field::make('radio', 'mos_plugin_jflip', __('Jquery Flip'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),  
        Field::make('radio', 'jquery_counterup', __('Jquery Counterup'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('off'),  
        Field::make('complex', 'mos_plugin_additional', __('Additional Assets'))
        ->add_fields(array(
            Field::make('select', 'type', __('Asset Type'))
            ->set_options(array(
                'style' => 'CSS',
                'script' => 'Script',
            )),
            Field::make('select', 'from', __('From'))
            ->set_options(array(
                'parent' => 'Parent Theme',
                'child' => 'Child Theme',
                'outside' => 'CDN/Outside',
            )),
            Field::make('text', 'source', __('Source')),
        )),
    ));
    Container::make('theme_options', __('Contact Info'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make('complex', 'mos-contact-phone', __('Phone'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('text', 'number', __('Phone Number')),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- number ? "(" + number + ")" : "" %>
            <% } %>
        ')
        ->set_collapsed(true),
        Field::make('complex', 'mos-contact-email', __('Email'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('text', 'email', __('Email Address')),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- email ? "(" + email + ")" : "" %>
            <% } %>
        ')
        ->set_collapsed(true),
        Field::make('complex', 'mos-contact-business-hours', __('Business Hours'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('text', 'hours', __('Business Hours')),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- hours ? "(" + hours + ")" : "" %>
            <% } %>
        ')
        ->set_collapsed(true),
        Field::make('complex', 'mos-contact-contact-address', __('Contact Address'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('text', 'address', __('Address')),
            Field::make('text', 'link', __('Map Link')),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %>
            <% } %>
        ')
        ->set_collapsed(true),
        Field::make('complex', 'mos-contact-social-media', __('Social Media'))
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('text', 'link', __('Link'))
            ->set_attribute( 'type', 'url' ),
            Field::make('text', 'icon', __('Icon Class'))
            ->set_help_text( 'Example: fa-facebook' ),
            Field::make('checkbox', 'new-tab', __('Open in new tab'))
            ->set_option_value('no'),
        ))        
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- link ? "(" + link + ")" : "" %>
            <% } %>
        ')
        ->set_collapsed(true),
    ));
    Container::make('theme_options', __('Back to Top'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make('radio', 'mos-back-to-top', __('Back to top option'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('on'),
        Field::make('image', 'mos-back-to-top-image', __('Back to top image')),
        Field::make('text', 'mos-back-to-top-class', __('Back to top class')),
    ));
    Container::make('theme_options', __('Page Loader'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make('radio', 'mos-page-loader', __('Page loader option'))
        ->set_options(array(
            'on' => 'Enabled',
            'off' => 'Disabled',
        ))
        ->set_default_value('on'),
        Field::make('image', 'mos-page-loader-image', __('Page loader image')),
        Field::make('color', 'mos-page-loader-background', 'Page loader background')
        ->set_alpha_enabled(true),
        Field::make('text', 'mos-page-loader-class', __('Page loader class')),
    ));



    Container::make('theme_options', __('Sticky Header'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make( 'checkbox', 'mos-header-sticky-enable', __( 'Enable Sticky Header' ) ),
        Field::make( 'association', 'mos-header-sticky-layout', __( 'Select Header Layout' ) )
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-sticky-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'layout',
            )
        ))
        ->set_max(1),  
        /*
        Field::make( 'radio_image', 'mos-header-sticky-layout', __( 'Sticky Header Layout' ) )
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-sticky-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_options( array(
            'mountain' => 'https://source.unsplash.com/X1UTzW8e7Q4/800x600',
            'temple' => 'https://source.unsplash.com/ioJVccFmWxE/800x600',
            'road' => 'https://source.unsplash.com/5c8fczgvar0/800x600',
        )),
        Field::make('image', 'mos-header-sticky-menu-icon', __('Sticky Header Menu Icon'))
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-sticky-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        )),
        Field::make('complex', 'mos-header-sticky-icons', __('Sticky Header Icons'))
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-sticky-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_collapsed(true)        
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('image', 'icon', __('Icon')),
            Field::make('text', 'link', __('Link'))
            ->set_attribute( 'type', 'url' ),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- link ? "(" + link + ")" : "" %>
            <% } %>
        '),
        */
    ));

    Container::make('theme_options', __('Mobile Header'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make( 'checkbox', 'mos-header-mobile-enable', __( 'Enable Mobile Header' ) ),
        Field::make( 'association', 'mos-header-mobile-layout', __( 'Select Header Layout' ) )
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-mobile-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_types( array(
            array(
                'type'      => 'post',
                'post_type' => 'layout',
            )
        ))
        ->set_max(1),  
        /*
        Field::make( 'radio_image', 'mos-header-mobile-layout', __( 'Mobile Header Layout' ) )
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-mobile-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_options( array(
            'mountain' => 'https://source.unsplash.com/X1UTzW8e7Q4/800x600',
            'temple' => 'https://source.unsplash.com/ioJVccFmWxE/800x600',
            'road' => 'https://source.unsplash.com/5c8fczgvar0/800x600',
        )),
        Field::make('image', 'mos-header-mobile-menu-icon', __('Mobile Header Menu Icon'))
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-mobile-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        )),
        Field::make('complex', 'mos-header-mobile-icons', __('Mobile Header Icons'))
        ->set_conditional_logic( array(
            'relation' => 'AND', // Optional, defaults to "AND"
            array(
                'field' => 'mos-header-mobile-enable',
                'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
            )
        ))
        ->set_collapsed(true)
        
        ->add_fields(array(
            Field::make('text', 'title', __('Title')),
            Field::make('image', 'icon', __('Icon')),
            Field::make('text', 'link', __('Link'))
            ->set_attribute( 'type', 'url' ),
        ))
        ->set_header_template('
            <% if (title) { %>
                <%- title %> <%- link ? "(" + link + ")" : "" %>
            <% } %>
        '),*/
    ));
    Container::make('theme_options', __('Translate'))
    ->set_page_parent($basic_options_container) // reference to a top level container
    ->add_fields(array(
        Field::make('complex', 'mos-translate', __('Translate'))
        ->set_collapsed(true)
        
        ->add_fields(array(
            Field::make('text', 'input', __('Input')),
            Field::make('text', 'output', __('Output')),
        ))
        ->set_header_template('
            <% if (input) { %>
                <%- input %> <%- output ? "(" + output + ")" : "" %>
            <% } %>
        ')
    ));
}