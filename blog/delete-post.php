<?php
include "dbconfig.php";

 $id=$_POST['id'];

$query=mysqli_query($link,"UPDATE blog SET status=0 WHERE id='$id'"); 

if($query){
	echo 'success';
}
?>