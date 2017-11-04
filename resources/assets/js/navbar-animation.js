$(document).ready(function () {
    var trigger = $('#wrapperButton'),
        overlay = $('.overlay'),
        isClosed = false;
    //var trigger = $('.hamburger')


    trigger.click(function () {
	console.log("Triggered");
        hamburger_cross();
    });

    function hamburger_cross() {

        if (isClosed === true) {
            overlay.hide();
            trigger.removeClass('is-active');
            //trigger.removeClass('is-open');
            //trigger.addClass('is-closed');
            isClosed = false;
        } else {
            overlay.show();
            trigger.addClass('is-active');
            //trigger.removeClass('is-closed');
            //trigger.addClass('is-open');
            isClosed = true;
        }
    }

    $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
    });
});
