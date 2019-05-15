$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        nav:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            1000:{
                items:3,
            }
        }
    })


    $('#btn_to_access_search_center_by_zip_france').click(function(){
        $("#block_btn_to_access_search_center").hide()
        $("#form_search_center_home").show()
    })

    $("#btn_launch_form").click(function(){
        $("#form_vae_step").show();
        $("#btn_launch_form").hide()
    })
    $(".close-form").click(function(){
        $("#form_vae_step").hide();
        $("#btn_launch_form").show()
    })

    // Afficher image de cover sur page de category ou article
    if($('.cover_img').length > 0){
        url_img_cover = $('.cover_img').attr('src')
        $('#block_header_photo_landing').css('background', 'url('+url_img_cover+') no-repeat center')
    }
    if($('.cover_img img').length > 0){
        url_img_cover = $('.cover_img img').attr('src')
        $('#block_header_photo_landing').css('background', 'url('+url_img_cover+') no-repeat center')
    }


    // $("#form_add_beneficiaire").submit(function(){
    //     url_redirect = $("input[name=current_url]").val()
    //     document.location.href = url_redirect
    // })

});