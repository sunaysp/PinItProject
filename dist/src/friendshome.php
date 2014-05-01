<?php include 'home_header.php'; ?>
        <div class="col-md-9" role="main">		
		  <div id="container">
			<div id="main" role="main">				
				<?php
					$friend = $_GET['friend_id'];
					$query = "SELECT u.user_id, u.username, u.firstname, u.lastname, u.location, u.profile_pic FROM user u where u.user_id=".$friend.";";
					$result=mysqli_query($link,$query);				
					$row = mysqli_fetch_array($result);
					$friend = $row['user_id'];						
					echo "<div align='center'>";
					$path='../profile/';
					echo "<a href='friendshome.php?friend_id=".$friend."'><img src=".$path.$row['profile_pic']." width='180' height='200'></img></a><br/><h3>".$row['firstname']."&nbsp;".$row['lastname']."</h3>";
					echo "<h4>".$row['location']."</h4>";
					$sql = "SELECT board_id FROM board WHERE board_id NOT IN (SELECT board_id FROM follows WHERE user_id = '".$_SESSION['sess_user_id']."') AND user_id ='".$friend."'  and visibility = 'Public'";				
					$r=mysqli_query($link,$sql);				
					$rw = mysqli_num_rows($r);
					$src = "friendshome.php?friend_id=".$friend;
					echo '<form name="followfriend" method="post" action="follow_friend.php">
					<input type="hidden" name="friend_id" value='.$friend.'>
					<input type="hidden" name="source" value ='.$src.'>';
					if($rw != 0)
					{					
						echo '<input type="hidden" name="action" value="follow"><input type="submit" class="btn btn-info btn-sm" value="Follow '.$row['firstname'].'"></input>';}
					else
					{
						echo '<input type="hidden" name="action" value="unfollow"><input type="submit" class="btn btn-info btn-sm" value="Unfollow '.$row['firstname'].'"></input>';
					}
					echo"<hr noshade size=3>";
					echo "</div>";					
					echo "<header><h1>".$row['firstname']."'s Boards</h1></header>";					
					echo "<div id='main' role='main'><ul class='example-tiles'>";
					
					$query2 = "SELECT board_id FROM follows WHERE user_id=".$_SESSION['sess_user_id'].";";				
					$result = mysqli_query($link,$query2);					
					$boardIds=array();
					
					while($rw=mysqli_fetch_array($result)) {
						array_push($boardIds,$rw[0]);
					}
					
					$query3 = "SELECT `name`,board_id FROM board WHERE user_id=".$friend." and visibility = 'Public';";				
					$result = mysqli_query($link,$query3);
				
					while($row = mysqli_fetch_array($result))
					{
						$board = $row['board_id'];	
						echo '<li><form name="followboard" method="post" action="follow_board.php">
						<a href="board_pins.php?board_id='.$board.'&board_name='.$row['name'].'">'.$row['name'].'</a><br/><div align="center">
						<input type="hidden" name="board_id" value='.$row['board_id'].'></input>
						<input type="hidden" name="friend_id" value='.$friend.'></input>
						<input type="hidden" name="source" value="friendshome.php"></input>';
											
						if($boardIds && in_array($board, $boardIds))
						{								
							echo'<input type="hidden" name="user_action" value="unfollow"></input><input type="submit" class="btn btn-info btn-sm" value="Unfollow"></div></form>';		
						}else
						{
							echo'<input type="hidden" name="user_action" value="follow"></input><input type="submit" class="btn btn-info btn-sm" value="Follow"></div></form>';						
						}
					}							
				echo "</ul></div>";
				?>
			</div>
		   </div>
		 </div>
<?php include 'home_footer.php'; ?>