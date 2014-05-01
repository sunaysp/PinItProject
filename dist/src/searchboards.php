 <?php include 'home_header.php'; ?>

<link rel="stylesheet" href="../css/style2.css" />
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="../js/pinterest.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>
<?php
		if (isset($_POST["key"])) {
			$key =  $_POST["key"];
		}else{  
			$key = $_GET["key"];
		}
?>
<ul class="nav nav-pills" style="height:100px;">
  <li>
  <a href="search.php?key=<?=$key?>">Pins</a></li>
  <li class="active"><a href="searchboards.php?key=<?=$key?>">Boards</a></li>
</ul>
<h3>Boards associated with category of your search key - <?=$key?></h3>
<div id="main" role="main">
		  <ul class="example-tiles">
		 
		  <?php	
			$query1 = "SELECT board_id FROM follows WHERE user_id=".$_SESSION['sess_user_id'].";";				
					$result1 = mysqli_query($link,$query1);					
					$boardIds=array();
					
					while($rw=mysqli_fetch_array($result1)) {
						array_push($boardIds,$rw[0]);
					}
					
			$query2 = 'SELECT b.name, b.board_id, b.user_id AS owner_id FROM board b where category_id in (select category_id from category where category like "%%'.$key.'%%" )';

			$result = mysqli_query($link,$query2);			
			while($row = mysqli_fetch_array($result))
			{
				echo '<li><form name="followboard" method="post" action="follow_board.php">
				<a href="getpins.php?board_id='.$row["board_id"].'&board_name='.$row['name'].'">'.$row['name'].'</a><br/><div align="center">
				<input type="hidden" name="board_id" value='.$row['board_id'].'></input>
				<input type="hidden" name="friend_id" value='.$row['owner_id'].'></input>		
				<input type="hidden" name="source" value="searchboards.php?key='.$key.'"></input>';		
				if($boardIds && in_array($row['board_id'], $boardIds))
						{								
							echo'<input type="hidden" name="user_action" value="unfollow"></input><input type="image" src="../images/unfollow.png" name="image" width="80" height="25"></div></form>';		
						}else
						{
							echo'<input type="hidden" name="user_action" value="follow"></input><input type="image" src="../images/Follow.png" name="image" width="70" height="25"></div></form>';						
						}					
			}					
			?>
		  </ul>
		</div>

 <?php include 'home_footer.php'; ?>