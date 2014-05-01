<?php
//Start session
session_start();
 
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
	header("location: login.html");
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- CSS Reset -->
  <link rel="stylesheet" href="../css/reset.css">

  <!-- Global CSS for the page and tiles -->
  <link rel="stylesheet" href="../css/main.css">
<!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- Documentation extras -->
<link href="../docs-assets/css/docs.css" rel="stylesheet">
<link href="../docs-assets/css/pygments-manni.css" rel="stylesheet">
<title>Home Page</title>
<style>
	.mandatory { color: red; }
</style>
<script>
function validateForm()
{
var x=document.forms["board"]["boardname"].value;
if (x==null || x=="" || y==null || y=="")
  {
  alert("Board name cannot be empty");
  return false;
  }
}
</script>
</head>
 
<body>
<h1>Welcome, <?php echo $_SESSION["sess_username"] ?></h1>
<?php include 'connection.php'; ?>

			
<form name="board" action="validateaddboard.php" method="post" onsubmit="return validateForm()" method="post">
	<table width="510" border="0" align="center">
		<tr>
			<td colspan="2"><p><strong>Add Board</strong></p></td>
		</tr>
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
</body>
</html>