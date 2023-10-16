<?php
function admin_shortcodes_page(){
	//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null )
    add_menu_page( 
        __( 'Theme Short Codes', 'textdomain' ),
        'Short Codes',
        'manage_options',
        'shortcodes',
        'shortcodes_page',
        'dashicons-book-alt',
        3
    ); 
}
add_action( 'admin_menu', 'admin_shortcodes_page' );
function shortcodes_page(){
	?>
<div class="wrap">
    <h1>Theme Short Codes</h1>
    <ol>
        <li>[home-url slug=''] <span class="sdetagils">displays home url</span></li>
        <li>[site-identity class='' container_class=''] <span class="sdetagils">displays site identity according to theme option</span></li>
        <li>[site-name link='0'] <span class="sdetagils">displays site name with/without site url</span></li>
        <li>[copyright-symbol] <span class="sdetagils">displays copyright symbol</span></li>
        <li>[this-year] <span class="sdetagils">displays 4 digit current year</span></li>
        <li>[email class='' display='all' title='0'] <span class="sdetagils">displays email from theme options</span></li>
        <li>[phone class='' display='all' title='0'] <span class="sdetagils">displays phone from theme options</span></li>
    </ol>
</div>
<?php
}
function home_url_func( $atts = array(), $content = '' ) {
	$atts = shortcode_atts( array(
		'slug' => '',
	), $atts, 'home-url' );

	return home_url( $atts['slug'] );
}
add_shortcode( 'home-url', 'home_url_func' );
function site_identity_func( $atts = array(), $content = null ) {
	global $forclient_options;
	$html = '';
	$atts = shortcode_atts( array(
		'class' => '',
		'container_class' => ''
	), $atts, 'site-identity' ); 
    ob_start(); ?>
<div class="logo-wrapper <?php echo $atts['container_class']?>">
    <a class="logo <?php echo $atts['class']?>" href="<?php echo home_url()?>">
        <?php if(carbon_get_theme_option( 'mos-logo' )) : ?>
        <?php echo wp_get_attachment_image( carbon_get_theme_option( 'mos-logo' ), 'full', "", array( "class" => "img-responsive img-fluid" ) );  ?>
        <?php else : ?>
        <h1 class="site-title"><a href="<?php echo home_url()?>"><?php echo get_bloginfo('name')?></a></h1>
        <p class="site-description"><?php echo get_bloginfo( 'description' )?></p>
        <?php endif?>
    </a>
</div>
<?php $html = ob_get_clean();	
	return $html;
}
add_shortcode( 'site-identity', 'site_identity_func' );
function site_name_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'link' => 0,
	), $atts, 'site-name' );
    
	if ($atts['link']) $html .=	'<a href="'.esc_url( home_url( '/' ) ).'">';
	$html .= get_bloginfo('name');
	if ($atts['link']) $html .=	'</a>';
	return $html;
}
add_shortcode( 'site-name', 'site_name_func' );
function copyright_symbol_func() {
	return '&copy;';
}
add_shortcode( 'copyright-symbol', 'copyright_symbol_func' );
function this_year_func() {
	return date('Y');
}
add_shortcode( 'this-year', 'this_year_func' );

function email_func($atts = array(), $content = '') {
	$atts = shortcode_atts( array(
        'class' => '',
        'display' => 'all',
		'title' => 0,
	), $atts, 'email' );  
    ob_start();     
    $emails = carbon_get_theme_option( 'mos-contact-email' );  
    if($emails && sizeof($emails)) :
    ?>
<span class="email-wrapper <?php echo $atts['class'] ?>">
    <?php if (!is_numeric($atts['display'])) : ?>
    <?php foreach($emails as $email) :?>
    <span class="email-unit">
        <span class="email-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $email['title'] ?></span>
        <span class="email-link"><a href="mailto:<?php echo $email['email'] ?>"><?php echo $email['email'] ?></a></span>
    </span>
    <?php endforeach;?>
    <?php else : ?>
    <span class="email-unit">
        <span class="email-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $emails[$atts['display']]['title'] ?></span>
        <span class="email-link"><a href="mailto:<?php echo $emails[$atts['display']]['email'] ?>"><?php echo $emails[$atts['display']]['email'] ?></a></span>
    </span>
    <?php endif ?>
    <?php echo do_shortcode($content) ?>
</span>
<?php endif?>
<?php $html = ob_get_clean();
    return $html;
}
add_shortcode( 'email', 'email_func' );

function phone_func($atts = array(), $content = '') {
	$atts = shortcode_atts( array(
        'class' => '',
        'display' => 'all',
		'title' => 0,
	), $atts, 'phone' );  
    ob_start();     
    $phones = carbon_get_theme_option( 'mos-contact-phone' );  
    if($phones && sizeof($phones)) :
    ?>
<span class="phone-wrapper <?php echo $atts['class'] ?>">
    <?php if (!is_numeric($atts['display'])) : ?>
    <?php foreach($phones as $phone) :?>
    <span class="phone-unit">
        <span class="phone-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $phone['title'] ?></span>
        <span class="phone-link"><a href="mailto:<?php echo $phone['number'] ?>"><?php echo $phone['number'] ?></a></span>
    </span>
    <?php endforeach;?>
    <?php else : ?>
    <span class="phone-unit">
        <span class="phone-title <?php if(!$atts['title']) echo 'd-none'?>"><?php echo $phones[$atts['display']]['title'] ?></span>
        <span class="phone-link"><a href="mailto:<?php echo $phones[$atts['display']]['number'] ?>"><?php echo $phones[$atts['display']]['number'] ?></a></span>
    </span>
    <?php endif ?>
    <?php echo do_shortcode($content) ?>
</span>
<?php endif?>
<?php $html = ob_get_clean();
    return $html;
}
add_shortcode( 'phone', 'phone_func' );

function mos_mobile_menu_func( $atts = array(), $content = null ) {
	$html = '';
	$atts = shortcode_atts( array(
		'class' => 'menu-light',
		'title' => '',
	), $atts, 'mobile-menu' ); 
    ob_start(); ?>
    <a class="toggle position-relative d-inline-block <?php echo @$atts['class']?>" href="#"><span></span></a>
<?php $html = ob_get_clean();	
	return $html;
}
add_shortcode( 'mobile-menu', 'mos_mobile_menu_func' );


function _mos_translate($input='', $ucf=false){
    $words = carbon_get_theme_option( 'mos-translate' );
    $found = 0;
    foreach($words as $word) {
        if (strtolower($word['input']) == strtolower($input)) {
            $found++;
            break;
        } 
    }
    $t_input = __($input, 'alphacommerz');
    return ($ucf)?(ucfirst(($found)?$word['output']:$t_input)):strtolower(($found)?$word['output']:$t_input);
}
function _e_mos_translate($input='', $ucf=false){
    echo _mos_translate($input, $ucf);
}

function mos_translate_func( $atts = array(), $content = null ) {
	$atts = shortcode_atts( array(
		'input' => '',
        'ucf' => false
	), $atts, 'mos-translate' ); 
    return _mos_translate($atts['input'],$atts['ucf']);
}
add_shortcode( 'mos-translate', 'mos_translate_func' );

function post_title_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id' => get_the_ID(),
    ), $atts, 'post-title' );
    if (is_home()) {
        $page_id = get_option( 'page_for_posts' );
    } else {
        $page_id = $atts['id'];
    }

    $post_title = get_the_title( $page_id );
    return '<h1 class="page-title">'.$post_title.'</h1>';
}
add_shortcode( 'post-title', 'post_title_shortcode' );
function mos_get_the_excerpt(){
    if (has_excerpt()) {
        $excerpt = wp_strip_all_tags(get_the_excerpt());
    }
    return '<div class="short-desc">'.$excerpt.'</div>';
}
add_shortcode( 'post-excerpt', 'mos_get_the_excerpt' );

function mos_popup_func( $atts = array(), $content = null ) {
	$html = '';
	$atts = shortcode_atts( array(
		'class' => '',
		'img' => '',
        'url' => '',
	), $atts, 'mos-popup' ); 
    ob_start(); ?>
    <div class="mos-popup-wrapper position-relative <?php echo @$atts['class']?>" href="#">
        <?php if (@$atts['url'] && @$atts['img']) :?>
            <img src="<?php echo $atts['img'] ?>" class="img-fluid">
            <a href="#" class="hidden-link mos-popup-activator" data-url="<?php echo @$atts['url'] ?>">Open Modal</a>
        <?php endif?>
    </div>
    <?php $html = ob_get_clean();	
	return $html;
}
add_shortcode( 'mos-popup', 'mos_popup_func' );

function mos_video_popup () {
	?>
	<!-- Modal -->
<div class="modal fade" id="videoPopupModal" tabindex="-1" aria-labelledby="videoPopupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-0">
        <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body p-0"><div class="ratio ratio-16x9"><iframe src="" allowfullscreen></iframe></div></div>
    </div>
  </div>
</div>
	<?php
}
add_action('wp_footer', 'mos_video_popup');


function mos_video_func( $atts = array(), $content = null ) {
	$html = '';
	$atts = shortcode_atts( array(
		'class' => '',
		'img' => '',
        'url' => '',
        'type' => 'inline' //inline, iframe
        
	), $atts, 'mos-video' ); 
    ob_start(); ?>
    <div class="mos-video-wrapper position-relative <?php echo @$atts['class']?>" href="#">
        <?php if (@$atts['img']) :?>
            <div class="image-wrap"><img src="<?php echo @$atts['img'] ?>" class="img-fluid"></div>
        <?php endif?>        
        <a href="#" class="hidden-link mos-video-activator" data-url="<?php echo @$atts['url'] ?>" data-type="<?php echo @$atts['type'] ?>">Open Video</a>        
        <?php if (@$atts['type'] == 'iframe') :?>
            <div class="video-wrap video-iframe-wrap ratio ratio-16x9"><iframe src="" allowfullscreen></iframe></div>
        <?php else : ?>
            <div class="video-wrap video-inline-wrap"><video src="" class="object-fit-fill" autoplay controls></video></div>
        <?php endif?>
    </div>
    <?php $html = ob_get_clean();	
	return $html;
}
add_shortcode( 'mos-video', 'mos_video_func' );