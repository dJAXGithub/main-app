<?php

	require_once('includes/pack_includes.php');
	session_start();

	$cm = New content_manager($_GET['content_type']);
	echo '<select name="id_category" id="id_category" class="'.($_GET['class'] ? $_GET['class'] : '').'" style="margin-left:4px"><option value="">Select</option>';
	foreach ($cm->GetCategories() as $i){
		if($_GET['id_selected']==$i->id) $selected = 'selected="selected"';
		else $selected = '';
		echo '<option value="'.$i->id.'" '.$selected.'">'.$i->name.'</option>';
	}
	echo '</select>';
?>