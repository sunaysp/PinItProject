<?php
 include 'connection.php';
//Start session
session_start();
 
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
	header("location: login.html");
	exit();
}

$board=$_POST['board_id'];
$friend=$_POST['friend_id'];
$action=$_POST['user_action'];
$source=$_POST['source'];
if($action == 'follow')
{
	$query="INSERT INTO follows(board_id, user_id) values('".$board."', '".$_SESSION['sess_user_id']."');";
	$result = mysqli_query($link, $query);
}
else
{
	$query="Delete from follows where board_id='".$board."' and user_id='".$_SESSION['sess_user_id']."';";
	$result = mysqli_query($link, $query);
}
mysqli_close($link);
header('Location: '.$source.'?friend_id='.$friend.'');
?>