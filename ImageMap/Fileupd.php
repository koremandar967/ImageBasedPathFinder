<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<HEAD>
<Style>
input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
	padding: 7px 1px;
	height:30px;
	width:100%;
    cursor: pointer;
}
#submit_button {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 10px 12px;
	width:100%;
    cursor: pointer;
}
#submit_Text {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 10px 12px;
	width:100%;
    cursor: pointer;
}
</Style>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
</head>
<body style="background:#FF6600">

				<script type="text/javascript" >
				$(function() {
				$("#submit_button").click(function() {
				$("#preview").html('');
				$("#create_account").ajaxForm({
						target: '#preview'
					}).submit();
				});
				}); 
				</script>


<form id="create_account" action="UploadToServer.php" method="post" enctype="multipart/form-data">
<input type="text" value="<?php echo $_GET["Lat"].",".$_GET["Log"]; ?>" placeholder="My Location" id="submit_Text" name="location"><br><br><br>
<label for="file-upload" class="custom-file-upload">
    Select Image File
</label><br>
<input id="file-upload" name="Ofile" type="file"/><br><br>
<input type="Button" value="Upload" id="submit_button" name="submit"><br><br>
</form>
<div id="preview"></div>
</body>
</html> 







