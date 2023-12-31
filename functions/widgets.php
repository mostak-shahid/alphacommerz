<?php
//Add widgets area
function alphacommerz_widgets_init(){
	register_sidebar(array(
		'id' => 'sidebar',
		'name' => __('Sidebar for Post', 'alphacommerz'),
		//'description' => __('Add widgets here to appear in your Left SideBar', 'alphacommerz'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'sidebar-page',
		'name' => __('Sidebar for Page', 'alphacommerz'),
		//'description' => __('Add widgets here to appear in your Left SideBar', 'alphacommerz'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	));
	register_sidebar(array(
		'id' => 'sidebar-shop',
		'name' => __('Sidebar for Shop', 'alphacommerz'),
		//'description' => __('Add widgets here to appear in your Left SideBar', 'alphacommerz'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_1',
		'name' => __('Footer Widget 1', 'alphacommerz'),
		'description' => __('Add widgets here to appear in your Footer Widget 1', 'alphacommerz'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_2',
		'name' => __('Footer Widget 2', 'alphacommerz'),
		'description' => __('Add widgets here to appear in your Footer Widget 2', 'alphacommerz'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_3',
		'name' => __('Footer Widget 3', 'alphacommerz'),
		'description' => __('Add widgets here to appear in your Footer Widget 3', 'alphacommerz'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_4',
		'name' => __('Footer Widget 4', 'alphacommerz'),
		'description' => __('Add widgets here to appear in your Footer Widget 4', 'alphacommerz'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		'after_widget' => '</div>'
	));		

}
add_action('widgets_init', 'alphacommerz_widgets_init');
