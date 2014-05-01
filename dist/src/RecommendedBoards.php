 <?php include 'home_header.php'; ?>

<link rel="stylesheet" href="../css/style2.css" />
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="../js/pinterest.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>

<ul class="nav nav-pills" style="height:100px;">
  <li>
  <a href="recommendation.php">Pins</a></li>
  <li class="active"><a href="recommendedBoards.php">Boards</a></li>
</ul>
<h3>Boards that you might want to follow</h3>
<div id="main" role="main">
		  <ul class="example-tiles">
		 
		  <?php	
		  $user =$_SESSION['sess_user_id'];
			$key = '';
			$query2 = "SELECT DISTINCT(b.board_id),b.name ,b.user_id AS owner_id FROM board b 
			WHERE category_id IN(SELECT DISTINCT category_id FROM board WHERE user_id ='".$user."'
			UNION SELECT DISTINCT category_id FROM board WHERE board_id IN 
		  (SELECT board_id FROM follows WHERE user_id = '".$user."' AND visibility = 'Public'))
		   AND b.board_id NOT IN (SELECT board_id FROM board WHERE user_id ='".$user."'
		   UNION SELECT board_id FROM follows WHERE user_id='".$user."') AND b.`visibility`='Public'";
			
		
			$result = mysqli_query($link,$query2);			
			while($row = mysqli_fetch_array($result))
			{
				echo '<li><form name="followboard" method="post" action="follow_board.php">
				<a href="getpins.php?board_id='.$row["board_id"].'&board_name='.$row['name'].'">'.$row['name'].'</a><br/><div align="center">
				<input type="hidden" name="board_id" value='.$row['board_id'].'></input>
				<input type="hidden" name="friend_id" value='.$row['owner_id'].'></input>		
				<input type="hidden" name="user_action" value="follow"></input>	
				<input type="hidden" name="source" value="your_follow_boards.php"></input>';		
				echo'<input type="submit" class="btn btn-info btn-sm" value="Follow"></div></form>';					
			}					
			?>
		  </ul>
		</div>

 <?php include 'home_footer.php'; ?>