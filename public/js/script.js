$(document).ready(function () {
    'use strict';

    $('#nav-toggle').on('click', function () {
        $('.nav-subscriber-dashboard ul.nav').slideToggle();
    });

    // Magnific popup
    $('.popup-youtube').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    $('#flash-overlay-modal').modal();

    /*-------------------------------------
     Testimonial
    -------------------------------------*/
    $("#client-testimonial").owlCarousel({
        navigation: false,
        pagination: true,
        slideSpeed: 800,
        paginationSpeed: 800,
        smartSpeed: 500,
        autoplay: true,
        singleItem: true,
        dots: true,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            680: {
                items: 1
            },
            1000: {
                items: 2
            }
        }
    });

    /*-------------------------------------
     International telephone input
    -------------------------------------*/
    var iti;
    var phone = document.querySelector("#phone");
    if (phone) {
        iti = window.intlTelInput(phone, {
            formatOnDisplay: false,
            placeholderNumberType: 'MOBILE',
            utilsScript: '/js/vendor/utils.js?1549804213570'
        });
    }

    var iti1;
    var phone1 = document.querySelector("#phone-1");
    if (phone1) {
        iti1 = window.intlTelInput(phone1, {
            formatOnDisplay: false,
            initialCountry: 'us',
            placeholderNumberType: 'MOBILE',
            utilsScript: site_url + '/assets/js/utils.js?1549804213570'
        });
    }

    var iti2;
    var phone2 = document.querySelector("#phone-2");
    if (phone2) {
        iti2 = window.intlTelInput(phone2, {
            formatOnDisplay: false,
            initialCountry: 'us',
            placeholderNumberType: 'MOBILE',
            utilsScript: '/assets/js/utils.js?1549804213570'
        });
    }

    var iti3;
    var phone3 = document.querySelector("#phone-3");
    if (phone3) {
        iti3 = window.intlTelInput(phone3, {
            formatOnDisplay: false,
            initialCountry: 'us',
            placeholderNumberType: 'MOBILE',
            utilsScript: '/assets/js/utils.js?1549804213570'
        });
    }

    var iti4;
    var phone4 = document.querySelector("#phone-4");
    if (phone4) {
        iti4 = window.intlTelInput(phone4, {
            formatOnDisplay: false,
            initialCountry: 'us',
            placeholderNumberType: 'MOBILE',
            utilsScript: '/assets/js/utils.js?1549804213570'
        });
    }

    /*-------------------------------------
     Smart widget
    -------------------------------------*/
    $("#smartwizard-register").on("leaveStep", function (e, anchorObject, stepNumber, stepDirection) {
        var elmForm = $("#form-step-" + stepNumber);
        // stepDirection === 'forward' :- this condition allows to do the form validation
        // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
        if (stepDirection === 'forward' && elmForm) {
            elmForm.validator('validate');
            var elmErr = elmForm.children('.has-error');
            if (elmErr && elmErr.length > 0) {
                // Form validation failed
                return false;
            }
        }
        return true;
    });

    $("#smartwizard-register").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
        if (stepNumber === 3) {
            $('.sw-btn-finish').removeClass('disabled');
        } else {
            $('.sw-btn-finish').addClass('disabled');
        }

        if ($('.sw-btn-prev').hasClass('disabled')) {
            $('.sw-btn-prev').hide();
        } else {
            $('.sw-btn-prev').show();
        }

        if ($('.sw-btn-next').hasClass('disabled')) {
            $('.sw-btn-next').hide();
            $('.sw-btn-group-extra').show();
        } else {
            $('.sw-btn-next').show();
            $('.sw-btn-group-extra').hide();
        }
    });

    var btnFinish = $('<button></button>').text('Finish')
        .addClass('btn btn-info sw-btn-finish')
        .on('click', function () {
            if (!$(this).hasClass('disabled')) {
                var elmForm = $("#form-register");
                if (elmForm) {
                    elmForm.validator('validate');
                    var elmErr = elmForm.find('.has-error');
                    if (elmErr && elmErr.length > 0) {
                        alert('Oops we still have error in the form');
                        return false;
                    } else {
                        // console.log('Great! we are ready to submit form');
                        // Process Stripe
                        Stripe.setPublishableKey(stripe_key);
                        Stripe.card.createToken(elmForm, function (status, response) {
                            if (response.error) {
                                $('#card-errors').text(response.error.message).addClass('alert alert-danger');
                                elmForm.find('button').prop('disabled', false);
                            } else {
                                // Append the token to the form
                                elmForm.append($('<input type="hidden" name="stripeToken">').val(response.id));

                                // Set country code
                                var full_phone = document.querySelector("#full_phone");
                                full_phone.value = iti.getNumber();
                                // Submit the form
                                elmForm.submit();
                            }
                        });
                        return false;
                    }
                }
            }
        });

    var btnCancel = $('<button></button>').text('Cancel')
        .addClass('btn btn-danger')
        .on('click', function () {
            $("#smartwizard-register").smartWizard("reset");
            $('#form-register').find("input, textarea").val("");
        });

    $("#smartwizard-register").smartWizard({
        selected: 0,
        keyNavigation: false,
        theme: 'arrows',
        transitionEffect: 'fade',
        showStepURLhash: false,
        toolbarSettings: {
            toolbarPosition: 'bottom',
            toolbarExtraButtons: [btnFinish]
        }
    });

    /*-------------------------------------
     Promo form
    -------------------------------------*/
    $("#form-promo").on("submit", function(e){
        e.preventDefault();
        var form = this;
        // Get International Telephone Input instance
        var input = document.querySelector('#phone');
        var iti = window.intlTelInputGlobals.getInstance(input);

        // Set country code
        var full_phone = document.querySelector("#full_phone");
        full_phone.value = iti.getNumber();
        // Submit the form
        form.submit();
    });

    /*-------------------------------------
     Contact form
    -------------------------------------*/
    $("#form-contact").on("submit", function(e){
        e.preventDefault();
        var form = this;
        // Get International Telephone Input instance
        var input = document.querySelector('#phone');
        var iti = window.intlTelInputGlobals.getInstance(input);

        // Set country code
        var full_phone = document.querySelector("#full_phone");
        full_phone.value = iti.getNumber();
        // Submit the form
        form.submit();
    });

    /*-------------------------------------
     Account info form
    -------------------------------------*/
    $("#form-account-info").on("submit", function(e){
        e.preventDefault();
        var form = this;
        // Get International Telephone Input instance
        var input = document.querySelector('#phone');
        var iti = window.intlTelInputGlobals.getInstance(input);

        // Set country code
        var full_phone = document.querySelector("#full_phone");
        full_phone.value = iti.getNumber();
        // Submit the form
        // return false;
        form.submit();
    });

    /*-------------------------------------
     Contact info form
    -------------------------------------*/
    $("#form-contact-info").on("submit", function(e){
        e.preventDefault();
        var form = this;
        // Get International Telephone Input instance
        var input1 = document.querySelector('#phone-1');
        var iti1 = window.intlTelInputGlobals.getInstance(input1);

        var input2 = document.querySelector('#phone-2');
        var iti2 = window.intlTelInputGlobals.getInstance(input2);

        var input3 = document.querySelector('#phone-3');
        var iti3 = window.intlTelInputGlobals.getInstance(input3);

        // Set country code
        var full_phone1 = document.querySelector("#full_phone1");
        full_phone1.value = iti1.getNumber();

        var full_phone2 = document.querySelector("#full_phone2");
        full_phone2.value = iti2.getNumber();

        var full_phone3 = document.querySelector("#full_phone3");
        full_phone3.value = iti3.getNumber();

        var full_phone4 = document.querySelector("#full_phone4");
        full_phone4.value = iti4.getNumber();
        // Submit the form
        // return false;
        form.submit();
    });
});



  
