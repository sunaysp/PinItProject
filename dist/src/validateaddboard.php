<?php
 include 'connection.php';
//Start session
session_start();
 
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
	header("location: login.html");
	exit();
}

$boardname=$_POST['boardname'];
$category=$_POST['category'];
$description=$_POST['description'];
$visibility=$_POST['visibility'];
$user_id=$_SESSION['sess_user_id'];

$query="INSERT INTO board(name, user_id, category_id, description, visibility) values
('$boardname', '$user_id','$category','$description','$visibility');";
 
mysqli_query($link, $query);
 
mysqli_close($link);
header('Location: boards.php');
?>