<?php 
include 'connection.php';
session_start();  
?>

<div align="center" title="Repin it!">
  <p> 
   <form name="repinpic" method="post" action="repinpic.php" onsubmit="return repin()">
				  <div>						
						<table width="510" border="0" align="center">					
						<tr>
						<h2><b> Select a board to repin this picture</b></h2>
						</tr>
						<tr><td><input type="hidden" name="pic_id" value='<?=$_GET['pic_id']?>'></input>
								<input type="hidden" name="pin_id" value='<?=$_GET['pin_id']?>'></input>
								<input type="hidden" name="desc" value='<?=$_GET['desc']?>'></input>
								<input type="hidden" name="source" value='<?=$_GET['source']?>'></input>
								<input type="hidden" name="board_name" value='<?=$_GET['board_name']?>'></input>
						</td></tr>
						<tr align="center">
							
							<td valign="middle" align="center">
							
								
							<select name="board">
							<option value=""><h3>Select Board</h3></option>';						
							<?php
							$query2 = "SELECT `board_id`,`name` FROM `board` where user_id=".$_SESSION['sess_user_id'].";";
							$result2 = mysqli_query($link,$query2);
							while($row2 = mysqli_fetch_array($result2))
						  {	
						  
							echo "<option value=".$row2['board_id']."><h3>".$row2['name']."</h3></option>";	
							
						  } ?>
							</select></td>
					</tr>					
					</table>			
				  </div></br>
			  <div>
				 <a href="javascript:TINY.box.hide()" class="btn">Cancel</a>
				<button type="submit" value="submit" class="btn btn-primary">Repin</button>
			  </div>
			  </form>
  </p>
</div>
 
