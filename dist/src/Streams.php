<?php
include('home_header.php');	?>
	<div class="col-md-9" role="main">		
	  <div id="container">
		<header>
		  <h1>Your Streams</h1>
		  
		</header>
		<div id="main" role="main">
		  <ul class="example-tiles">
		   <li><a href="#addstreams" role="button" class="btn" data-toggle="modal">Add Stream</a></li>
			<?php
			$query = "SELECT stream_name,stream_id FROM stream WHERE user_id=".$_SESSION['sess_user_id'].";";
				$result = mysqli_query($link,$query);
				while($row = mysqli_fetch_array($result))
				  {
					echo '<li><a href="showpins.php?stream_id='.$row['stream_id'].'&stream_name='.$row['stream_name'].'">'.$row['stream_name'].'</a></li>';
				}
			?>
		  </ul>
		</div>
		</div>

	 </div>

  </div>
    </div>
	
<div class="modal fade" id="addstreams" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create Stream</h4>
      </div>
	 <form name="stream" action="validateaddstream.php" method="post" onsubmit="return validateForm()" method="post">
				
      <div class="modal-body">
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
                
				</table>
			
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" value="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

	<?php include('home_footer.php');?>