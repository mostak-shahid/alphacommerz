<?php 
get_header();
?>
<section class="blog-project-wrapper">
    <article id="<?php echo get_post_type() ?>-<?php echo $post_id ?>" <?php post_class( 'single-blog' ); ?> itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
        <?php the_content()?>
    </article>
</section>
<?php get_footer() ?>