/* ------------------------------------------------------------------------------
*
*  # Form validation
*
*  Demo JS code for form_validation.html page
*
* ---------------------------------------------------------------------------- */

document.addEventListener('DOMContentLoaded', function() {


    // Form components
    // ------------------------------

    // Switchery toggles
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html);
    });

    // Touchspin
    $(".touchspin-postfix").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        postfix: '%'
    });


    // Styled checkboxes, radios
    $(".styled").uniform();


    // Styled file input
    $(".file-styled").uniform({
        fileButtonClass: 'action btn bg-blue'
    });


    // Bootstrap Switch
    $(".switch").bootstrapSwitch({
        onSwitchChange: function(state) {
            if(state) {
                $(this).valid(true);
            }
            else {
                $(this).valid(false);
            }
        }
    });


    //
    // Select2 select
    //

    // Initialize
    var $select = $('.select').select2({
        minimumResultsForSearch: Infinity
    });
    
    // Trigger value change when selection is made
    $select.on('change', function() {
        $(this).trigger('blur');
    });

// Add Driver Validation Start
	var ValidateDriver = {};
	ValidateDriver.init = function () {
		// Validate For Registration
		$('.validate-add-driver').validate({
			highlight: function (element, errorClass, validClass) {
				if ($(element).attr("type") === "radio") {
					this.findByName(element.name).addClass(errorClass).removeClass(validClass);
				} else {
					$(element).addClass(errorClass).removeClass(validClass);
					$(element).parent('input').removeClass('valid');
				}
			},
			unhighlight: function (element, errorClass, validClass) {
				if ($(element).attr("type") === "radio") {
					this.findByName(element.name).removeClass(errorClass).addClass(validClass);
				} else {
					$(element).removeClass(errorClass).addClass(validClass);
					$(element).parent('input').addClass('valid');
				}
			},

			rules: {
				dr_adhno: {
					minlength: 14,
				},
				dr_panno: {
					minlength: 10,
				},
				dr_phone: {
					minlength: 14,
				},
				dr_licexp: {
					minlength: 10,
				}
			},
			messages: {
				dr_adhno: {
					minlength: "Please enter 12 Digit Aadhar No",
				},
				dr_panno: {
					minlength: "Please enter valid PAN Card No",
				},
				dr_phone: {
					minlength: "Please enter 10 Digit Mobile No",
				},
				dr_licexp: {
					minlength: "Please enter valid Date",
				}
			}
		});
	};
	$(ValidateDriver.init);
// Add Driver Validation End
	
// Add Vehicle Validation Start
	var ValidateVehicle = {};
	ValidateVehicle.init = function () {
		// Validate For Registration
		$('.validate-add-vehicle').validate({
			highlight: function (element, errorClass, validClass) {
				if ($(element).attr("type") === "radio") {
					this.findByName(element.name).addClass(errorClass).removeClass(validClass);
				} else {
					$(element).addClass(errorClass).removeClass(validClass);
					$(element).parent('input').removeClass('valid');
				}
			},
			unhighlight: function (element, errorClass, validClass) {
				if ($(element).attr("type") === "radio") {
					this.findByName(element.name).removeClass(errorClass).addClass(validClass);
				} else {
					$(element).removeClass(errorClass).addClass(validClass);
					$(element).parent('input').addClass('valid');
				}
			},

			rules: {
				lorry_no: {
					minlength: 12,
				},
			},
			messages: {
				lorry_no: {
					minlength: "Please enter valid Lorry No",
				},
			}
		});
	};
	$(ValidateVehicle.init);
// Add Vehicle Validation End


// Add Lead validation start
    var ValidateLead = {};
    ValidateLead.init = function () {
        // Validate For Registration
        $('.validate-add-lead').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                pincode: {
                    minlength:6,
                    maxlength:6,
                }, 
            },
            messages: {
                pincode:{
                    minlength:"Please Enter 6 Digit Pincode.",
                    maxlength:"Please Enter 6 Digit Pincode."
                },
                
            }
        });
    };
    $(ValidateLead.init);
// Add Lead Validation End
	
// Add Org Validation Start
	var ValidateOrganization = {};
	ValidateOrganization.init = function () {
		// Validate For Registration
		$('.validate-add-organization').validate({
			highlight: function (element, errorClass, validClass) {
				if ($(element).attr("type") === "radio") {
					this.findByName(element.name).addClass(errorClass).removeClass(validClass);
				} else {
					$(element).addClass(errorClass).removeClass(validClass);
					$(element).parent('input').removeClass('valid');
				}
			},
			unhighlight: function (element, errorClass, validClass) {
				if ($(element).attr("type") === "radio") {
					this.findByName(element.name).removeClass(errorClass).addClass(validClass);
				} else {
					$(element).removeClass(errorClass).addClass(validClass);
					$(element).parent('input').addClass('valid');
				}
			},

			rules: {
				org_pemail: {
					email: true,
				},
				org_semail: {
					email: true,
				},
				org_gstno: {
					minlength: 13,
				},
				org_cin: {
					minlength: 21,
				},
				org_llpin: {
					minlength: 8,
				},
			},
			messages: {
				org_gstno: {
					minlength: "Please enter valid 13 character GST No",
				},
				org_cin: {
					minlength: "Please enter valid 21 character CIN",
				},
				org_llpin: {
					minlength: "Please enter valid 7 character LLPIN",
				},
			}
		});
	};
	$(ValidateOrganization.init);
// Add Org Validation End

// Add company validation start
    var ValidateCustomer= {};
    ValidateCustomer.init = function () {
        // Validate For Registration
        $('.validate-add-customer').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                com_pin:{
                    minlength:6,
                },
                com_phone: {
                    minlength: 14,
                },
                com_gstno: {
                    minlength: 13,
                },
                com_email:{
                    email:true,
                }
            },
            messages: {
                 com_pin:{
                    minlength:"Please Enter 6 Digit Pincode.",
                },
                com_phone:{
                    minlength:"Please Enter 10 Digit Mobile No.",
                },
                com_gstno: {
                    minlength: "Please enter valid GST No",
                },
            }
        });
    };
    $(ValidateCustomer.init);
// Add company Validation End


// Add employee validation start
    var ValidateEmployee= {};
    ValidateEmployee.init = function () {
        // Validate For Registration
        $('.validate-add-emp').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                e_pin:{
                    minlength:6,
                },
                e_phone: {
                    minlength: 14,
                },
                e_email:{
                    email:true,
                }
            },
            messages: {
                 e_pin:{
                    minlength:"Please Enter 6 Digit Pincode.",
                },
                e_phone:{
                    minlength:"Please Enter 10 Digit Mobile No.",
                },
            }
        });
    };
    $(ValidateEmployee.init);
// Add employee Validation End



// change password validation start
    var ValidateChangepass = {};
    ValidateChangepass.init = function () {
        // Validate For Registration
        $('.validate-change-password').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                oldpass: {
                    minlength: 5,
                },
                newpass: {
                    minlength: 5,
                },
                confirmpass:{
                    equalTo:"#newpass",
                }
            },
            messages: {
                oldpass:{
                    minlength:"Please Enter Atleast 5 characters",
                },
                newpass: {
                    minlength: "Please Enter Atleast 5 characters",
                },
                confirmpass: {
                     equalTo: "New and Confirm password Not Matched",
                },
            }
        });
    };
    $(ValidateChangepass.init);
    // change password Validation End


//validate Add Product Start
    var Validateaddproduct = {};
    Validateaddproduct.init = function () {
        // Validate For Registration
        $('.validate-add-product').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateaddproduct.init);
//Validation Add Product End


//validate Add Article Start
    var Validateaddarticle = {};
    Validateaddarticle.init = function () {
        // Validate For Registration
        $('.validate-add-article').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                   
            },
            messages: {
              
            }
        });
    };
    $(Validateaddarticle.init);
 //Validation Add Article End


//validate Add Survey Start
    var Validateaddsurvey = {};
    Validateaddsurvey.init = function () {
        // Validate For Registration
        $('.validate-add-survey').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateaddsurvey.init)
//Validation Add Survey End

//validate Schedule Survey Start
    var Validateschedulesurvey = {};
    Validateschedulesurvey.init = function () {
        // Validate For Registration
        $('.validate-schedule-survey').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateschedulesurvey.init);
//Validation Schedule Survey End

//validate warehouse Start
    var Validateaddwarehouse = {};
    Validateaddwarehouse.init = function () {
        // Validate For Registration
        $('.validate-add-warehouse').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateaddwarehouse.init);
//Validation warehouse End   

//validate fullload trip Start
    var Validatefullloadtrip = {};
    Validatefullloadtrip.init = function () {
        // Validate For Registration
        $('.validate-fullload-trip').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validatefullloadtrip.init);
//Validation fullload trip End     


//validate partload trip Start
    var Validatepartloadtrip = {};
    Validatepartloadtrip.init = function () {
        // Validate For Registration
        $('.validate-partload-trip').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validatepartloadtrip.init);
//Validation partload trip End 


//validate edit incategory trip Start
    var Validateeditincategory = {};
    Validateeditincategory.init = function () {
        // Validate For Registration
        $('.validate-edit-incategory').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateeditincategory.init);
//Validation edit incategory End 

//validate add incategory trip Start
    var Validateaddincategory = {};
    Validateaddincategory.init = function () {
        // Validate For Registration
        $('.validate-add-incategory').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateaddincategory.init);
//Validation edit incategory End 
    
//validate add bank acc Start
    var Validateaddbankacc = {};
    Validateaddbankacc.init = function () {

        $('.validate-add-bankacc').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateaddbankacc.init);
//Validation add bank acc End 


//validate add pos
    var Validateaddpos = {};
    Validateaddpos.init = function () {

        $('.validate-add-pos').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                pos_amount: {
                number: true
                },
                pos_gst: {
                number: true
                }
            },
            messages: {
            }
        });
    };
    $(Validateaddpos.init);
//Validation add pos  

//validate add admin
    var Validateaddadmin = {};
    Validateaddadmin.init = function () {

        $('.validate-add-admin').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
               
            },
            messages: {
            }
        });
    };
    $(Validateaddadmin.init);
//Validation add admin End  


// change_ftrips_status
    var Validatechangeftripsform = {};
    Validatechangeftripsform.init = function () {

        $('.validate_change_ftrips').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
               
            },
            messages: {
            }
        });
    };
    $(Validatechangeftripsform.init);
//Validation change_ftrips_status

// change_ptrips_status
    var Validatechangeptripsform = {};
    Validatechangeptripsform.init = function () {

        $('.validate_change_ptrips').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
               
            },
            messages: {
            }
        });
    };
    $(Validatechangeptripsform.init);
//Validation change_ptrips_status

//validate add podf
    var Validateaddpodf = {};
    Validateaddpodf.init = function () {

        $('.validate-add-podf').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
            },
            messages: {
            }
        });
    };
    $(Validateaddpodf.init);
//Validation add podf 

//validate add podp
    var Validateaddpodp = {};
    Validateaddpodp.init = function () {

        $('.validate-add-podp').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
            },
            messages: {
            }
        });
    };
    $(Validateaddpodp.init);
//Validation add podp


//validate addtripexp
    var Validateaddtripexp = {};
    Validateaddtripexp.init = function () {

        $('.validate-trip-pay').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
            },
            messages: {
            }
        });
    };
    $(Validateaddtripexp.init);
//Validation addtripexp


//validate addtripexpedit
    var Validateaddtripexpedit = {};
    Validateaddtripexpedit.init = function () {

        $('.validate-trip-pay-edit').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
            },
            messages: {
            }
        });
    };
    $(Validateaddtripexpedit.init);
//Validation addtripexpedit


//validate email seetings
    var Validateemailsettings = {};
    Validateemailsettings.init = function () {
        // Validate For Registration
        $('.validate-email-settings').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateemailsettings.init);
//Validation email seetings


//validate sms seetings
    var Validatesmssettings = {};
    Validatesmssettings.init = function () {
        // Validate For Registration
        $('.validate-sms-settings').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validatesmssettings.init);
//Validation sms seetings

//validate add user
    var Validateadduser = {};
    Validateadduser.init = function () {
        // Validate For Registration
        $('.validate-add-user').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateadduser.init);
//Validation add user end


//validate add additional package
    var Validateaddpack = {};
    Validateaddpack.init = function () {
        // Validate For Registration
        $('.validate-package').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateaddpack.init);
//Validation add additional package


//validate add quote
    var Validateaddquote = {};
    Validateaddquote.init = function () {
        // Validate For Registration
        $('.validate-add-quotation').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateaddquote.init);
//Validation add quote

//validate add invoice
    var Validateaddinvoice = {};
    Validateaddinvoice.init = function () {
        // Validate For Registration
        $('.validate-add-invoice').validate({
            highlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).parent('input').removeClass('valid');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if ($(element).attr("type") === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).removeClass(errorClass).addClass(validClass);
                    $(element).parent('input').addClass('valid');
                }
            },

            rules: {
                
            },
            messages: {
            }
        });
    };
    $(Validateaddinvoice.init);
//Validation add additional package



    // Initialize
    var validator = $(".form-validate-jquery").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Success.");
        },
        rules: {
            password: {
                minlength: 5
            },
            repeat_password: {
                equalTo: "#password"
            },
            email: {
                email: true
            },
            repeat_email: {
                equalTo: "#email"
            },
            minimum_characters: {
                minlength: 10
            },
            maximum_characters: {
                maxlength: 10
            },
            minimum_number: {
                min: 10
            },
            maximum_number: {
                max: 10
            },
            number_range: {
                range: [10, 20]
            },
            url: {
                url: true
            },
            date: {
                date: true
            },
            date_iso: {
                dateISO: true
            },
            numbers: {
                number: true
            },
            digits: {
                digits: true
            },
            creditcard: {
                creditcard: true
            },
            basic_checkbox: {
                minlength: 2
            },
            styled_checkbox: {
                minlength: 2
            },
            switchery_group: {
                minlength: 2
            },
            switch_group: {
                minlength: 2
            }
        },
        messages: {
            custom: {
                required: 'This is a custom error message'
            },
            basic_checkbox: {
                minlength: 'Please select at least {0} checkboxes'
            },
            styled_checkbox: {
                minlength: 'Please select at least {0} checkboxes'
            },
            switchery_group: {
                minlength: 'Please select at least {0} switches'
            },
            switch_group: {
                minlength: 'Please select at least {0} switches'
            },
            agree: 'Please accept our policy'
        }
    });

    // Reset form
    $('#reset').on('click', function() {
        validator.resetForm();
    });

});
