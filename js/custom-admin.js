jQuery(document).ready(function($) {  
     
    $(".mos-action-cv").click(function(e) {    
        e.preventDefault();
        var cv = $(this).data('cv');             
        tb_show("", cv+"?TB_iframe=true");
        return false;
    });
     
    $(".thickbox").click(function(e) {    
        var html = $(this).data('html');
        $("#my-content-id").html("<p>"+html+"</p>")
    });
    

    $( window ).load(function() {
        $('.html-editor').find("textarea").ace({ theme: 'twilight', lang: 'html' });
        $('.css-editor').find("textarea").ace({ theme: 'twilight', lang: 'css' });
        $('.js-editor').find("textarea").ace({ theme: 'twilight', lang: 'javascript' });
    });
    var page_template = $('#page_template').val();
    show_meta_boxes (page_template);

    $('#page_template').change(function(){
        var page_template = $(this).val();
        show_meta_boxes(page_template);
    });

    $("span.photo_upload_button").on("click", function(add){
        add.preventDefault();
        var imageUploader = wp.media({
            // 'title'     : 'Upload Image',
            // 'button'    : {
            //     'text'  : 'Set the image'
            // },
            'multiple'  : false
        });
        imageUploader.open();
        var button = $(this);
        imageUploader.on("select", function(){
            var image = imageUploader.state().get("selection").first().toJSON();
            var image_link = image.url;
            var thum_link = image.url;
            if (image.height > 150 || image.width > 150) { thum_link = image.sizes.thumbnail.url; }
            //console.log(image);
            //button.siblings('input.photo_url').val(image_link);
            //button..before('<div class="screenshot-photo"><a class="of-uploaded-photo" href="'+ image_link +'" target="_blank"><img class="redux-option-photo" src="'+ thum_link +'"></a></div>');;

            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo').val(image_link);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-id').val(image.id);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-height').val(image.height);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-width').val(image.width);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-thumbnail').val(thum_link);
            button.siblings('div.screenshot-photo').removeClass('hide');
            button.siblings('span.remove-photo').removeClass('hide');
            button.siblings('div.screenshot-photo').find('.of-uploaded-photo').attr("href",image_link);
            button.siblings('div.screenshot-photo').find('img').attr('src', thum_link);
        })
    });
    $("span.remove-photo").on("click", function(del){
        del.preventDefault();
        $(this).addClass('hide');

        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-id').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-height').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-width').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-thumbnail').val('');

        $(this).siblings('div.screenshot-photo').addClass('hide');
        $(this).siblings('div.screenshot-photo').find('.of-uploaded-photo').attr("href",'');
        $(this).siblings('div.screenshot-photo').find('img').attr('src', '');

    });

    function show_meta_boxes(page_template) {
        if(page_template == 'page-template/lightbox-page.php') {
            $('#_alphacommerz_gallery_details').show();
        } else {
           $('#_alphacommerz_gallery_details').hide(); 
        }
        if(page_template == 'page-template/gallery-page.php') {
            $('#_alphacommerz_link_gallery_details').show();
        } else {
           $('#_alphacommerz_link_gallery_details').hide();
        }
    }

    
    $("span.theme_option_photo_upload_button").on("click", function(add){
        add.preventDefault();
        var imageUploader = wp.media({
            // 'title'     : 'Upload Image',
            // 'button'    : {
            //     'text'  : 'Set the image'
            // },
            'multiple'  : false
        });
        imageUploader.open();
        var button = $(this);
        imageUploader.on("select", function(){
            var image = imageUploader.state().get("selection").first().toJSON();
            var image_link = image.url;
            var thum_link = image.url;
            if (image.height > 150 || image.width > 150) { thum_link = image.sizes.thumbnail.url; }
            button.closest('.photo-container').find('.photo').val(image_link);
            button.siblings('div.theme_option_photo_container').find('img').attr('src', thum_link);
        })
    });

    /* Theme Option JS */
    $("span.theme_option_photo_remove_button").on("click", function(del){
        del.preventDefault();
        var button = $(this);
        var newSrc = button.siblings('div.theme_option_photo_container').find('img').data('src');
        $(this).closest('.photo-container').find('.photo').val('');
        button.siblings('div.theme_option_photo_container').find('img').attr('src', newSrc);
    });

    $(".theme_option_range").on('change', function(){
        $(this).closest('.range-wrapper').find('.theme_option_range_value').val($(this).val());
        //console.log($(this).val());
    });
    $(".theme_option_repeater_add_button").on('click', function(){
        var clonedData = $(this).closest('.repeater-wrapper').find('.repeater-data-wrapper > .repeater-unit').clone();
        $(this).siblings('.repeater-data').append(clonedData);
    });
    $('body').on('click', '.theme_option_repeater_remove_button', function (){
        $(this).parent().remove();
    });

    $('.mos-tabs').find('.mos-nav-tab').on('click', function (e){
        e.preventDefault();
        var tab = $(this).data('tab');
        setMosCookie('mos_themeoption_active_tab',tab,1);
        $(this).closest('li').siblings().find('a').removeClass('nav-tab-active');
        $(this).closest('li').find('ul a').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('.mos-tab-item').hide();

        $('.mos-tab-item--' + tab).show();

    });
    //console.log($(".mos-tab-item:first-child").attr('class').split(/\s+/).length);

    if(getMosCookie('mos_themeoption_active_tab')) {
        console.log(getMosCookie('mos_themeoption_active_tab'));
        $('.'+getMosCookie('mos_themeoption_active_tab')).closest('li').siblings().find('a').removeClass('nav-tab-active');
        $('.'+getMosCookie('mos_themeoption_active_tab')).addClass('nav-tab-active');
        $('.mos-tab-item').hide();
        $('.mos-tab-item--' + getMosCookie('mos_themeoption_active_tab')).show();
        
    } else {
        /*Need to code here*/
    }
    //setMosCookie('mos_themeoption_active_tab','mos-tab-item--tab-2',0);
    /* Theme Option JS */

}); 
/* Theme Option JS 
( function() {
    document.addEventListener( 'click', ( event ) => {
        const target = event.target;
        if ( ! target.closest( '.mos-tabs a' ) ) {
            return;
        }
        event.preventDefault();
        document.querySelectorAll( '.mos-tabs a' ).forEach( ( tablink ) => {
            tablink.classList.remove( 'nav-tab-active' );
        } );
        target.classList.add( 'nav-tab-active' );
        targetTab = target.getAttribute( 'data-tab' );
        document.querySelectorAll( '.mos-options-form .mos-tab-item' ).forEach( ( item ) => {
            if ( item.classList.contains( `mos-tab-item--${targetTab}` ) ) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        } );
    } );
    document.addEventListener( 'DOMContentLoaded', function () {
        document.querySelector( '.mos-tabs .nav-tab' ).click();
    }, false );
} )();
/* Theme Option JS */
function setMosCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    //alert(cname);
}

function getMosCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}