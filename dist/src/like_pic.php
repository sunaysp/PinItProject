<?php
 include 'connection.php';
//Start session
session_start();
 
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
	header("location: login.html");
	exit();
}

$pic=$_POST['pic_id'];
$board=$_POST['board_id'];
$name=$_POST['board_name'];
$action=$_POST['user_action'];
$source=$_POST['source'];
if($action == 'like')
{
	$query="INSERT INTO likes(pic_id, user_id) values('".$pic."', '".$_SESSION['sess_user_id']."');";
	$result = mysqli_query($link, $query);
}
else
{
	$query="Delete from likes where pic_id='".$pic."' and user_id='".$_SESSION['sess_user_id']."';";
	$result = mysqli_query($link, $query);
}
mysqli_close($link);
if($board == 0)
{
header('Location: '.$source.'');
}else
{
header('Location: '.$source.'?board_id='.$board.'&board_name='.$name.'');
}?>