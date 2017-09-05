<?
	include('includes/pack_includes.php');

	$type = $_GET['type'];
	$id = $_GET['id'];

	$path = UPLOAD_CONTENT . $type . FILE_NOTATION_SEPARATOR . $id . "_preview.jpg";
?>

<div align="center" style="background-color:gray">
	<? if(file_exists($path)) echo '<img src="'.$path.'" align="center" />';
	else echo '<br><img height="75" src="images/rhovit_logo.png" /><div style="font-family:arial;padding:50px;color:white"><strong>Preview not available.</strong></div>';
	?>	
</div>