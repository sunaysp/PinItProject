<?php
include ("connection.php");

$pin_id = $_GET['pin_id'];
$pic_id=$_GET['pic_id'];
$parent_id=$_GET['parent_id'];
$board_id=$_GET['board_id'];
$board_name=$_GET['board_name'];

if($parent_id==0) {
	$query="select * from pin where parent_id=$pin_id";
	$result=mysqli_query($link,$query);

	if(mysqli_num_rows($result)!=0) {
	echo "inside";
		while($row = mysqli_fetch_array($result)) {
			
			$delquery="delete from pin where pin_id=$row[0]";
			$res=mysqli_query($link,$delquery);
			
		}
	}	
		$delquery2="delete from picture where pic_id=$pic_id";
		$res=mysqli_query($link,$delquery2);
		
		$delquery3="delete from pin where pin_id=$pin_id";
		$res=mysqli_query($link,$delquery3);
	
		
	
}
else {
	$delquery4="delete from pin where pin_id=$pin_id";
		$res=mysqli_query($link,$delquery4);
}
?>
<?php header("Location: addpins.php?board_id=$board_id&board_name=$board_name"); ?>

