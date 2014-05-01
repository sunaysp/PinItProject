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
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?=$_SESSION['sess_fullname']?> boards</title>
  
  <!-- CSS Reset -->
  <link rel="stylesheet" href="../css/reset.css">

  <!-- Global CSS for the page and tiles -->
  <link rel="stylesheet" href="../css/main.css">
<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- Documentation extras -->
<link href="../docs-assets/css/docs.css" rel="stylesheet">
<link href="../docs-assets/css/pygments-manni.css" rel="stylesheet">

</head>
<body>


	  <div id="container">
		<header>
		  <h1><?=$_SESSION['sess_fullname'] ?> Boards</h1>
		  <p>Click to view the pins on this board</p>
		</header>
		<div id="main" role="main">
		  <ul class="example-tiles">
		  <li><a href="addboard.php">Add board</a></li>
			<?php
			$query = "SELECT `name` FROM board WHERE user_id=".$_SESSION['sess_user_id'].";";
				$result = mysqli_query($link,$query);
				while($row = mysqli_fetch_array($result))
				  {
					echo '<li><a href="addboard.php">'.$row['name'].'</a></li>';
				}
			?>
		  </ul>
		</div>
		</div>


  <!-- include jQuery -->
  <script src="../libs/jquery.min.js"></script>

  <!-- Include the plug-in -->
  <script src="../jquery.wookmark.js"></script>

  <!-- Once the page is loaded, initalize the plug-in. -->
  <script type="text/javascript">
    (function ($){
      $(function() {
        var handler = $('.example-tiles li');

        handler.wookmark({
            // Prepare layout options.
            autoResize: true, // This will auto-update the layout when the browser window is resized.
            container: $('#main'), // Optional, used for some extra CSS styling
            offset: 5, // Optional, the distance between grid items
            outerOffset: 10, // Optional, the distance to the containers border
            itemWidth: 220 // Optional, the width of a grid item
        });
      });
    })(jQuery);
  </script>
</body>
</html>
