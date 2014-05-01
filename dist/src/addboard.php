<?php include 'home_header.php'; ?>
        <div class="col-md-9" role="main">		
		  <div id="container">
			<div id="main" role="main">		
			<table>
			<h1>Add a board</h1>
			<?php include 'connection.php'; ?>

			<form name="board" action="validateaddboard.php" method="post" onsubmit="return validateForm()" method="post">
				<table width="510" border="0" align="center">					
					<tr>
						<td>Board Name:<span class="mandatory">*</span></td>
						<td><input type="text" name="boardname" maxlength="20" /></td>
					</tr>
					<tr>
						<td>Category:</td>
						<td>
						<select name="category">
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
						<td>Description:</td>
						<td><textarea name="description" id="txtArea" rows="3" cols="25"></textarea> </td>
					</tr>
					<tr>
						<td>Visibility:</td>
						<td>
						<select name="visibility">
						<option value="public">Public</option>
						<option value="secret">Secret</option>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="submit"/>
						<input type="submit" name="cancel" value="cancel"/></td>
					</tr>
				</table>
			</form>
			</div>
<?php include 'home_footer.php'; ?>