jQuery(document).ready(function () {
    var $ = jQuery.noConflict();
    $('.slider').bxSlider();
    if ($(window).width() < 768) {
        $('.side-bar-posts').bxSlider({
            controls: false,
            infiniteLoop: true,
            speed: 600,
            auto: true
        });
    }



    // end reverse the comment form of wordpress 

    $('#loginBtn').click(function () {
        $('#registerModal').modal('hide');
        $('#loginmodal').modal('show');
    })
    $('#registerBtn').click(function () {
        $('#loginmodal').modal('hide');
        $('#registerModal').modal('show');
    })

    // change the text that exist above the edit profile image
    $("#wpua-add-existing").html('<i class="fas fa-camera"></i>');

    // copy text to clipboard
    $(function () {
        $('[data-toggle="popover"]').popover()
    })

    var clipboard = new ClipboardJS('#btnCopy');

});


// when user reize the window
// $(window).resize(function () {
//     var width = $(window).width();
//     if (width < 768) {
//         $('.side-bar-posts').bxSlider();
//     }
// })


