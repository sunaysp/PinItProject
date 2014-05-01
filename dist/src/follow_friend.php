<?php
 include 'connection.php';
//Start session
session_start();
 
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
	header("location: login.html");
	exit();
}

$friend=$_POST['friend_id'];
$action=$_POST['action'];
$source=$_POST['source'];
			if($action == 'follow')
			{
	
					$query3 = " SELECT board_id FROM board WHERE board_id NOT IN (SELECT board_id FROM follows WHERE user_id = '".$_SESSION['sess_user_id']."') AND user_id = '".$friend."' and visibility = 'Public';";				
					$result = mysqli_query($link,$query3);
				
					while($row = mysqli_fetch_array($result))
					{
						$query="INSERT INTO follows(board_id, user_id) values('".$row['board_id']."', '".$_SESSION['sess_user_id']."');";
						$result2 = mysqli_query($link, $query);
					}
			}else
			{

				$query1="Delete from follows where  user_id='".$_SESSION['sess_user_id']."' and board_id in (select board_id from board where user_id = '".$friend."');";
				$result3 = mysqli_query($link, $query1);
			}				

mysqli_close($link);
header('Location: '.$source.'?friend_id='.$friend.'');
?>