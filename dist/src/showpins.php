<?php
include ("connection.php");
session_start();
$stream_name=$_GET['stream_name'];
$stream_id=$_GET['stream_id'];

?>

<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Pins</title>

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
<div id='title'>
  </div>
  <br/>
  <br/> 
<h2 align="center"><b> <?=$stream_name ?></b></h2>
    
<div id='update'>


<?php include ("load_Streampins.php"); ?>
 

</div> <!-- #content -->

</body>
</html>