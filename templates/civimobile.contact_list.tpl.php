<?php require('civimobile.header.php'); ?>

	<div data-role="dialog" id="no-match-dialog" >
	  <div data-role="header" data-theme="d">
	    <h1>No match</h1>
	  </div>    
	  <div data-role="content" id="text">
		<p>No contacts match your search, click below to add a new contact</p>
		<a href="<?php print url('civimobile/create/contact') ?>" data-role="button" data-icon="plus">Add contact</a>
	  </div>
	    
	</div>

<div data-role="page" data-theme="c" id="jqm-contacts"> 
	<div id="jqm-contactsheader" data-role="header">
        <h3>Search Contacts</h3>
        <a href="/civimobile" data-ajax="false" data-direction="reverse" data-role="button" data-icon="home" data-iconpos="notext" class="ui-btn-right jqm-home">Home</a>
	</div> 
	
	<div data-role="content" id="contact-content"> 
    <div class="ui-listview-filter ui-bar-c">
        <input type="search" name="sort_name" id="sort_name" value="" />
    </div>
    </div>

    	 
    <?php require_once('civimobile.navbar.php'); ?>

    
    
<script>

$( function(){
    
<?php
   $results=json_encode(civicrm_api("Contact","get", array ('sequential' =>'1', 'version'=>3, 'return' =>'display_name,phone')));	
   echo "contacts = $results;\n";
    ///start with all the contacts (well the 25 first, ordered by the ever so useful contact_id), would be great to sort by desc modification date & user = current user? 
?>
   $('#contact-content').append('<ul id="contacts" data-role="listview" data-inset="false" data-filter="false" ></ul>');
   $.each(contacts.values, function(key, value) {
     $('#contacts').append('<li role="option" tabindex="-1" data-ajax="false" data-theme="c" id="contact-'+value.contact_id+'" ><a href="#contact/'+value.contact_id+'" data-role="contact-'+value.contact_id+'">'+value.display_name+'</a></li>');
   });
   $('#contacts').listview();


  $('#sort_name').change (function () {
    contactSearch ($(this).val());
  }); 
   
});


function contactSearch (q){
    $.mobile.showPageLoadingMsg( 'Searching' );
    $().crmAPI ('Contact','get',{'version' :'3', 'sort_name': q, 'return' : 'display_name,phone' }
          ,{ 
            ajaxURL: crmajaxURL,
            success:function (data){
              if (data.count == 0) {
                cmd = null;
                $('#contact-content').append($('#add_contact'));
                $('#contacts').hide();
				$.mobile.changePage('#no-match-dialog', 'pop', true, true);
                // $('#add_contact').show();
                //                 populateContactForm();
                //                 $('#save-contact').click(function(){ createContact(); });                              
              }
              else {
                cmd = "refresh";
                $('#contacts').show();
                $('#add_contact').hide();
                $('#contacts').empty();
              }
              $.each(data.values, function(key, value) {
                $('#contacts').append('<li role="option" tabindex="-1" data-ajax="false" data-theme="c" id="event-'+value.contact_id+'" ><a href="#contact/'+value.contact_id+'" data-role="contact-'+value.contact_id+'">'+value.display_name+'</a></li>');
              });
           $.mobile.hidePageLoadingMsg( );
           $('#contacts').listview(cmd);
          }
   });
}

function populateContactForm() {
    $('#phone, #email, #note, #last_name, #first_name').val('');    

    searchTerms = $('#sort_name').val().split(' ');

    $('#first_name').val(searchTerms[0]); 

    if (searchTerms[1]){
        $('#last_name').val(searchTerms[1]); 
        }
    }



</script>
</div> 

<? require('civimobile.footer.php'); ?>
