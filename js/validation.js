jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
$( "name" ).validate({
  rules: {
    fruit: {
      required: true
    }
  }
});

jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});

jQuery.validator.setDefaults({
    highlight: function(element) {
        jQuery(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        jQuery(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'label label-danger',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});


$( "#admission_form" ).validate({
	onfocusout: function(element) { $(element).valid(); },
  rules: {
    email: {
      required: true,
      email: true
    }
  },
  messages: {
	  email:{
		  required: "jhkjhjkhjjk"
	  }
  }
});