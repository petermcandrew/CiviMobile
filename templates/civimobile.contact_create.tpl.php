<?php require('civimobile.header.php'); ?>
<div data-role="page" data-theme="c" id="jqm-contacts-create">

	<div data-role="header" data-theme="a">
		<a href="#" data-rel="back" class="ui-btn-left" data-icon="arrow-l">Home</a>
		<h3>Add contact</h3>
	</div><!-- /header -->
	<div data-role="content" id="contact-create-content"> 
		<div data-role="fieldcontain">
		      <input type="text" placeholder="First Name" name="first_name" id="first_name" value=""  />
		  </div>
		  <div data-role="fieldcontain">
		      <input type="text" placeholder="Last Name"name="last_name" id="last_name" value=""  />
		  </div>
		  <div data-role="fieldcontain">
		      <input type="email" placeholder="Email" name="email" id="email" value=""  />
		  </div>    
		  <div data-role="fieldcontain">
		      <input type="tel" placeholder="Phone" name="tel" id="tel" value=""  />
		  </div>
		  <div data-role="fieldcontain">
		  	<textarea cols="40" rows="8" name="note" placeholder="Note" id="note"></textarea>
		  </div>
		<a href="#" data-role="button" id="save-contact">Save Contact</a>
	
		
	</div>
</div>
<script>

		$('#save-contact').bind('click', function() {
		  createContact();
		});
		
		function createContact() {
		first_name = $('#first_name').val();
		last_name = $('#last_name').val();
		phone = $('#tel').val();
		email = $('#email').val();
		note = $('#note').val();


		$().crmAPI('Contact', 'create', {
		    'version': '3',
		    'contact_type': 'Individual',
		    // only individuals for now
		    'first_name': first_name,
		    'last_name': last_name,
		    'phone': phone,
		    'email': email,
		    'notes': note
		}
		,
		{
    		success: function(data) {
        	$.each(data.values,
	        function(key, value) {
            $.mobile.changePage("/civimobile/contact/" + value.id);
        });
    }
});
}
		
	
	
</script>
<? require('civimobile.footer.php'); ?>