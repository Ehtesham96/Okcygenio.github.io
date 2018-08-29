<?php
include "dbconfig.php";

$title=$_POST['title'];
$img=$_POST['img'];
$content=$_POST['content'];
$content1=$_POST['content1']; 
$query=mysqli_query($link,"INSERT INTO blog (title,img,content,content1) values('$title','$img','$content','$content1')");

if($query){
	echo 'success';
}else{
	echo 'fail';
}

?>