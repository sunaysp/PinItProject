<?php include 'home_header.php'; ?>
	  <div id="container">
		<header>
		  <h1>You are following</h1>		
		</header>
		<div id="main" role="main">
		  <ul class="example-tiles">
		 
		  <?php	
			
			$query2 = "SELECT b.name, f.board_id, b.user_id AS owner_id FROM follows f JOIN board b ON f.board_id = b.board_id WHERE f.user_id =".$_SESSION['sess_user_id'].";";				
			$result = mysqli_query($link,$query2);			
			while($row = mysqli_fetch_array($result))
			{
				echo '<li><form name="followboard" method="post" action="follow_board.php">
				<a href="getpins.php?board_id='.$row["board_id"].'&board_name='.$row['name'].'">'.$row['name'].'</a><br/><div align="center">
				<input type="hidden" name="board_id" value='.$row['board_id'].'></input>
				<input type="hidden" name="friend_id" value='.$row['owner_id'].'></input>		
				<input type="hidden" name="user_action" value="unfollow"></input>	
				<input type="hidden" name="source" value="your_follow_boards.php"></input>';		
				echo'<input type="submit" class="btn btn-info btn-sm" value="Unfollow"></div></form>';					
			}					
			?>
		  </ul>
		</div>
		</div>
<?php include 'home_footer.php'; ?>