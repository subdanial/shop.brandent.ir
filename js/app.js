$(document).on('click', '.js-btn-toggle-menu', function () {

    $('.js-desktop-nav').fadeToggle(500);

    if ($('.js-text-open').css('display') == 'none') {
  

        $('.js-text-open').fadeIn(500);
        $('.js-text-close').fadeOut(500);
    } else {
        $('.js-text-open').fadeOut(500);
        $('.js-text-close').fadeIn(500);
    }

})
$(document).on('click', '.js-full-nav-close', function () {
$('.js-full-nav').fadeOut();
})
$(document).on('click', '.js-full-nav-open', function () {
$('.js-full-nav').fadeIn();
$('.js-full-nav').css('display','flex');
})