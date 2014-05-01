<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>
  
     welcome to &middot; Pin it!
  
</title>

<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

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

  </head>
  <body>
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
		 <a href="edit_profile.php">Profile</a>				
		</li>    
      </ul>
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
           <ul class="nav bs-sidenav"> 			
				<li><?php session_start();
				$path='../profile/';
				echo'<img src='.$path.$_SESSION["sess_profile"].' width="180" height="150" border="5">';
				?>
				</li>
                <li><a href="boards.php">Your Boards</a></li>				
				<li><a href="yourpins.php">Your Pins</a></li>
				<li><a href="#download-additional">Your likes</a></li>  
				<li><a href="your_friends.php">Your Friends</a></li>  			
				<li><a href="#whats-included">Follow Boards</a></li>
				<li><a href="Streams.php">Follow Streams</a></li>
				<li><a href="find_friend.php">Find Friends</a></li>          
				<li><a href="notifications.php">Notifications</a></li>   				
            </ul>
          </div>
        </div>
	