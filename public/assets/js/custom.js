$(document).ready(function() {
    var trigger = 0;
    var form = $("#contact");
    var totPet = 1;
    form.validate({
        //errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            email: {
                required: true
            },
            password: {
                required: true,
                minlength: 5
            },
            password_confirmation: {
                equalTo: "#password"
            },
            name: {
                required: true
            },
            address: {
                required: true
            },
            city: {
                required: true
            },
            state: {
                required: true
            },
            zip_code: {
                required: true
            },
            country: {
                required: true
            },
            phone: {
                required: true,
                minlength: 9,
                number: true
            },
            pet_name: {
                required: true
            },
            color: {
                required: true
            },
            breed: {
                required: true
            },
            cardholder_name: {
                required: true
            },
            cardholder_number: {
                required: true,
                minlength: 16
            },
            expiry_date: {
                required: true
            },
            cvc: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            email: {
                required: "Please, provide your email address."
            },
            password: {
                required: "Please, type in a password.",
                minlength: "Password must be atleast 5 characters."
            },
            password_confirmation: {
                equalTo: "Please, confirm your password again."
            },
            name: {
                required: "Please, provide your full name."
            },
            address: {
                required: "Please, provide your address."
            },
            city: {
                required: "Please, provide your city name."
            },
            state: {
                required: "Please, provide your state name."
            },
            zip_code: {
                required: "Please, provide your zip code."
            },
            country: {
                required: "Please, provide your country name."
            },
            phone: {
                required: "Please, provide your phone number.",
                number: "Phone number must be numeric."
            },
            pet_name: {
                required: "Please, provide your pet name."
            },
            color: {
                required: "Please, provide the pet color."
            },
            breed: {
                required: "Please, provide it's breed."
            },
            cardholder_name: {
                required: "Please, provide the card name."
            },
            cardholder_number: {
                required: "Please, provide the card number.",
                minlength: "Card number has to be minimum of 16 digits."
            },
            expiry_month: {
                required: "Please, provide expiry month."
            },
            cvc: {
                required: "Please, provide the CVC number."
            }
        }
    });
    form.children("div").steps({
        headerTag: "div.step-heading",
        bodyTag: "section",
        labels: {
            current: "current step:",
            pagination: "Pagination",
            finish: "FINISH",
            next: "NEXT STEP",
            previous: "BACK",
            loading: "Loading ..."
        },
        transitionEffect: "fade",
        onStepChanging: function(event, currentIndex, newIndex) {

            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex) {
                return true;
            }

            form.validate().settings.ignore = ":disabled,:hidden";
            if (form.valid() && newIndex == 1 && trigger == 0) {
                trigger++;
                $("#add-pet").trigger('click')
            }
            if (form.valid() && newIndex == 2) {
                var country = $("select[name='country']").val();
                var zip_code = $("input[name='zip_code']").val();
                var totalPets = $('.pet-group').length;
                $('#total-pets').text(totalPets)
                $('#total-amount').text('Calculating ...')

                $.ajax({
                    type: 'GET',
                    url: "/calculate-charge?country=" + country + "&zip_code=" + zip_code + "&totalPets=" + totalPets,
                    data: {},
                    dataType: 'json',
                    success: function(data) {

                        $('#total-amount').text('€' + data)
                    },

                });

            }

            return form.valid();
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            $('.loading-wrapper').show();
            var date_expiry = $("input[name='date_expiry']").val().split('-');
            Stripe.card.createToken({
                number: $("input[name='card_holder']").val(),
                cvc: $("input[name='cvc']").val(),
                exp_month: date_expiry[0],
                exp_year: date_expiry[1],
                address_zip: $("input[name='zip_code']").val()
            }, stripeResponseHandler);
        }
    });

    function stripeResponseHandler(status, response) {
        // Grab the form:
        var $form = $('#contact');
        $form.find('.payment-errors').text('');

        if (response.error) { // Problem!
            $('.loading-wrapper').hide();
            // Show the errors on the form
            $form.find('.payment-errors').html('<p>' + response.error.message + '</p>');
            $form.find('button').prop('disabled', false); // Re-enable submission

        } else { // Token was created!
            // Get the token ID:
            var token = response.id;
            // Insert the token into the form so it gets submitted to the server:
            // $form.append($('<input type="hidden" name="stripeToken" />').val(token));
            var postData = {
                name: $("input[name='name']").val(),
                email: $("input[name='email']").val(),
                password: $("input[name='password']").val(),
                password_confirmation: $("input[name='password_confirmation']").val(),
                city: $("input[name='city']").val(),
                address: $("input[name='address']").val(),
                zip_code: $("input[name='zip_code']").val(),
                state: $("input[name='state']").val(),
                country: $("select[name='country']").val(),
                reward: $("input[name='reward']").val(),
                phone: $("input[name='phone']").val(),
                s_phone: $("input[name='s_phone']").val(),
                pets: $("[name^='pets']").serialize(),
                stripe_token: token,
            };
            $('.alert-danger').html('');
            $('.alert-danger').hide();

            $.ajax({
                type: 'POST',
                url: "/checkout",
                data: postData,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $('.thanks-wrapper').show();
                        $('.actions').hide();
                        $('.steps ul li').addClass('disabled');
                    }

                },
                error: function(request, status, error) {
                    json = $.parseJSON(request.responseText);
                    $.each(json.errors, function(key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<p>' + value + '</p>');
                    });
                }

            });
            // Submit the form:
            //$form.get(0).submit();
        }
    }



    $('.upload-wrap input[type=file]').change(function() {
        var id = $(this).attr("id");
        var newimage = new FileReader();
        newimage.readAsDataURL(this.files[0]);
        newimage.onload = function(e) {
            $('.uploadpreview.' + id).css('background-image', 'url(' + e.target.result + ')');
        }
    });

    $('.pet-slider').slick({
        infinite: true
    });

    $('#date_expiry').datepicker({
        format: 'mm-yyyy',
        startDate: 'getDate'
    });

    $('#cardholder-number').mask('0000 0000 0000 0000');
});