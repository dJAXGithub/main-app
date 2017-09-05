<?php

$id = urldecode($_GET['id']); 
$id = $_GET['id']; 
$filename = "RHOVIT_some_movie.mp4";
header('Content-Type: audio/mpeg');
header('Content-Disposition: attachment; filename=theSong.mp4;');
header("location: ".$id);

exit();

?>
