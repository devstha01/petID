var form = $("#contact");
form.validate({
    //errorPlacement: function errorPlacement(error, element) { element.before(error); },
    // rules: {
    //     confirm_password: {
    //         equalTo: "#password"
    //     }
    // }
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


// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
//             $('#imagePreview').hide();
//             $('#imagePreview').fadeIn(650);
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }
// $("#imageUpload").change(function() {
//     readURL(this);
// });

// function readURL2(input) {
//     if (input.files && input.files[0]) {
//         var reader2 = new FileReader();
//         reader2.onload = function(e) {
//             $('#imagePreview2').css('background-image', 'url(' + e.target.result + ')');
//             $('#imagePreview2').hide();
//             $('#imagePreview2').fadeIn(650);
//         }
//         reader2.readAsDataURL(input.files[0]);
//     }
// }
// $("#imageUpload2").change(function() {
//     readURL2(this);
// });

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
    format: 'yy-mm',
    startDate: 'getDate'
});

$(document).ready(function() {
    $('#cardholder-number').mask('0000 0000 0000 0000');
})