<?php
ob_start();
include ("connection.php");
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT user_id, username, password,concat(firstname,' ', lastname) as fullname, salt, profile_pic FROM user
        WHERE username = '$username';";
$result = mysqli_query($link,$query);
 
if(mysql_num_rows($result) == 0) // User not found. So, redirect to login_form again.
{
    header('Location: index.html');
}

$userData = mysqli_fetch_array($result, MYSQL_ASSOC);
$hash = hash('sha256', $password);
$salt = $userData['salt'];
$hash2 = hash('sha256', $salt . $hash );

if($hash2 != $userData['password']) // Incorrect password. So, redirect to login_form again.
{
    header('Location: index.html');
}else{ 
// Redirect to home page after successful login.
	session_regenerate_id();
	$_SESSION['sess_user_id'] = $userData['user_id'];
	$_SESSION['sess_username'] = $userData['username'];
	$_SESSION['sess_profile'] = $userData['profile_pic'];
	$_SESSION['sess_fullname'] = $userData['fullname'];
	session_write_close();
	header('Location: home.php'); // Redirects to home page
}

?>