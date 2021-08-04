<?php
include'config.php';
include'session.php';

if(isset($_GET['id']))
	$id=$_GET['id'];

$q="delete from notices where id='$id'";
mysqli_query($con,$q);

$q="delete from attachments where id='$id'";
mysqli_query($con,$q);

header('location:rejected.php');
?>