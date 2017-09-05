<?php
$ep = "../../";
include('../../includes/pack_includes.php');

/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = UPLOAD_CONTENT_TEMP; 

$cp_id = $_GET['cp_id'];

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	//$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetPath = $targetFolder;
	//$_FILES['Filedata']['name'] = str_replace(' ', '_', $_FILES['Filedata']['name']);
	//$ext = "." . content_files_helper::getFileExtension($_FILES['Filedata']['name']);
	$targetFile = rtrim($targetPath,'/') . '/' . $cp_id  . $_GET['prefix'] . "_" .$_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('mp3','mp4','pdf','avi','mov','MP4','AVI','MP3','PDF','ZIP','RAR','zip','rar'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo $_FILES['Filedata']['name'];
	} else {
		echo 'Invalid file type.';
	}
}
?>
