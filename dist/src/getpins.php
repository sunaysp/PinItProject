<?php
include 'home_header.php'; 
$board_name=$_GET['board_name'];
$board_id=$_GET['board_id'];

?>
 <div class="col-md-9" role="main">		
		  <div id="container">    
			<div id="main" role="main">
<link rel="stylesheet" href="../css/style2.css" />
<script type="text/javascript" >
 $(document).ready(function() { 
		
            $('#photoimg').live('change', function()			{ 
			           $("#preview").html('');
				$("#current").hide();
			    $("#preview").html('<img src="css/ajax-loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
		
		});
        }); 
</script>

<h2 align="center"><b> <?=$board_name?></b></h2>
<?php

if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
	header("location: login.html");
	exit();
	}
	$board_id = $_GET['board_id'];
	$sql="SELECT C.* FROM `board` B
	INNER JOIN `pin` C ON C.`board_id`=B.`board_id`
	WHERE b.board_id = ".$board_id."
	order by C.pin_id DESC";
	
?>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="../js/pinterest.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>


<?php
$result=mysqli_query($link,$sql);
while($row=mysqli_fetch_row($result))
{
	$pid=$row[0];
	$desc=$row[6];

	echo "<div class='box col2' id='box$pid'>";
	echo "<div class='pin_holder'>";
	echo "<div class='data'>";
	$pic_id=$row[2];
	if($pic_id!=0)
	{
		$img_query=mysqli_query($link,"Select * from picture where pic_id=$pic_id");
		$img_result=mysqli_fetch_row($img_query);
		$img_path=$img_result[1];
		echo "<div style='margin-bottom:5px;'><img src='../images/".$img_path."' class='pin_image' /></div>";
		echo "<div>$desc</div></div>";
	}
	else
	{
		echo "<div><b>$desc</b></div></div>";
	}
	echo "</div>";
	echo "<div style='margin-left:10px;'><a href='#' class='commentopen' id='$pid'><small>Comment</small></a></div>";

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
	echo "</div></div></div>";
}

include 'home_footer.php'; 
?>
