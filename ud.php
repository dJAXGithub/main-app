<link rel="stylesheet" type="text/css" href="js/uploadify/uploadify.css" />  
<script type="text/javascript" src="js/jquery-1.8.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.simplemodal.js"></script>
<script src="js/uploadify/jquery.uploadify-3.1.min.js"></script>
<input type="file" name="test" id="test" />
<script>
$('#test').uploadify({
                            'swf'      : 'js/uploadify/uploadify.swf',
                            'uploader' : 'js/uploadify/uploadify.php?cp_id=7&prefix=_prom',
                            'fileTypeExts': "*.avi;*.mp4",
							 'folder': '',
                            'onDialogOpen' : function(file, data, response) {
                                $("#aux_update").html("");
                            },
                            'onUploadSuccess' : function(file, data, response) {
                                $("#div_file_main_tmp_name").html('<img src="images/filesave.png" width="24" align="absmiddle" /> ' + file.name);
                            },
							'onUploadError' : function(file, errorCode, errorMsg, errorString) {
								alert('The file ' + file.name + ' could not be uploaded: ' + errorString + ' ' +errorMsg+ ' ' +errorMsg);
							},
							'onUploadStart' : function(file, errorCode, errorMsg, errorString) {
								//alert('Starting to upload ' + file.name);
								//$("#main_file_ext").val(file_get_ext(file.name));
							}
                        
                    });
					
</script>

