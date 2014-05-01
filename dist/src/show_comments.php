<?php
$loggedinUser=$_SESSION['sess_user_id'];
$command="SELECT CONCAT(B.firstname,' ',B.lastname) AS usr, B.profile_pic AS profile_pic, A.comment AS `comment`, A.created_date AS created_date
 FROM COMMENT A INNER JOIN `user` B ON A.user_id=B.`user_id` WHERE A.pin_id=$pid";
$path='../profile/';
$comm_result=mysqli_query($link,$command);
while($cdata=mysqli_fetch_row($comm_result))
{
echo "<div class='comment_area'>";
echo "<div class='comment_user'><img src='".$path.$cdata[1]."' width='25px' height='25px'/></div>";
echo "<div class='commentbody'><a href='#'><b>".$cdata[0]."</b></a> ".$cdata[2]."</div></div>";
}
?>