<?php
include'config.php';
include'session.php';

if(isset($_GET['id']))
	$id=$_GET['id'];
	
if(isset($_GET['src']))
	$src=$_GET['src'];
	

$q="delete from attachments where id='$id' AND attachment='$src'";
mysqli_query($con,$q);

header('location:add.php?id='.$id);
?>