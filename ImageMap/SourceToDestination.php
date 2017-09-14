<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<HEAD>
<Style>
input[type="file"] {
    display: none;
}
.custom-file-upload1 {
   border: 1px solid #ccc;
    display: inline-block;
	padding: 7px 1px;
	height:30px;
	width:100%;
    cursor: pointer;
}

.custom-file-upload2 {
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


<form id="create_account" action="UploadToServersd.php" method="post" enctype="multipart/form-data">
<label for="file-upload1" class="custom-file-upload1">
    Select Source Image File
</label>
<input id="file-upload1" name="Ofiles" type="file"/><br><br>

<label for="file-upload2" class="custom-file-upload2">
    Select Destination Image File
</label>
<input id="file-upload2" name="Ofiled" type="file"/><br><br>

<input type="Button" value="Upload" id="submit_button" name="submit"><br><br>
</form>
<div id="preview"></div>
</body>
</html> 







