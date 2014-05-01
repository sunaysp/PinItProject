<?php include 'home_header.php'; ?>
<!-- Global CSS for the page and tiles -->
<link rel="stylesheet" href="../css/main.css">
<!-- CSS Reset -->
<link rel="stylesheet" href="../css/reset.css">
        <div class="col-md-9" role="main">		
		  <div id="container">    
			<div id="main" role="main">
			<header>
			  <h1>Your Friends</h1>      
			</header>
			  <ul class="example-tiles">
			  <li><a href="find_friend.php">Add Friend</a></li>
				<?php
				$query = "SELECT u.user_id, u.username, u.firstname, u.lastname, u.location, u.profile_pic, f.status FROM friends f
					LEFT OUTER JOIN USER u ON f.friend_id = u.user_id where f.user_id=".$_SESSION['sess_user_id'].";";
					$result = mysqli_query($link,$query);
					while($row = mysqli_fetch_array($result))
					{
						$path='../profile/';
						echo "<li><a href='friendshome.php?friend_id=".$row['user_id']."'><img src=".$path.$row['profile_pic']." width='180' height='200'>".$row['firstname']."&nbsp;".$row['lastname']."";
						if($row['status'] == 'SENT'){echo"<h6 style='font-family:arial;color:black;'><b>Pending acceptance</b></h6>";}						
						echo"</img></a></li>";
					}
				?>
			  </ul>
			</div>
		</div>
		 </div>
<?php include 'home_footer.php'; ?>