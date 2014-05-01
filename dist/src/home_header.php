<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<?php	
	include 'connection.php';	
	session_start(); 
	if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
		header("location: login.html");
		exit();					
	}
?>
<title>
  
     welcome to &middot; Pin it!
  
</title>

<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<!-- Global CSS for the page and tiles -->
<link rel="stylesheet" href="../css/main.css">
<!-- CSS Reset -->
<link rel="stylesheet" href="../css/reset.css">

<!-- Documentation extras -->
<link href="../docs-assets/css/docs.css" rel="stylesheet">
<link href="../docs-assets/css/pygments-manni.css" rel="stylesheet">
<script>;

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-146052-10']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<script>
	 $('#edit_profile').modal('show');
</script>
  </head>
  <body>
  <?php	
	
	$user_id = $_SESSION["sess_user_id"];
	$query = "SELECT profile_pic FROM user
        WHERE user_id = '$user_id';";
	$result=mysqli_query($link,$query);	
	$row=mysqli_fetch_row($result);
	$profile_pic=$row[0];
	//echo $profile_pic;
?>
    <a class="sr-only" href="#content">Skip to main content</a>

    <!-- Docs master nav -->
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


    <!-- Docs page layout -->
    <div class="bs-header" id="content">
      <div class="container">
       <br>
       <br><br><br><br>
      </div>
    </div>

    <div class="container bs-docs-container">
      <div class="row">
	  
        <div class="col-md-3">
          <div class="bs-sidebar hidden-print" role="complementary">
           <ul class="nav bs-sidenav nav-pills nav-stacked" style="float: left;"> 			
				<li><?php
				$path='../profile/';
				echo'<img src='.$path.$profile_pic.' width="200" height="240" border="5">';
				?>
				</li>
                <li><a href="boards.php">Your Boards</a></li>				
				<li><a href="yourpins.php">Your Pins</a></li>
				<li><a href="your_likes.php">Your likes</a></li>  
				<li><a href="your_friends.php">Your Friends</a></li>  			
				<li><a href="your_follow_boards.php">Follow Boards</a></li>
				<li><a href="Streams.php">Follow Streams</a></li>
				<li><a href="find_friend.php">Find Friends</a></li>          
				<li><a href="notifications.php">Notifications</a></li>   				
            </ul>
          </div>
        </div>
	<!-- Modal -->
	
<div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit profile</h4>
      </div>
	  <form name="editprofile" method="post" action="save_profile.php" enctype="multipart/form-data" >
	  
      <div class="modal-body">
	  <?php
		$query = "SELECT username, firstname, lastname, location, email from user where user_id = ".$_SESSION['sess_user_id'].";";
		$result=mysqli_query($link,$query);				
		$userData = mysqli_fetch_array($result, MYSQL_ASSOC);
		
	  ?>
        		<table width="510" border="0" align="center">					
					<tr>
						<td>Username:<span class="mandatory">*</span></td>
						<td><label><?=$userData['username']?></label></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="text" name="email" maxlength="35" value="<?=$userData['email']?>" /></td>
					</tr>
					<tr>
						<td><label>First Name:</label></td>
						<td><input type="text" name="firstname" maxlength="35" value="<?=$userData['firstname']?>" /></td>
					</tr>
					<tr>
						<td><label>Last Name:</label></td>
						<td><input type="text" name="lastname" maxlength="30" value="<?=$userData['lastname']?>" /></td>
					</tr>
					<tr>
						<td><label>Location:</label></td>
						<td><input type="text" name="location" maxlength="30" value="<?=$userData['location']?>" /></td>
					</tr>
					<tr>
						<div class="form-group">
						<label for="ppic">Upload your profile Picture</label>
						<input type="file" id="ppic" name="ppic"/>
						<p class="help-block">You can opt not to</p>
						</div>
					</tr>
					
				</table>
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" value="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

	