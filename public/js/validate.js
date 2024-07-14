$(document).ready(function(){
	$("#login_form").validate({
		rules: {
			password_log: {
				required: true,
				minlength: 5
			},
			email_id_log: {
				required: true,
				email: true
			},
		},
		messages: {			
			email_id_log: {
				required: "Please enter a email address",
				email: "Please enter a valid email address"
			},
			password_log: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			}
		}
	});

	$("#registration_form").validate({
		rules: {
			user_name: {
				required: true,
				minlength: 3
			},
			phone_number: {
				required: true,
				number: true,
				maxlength:10,
				minlength:10
			},
			email:{
				required:true,
				email:true
			},
			user_password:{
				required:true,
				minlength:5
			},
			agree:"required"
		},
		messages: {			
			phone_number: {
				required: "Please enter a number",
				maxlength: "Please enter a only 10 digits",
				minlength: "Please enter a only 10 digits"
			},
			user_name: {
				required: "Please enter a user name",
				minlength: "Your user name must be at least 3 characters long"
			},
			email:{
				required: "Please enter a email address",
				email: "Please enter a valid email address"
			},
			user_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			agree:"Please select terms and conditions"
		}
	});

	$("#forgot_password_form").validate({
		rules: {
			email_id_forgot:{
				required:true,
				email:true
			}
		},
		messages: {			
			email_id_forgot:{
				required: "Please enter a email address",
				email: "Please enter a valid email address"
			}
		}
	});
	$("#contact_form").validate({
		rules:{
			first_name:"required",
			last_name :"required",
			phone_nos: {
				required: true,
				number: true,
				maxlength:10,
				minlength:10
			},
			email:{
				required:true,
				email:true
			},
			message:"required",
		},
		messages:{
			first_name:"Please enter your first name!",
			last_name :"Please enter your lase name!",
			phone_nos: {
				required: "Please enter a number!",
				maxlength: "Please enter a only 10 digits!",
				minlength: "Please enter a only 10 digits!"
			},
			email:{
				required: "Please enter your email address!",
				email: "Please enter your valid email address!"
			},
			message:"Please enter your message!"
		}
	});

	$("#compose_mail").validate({
		rules: {
			to_email: "required",
			subject: "required",
			message: "required"
		},
		messages: {			
			to_email:"Please Select To email!",
			subject: "Please enter subject!",
			message: "Pleas enter your message!"				
			
		}
	});

	$("#compose_mail_others").validate({
		rules: {
			to_email: "required",
			"customer_email[]": "required",
			any_email:{
				required:true,
				email:true
			},
			subject: "required",
			message: "required"
		},
		messages: {			
			to_email:"Please Select Type!",
			subject: "Please enter subject!",
			any_email:{
				required:"Please enter email address!",
				email:"Please enter valid email address!"
			},
			message: "Pleas enter your message!"				
			
		}
	});

	$("#add_post").validate({
		rules: {
			title:"required",
			category:"required",
			status:"required",
			price:{
				required:true,
				number:true,
			},
			country:"required",
			state:"required",
			city:"required",
			short_description:"required",
			description:"required",	
			image:{
                required: true,
                accept:"jpg,png,jpeg,gif"  
            }  		
		},
		messages: {		
			title:"Please enter ads name!",
			category:"Please select category!",
			price:{
				required:"Please enter price!",
				number:"Please enter validate price!"
			},
			country:"Please select country name!",
			state:"Please select state name!",
			city:"Please select city name!",
			short_description :"Please enter short description!",
			description :"Please enter description",
			image:{
                required: "Select image!",
                accept: "Only image type jpg/png/jpeg/gif is allowed"
            },
			status:"Please select status",
		}
	});

	$("#edit_post").validate({
		rules: {
			title:"required",
			category:"required",
			price:{
				required:true,
				number:true,
			},
			country:"required",
			state:"required",
			city:"required",
			short_description:"required",
			description:"required",	
			image:{                
                accept:"jpg,png,jpeg,gif"  
            },
            status:"required",	
		},
		messages: {		
			title:"Please enter ads name!",
			category:"Please select category!",
			price:{
				required:"Please enter price!",
				number:"Please enter validate price!"
			},
			country:"Please select country name!",
			state:"Please select state name!",
			city:"Please select city name!",
			short_description :"Please enter short description!",
			description :"Please enter description",
			image:{
                accept: "Only image type jpg/png/jpeg/gif is allowed"
            },
            status:"Please select status!"
		}
	});

	$('#upload_image').validate({
	   	rules: {
	       "file[]": {
	                     required: true,
	                     extension: "jpg|jpeg|png",
	                  }
	        },
	    messages: {		
			
			"file[]":{
				required:"Please choose image file!",
				extension:"Please choose valid image file!"
			},
		}
	});
});	
