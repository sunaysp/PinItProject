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

$pin_total = mysqli_query($link,"SELECT * from pin where board_id=".$board_id."");
$pin_count= mysqli_num_rows($pin_total);
// echo $board_id.'<br>';
// echo "SELECT * from pin where board_id=".$board_id."";
?>
<div id="container" class="clearfix">
 
<?php

$sql="select * from pin where board_id=".$board_id." order by pin_id DESC";

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
<input type="submit"  value=" Comment "  id="<?php echo $pid;?>" class="comment_button"/>
</form>
</div>
</div>

<?php
echo "</div>";
}

?>

</div> <!-- #container -->

/* <?php
// if($pin_count>10)
// {
// echo "<div id='more$pid' class='morebox'>";
// echo "<a href='#' class='more' id='$pid'>Load More Pins</a>";
// echo "</div>";
// }
 
 ?> */