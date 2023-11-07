<?php /*Template Name: Portfolio Template*/ ?>
<?php get_header() ?>

<section class="project-listing py-5">
    <div class="button-group filters-button-group">
        <button class="button is-checked" data-filter="*">All</button>
    <?php 
        $taxonomies = get_terms( array(
            'taxonomy' => 'project_category',
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
        'post_type' => 'project',
        'posts_per_page' => -1,
        'order' => 'ASC',
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) : ?>
        <div class="isotop-grid">
        <?php while ( $query->have_posts() ) : $query->the_post();
            $project_category_arr = [];
            $post_id = get_the_ID();
            $project_category_list = wp_get_post_terms( $post_id, 'project_category' );
            if ($project_category_list){
                foreach($project_category_list as $project_category){
                    $project_category_arr[] = $project_category->slug;
                }
            }
            ?>
            <div class="isotope-grid-item <?php echo implode(" ",$project_category_arr)?>">
                <?php if ( has_post_thumbnail() ) : ?>
                    <a class="media-part" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                <?php endif; ?>
                <div class="text-part p-3">
                    <h4 class="project-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() )?></a></h4>
                    <div class="intro"><?php echo get_the_excerpt() ?></div>
                    <div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex mt-2">
                        <div class="wp-block-button"><a href="<?php the_permalink(); ?>" class="wp-block-button__link wp-element-button">Read More</a></div>
                    </div>
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
}
.isotope-grid-item .media-part img {		
	transition: all .5s ease-in-out;
}
.isotope-grid-item:hover .media-part img {
	transform: scale(1.2) rotate(5deg);
}
.isotope-grid-item .project-title {
    font-size: 22px;
    font-weight: 600;
    line-height: 1.6em;
    margin-bottom: 0px;
}
.isotope-grid-item .project-title a {
    color: #54595f;
}
.filters-button-group .button {
    color: #FFFFFF;
    background-color: var(--mos-primary-color);
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
    background-color: var(--mos-secondary-color);
}

@media (max-width: 768px) {
    .isotope-grid-item {
        width: calc(50% - 30px);
    }
}
@media (max-width: 575px) {
    .isotope-grid-item {
        width: calc(100%);
    }

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
            var html = '<a class="media-part" href="http://alpha-bd.test/project/soldfy/" title="Soldfy"> <img width="700" height="854" src="http://alpha-bd.test/wp-content/uploads/2023/10/soldfy-cover-2.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" decoding="async" fetchpriority="high" srcset="http://alpha-bd.test/wp-content/uploads/2023/10/soldfy-cover-2.png 700w, http://alpha-bd.test/wp-content/uploads/2023/10/soldfy-cover-2-246x300.png 246w, http://alpha-bd.test/wp-content/uploads/2023/10/soldfy-cover-2-500x610.png 500w" sizes="(max-width: 700px) 100vw, 700px"> </a> <div class="text-part p-3"> <h4 class="project-title"><a href="http://alpha-bd.test/project/soldfy/">Soldfy xx</a></h4> <div class="intro">Fyndamobil is a leading B2C retailer of IT products in Sweden. </div><div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex mt-2"> <div class="wp-block-button"><a href="http://alpha-bd.test/project/soldfy/" class="wp-block-button__link wp-element-button">Read More</a></div></div></div>';
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