<?php include 'home_header.php'; ?>
	<!-- Global CSS for the page and tiles -->
<link rel="stylesheet" href="../css/main.css">
<!-- CSS Reset -->
<link rel="stylesheet" href="../css/reset.css">
<script>
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
<script src="jqBootstrapValidation.js"></script>
<script>
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
	<script>
	 $('#addboard').modal('show');
	</script>
	<div class="col-md-9" role="main">		
	  <div id="container">
		<header>
		  <h1>Your Boards</h1>
		</header>
		<div id="main" role="main">
		  <ul class="example-tiles">
		 <!-- <li><a href="addboard.php">Add board</a></li> -->
		  <li><a href="#addboard" role="button" class="btn" data-toggle="modal">Add board</a></li>

			<?php
			$query = "SELECT `name`,board_id FROM board WHERE user_id=".$_SESSION['sess_user_id'].";";
				$result = mysqli_query($link,$query);
				while($row = mysqli_fetch_array($result))
				  {
					echo '<li><a href="addpins.php?board_id='.$row['board_id'].'&board_name='.$row['name'].'">'.$row['name'].'</a></li>';
				}
			?>
		  </ul>
		</div>
		</div>

	 </div>

  
	<!-- Modal -->
<div class="modal fade" id="addboard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create Board</h4>
      </div>
	  <form name="board" class="form-horizontal" action="validateaddboard.php" method="post" onsubmit="return validateForm()" role="form">
	  <div class="control-group">
	  <div class="controls">
      <div class="modal-body">
        		<table width="510" border="0" align="center">					
					<tr>
						  <div class="form-group">
						<td><label class="control-label" for="boardname">Board Name:<span class="mandatory">*</span></label></td>
						<td><input type="text" name="boardname" id="boardname" class="form-control" placeholder="Enter name" maxlength="30" required /></td>
						<p class="help-block"></p>
						</div>
					</tr>
					<tr>
						<td><label class="control-label">Category:</label></td>
						<td>
						<select class="form-control" name="category">
						<option value="">Select Category</option>
						<?php
						$query = "SELECT `category_id`,`category` FROM `category`;";
						$result = mysqli_query($link,$query);
						while($row = mysqli_fetch_array($result))
						  {
							?>
						 <!-- echo '<option value=\"'.$row['category_id'].'\">'. $row['category'].'</option>' -->
						 <option value="<?=$row['category_id']?>"><?=$row['category']?></option>
						<?php	} ?>
						</select></td>
					</tr>
					<tr>
						<td><label class="control-label">Description:</label></td>
						<td><textarea name="description" id="txtArea" class="form-control" rows="3" cols="25"></textarea> </td>
					</tr>
					<tr>
						<td><label class="control-label">Visibility:</label></td>
						<td>
						<select name="visibility" class="form-control">
						<option value="public">Public</option>
						<option value="secret">Secret</option>
						</td>
					</tr>
					
				</table>
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" value="submit" class="btn btn-primary">Save changes</button>
      </div>
	  </div>
	  </div>
	  </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include 'home_footer.php'; ?>
