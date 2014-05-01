<?php include 'home_header.php'; ?>
<!-- Global CSS for the page and tiles -->
<link rel="stylesheet" href="../css/main.css">
<!-- CSS Reset -->
<link rel="stylesheet" href="../css/reset.css">
        <div class="col-md-9" role="main">		
		  <div id="container">    
			<div id="main" role="main">
			
			 <?php
				$query = "SELECT u.user_id, u.username, u.firstname, u.lastname, u.location, u.profile_pic from user u
				WHERE u.user_id IN (SELECT f.user_id FROM friends f WHERE f.status = 'SENT' AND f.friend_id = ".$_SESSION['sess_user_id'].");";
			
					$result = mysqli_query($link,$query);
					if($result && $row = mysqli_num_rows($result))
					{		
						$path='../profile/';					
						echo '<ui style="list-style-type:none;">';
							while($row = mysqli_fetch_array($result))
							{						
								echo '<li><form name="friendship" method="post" action="add_friend.php">
										<img src='.$path.$row['profile_pic'].' width="200" height="240"><br/>
										<div align="left"><b>'.$row['firstname'].'&nbsp'.$row['lastname'].'<br/>'.$row['location'].'</b></br>
										<input type="hidden" name="user_id" value='.$row['user_id'].'></input>';
										$friendname = $row['firstname'].$row['lastname'];
										echo '<a href="add_friend.php?status=confirm&user_id='.$row['user_id'].'&friend_id='.$_SESSION['sess_user_id'].' &friendname='.$friendname.'"  class="btn">Confirm Request</a><br/>
										<a href="add_friend.php?status=cancel&user_id='.$row['user_id'].'&friend_id='.$_SESSION['sess_user_id'].' &friendname='.$friendname.'"  class="btn">Cancel Request</a><br/>
										</div></form>';
								"</img></a></li>";
								echo '<script type="text/javascript">
										function submitform()
										{
										  document.friendship.submit();
										}
										</script>';		
							}				
					echo '</ui>';						
					}
					else{
							echo '<h3>You have no pending requests!</h3><br/><br/>';
						}
				?>				
			</div>
		</div>
		 </div>
<?php include 'home_footer.php'; ?>