(function ($) {

    "use strict";


    $('.comment-form').validate({
        rules: {
            author: {
                minlength: 2,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            comment: {
                minlength: 2,
                required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            element.closest('.form-group').removeClass('has-error').addClass('has-success');
        }
    });

}(jQuery));

