/*
  Jquery Validation using jqBootstrapValidation
   example is taken from jqBootstrapValidation docs 
  */
$(function() {

 $("input,textarea").jqBootstrapValidation(
    {
     preventSubmit: true,
     submitError: function($form, event, errors) {
      // ukoliko submit stvori nekakvu pogresku ?
     },
     submitSuccess: function($form, event) {
      event.preventDefault(); // sprijeci default submit postavke
       // prikupljanje podataka iz POST-a
       var name = $("input#name").val();  
       var email = $("input#email").val(); 
       var message = $("textarea#message").val();
        var firstName = name;
           // provjera razmaka za Success/Fail poruku
        if (firstName.indexOf(' ') >= 0) {
	   firstName = name.split(' ').slice(0, -1).join(' ');
         }        
	 $.ajax({
                url: "./bin/contact_me.php",
            	type: "POST",
            	data: {name: name, email: email, message: message},
            	cache: false,
            	success: function() {  
            	// uspjesno poslan email
            	   $('#success').html("<div class='alert alert-success'>");
            	   $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            		.append( "</button>");
            	  $('#success > .alert-success')
            		.append("<strong>Vaša je poruka uspješno poslana. </strong>");
 		  $('#success > .alert-success')
 			.append('</div>');
 						    
 		  // pobriši sve podatke
 		  $('#contactForm').trigger("reset");
 	      },
 	   error: function() {		
 		// neuspjeh
 		 $('#success').html("<div class='alert alert-danger'>");
            	$('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            	 .append( "</button>");
            	$('#success > .alert-danger').append("<strong>Pogreška mail servera...</strong> Molimo pošaljite mail direktno na <a href='mailto:raspberry.pus@gmail.com?Subject=Message_Me from klijenti@salon.com'>raspberry.pus@gmail.com</a> ?");
 	        $('#success > .alert-danger').append('</div>');
 		// pobriši sve podatke
 		$('#contactForm').trigger("reset");
 	    },
           })
         },
         filter: function() {
                   return $(this).is(":visible");
         },
       });

      $("a[data-toggle=\"tab\"]").click(function(e) {
                    e.preventDefault();
                    $(this).tab("show");
        });
  });
 

/* sakrij fail/success box */ 
$('#name').focus(function() {
     $('#success').html('');
  });
