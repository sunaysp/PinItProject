<?php
include ("includes/db.php");
?>

<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<link rel="stylesheet" href="css/style.css" />


<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="js/pinterest.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<script type="text/javascript" >
 $(document).ready(function() { 
		
            $('#photoimg').live('change', function()			{ 
			           $("#preview").html('');
				$("#current").hide();
			    $("#preview").html('<img src="css/ajax-loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
		
		});
        }); 
</script>

</head>
<body class="demos ">
  
<div id="content">
<div id='title'>
  

    
<div id='update'>

<div><input type='text' id='pin_update' class='textbox' name='pin_update' placeholder='Type your Pin here...' maxlength='100'/></div>
<div id='button_area'><input type='submit' id='pin_submit' class='pin_button'/></div>

<div id='upload_area'>
<form id="imageform" method="post" enctype="multipart/form-data" action='ajax_image.php'>
<b>Upload an Image:</b><input type="file" name="photoimg" id="photoimg" />
</form>
</div>
<div id='preview'></div>



</div>

<?php include ("load_pin.php"); ?>
 
<div id='footer'>&copy;Sunay & Sangeetha</div>
</div> <!-- #content -->

</body>
</html>