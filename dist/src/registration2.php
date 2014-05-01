<?php
include 'connection.php';
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$location = $_POST['location'];
$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$email = $_POST['email'];

if($password1 != $password2)
    header('Location: index.html');
 
if(strlen($username) > 30)
    header('Location: index.html');
 
$hash = hash('sha256', $password1);
 
function createSalt()
{
    $text = md5(uniqid(rand(), true));
   return substr($text, 0, 3);
}
 
$salt = createSalt();
$password = hash('sha256', $salt . $hash);
$query = "INSERT INTO user (username,firstname,lastname,location, password, email,isactive, salt) VALUES 
		( '$username','$fname','$lname','$location', '$password', '$email',1, '$salt' )";

mysqli_query($link, $query); 
mysqli_close($link);
 
header('Location: index.html');
?>