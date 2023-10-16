<?php get_header() ?>
<?php
$option_404_layout = carbon_get_theme_option( 'mos-404-page' );
if(@$option_404_layout) :     
    $layout_id = $option_404_layout[0]['id'];//This is page id or post id
    $content_post = get_post($layout_id);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    echo $content;  
?>     
<?php else : ?>                
<section class="notFound-banner text-center position-relative">
    <div class="container-lg">
        <div class="bannerContent d-flex align-items-center justify-content-center">
            <div class="wrapper"><img class="lazy-load-image lazyload img-fluid img-404-page" src="<?php echo get_template_directory_uri() ?>/images/404.svg" alt="404 Page" width="600" height="455" loading="lazy">
                <div class="banner-heading fs-48 fw-normal">
                    <h2>Oops! this page <strong>not found</strong></h2>
                </div>
                <div class="banner-desc">The page you are looking for might have been removed its name, changed or is temporary unavailable.</div>
                <div class="btn-wrapper">
                    <a class="btn position-relative border-0 rounded-pill d-flex align-items-center justify-content-center gap-2" href="<?php echo home_url()?>">
                        <span>Back to Home</span>
                        <span class="btn-arrow"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif?>
<?php get_footer() ?>
