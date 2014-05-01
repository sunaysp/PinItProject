<?php include 'home_header.php'; ?>
        <div class="col-md-9" role="main">		
		  <div id="container">
			<div id="main" role="main">
				<?php
				$user= $_SESSION["sess_user_id"];
				$criteria = $_POST['criteria'];
				$key = $_POST['keyname'];
				$query = 'SELECT user_id,username,firstname,lastname,location,profile_pic from user where '.$criteria.' like "%%'.$key.'" and user_id <>('.$user.') and user_id not in (select friend_id from friends where user_id = '.$user.');';
				$result = mysqli_query($link,$query);			
				$num_rows = mysqli_num_rows($result);
				echo '<div class="clear"><h3>we found exactly '.$num_rows.' user(s) matching the '.$criteria.' criteria - "'.$key.'"</h3></div>';
				echo '<div id="form_wrapper" role="main" align="left" class="form_wrapper">';
				echo '<ui style="list-style-type:none;">';
				if($num_rows!=0)
				{								
					while ($row = mysqli_fetch_array($result, MYSQL_BOTH))
						 {								
							$user_id = $row[0];
							if($user_id!= $user)
							{						
								$username = $row[1];							
								$firstname = $row[2];
								$lastname = $row[3];
								$location = $row[4];
								$url = "../profile/".$row[5];		
								echo '<li><form name="friendship" method="post" action="add_friend.php">
								<img src='.$url.' width="200" height="240"><br/>
								<div align="left"><b>'.$firstname.'&nbsp'.$lastname.'<br/>'.$location.'</b>
								<input type="hidden" name="user_id" value='.$user_id.'></input>
								<input type="hidden" name="friendname" value='.$firstname.'&nbsp'.$lastname.'></input><br/>
								<input type="hidden" name="status" value="request"></input><br/>
								<a href="javascript: submitform()">Add Friend</a><br/>
								</div></form></li>';
								echo '<script type="text/javascript">
								function submitform()
								{
								  document.friendship.submit();
								}
								</script>';		
							}
						 }
						 
						 echo '</ui></div>';
					}else
					{
						echo '<a href="find_friend.php">Search again?</a>&nbsp;&nbsp;&nbsp;<a href="your_friends.php">Check your friend list</a>';
					}
				?>
			</div>
		   </div>
		 </div>
<?php include 'home_footer.php'; ?>