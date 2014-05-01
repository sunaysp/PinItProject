<?php

if(isset($board_id)){

$sql="select * from pin where board_id=".$board_id." order by pin_id DESC";
}
else if(isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')){
$sql="SELECT C.* FROM `board` B
INNER JOIN `pin` C ON C.`board_id`=B.`board_id`
WHERE B.`user_id`=".$_SESSION['sess_user_id']."
order by C.pin_id DESC";

}
$pin_total = mysqli_query($link,$sql);
$pin_count= mysqli_num_rows($pin_total);

?>
<div id="container" class="clearfix">
 <h2> Your Pins</h2>
<?php


$result=mysqli_query($link,$sql);

while($row=mysqli_fetch_row($result))
{
$pid=$row[0];
$parent_id=$row[5];
$message=$row[6];
echo "<div class='box col2' id='box$pid'>";
echo "<div class='pin_holder'>";
echo "<div class='data'>";
$pic_id=$row[2];
if($pic_id!=0)
{
$img_query=mysqli_query($link,"Select * from picture where pic_id=$pic_id");

$img_result=mysqli_fetch_row($img_query);
$img_path=$img_result[1];
echo "<a href='delete_pins2.php?pin_id=$pid&pic_id=$pic_id&parent_id=$parent_id'><img src='../images/trash2.png' width='14' height='14'/></a>";

echo "<div style='margin-bottom:5px;'><img src='../images/$img_path' class='pin_image' /></div>";
echo "<div>$message</div></div>";
}
else
{
echo "<div><b>$message</b></div></div>";
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
<input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['sess_user_id'] ?>"/>
<input type="submit"  value=" Comment "  id="<?php echo $pid;?>" class="comment_button"/>
</form>
</div>
</div>

<?php
echo "</div>";
}

?>

</div> <!-- #container -->

