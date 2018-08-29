<?php
include "dbconfig.php";
 
$id=$_POST['id'];
$title=$_POST['title'];
$img=$_POST['img'];
$content=$_POST['content'];
$content1=$_POST['content1'];

$query=mysqli_query($link,"UPDATE blog SET title='$title',img='$img',content='$content',content1='$content1' WHERE id='$id'");

//$query=mysqli_query($con,"UPDATE user SET username='$username',email='$email',mobile_no='$mobile_no',address='$address',facebook='$facebook',twitter='$twitter',instagram='$instagram',youtube='$youtube',image='$image' WHERE id='$id'");
if($query){
	echo 'success';
//	session_start();

}else{
	echo 'fail';
}

?>


	
  