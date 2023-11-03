<?php /*Template Name: Templates Template*/ ?>
<?php get_header() ?>

<section class="template-listing py-5 row">
    <div class="button-group filters-button-group col-12 col-lg-3">
        <button class="button is-checked" data-filter="*">All</button>
    <?php 
        $taxonomies = get_terms( array(
            'taxonomy' => 'template_category',
            'hide_empty' => false
        ) );
        //var_dump($taxonomies);
        if ( $taxonomies ) :

            foreach ( $taxonomies as $taxonomy ) : ?>
                <button class="button" data-filter=".<?php echo $taxonomy->slug ?>"><?php echo $taxonomy->name ?></button>
            <?php endforeach;
        endif;  
    ?>
    </div>
    <?php
    $args = array(
        'post_type' => 'template',
        'posts_per_page' => -1,
        'order' => 'ASC',
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) : ?>
        <div class="isotop-grid  col-12 col-lg-9">
        <?php while ( $query->have_posts() ) : $query->the_post();
            $template_category_arr = [];
            $post_id = get_the_ID();
            $template_category_list = wp_get_post_terms( $post_id, 'template_category' );
            if ($template_category_list){
                foreach($template_category_list as $template_category){
                    $template_category_arr[] = $template_category->slug;
                }
            }
            ?>
            <div class="isotope-grid-item <?php echo implode(" ",$template_category_arr)?>">
                <?php if ( has_post_thumbnail() ) : ?>
                    <span class="media-part ratio ratio-1x1">
                        <?php the_post_thumbnail(); ?>
                    </span>
                <?php endif; ?>
                <div class="text-part p-3">
                    <h4 class="template-title"><?php echo esc_html( get_the_title() )?></h4>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
        <!-- <div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex mt-2">
            <div class="wp-block-button"><span class="wp-block-button__link wp-element-button append-button" data-offset="3">Load More</span></div>
        </div> -->
    <?php endif;
    wp_reset_postdata();
    ?>
</section>
<?php the_content() ?>
<?php get_footer() ?>
<style>

.isotop-grid {
  margin: 0px -15px;
}

/* clear fix */
.isotop-grid:after {
  content: '';
  display: block;
  clear: both;
}

/* ---- .isotope-grid-item ---- */

.isotope-grid-item {
  position: relative;
  float: left;
  width: calc(33.33333333% - 30px);
  margin: 15px;
  background-color: #ffffff;
}

.isotope-grid-item > * {
  margin: 0;
  padding: 0;
} 
.isotope-grid-item .media-part {
	overflow: hidden;
	display: block;
    position: relative;
}
.isotope-grid-item .media-part::before {
    content: '';
    padding-top:100%;
}
.isotope-grid-item .media-part img {	
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    transition: all 3s ease-in-out;
}
.isotope-grid-item {
    transition: all .3s ease-in-out;
}
.isotope-grid-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 5px 18px rgb(0 0 0 / 12%);
}
.isotope-grid-item:hover .media-part img {
	/* transform: scale(1.2) rotate(5deg); */
    object-position: bottom center;
}
.isotope-grid-item .template-title {
    font-size: 22px;
    font-weight: 600;
    line-height: 1.6em;
    margin-bottom: 0px;
}
.filters-button-group .button {
    width: 100%;
    text-align: left;
    display: block;
    color: var(--mos-primary-color);
    font-weight: 500;
    border-style: none; 
    padding: 4px 14px 4px 14px;    
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
}
.filters-button-group .button:hover,
.filters-button-group .button.is-checked {
    color: var(--mos-secondary-color);
}

</style>
<?php if (carbon_get_theme_option( 'mos_plugin_isotop' ) == 'on') : ?>
    <script type="text/javascript"> 
    jQuery(document).ready(function($) {  
        var $grid = $('.isotop-grid').isotope({
            itemSelector: '.isotope-grid-item',
            layoutMode: 'fitRows'
        });
        // filter functions
        /*var filterFns = {
            // show if number is greater than 50
            numberGreaterThan50: function() {
                var number = $(this).find('.number').text();
                return parseInt( number, 10 ) > 50;
            },
            // show if name ends with -ium
            ium: function() {
                var name = $(this).find('.name').text();
                return name.match( /ium$/ );
            }
        };*/
        // bind filter button click
        $('.filters-button-group').on( 'click', 'button', function() {
            var filterValue = $( this ).attr('data-filter');
            // use filterFn if matches value
            //filterValue = filterFns[ filterValue ] || filterValue;
            $grid.isotope({ filter: filterValue });
        });
        // change is-checked class on buttons
        $('.button-group').each( function( i, buttonGroup ) {
            var $buttonGroup = $( buttonGroup );
            $buttonGroup.on( 'click', 'button', function() {
                $buttonGroup.find('.is-checked').removeClass('is-checked');
                $( this ).addClass('is-checked');
            });
        });
        /*
        var oldOffset = newOffset = 3;
        $(window).scroll(function(oldOffset, newOffset) {            
            
            if($(window).scrollTop() == $(document).height() - $(window).height()) {
                console.log(newOffset);
                // create new item elements
                var $items = getItemElement().add(getItemElement()).add(getItemElement());
                //var $items = getItemElement();
                //if(!$items) $(this).hide();
                // append elements to container
                $grid.append($items)
                    // add and lay out newly appended elements
                    .isotope('appended', $items);
                newOffset = newOffset + 3;
                $('.append-button').attr('data-offset', newOffset );

            }
        });*/
        /*$('.append-button').on('click', function() {
            // create new item elements
            //var $items = getItemElement().add(getItemElement()).add(getItemElement());
            var $items = getItemElement();
            if(!$items) $(this).hide();
            // append elements to container
            $grid.append($items)
                // add and lay out newly appended elements
                .isotope('appended', $items);
        });*/

        /*
        // make <div class="grid-item grid-item--width# grid-item--height#" />
        function getItemElement() {
            var $item;
            var html = '<a class="media-part" href="http://alpha-bd.test/template/soldfy/" title="Soldfy"> <img width="700" height="854" src="http://alpha-bd.test/wp-content/uploads/2023/10/soldfy-cover-2.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" decoding="async" fetchpriority="high" srcset="http://alpha-bd.test/wp-content/uploads/2023/10/soldfy-cover-2.png 700w, http://alpha-bd.test/wp-content/uploads/2023/10/soldfy-cover-2-246x300.png 246w, http://alpha-bd.test/wp-content/uploads/2023/10/soldfy-cover-2-500x610.png 500w" sizes="(max-width: 700px) 100vw, 700px"> </a> <div class="text-part p-3"> <h4 class="template-title"><a href="http://alpha-bd.test/template/soldfy/">Soldfy xx</a></h4> <div class="intro">Fyndamobil is a leading B2C retailer of IT products in Sweden. </div><div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex mt-2"> <div class="wp-block-button"><a href="http://alpha-bd.test/template/soldfy/" class="wp-block-button__link wp-element-button">Read More</a></div></div></div>';
            //html = ''
            if (html) {
                $item = $('<div class="isotope-grid-item"></div>');
                //                $item.addClass(widthClass).addClass(heightClass);
                
                $item.append(html);
            }
            return $item;
        }*/
    });
    </script>
<?php endif?>