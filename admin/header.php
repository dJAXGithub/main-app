<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
	<link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
	<link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../css/tipTip.css" media="screen" />
	<link href="../css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../css/dropdown/themes/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../css/horizontal-centering.css" media="all" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="../js/scripts.js"></script>
	<script type="text/javascript" src="../js/login.js"></script>
<?php
echo $header_helper->GetJsScripts();
echo $header_helper->GetCssSheets();
?>
<title>Rhovit Administration Panel</title>
</head>
<body>
  <div class="body">
    <div class="adminBodyContent">
	  <div class="adminContentSuperior">
<?php if (security::IsRhovitAdministratorAuthenticated()) { ?>
	  <div class="contentBotoneraSuperior">
		<div class="botoneraSuperior">
			<div class="textoBotonSuperiorRight first" style="margin-left:25px">
			  <a href="logout.php">Log Out</a>
           </div>
           <div class="textoBotonSuperiorRight">
              |
            </div>
           <div class="textoBotonSuperiorRight">
              <a href="change_password.php">
                Change Password
              </a>
           </div>
         </div>
	  </div>
<?php } ?>
<div style="width:996px;margin: auto;">
        <div style="padding-top:20px;">
			<img src="../images/rhovit_logo.png" width="176px" border="0" />
        </div>

<?php if (security::IsRhovitAdministratorAuthenticated()) { ?>
		<div class="adminContentBotoneraHeader">
<?php include("../includes/menu_admin.php"); ?>
		</div>
<?php } ?>
</div>