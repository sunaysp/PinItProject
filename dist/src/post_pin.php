<?php
include("connection.php");

if($_POST)
{
$pin=$_POST['pin'];
$pin=mysqli_real_escape_string($link,"$pin");

$upload_id=$_POST['z'];
$board_id=$_POST['board_id'];

$upload=$_POST['upload'];

if($upload==0) {
$tagslist=$_POST['tags_list'];
$sql_query = "INSERT INTO pin(board_id,pic_id,description) VALUES ($board_id,$upload_id,'$pin')";
$sql_result=mysqli_query($link,$sql_query);
}
else {
$tagslist=$_POST['tagnames'];
$html = file_get_contents($pin);

$doc = new DOMDocument();
@$doc->loadHTML($html);

$imgtags = $doc->getElementsByTagName('img');

	foreach ($imgtags as $tag) {
		$imgname=$tag->getAttribute('title');
		
		 $imagefile = $tag->getAttribute('src');
		 $content = @file_get_contents($imagefile);
		 
		 
		if(!empty($imgname)) {
			$actual_image_name = $imgname.".jpeg";
			$picquery="INSERT INTO picture(url,source) values('$actual_image_name','$pin')";
			
			$command=mysqli_query($link,$picquery);
			$fetchquery="Select pic_id from picture order by pic_id desc limit 1";
			
				$query1=mysqli_query($link,$fetchquery);
				$result=mysqli_fetch_array($query1);
				$id=$result['pic_id'];
				
			 $fp = fopen($actual_image_name, 'w') or die('Cannot open file:  '.$actual_image_name);
			 
			 fwrite($fp, $content);
			 fclose($fp);
			 
			 rename($actual_image_name,"../images/$actual_image_name");
			 
			
			 $sql_query = "INSERT INTO pin(board_id,pic_id,description) VALUES ($board_id,$id,'$imgname')";
			 
			 $sql_result=mysqli_query($link,$sql_query);
			 
		}
		   
	}
}

$tagarray = explode(",",$tagslist);

$newquery="SELECT * from pin order by pin_id desc limit 1";
$newresult = mysqli_query($link,$newquery);

echo '<div id="container" class="clearfix">';

while($data=mysqli_fetch_row($newresult))
{

$pid=$data[0];
$pin=$data[6];
echo "<div class='box col2' id='box$pid'>";
echo "<div class='pin_holder'>";
echo "<div class='data'>";
$pic_id=$data[2];
if($pic_id)
{
$img_query=mysqli_query($link,"Select url from picture where pic_id=$pic_id");
$result=mysqli_fetch_array($img_query);
$img_path=$result['url'];
echo "<div style='margin-bottom:5px;'><img src='../images/$img_path' class='pin_image'></div>";
echo "<div>$pin</div></div>";

foreach($tagarray as $tag) {
	$tag_name=trim($tag);
	
	$newquery='SELECT * FROM tags WHERE tag_name="'.$tag_name.'"';
	$newresult = mysqli_query($link,$newquery);
	$res=mysqli_fetch_array($newresult);
	
	if(mysqli_num_rows($newresult)==0) {
	$insertquery='insert into tags(`tag_name`) values("'.$tag_name.'")';
	$result1=mysqli_query($link,$insertquery);
	
	$newquery2='SELECT * FROM tags WHERE tag_name="'.$tag_name.'"';
	$newresult2 = mysqli_query($link,$newquery2);
	$res2=mysqli_fetch_array($newresult2);
	
	$tag_id=$res2['tag_id'];
	
	}
	else {
		$tag_id=$res['tag_id'];
	}
	$insertquery2="INSERT INTO tagpin VALUES($tag_id,$pid)";
	$result2=mysqli_query($link,$insertquery2);
	
}

}
else
{
echo "<div><b>$pin</b></div></div>";
}
echo "</div>";
echo "<div style='margin-left:10px;'><a href='#' class='commentopen' id='$pid'><small>Comment</small></a></div>";

}

}
?>
<div class='commentpost' style='display:none;' id='commentbox<?php echo $pid;?>'>
<div class='commentbox_area'>
<form method="post" action="">
<textarea name="comment" class="comment" maxlength="200"  id="ctextarea<?php echo $pid;?>" placeholder="Add a comment..."></textarea>
<br/>
<input type="submit"  value=" Comment "  id="<?php echo $pid;?>" class="comment_button"/>
</form>
</div>
</div>
</div>
