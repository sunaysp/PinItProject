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
		}?>
<ul class="nav nav-pills" style="height:100px;">
  <li class="active">
  <a href="search.php?key=<?=$key?>">Pins</a></li>
  <li><a href="searchboards.php?key=<?=$key?>">Boards</a></li>
</ul>
 <script type="text/javascript" src="../js/tinybox.js"></script>
	<div>		
	<?php

		if(isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')){
		
			$sql= "SELECT * FROM pin WHERE pin_id IN (SELECT pin_id FROM tagpin JOIN tags ON tagpin.tag_id = tags.tag_id
			WHERE tag_name LIKE '%%".$key."%%' ORDER BY created_date DESC)";
		
		}
		?>
		<h3>Pins associated with your search key - <?=$key?> </h3>
		
		 
		<?php

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
		$source= "search.php?key=".$key;	
		$board_name = "";	
		$img_result=mysqli_fetch_row($img_query);
		$img_path=$img_result[1];
		echo "<div style='margin-bottom:5px;'><img src='../images/$img_path' class='pin_image' /></div>";?>
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
								<input type="hidden" name="source" value='.$source.'></input>
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
						
							
							echo '</td></tr></table></div>';
		echo"</div>";//description div ends
	}
	else
	{
		echo "<div><b>$message</b></div></div>";
	}
	echo "</div>";
	

?>

		<div id="commentload<?php echo $pid;?>">

		<?php include("show_comments.php"); ?>

		</div>

		<div class='commentpost' style='display:none;' id='commentbox<?php echo $pid;?>'>
		<div class='commentbox_area'>
		<form method="post" action="">
		<textarea name="comment" class="comment" maxlength="200"  id="ctextarea<?php echo $pid;?>" placeholder="Add a comment..." maxlength='200'></textarea>
		<br/>
		<input type="submit"  value=" Comment "  id="<?php echo $pid;?>" class="comment_button"/>
		</form>
		</div>
		</div>

		<?php
		echo "</div>";
		}

		?>

	 </div>

 <?php include 'home_footer.php'; ?>