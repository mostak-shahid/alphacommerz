<footer class="footer">
    <div class="widgets">        
        <div class="row-wrapper">
            <div class="row">
                <div class="col-lg-4 col-sm-6 text-center text-sm-start">
                    <div class="contacts">
                        <?php if ( is_active_sidebar( "footer_1" ) ) : ?>
                        <?php dynamic_sidebar( "footer_1" ); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 text-center text-sm-start">
                    <div class="contacts">
                        <?php if ( is_active_sidebar( "footer_2" ) ) : ?>
                        <?php dynamic_sidebar( "footer_2" ); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-sm-start">
                    <div class="contacts">
                        <?php if ( is_active_sidebar( "footer_3" ) ) : ?>
                        <?php dynamic_sidebar( "footer_3" ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <?php 
    $option_footer_layout = carbon_get_theme_option( 'mos-footer-layout' );
    $mos_page_footer_type = carbon_get_post_meta( get_the_ID(), 'mos_page_footer_type' );
    $mos_page_footer_layout = carbon_get_post_meta( get_the_ID(), 'mos_page_footer_layout' );
    $footer_layout = ($mos_page_footer_type == 'custom')?$mos_page_footer_layout:$option_footer_layout;

    if($mos_page_footer_type != 'none' && @$footer_layout) : 
        $layout_id = $footer_layout[0]['id'];//This is page id or post id
        $content_post = get_post($layout_id);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        echo $content;
    endif;
    ?>
</footer>
<?php 
$btt_enable = carbon_get_theme_option('mos-back-to-top');
$btt_image = carbon_get_theme_option('mos-back-to-top-image');
$btt_background = carbon_get_theme_option('mos-back-to-top-background');
$btt_class = carbon_get_theme_option('mos-back-to-top-class');
if($btt_enable) :
?>    
<div id="btt-btn" class="scrollup <?php echo $btt_class ?>" onclick="backToTop()">
    <?php if ($btt_image): ?>
    <?php echo wp_get_attachment_image( $btt_image, 'full' );  ?>
    <?php else : ?>
    <i class="fa fa-angle-up"></i>
    <?php endif?>
</div>
<?php endif?>
</div><!--/#container.<?php echo carbon_get_theme_option( 'mos-site-layout' ) ?>-->

<?php wp_footer();?>  

</body>

</html>
