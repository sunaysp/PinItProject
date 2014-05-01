<?php include('home_header.php');?>
        <div class="col-md-9" role="main">		
		  <div id="container">
			<div id="main" role="main">		
			<table>
			<h1>Add a Stream</h1>
			<?php include 'connection.php'; ?>

			<form name="stream" action="validateaddstream.php" method="post" onsubmit="return validateForm()" method="post">
				<table width="510" border="0" align="center">					
					<tr>
						<td>Stream Name:<span class="mandatory">*</span></td>
						<td><input type="text" name="streamname" maxlength="20" /></td>
					</tr>

					<tr>
						<td>Boards: </td>
						<td>
              
						
						<?php
						$query = "SELECT B.name as boardname, B.board_id as board_id FROM follows A INNER JOIN board B ON A.board_id=B.board_id WHERE A.user_id='".$_SESSION['sess_user_id']."';";
           
						$result = mysqli_query($link,$query);
						while($row = mysqli_fetch_array($result))
						  {
							?>
						 <!-- echo '<option value=\"'.$row['category_id'].'\">'. $row['category'].'</option>' -->
             <input type="checkbox" name="board_id[]" value="<?=$row['board_id']?>"> <?=$row['boardname']?> </input>
						 
						<?php	} ?>
						</td>
					</tr>
                <form class="form-search form-inline">
                  <input type="text" class="search-query" placeholder="Search..." />
              </form>
					<tr>
						<td></td>
						<td><button type="submit" class="btn">Submit</button>
						<button type="submit" value="cancel" class="btn">Cancel</button></td>
					</tr>
				</table>
			</form>

			</div>
		   </div>
		 </div>
<?php include('home_footer.php');?>