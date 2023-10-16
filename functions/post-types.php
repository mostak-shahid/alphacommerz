<?php
function mos_custom_post_types() {
	/**
	 * Post Type: Layouts.
	 */
	$labels = [
		"name" => esc_html__( "Layouts", "alphacommerz" ),
		"singular_name" => esc_html__( "Layout", "alphacommerz" ),
	];
	$args = [
		"label" => esc_html__( "Layouts", "alphacommerz" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "layout", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
        "menu_icon" => "dashicons-editor-kitchensink",
        "menu_position" => 4,
	];
	register_post_type( "layout", $args );
    /**
	 * Post Type: Jobs.
	 */
	$labels = [
		"name" => esc_html__( "Jobs", "alphacommerz" ),
		"singular_name" => esc_html__( "Job", "alphacommerz" ),
	];
	$args = [
		"label" => esc_html__( "Jobs", "alphacommerz" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "job", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
        "menu_icon" => "dashicons-networking",
        "menu_position" => 5,
	];
	register_post_type( "job", $args );
}
add_action( 'init', 'mos_custom_post_types' );


function mos_custom_taxonomy() {
	/**
	 * Taxonomy: Job Categories.
	 */
	$labels = [
		"name" => esc_html__( "Job Categories", "alphacommerz" ),
		"singular_name" => esc_html__( "Job Category", "alphacommerz" ),
	];	
	$args = [
		"label" => esc_html__( "Job Categories", "alphacommerz" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'job_category', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "job_category",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "job_category", [ "job" ], $args );
	/**
	 * Taxonomy: Job Types.
	 */
	$labels = [
		"name" => esc_html__( "Job Types", "alphacommerz" ),
		"singular_name" => esc_html__( "Job Type", "alphacommerz" ),
	];	
	$args = [
		"label" => esc_html__( "Job Types", "alphacommerz" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'job_type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "job_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "job_type", [ "job" ], $args );
	/**
	 * Taxonomy: Job Locations.
	 */
	$labels = [
		"name" => esc_html__( "Job Locations", "alphacommerz" ),
		"singular_name" => esc_html__( "Job Location", "alphacommerz" ),
	];	
	$args = [
		"label" => esc_html__( "Job Locations", "alphacommerz" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'job_location', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "job_location",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "job_location", [ "job" ], $args );
	/**
	 * Taxonomy: Layout Categories.
	 */
	$labels = [
		"name" => esc_html__( "Categories", "alphacommerz" ),
		"singular_name" => esc_html__( "Category", "alphacommerz" ),
	];	
	$args = [
		"label" => esc_html__( "Categories", "alphacommerz" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'layout_category', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "layout_category",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "layout_category", [ "layout" ], $args );
	/**
	 * Taxonomy: Tags.
	 */
	$labels = [
		"name" => esc_html__( "Tags", "alphacommerz" ),
		"singular_name" => esc_html__( "Tag", "alphacommerz" ),
	];	
	$args = [
		"label" => esc_html__( "Tags", "alphacommerz" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'layout_tag', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "layout_tag",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "layout_tag", [ "layout" ], $args );
}
add_action( 'init', 'mos_custom_taxonomy' );
add_action( 'after_switch_theme', 'flush_rewrite_rules' );
