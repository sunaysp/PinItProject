<?php include 'home_header.php'; ?>
        <div class="col-md-9" role="main">		
		  <div id="container">
			<div id="main" role="main">
				<?php
				if (isset($_POST["user_id"])) {
					$friend = $_POST['user_id'];
					$friendname = $_POST['friendname'];
					$status = $_POST['status'];
				}else{  
					$friend = $_GET['user_id'];
					$friendname = $_GET['friendname'];
					$status = $_GET['status'];
				}
				
				$user= $_SESSION["sess_user_id"];
				$query1 = "Select status from friends where user_id='.$user.' and friend_id='.$friend' ;";
				$result = mysqli_query($link,$query1);			
				$userData = mysqli_fetch_array($result, MYSQL_ASSOC);
			
			if($status == 'cancel')
			{
				$query2 = "Delete from friends where user_id =".$friend."  and friend_id=".$user." and status='SENT';";
				$result = mysqli_query($link,$query2);	
				header('Location: notifications.php');
			}
			else
			{
					if($userData['status'] == 'SENT')
					{
						echo '<h3>A friend request was already been sent to '.$friendname.' and is awaiting response!</h3><br/><br/>';
						echo '<a href="find_friend.php">Add Another Friend</a>&nbsp;&nbsp;&nbsp;<a href="your_friends.php">Check your friend list</a>';
					}
					else if ($userData['status'] == 'ACCEPTED')
					{
						echo '<h3>You are already friends with '.$friendname.'.</h3><br/><br/>';
						echo '<a href="find_friend.php">Add Another Friend</a>&nbsp;&nbsp;&nbsp;<a href="your_friends.php">Check your friend list</a>';
					}
				else
				{				
					if($status == 'request')
					{
						$query2 = "Insert into friends(user_id,friend_id,STATUS) values (".$user.",".$friend.",'SENT');";
						$result = mysqli_query($link,$query2);				 
						if($result)// User not found. So, redirect to login_form again.
						{
							echo '<h3>A request has been sent to '.$friendname.'.</h3><br/><br/>';
							echo '<a href="find_friend.php">Add Another Friend</a>&nbsp;&nbsp;&nbsp;<a href="your_friends.php">Check your friend list</a>';
							$query3 = "Insert into activity(name,user_id) values ('Friend sent',".$user.");";
							$result = mysqli_query($link,$query3);	
							$query4 = "Insert into activity(name,user_id) values ('Friend pending',".$friend.");";
							$result = mysqli_query($link,$query4);	
							
						}else
						{
							echo '<h3>There was an error sending the friend request to '.$friendname.'</h3><br/><br/>';
							echo '<a href="find_friend.php">Try again?</a>&nbsp;&nbsp;&nbsp;<a href="your_friends.php">Check your friend list</a>';							
						}
					}
					else{
					// when call is from notifications.php
						$query2 = "Insert into friends(user_id,friend_id,STATUS) values (".$user.",".$friend.",'ACCEPTED');";
						$result = mysqli_query($link,$query2);				 
						if($result)
						{
							$query2 = "Update friends set status = 'ACCEPTED' where user_id = ".$friend." and friend_id = ".$user.";";
							$result = mysqli_query($link,$query2);
							echo '<h3>'.$friendname.' has been added to your friends list.</h3><br/><br/>';
							echo '<a href="your_friends.php">Check your friend list</a>';
							$query3 = "Insert into activity(name,user_id) values ('Friend Accepted',".$user.");";
							$result = mysqli_query($link,$query3);								
						}else
						{
							echo '<h3>There was an error accepting friend request from '.$friendname.'</h3><br/><br/>';
							echo '<a href="notifications.php">Check notifications</a>&nbsp;&nbsp;&nbsp;<a href="your_friends.php">Check your friend list</a>';						
						}
					}
				}	
			}
				?>
			</div>
		   </div>
		 </div>
<?php include 'home_footer.php'; ?>