<?php get_header() ?>
<?php
$logo = carbon_get_theme_option( 'mos_portfolio_logo' );    
$name = carbon_get_theme_option( 'mos_portfolio_name' );    
$like = carbon_get_theme_option( 'mos_portfolio_like' );    
?>

<?php
$args = array (
    'posts_per_page' => 5,
    'cat' => 6

);
// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<ul>';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo '<li>' . get_the_title() . '</li>';
	}
	echo '</ul>';
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
?>

<?php get_footer() ?>
