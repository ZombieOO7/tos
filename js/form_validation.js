(function($){

	/*searchFormValidation();*/
	newsletterFormValidation();
	/*otpFormValidation();*/
	contactFormValidation();
	loginFormValidation();
	registrationFormValidation();
	

/*	function searchFormValidation()
	{
		$("#global-search").validate({
		    rules: {
		        keyword: {
		            required: true
		        }
		    },
		    messages: {
		        keyword: {
		            required: "Please Enter Search Keyword"
		        }
		    },
		    errorPlacement: function(error, element) {
		        element.after(error);
		        error.hide().slideDown();
		    }
		}); 
	}*/

	function newsletterFormValidation()
	{
		$("#subscriber_form").validate({
		    rules: {
		        s_name: {
		            required: true
		        },
		        s_email: {
		            required: true,
		            email: true
		        }
		    },
		    messages: {
		        s_name: {
		            required: "Please Enter Your Name"
		        },
		        s_email: {
		            required: "Please Enter Your Email"
		        }
		    },
		    errorPlacement: function(error, element) {
		        element.after(error);
		        error.hide().slideDown();
		    }
		}); 
	}

/*	function otpFormValidation()
	{
		$("#otp-form").validate({
		    rules: {
		        s_otp: {
		            required: true
		        }
		    },
		    messages: {
		        s_otp: {
		            required: "Please Enter OTP"
		        }
		    },
		    errorPlacement: function(error, element) {
		        element.after(error);
		        error.hide().slideDown();
		    }
		}); 
	}*/

	function contactFormValidation() {
		$(".contact-form").validate({
		    rules: {
		        i_name: {
		            required: true
		        },
		        i_email: {
		            required: true,
		            email: true
		        },
		        i_phone: {
		            required: true,
		            number: true
		        },
		        i_subject: {
		            required: true
		        },
		        i_description: {
		            required: true
		        }
		    },
		    messages: {
		        i_name: {
		            required: "Please Enter Your Name Here"
		        },
		        i_phone: {
		            required: "Please Enter Your Phone No Here"
		        },
		        i_subject: {
		            required: "Please Enter Your Subject Here"
		        },
		        i_email: {
		            required: "Please Enter Your Email"
		        },
		        i_description: {
		            required: "Please Enter Your Message"
		        }
		    },
		    errorPlacement: function(error, element) {
		        element.after(error);
		        error.hide().slideDown();
		    }
		}); 
	}


	function loginFormValidation() {
		$("#tab-login").validate({
		    rules: {
		        cust_email: {
		            required: true,
		            email: true
		        },
		        cust_pass: {
		            required: true,
		        }
		    },
		    messages: {
		        cust_email: {
		            required: "Please Enter Your Email"
		        },
		        cust_pass: {
		            required: "Please Enter Your Password"
		        }
		    },
		    errorPlacement: function(error, element) {
		        element.after(error);
		        error.hide().slideDown();
		    }
		}); 
	}



	function registrationFormValidation() {
		$("#tab-register").validate({
		    rules: {
		        cust_name: {
		            required: true
		        },
		         cust_phone: {
		            required: true,
		            number: true
		        },
		        cust_email: {
		            required: true,
		            email: true
		        },
		        cust_pass: {
		            required: true
		        }
		    },
		    messages: {
		        cust_name: {
		            required: "Please Enter Your Name"
		        },
		        cust_phone: {
		            required: "Please Enter Your Phone No"
		        },
		        cust_email: {
		            required: "Please Enter Your Email"
		        },
		        cust_pass: {
		            required: "Please Enter Your Password"
		        }
		    },
		    errorPlacement: function(error, element) {
		        element.after(error);
		        error.hide().slideDown();
		    }
		}); 
	}

})(jQuery);	