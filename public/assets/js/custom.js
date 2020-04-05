$(document).ready(function() {
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
            confirm_password: {
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
            confirm_password: {
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
            console.log(currentIndex, newIndex);
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex) {
                return true;
            }
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            // alert("Submitted!");
            $('.thanks-wrapper').show();
            $('.actions').hide();
            $('.steps ul li').addClass('disabled');
        }
    });

    $("#append_pet").click(function() {
        totPet++;
        var pet = $(`
             <div class="pet-group">
             <div class="form-heading pet-add">
                 <h1>About Pet #<span>${totPet}</span></h1>
                 <a href="#" class="remove-appended">
                     <img src="assets/img/icons/minus_sir.svg" alt="">
                 </a>
             </div>
             <div class="form-group">
                 <label for="pet_name">Pet Name *</label>
                 <input type="text" placeholder="Pet Name *" name="pet_name" class="form-control controls">
             </div>
             <div class="form-group">
                 <label for="gender">Gender *</label>
                 <select name="gender[]" class="custom-select gender" required="" data-msg-required="Please, provide your pet's gender">
                     <option value="">Please Gender</option>
                     <option value="male">Male</option>
                     <option value="female">Female</option>
                 </select>
             </div>
             <div class="form-group">
                 <label for="color">Color</label>
                 <input type="text" placeholder="Color *" name="color" class="form-control controls">
             </div>
             <div class="form-group">
                 <label for="breed">Breed *</label>
                 <input type="text" placeholder="Breed *" name="city" class="form-control controls">
             </div>
             <div class="form-group">
                 <div class="upload-wrap"><p class="head">Upload Pet Image</p>
                     <label for="img${totPet + 1}">
                         <div class="uploadpreview img${totPet + 1}"></div>
                         
                     </label>
                     <input id="img${totPet + 1}" type="file" accept="image/*">
                 </div>

                 <div class="upload-wrap"><p class="head">Upload Pet Image</p>
                     <label for="img${totPet + 2}">
                         <div class="uploadpreview img${totPet + 2}"></div>
                     </label>
                     <input id="img${totPet + 2}" type="file" accept="image/*">
                 </div>
             </div>
         </div>`);
        $(".append-wrapper").append(pet);
    });

    // Remove Child
    $("#append_pet").click(function() {
        setTimeout(function() {
            $('.remove-appended').on('click', function() {
                $(this).parents().eq(1).remove();
                totPet--;
            })

            $('.upload-wrap input[type=file]').change(function() {
                var id = $(this).attr("id");
                var newimage = new FileReader();
                newimage.readAsDataURL(this.files[0]);
                newimage.onload = function(e) {
                    $('.uploadpreview.' + id).css('background-image', 'url(' + e.target.result + ')');
                }
            });
        }, 1000);

    });


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
        format: 'mm-yy',
        startDate: 'getDate'
    });

    $('#cardholder-number').mask('0000 0000 0000 0000');
});