<?php include 'home_header.php'; ?>	
<!-- Global CSS for the page and tiles -->
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/tiny.css" />
<!-- CSS Reset -->
<link rel="stylesheet" href="../css/reset.css">
<script type="text/javascript" src="../js/tinybox.js"></script>
<div class="col-md-9" role="main">		
  <div id="container">
	<div id="main" role="main">
		<?php
			$sql="SELECT C.* FROM `pin` C	INNER JOIN `board` B ON C.`board_id`=B.`board_id` order by C.pin_id DESC";
			$result=mysqli_query($link,$sql);
			while($row=mysqli_fetch_row($result))
			{
				$pid=$row[0];
				$parent=$row[5];
				if($parent == 0)
				{				 
				 $parent = $pid;
				}
				$message=$row[6];
				echo "<div class='box col2' id='box$pid'>";
				echo "<div class='pin_holder'>";
				echo "<div class='data'>";
				$pic_id=$row[2];
				if($pic_id!=0)
				{
					$img_query=mysqli_query($link,"Select * from picture where pic_id=$pic_id");
					$source= "home.php";				
					$img_result=mysqli_fetch_row($img_query);
					echo '<ui style="list-style-type:none;" id="tiles" align="center">';
							$board_name = "";				
							$url = "../images/".$img_result[1];	
							echo '<li><img src="'.$url.'" width="200" height="283">'?>
							<div><b><?=$message?></b></div><div style="text-align: left">
							<table>
							<tr>
							<td>								
							<div class='btn btn-info btn-sm' onclick="TINY.box.show({url:'repin.php?pin_id=<?=$parent?>&pic_id=<?=$pic_id?>&desc=<?=$message?>&source=<?=$source?>&board_name=<?=$board_name ?>',width:800,height:200, opacity:20})">Repin
							</div></td>
							<td>
							<?php
							//likes start
								$query3 = "SELECT pic_id FROM likes WHERE user_id=".$_SESSION['sess_user_id'].";";			
								$result3 = mysqli_query($link,$query3);			
								$picIds=array();								
								while($rw=mysqli_fetch_array($result3)) {
									array_push($picIds,$rw[0]);									
								}		
								
								$board_id = 0;	
								$query4 = "SELECT COUNT(`user_id`) AS likes FROM likes WHERE pic_id='".$pic_id."';";
								$result4=mysqli_query($link,$query4);				
								$row4 = mysqli_fetch_array($result4);															
								$likes = $row4[0];
						
								echo'<form name="likepic" method="post" action="like_pic.php">						
								<input type="hidden" name="pic_id" value='.$pic_id.'></input>
								<input type="hidden" name="source" value="home.php"></input>
								<input type="hidden" name="board_id" value='.$board_id.'></input>
								<input type="hidden" name="board_name" value='.$board_name.'></input>';
															
								if($picIds && in_array($pic_id, $picIds))
								{								
									echo'<input type="hidden" name="user_action" value="unlike"/></input>
									<input type="submit" class="btn btn-info btn-sm" value="Unlike">
									<span class="badge badge-warning">'.$likes.'</span>
									</input></div></form>';		
								}else
								{
								echo'<input type="hidden" name="user_action" value="like"></input>
									<input type="submit" class="btn btn-info btn-sm" value="like">
									<span class="badge badge-warning">'.$likes.'</span></input></div></form>';														
								}
								
							//likes end
							?>
							
							</td></tr></table></div>
							
							
							<?php echo'</li>';			
						 
						 echo '</ui>';
				}
				echo "</div></div></div>";
			}
		?>
	</div>
   </div>
 </div>
<?php include 'home_footer.php'; ?>