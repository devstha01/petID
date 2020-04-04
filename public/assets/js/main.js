// $(function() {
//     $("#checkout-form").steps({
//         headerTag: "h2",
//         bodyTag: "section",
//         transitionEffect: "slideLeft"
//     });

// });
// form.children("#checkout-form").steps({
//     headerTag: "h2",
//     bodyTag: "section",
//     transitionEffect: "slideLeft",
//     onStepChanging: function(event, currentIndex, newIndex) {
//         form.validate().settings.ignore = ":disabled,:hidden";
//         return form.valid();
//     },
//     onFinishing: function(event, currentIndex) {
//         form.validate().settings.ignore = ":disabled";
//         return form.valid();
//     },
//     onFinished: function(event, currentIndex) {
//         alert("Submitted!");
//     }
// });
$("#petid-form").validate({
    rules: {
        first_name: {
            required: true
        },
        last_name: {
            required: true
        },
        email: {
            required: true
        },
        telephone: {
            required: true,
            minlength: 2
        },
        company: {
            required: true,
            minlength: 2
        },
        attendee_names: {
            required: true,
            minlength: 2
        },
        street: {
            required: true,
            minlength: 2
        },
        city: {
            required: true,
            minlength: 2
        },
        state: {
            required: true,
            minlength: 2
        },
        postal_code: {
            required: true,
            minlength: 2
        },
        country: {
            required: true,
            minlength: 2
        }
    },
    messages: {
        first_name: {
            required: "Please, provide your first name."
        },
        last_name: {
            required: "Please, provide your last name."
        },
        email: {
            required: "Please, provide your email."
        },
        telephone: {
            required: "Please, provide your phone number."
        },
        company: {
            required: "Please, provide your company name."
        },
        attendee_names: {
            required: "Please, provide the attendees names."
        },
        street: {
            required: "Please, provide your street name."
        },
        city: {
            required: "Please, provide your city name."
        },
        state: {
            required: "Please, provide your state name."
        },
        postal_code: {
            required: "Please, provide your postal code."
        },
        country: {
            required: "Please, provide your country."
        }

    }
});
$(function() {
    var form = $("#petid-form");
    $("#petid-form").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function(event, currentIndex, newIndex) {



            form.validate().settings.ignore = ":disabled,:hidden";

            return form.valid();
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            //alert("Submitted!");
        }
    });
});
// $(document).on('click', "ul li a[href='#next']", function(e) {
//     alert('inder');
//     e.preventDefault();

//     if ($("#checkout-form").valid()) { // test for validity
//         alert('inter here'),
//             onStepChanging: function(event, currentIndex, newIndex) {
//                 form.validate().settings.ignore = ":disabled,:hidden";
//                 return form.valid();
//             },
//             // do stuff if form is valid
//     } else {

//         $theSteps = $('.steps ul').find('.current');
//         $($theSteps).next('li').addClass('disabled');
//         return false;

//     }


// });