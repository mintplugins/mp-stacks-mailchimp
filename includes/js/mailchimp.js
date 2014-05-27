jQuery(document).ready(function($){
	
	$(document).on( 'click', '.mp_stacks_mailchimp_submit', function(event){
		$(this).parent().parent().submit();
	});
	
	//When somone submits the mailchimp form
	$( '.mp_stacks_mailchimp_signup').on('submit', function( event) {
		
		event.preventDefault();
	
		// Use ajax to add the persons email to the list
		var postData = {
			action: 'mp_stacks_mailchimp',
			mp_stacks_mailchimp_email: $(this).find( '.mp-stacks-mailchimp-email' ).val(),
			mp_stacks_mailchimp_brick_id: $(this).find( '.mp-stacks-mailchimp-brick-id' ).val()
		};
		
		var the_form = $(this);
		
		//Ajax to make new stack
		$.ajax({
			type: "POST",
			data: postData,
			url: mp_stacks_frontend_vars.ajaxurl,
			success: function (response) {
				
				the_form.empty();
																
				//Add our response to the email signup area
				the_form.prepend(response);
			
			}
		}).fail(function (data) {
			console.log(data);
		});
			
	});
			
}); 