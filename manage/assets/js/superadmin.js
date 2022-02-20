/* ------------------------------------------------------------------------------
*
*  # Login form with validation
*
*  Demo JS code for login_validation.html page
*
* ---------------------------------------------------------------------------- */

jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
$( ".form-validate" ).validate({
 rules: {
            password: {
                required:true,
                minlength: 5
            },
             Ucaptcha: {
            required: true,
            digits: true,
            minlength:"5"
          }
        },
         messages: {
            username:"Enter your username",
            password: {
                required: "Enter your password",
                minlength: jQuery.validator.format("At least {0} characters required")
            },
             Ucaptcha: {
                required: "Enter Captcha ",
                minlength: jQuery.validator.format("At least {5} characters required")

            }
        }
});
