<?php
//accepting a notice by admin
include'config.php';
include'session.php';
//going back to login page if not logged in
$uname = $_SESSION['uname'];
if($uname==""){
	header('location:../login.php?data=1');
}
//getting the id of notice to be rejected
if(isset($_GET['id']))
	$id=$_GET['id'];
//updating the database and sending notice to student
$q="update notices set approval=1 where id='$id'";
			mysqli_query($con,$q);
			$result=mysqli_query($con,"select * from notices where id='$id'");
			$row=mysqli_fetch_assoc($result);
            $num=mysqli_num_rows($result);
			if($num>0){
				$cource=$row['cource'];
				$branch=$row['branch'];
				$year=$row['year'];
				$pdf_src=$row['pdf_src'];
				$sent_by=$row['sent_by'];
				$club=$row['club'];
				$title=$row['title'];
				mysqli_query($con,"insert into student_notices(id, title, cource, branch, club, year, pdf_src, sent_by) values('$id','$title', '$cource','$branch','$club', '$year','$pdf_src','$sent_by')");				
			}
//going back to previous page
header('location:request.php');
?>