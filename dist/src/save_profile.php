<?php
//Start session
include('connection.php');
session_start();
 
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
	header("location: login.html");
	exit();
}

function saveImg($_FILE,$profile_name){
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["ppic"]["name"]);
        $extension = end($temp);
        if ((($_FILES["ppic"]["type"] == "image/gif")
                || ($_FILES["ppic"]["type"] == "image/jpeg")
                || ($_FILES["ppic"]["type"] == "image/jpg")
                || ($_FILES["ppic"]["type"] == "image/pjpeg")
                || ($_FILES["ppic"]["type"] == "image/x-png")
                || ($_FILES["ppic"]["type"] == "image/png"))
                && in_array($extension, $allowedExts))
        	{
                if ($_FILES["ppic"]["error"] > 0)
                {
                        echo "Error: " . $_FILES["ppic"]["error"] . "<br>";
			exit;
                }
                else
                {
                       
                        move_uploaded_file($_FILES["ppic"]["tmp_name"],"../profile/".$profile_name.".".$extension);
                        return "../profile/".$profile_name.".".$extension;
                        //}


                }
        }
        else
        {
                echo "Invalid file";
        }
}

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$location = $_POST['location'];
$email = $_POST['email'];

$conn = mysqli_connect('localhost','root','BAgowan13sql','pinit'); 
 
//sanitize user-name
$temp = explode(".", $_FILES["ppic"]["name"]);
$extension = end($temp);
$profile_pic=$_SESSION['sess_username'].".".$extension;

$query = 'update user set firstname = "'.$fname.'", lastname = "'.$lname.'", location = "'.$location.'", email = "'.$email.'", profile_pic = "'.$profile_pic.'"
		where user_id='.$_SESSION['sess_user_id'].';';
	

//added $conn variable in order to connect to our database.
$result = mysqli_query($conn, $query);

	$picturePath=saveImg($_FILES,$_SESSION['sess_username']);
	echo $picturePath;

mysqli_close($conn);
 

header('Location: home.php');
?>