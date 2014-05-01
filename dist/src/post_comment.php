<?php
include("connection.php");

if($_POST)
{

$comment=$_POST['comment'];
$path ="../profile/";
$pid=$_POST['pid'];
$user_id=$_POST['user_id'];
echo $user_id;
$query = "INSERT INTO comment(comment,pin_id,user_id) VALUES ('$comment','$pid',$user_id)";
$result=mysqli_query($link,$query);

$query = "select CONCAT(firstname,' ',lastname) AS usr, profile_pic AS profile_pic from `user` where user_id=$user_id";

$result=mysqli_query($link,$query);
$cdata=mysqli_fetch_row($result);

echo "<div class='comment_area'>";
echo "<div class='comment_user'><img src='".$path.$cdata[1]."' /></div>";
echo "<div class='commentbody'><a href='#'><b>".$cdata[0]."</b></a> $comment</div></div>";


}

?>