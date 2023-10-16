<?php
/**
 * Remove the title
 */
add_filter( 'woocommerce_show_page_title', 'hide_shop_page_title' ); 
function hide_shop_page_title( $title ) {
   if ( is_shop() ) $title = false;
   return $title;
}
/**
 * Remove the breadcrumbs 
 */
add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
// remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


add_action('woocommerce_sidebar', function() {mos_element_wrapper_start('section', 'mos-woocommerce-page', 'mos-woocommerce-page page-content');}, 1);
add_action('woocommerce_sidebar', function() {mos_element_wrapper_start('div', '', 'content-wrap');}, 2);
add_action('woocommerce_sidebar', function() {mos_element_wrapper_start('div', '', 'row-wrapper');}, 3);
add_action('woocommerce_sidebar', function() {mos_element_wrapper_start('div', '', 'row');}, 4);
add_action('woocommerce_sidebar', function() {mos_element_wrapper_start('div', '', 'col-lg-3 order-fast');}, 5);
//add_action('woocommerce_sidebar', function(){echo 'Test';}, 2);
add_action('woocommerce_sidebar', function() {mos_element_wrapper_end('div', 'mos-woocommerce-page', 'col-lg-3 order-fast');}, 11);
add_action('woocommerce_sidebar', function() {mos_element_wrapper_start('div', '', 'col-lg-9 order-last');}, 12);

add_action('woocommerce_after_main_content', function() {mos_element_wrapper_end('div', '', 'col-lg-9 order-last');}, 1);
add_action('woocommerce_after_main_content', function() {mos_element_wrapper_end('div', '', 'row');}, 2);
add_action('woocommerce_after_main_content', function() {mos_element_wrapper_end('div', '', 'row-wrapper');}, 3);
add_action('woocommerce_after_main_content', function() {mos_element_wrapper_end('div', '', 'content-wrap');}, 4);
add_action('woocommerce_after_main_content', function() {mos_element_wrapper_end('section', 'mos-woocommerce-page', 'mos-woocommerce-page page-content');}, 5);