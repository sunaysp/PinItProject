<?php
//Start session
session_start();
include 'connection.php';

if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
	header("location: login.html");
	exit();
	//SELECT CONCAT(firstname,' ',lastname) AS fullname FROM USER\
	
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
<link rel="stylesheet" href="../css/style2.css" />

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

<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="../js/pinterest.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>

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
				<li><?php  
				echo'<img src='.$_SESSION["sess_profile"].' width="200" height="240" border="5">';
				?>
				</li>
                <li><a href="boards.php">Your Boards</a></li>				
				<li><a href="yourpins.php">Your Pins</a></li>
				<li><a href="#download-additional">Your likes</a></li>  
				<li><a href="your_friends.php">Your Friends</a></li>  			
				<li><a href="#whats-included">Follow Boards</a></li>
				<li><a href="#template">Follow Streams</a></li>
				<li><a href="find_friend.php">Find Friends</a></li>          
				<li><a href="notifications.php">Notifications</a></li>   				
            </ul>
          </div>
        </div>
	
	<div class="col-md-9" role="main">		
	  <div id="container">
		<div id="main" role="main">
			<?php
			 $link = mysql_connect('localhost','root','root');
			 if(!$link) {
			  die("Our server is down. Please try after some time or Contact your administrator");
			 } 
			$schema = 'pinterest';
			mysql_select_db($schema);
			
			$query="SELECT D.pic_id, D.`url` FROM `board` B
INNER JOIN `pin` C ON C.`board_id`=B.`board_id`
INNER JOIN picture D ON C.`pic_id`=D.`pic_id`
WHERE B.`user_id`=".$_SESSION['sess_user_id'];
			$result=mysql_query($query);
				
			echo '<ui style="list-style-type:none;" id="tiles">';
			while ($row = mysql_fetch_array($result, MYSQL_BOTH))
				 {						
					$url = "../images/".$row[1];		
					echo '<li><img src='.$url.' width="200" height="283"></li>';			
				 }
				 echo '</ui>';
			?>
		</div>
	   </div>
	 </div>

  </div>
    </div>

  </div>
    </div>
    <!-- JS and analytics only. -->
    <!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="../js/bootstrap.js"></script>

<script src="http://platform.twitter.com/widgets.js"></script>
<script src="../docs-assets/js/holder.js"></script>

<script src="../docs-assets/js/application.js"></script>


  <!-- include jQuery -->
  <script src="../libs/jquery.min.js"></script>

  <!-- Include the imagesLoaded plug-in -->
  <script src="../libs/jquery.imagesloaded.js"></script>

  <!-- Include the plug-in -->
  <script src="../jquery.wookmark.js"></script>

  <!-- Once the page is loaded, initalize the plug-in. -->
  <script type="text/javascript">
    (function ($){
      $('#tiles').imagesLoaded(function() {
        var handler = null;

        // Prepare layout options.
        var options = {
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#main'), // Optional, used for some extra CSS styling
          offset: 20, // Optional, the distance between grid items
          itemWidth: 210 // Optional, the width of a grid item
        };

        function applyLayout() {
          $('#tiles').imagesLoaded(function() {
            // Destroy the old handler
            if (handler.wookmarkInstance) {
              handler.wookmarkInstance.clear();
            }

            // Create a new layout handler.
            handler = $('#tiles li');
            handler.wookmark(options);
          });
        }

        /**
         * When scrolled all the way to the bottom, add more tiles.
         */
        function onScroll(event) {
          // Check if we're within 100 pixels of the bottom edge of the broser window.
          var winHeight = window.innerHeight ? window.innerHeight : $(window).height(); // iphone fix
          var closeToBottom = ($(window).scrollTop() + winHeight > $(document).height() - 100);

          if (closeToBottom) {
            // Get the first then items from the grid, clone them, and add them to the bottom of the grid.
            var items = $('#tiles li'),
                firstTen = items.slice(0, 10);
            $('#tiles').append(firstTen.clone());

            applyLayout();
          }
        };

        // Capture scroll event.
        $(window).bind('scroll', onScroll);

        // Call the layout function.
        handler = $('#tiles li');
        handler.wookmark(options);
      });
    })(jQuery);
  </script>



<!-- Analytics
================================================== -->
<script>
  var _gauges = _gauges || [];
  (function() {
    var t   = document.createElement('script');
    t.async = true;
    t.id    = 'gauges-tracker';
    t.setAttribute('data-site-id', '4f0dc9fef5a1f55508000013');
    t.src = '//secure.gaug.es/track.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(t, s);
  })();
</script>


  </body>
</html>
