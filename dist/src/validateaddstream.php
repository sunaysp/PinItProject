<?php
 include 'connection.php';
//Start session
session_start();
 
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
	header("location: login.html");
	exit();
}

$streamname=$_POST['streamname'];


$user_id=$_SESSION['sess_user_id'];


$query="INSERT INTO stream(stream_name,user_id) VALUES('$streamname',$user_id);";
echo $query;
if(mysqli_query($link, $query)) {

	$query1="select * from stream order by stream_id desc limit 1";
	$result = mysqli_query($link, $query1);
	$row = mysqli_fetch_array($result);

	if(!empty($_POST['board_id'])) {
	    foreach($_POST['board_id'] as $id) {
	            $query2="INSERT INTO `followstream`(`stream_id`,`board_id`) VALUES($row[0],$id)";
	            echo $query2;
				mysqli_query($link,$query2);
	 
	    }
	}
}


mysqli_close($link);
header('Location: Streams.php');
?>