<?php
 include 'connection.php';
//Start session
session_start();
 
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
	header("location: login.html");
	exit();
}

$parent_pin=$_POST['pin_id'];
$pic=$_POST['pic_id'];
$desc=$_POST['desc'];
$board_id=$_POST['board'];
$board_name=$_POST['board_name'];
$user_id=$_SESSION['sess_user_id'];


$query='INSERT INTO pin(`board_id`, `pic_id`, `parent_id`, `description`)VALUES( '.$board_id.', '.$pic.', '.$parent_pin.', "'.$desc.'");';

mysqli_query($link, $query); 
mysqli_close($link);
header('Location: yourpins.php');


?>