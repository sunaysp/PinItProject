<?php
// if(isset($lastid))
// {
// $lastid=$lastid;
// $loadmore="and pid<'$lastid'";
// }
// else
// {
// $lastid=0;
// $loadmore='';
// }


$sql="SELECT C.* FROM stream A
INNER JOIN followstream B ON A.`stream_id`=B.`stream_id`
INNER JOIN pin C ON B.board_id=C.board_id
WHERE A.stream_id=".$stream_id;


?>
<div id="container" class="clearfix">
 
<?php


$result=mysqli_query($link,$sql);

while($row=mysqli_fetch_row($result))
{
$pid=$row[0];
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

