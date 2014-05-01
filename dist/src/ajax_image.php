<?php
session_start();
include ("connection.php");
$path = "../images/";
$valid_formats = array("jpg", "png", "gif","JPG");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
  $name = $_FILES['photoimg']['name'];
  $size = $_FILES['photoimg']['size'];
  if(strlen($name))
         {
	list($txt, $ext) = explode(".", $name);
	if(in_array($ext,$valid_formats))
		{
		if($size<(1024*1024))
			{
			$actual_image_name = time().substr(str_replace(" ", "_", $txt), 10).".".$ext;
			
			$tmp = $_FILES['photoimg']['tmp_name'];
			
			if(move_uploaded_file($tmp, $path.$actual_image_name))
				{
				$command=mysqli_query($link,"INSERT INTO picture(url) values('$actual_image_name')");
				$query=mysqli_query($link,"Select pic_id,url from picture where url='$actual_image_name'");
				$result=mysqli_fetch_array($query);

				$id=$result['pic_id'];

				echo "<img src='".$path.$actual_image_name."' class='preview' id='$id'>";			
			        }
			else
			echo "failed";
		}
	else
	echo "Image file size max 250k";					
          }
else
echo "Invalid file format..";	 
}
				
else
echo "Please select image..!";
				
exit;
}
?>