<?
	if(!isset($_SESSION['rhovit_user_provider'])) {
		$id = $rhovit_user->rhovit_userId;
		$profile = 'user';
	}else{
		$id = $rhovit_user_provider->rhovit_user_providerId;
		$profile = 'provider';
	}
?>
<!-- Include these scripts to import address books with CloudSponge -->
<script type="text/javascript" src="https://api.cloudsponge.com/address_books.js"></script>
<script type="text/javascript" charset="utf-8">

var csPageOptions = {
 
//PROD
  domain_key:"DHXBJCMHSSWRCB678SPG",
  textarea_id:"contact_list",
 
//TEST 
  //domain_key:"27WUS6BLQZVFMCN5CCY2", 
  //textarea_id:"contact_list",
  // include other options here

  afterSubmitContacts: function(contacts) {
	jQuery('#div_import_status').html('<img src="images/loading.gif" width="20" align="absmiddle"/> Importing contacts...');
    // contacts is an array of the contacts that the user selected

    // define our local vars here

    var contact, name, email, textarea_element;

    var emails = [];

    // for each contact, format the name and email as a recipient

    for (var i = 0; i < contacts.length; i++) {

		contact = contacts[i];
		
		name = contact.fullName();
		email = contact.selectedEmail();
	  
		jQuery.ajax({
			url: "ajax_import_contact.php",
			type: "POST",
			data: "name=" + name + "&email=" + email + "&ref_profile=<?=$profile?>&ref_id=<?=$id?>",
			async: false
		});

    }
	alert('Contacts Invited. Thanks!');
    jQuery('#div_import_status').html('');
  }
};
</script>

<!-- This textarea will be populated with the contacts returned by CloudSponge -->
<textarea id="contact_list" style="width:450px;height:82px;display:none;" ></textarea>
<div id="div_import_status"></div>
<!-- Any link with a class="cs_import" will start the import process -->
<img src="images/contact_grey_add.png" width="20" align="absmiddle"/><a class="cs_import">Invite my contacts to RHOVIT</a>