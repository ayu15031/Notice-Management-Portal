<?php
//rejecting a notice by admin
include'config.php';
include'session.php';

$uname = $_SESSION['uname'];
//if not logged in go back to login page
if($uname==""){
	header('location:../login.php?data=1');
}
if(isset($_GET['id']))
	$id=$_GET['id'];
//firing a query for rejecting notice
$q="update notices set approval=0 where id='$id'";
mysqli_query($con,$q);
$message="Notice rejected";
//returning to the page
header('location:request.php');
?>
