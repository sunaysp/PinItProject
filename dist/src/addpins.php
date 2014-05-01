<?php
include ("connection.php");
session_start();
$board_name=$_GET['board_name'];
$board_id=$_GET['board_id'];

?>

<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Add Pins</title>

<link rel="stylesheet" href="../css/style2.css" />


<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="../js/pinterest.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>
<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<!-- Global CSS for the page and tiles -->
<link rel="stylesheet" href="../css/main.css">
<!-- CSS Reset -->
<link rel="stylesheet" href="../css/reset.css">
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
 <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>      
      </button>
         <a href="home.php" class="navbar-brand">Pin it!</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">       
        <li>		
		 <a href="#edit_profile" role="button" class="btn" data-toggle="modal">Profile</a>			
		</li>    
      </ul>
	  <ul class="nav navbar-nav">       
        <li>		
		 <a href="recommendation.php">Our Recommendation</a>				
		</li>    
      </ul>
	  <form class="navbar-form navbar-left" role="search" method="post" action="search.php"><table><tr><td>
      <div class="form-group">
        <input type="text" name="key" class="form-control" placeholder="Search">
      </div>
	  </td>
	  <td>	  
      <input type="image" src="../images/search4.png" width="44" height="40"></input>
	</td></tr></table>	</form>
      <ul class="nav navbar-nav navbar-right">	    
        <li>
          <a href="index.html">Logout</a>
        </li>
      </ul>
    </nav>
  </div>
</header>

</head>
<body class="demos ">
  
<div id="content">
<div id='title'></div>
<br/>
  <br/>  
  <h2 align="center"><b> <?=$_GET['board_name'] ?></b></h2>
<div id='update'>

<div><input type='text' id='pin_update' class='textbox' name='pin_update' placeholder='Type your Pin here...' maxlength='100'/></div>
<input type="hidden" id='board_id' name="board_id" value="<?php echo $board_id;?>" />
<div><input type='text' class='textbox' id='tagslist' name='tagslist' placeholder='Enter the tags here with comma seperated value.. ' /></div>
<div id='button_area'><input type='submit' id='pin_submit' class='pin_button'/></div>
<br/>

<div id='upload_area'>
<form id="imageform" method="post" enctype="multipart/form-data" action='ajax_image.php'>
<br/>
<b>Upload an Image: </b><input type="file" name="photoimg" id="photoimg" />

</form>
</div>
<br/>
<b>Upload from Web?</b>
<div><input type='url' id='pin_updload' class='textbox' name='pin_upload' placeholder='Copy the website link here...' maxlength='100'/></div>
<input type="hidden" id='board_id' name="board_id" value="<?php echo $board_id;?>" />

<input type='text' class='textbox' id='tagnames' name='tagnames' placeholder='Enter the tags here with comma seperated value.. ' />
<div id='button_area'><input type='submit' id='pin_submit2' class='pin_button'/></div>
<br/><br/><br/>
<div id='preview'></div>



</div>

<?php include ("load_pin.php"); ?>
 

</body>
</html>