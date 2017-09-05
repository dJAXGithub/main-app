<?php
$ep = "../";
include($ep.'includes/pack_includes.php');
security::AuthenticateRhovitAdministrator();
$header_helper = new header_helper();
include('header.php');
?>
<div class="contentCenter">	
	<div class="contentCenterTitle">
	  <h1>
		<div class="Orange">THE</div>
		<div class="Black">ADMINISTRATION PANEL</div>
	  </h1>
	</div>
	<div class="adminMainContent">
		<strong>Welcome!</strong><br /><br />Please select an option from the upper menu to start.
	</div>
	<div class="cboth"></div>
</div>
<?php
include('footer.php');
?>