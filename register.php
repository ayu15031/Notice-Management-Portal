<?php
include'config.php';
session_start();

 $email=$_SESSION['email'];

$error="";
$success="";
$uname="";
$des="";
$name="";
$id="";
$mob="";


$q="select * from faculty_login where email='$email'";
$result = mysqli_query($con,$q);
$num = mysqli_num_rows($result);

if($num>0){
	$row = mysqli_fetch_assoc($result);
	
	$_SESSION['id']=$row['id_no'];
	$_SESSION['branch']=$row['branch'];
	header('location:faculty/index.php');
}


 

if(isset($_POST['submit'])){
		
		$branch = $_POST['branch'];
		$name= $_POST['name'];
		
		$id=$_POST['enroll'];
		$des=$_POST['des'];
		$q="select * from faculty_login where id_no='$id'";
		$result = mysqli_query($con, $q);
		$num = mysqli_num_rows($result);
		if($num>0)
			$error="Faculty already added";
		
		
		else{
		
		
		$q="insert into faculty_login values('$branch','$id','$des','$email')";
		$result = mysqli_query($con, $q);
		header('location:faculty/index.php');
		}
		}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty</title>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="Styles/reset.css" rel="stylesheet" />
    <link type="text/css" href="Styles/module.css" rel="stylesheet" />
    <link type="text/css" href="Styles/main.css" rel="stylesheet" />
	<style>
li .dropdown{
    float: left;
}

.dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {

}

li.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
	min-width: 160px;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
</head>
<body>
    <div class="headerWrapper">
        <div class="headerWrapperFix">
            <h1 class="hidden">
                BITS Pilani</h1>
            <div class="logoWrapper">
                <a href="index.aspx" class="logo">
                    <img src="images/sftwaredev_thumb.gif" alt="BITS Pilani logo" />
                </a>
            </div>
            <ul class="mainNav">
              <li class="sel"><a href="">About Us</a></li>
                    <li ><a href="">Contact Us</a></li>
				<li class="sel"><a href="loginf.php">Faculty Login</a></li>
               
               <li class="dropdown">
				<a href="javascript:void(0)" class="dropbtn">Student Login</a>
				<div class="dropdown-content">
				  
				  <a href="login.php?data=3">Student Incharge</a>
				  <a href="login.php?data=4">Student</a>
				</div>
			  </li>

            </ul>
            <ul class="commonNav">
                <li><a href="http://universe.bits-pilani.ac.in/">University Home</a></li>
                <li><a href="http://universe.bits-pilani.ac.in/pilani">Pilani Campus Home</a></li>
                <li><a href="http://universe.bits-pilani.ac.in/pilani/SoftwareDevelopmentEduTec/Home">
                    Centre for Software Development</a></li>
                <li><a href="http://universe.bits-pilani.ac.in/pilani/SoftwareDevelopmentEduTec/Contact">
                    Contact Us</a></li>
				<li><a href="logout.php">LOGOUT</a></li>
            </ul>
        </div>
    </div>
    <div class="infoWrapper">
        <div class="breadCrumbWrapper">
            <p>
                You are here:</p>
            <ul class="breadCrumb">
                <li class="home"><a href="#">Home</a></li>
                <li>Page</li>
            </ul>
        </div>
    </div>
    <div class="bannerInsideWrapper">
        <div class="bannerInsideFix">
            <h1>
                Signup
            </h1>
            <div class="bannerCont">
                <img src="images/insideBanner.jpg" alt="banner" width="944" height="176" />
                <div class="qts">
                    NOTICE
                </div>
            </div>
        </div>
    </div>
    <div class="contentWrapper">
        <div class="contentFix">
            <div class="twoCol">
                <div class="fontstyle">
				
				<div class="row">
		 <div class="col-md-4">
		 </div>
		 <div class="col-md-4">
		  <p style="color:red; text-align:center; margin-top:20px;"><?php echo $error;?></p>
		 <p style="color:green; text-align:center;"><?php echo $success;?></p>
		 <form method="post" style="margin-top:30px; margin-left:auto; margin-right:auto;">
				
				
				
				 <div class="form-group">
					<label class="control-label">Designation</label>
					<input  name="des" maxlength="100" value="<?php echo $des;?>" type="text" class="form-control" >
				  </div>
				 <div class="form-group">
				 <label class="control-label">Email</label>
				 <input maxlength="100" name="email" type="email" required="required" value="<?php echo $email;?>" class="form-control" disabled />
			     </div>
				 
				  
				  <div class="form-group">
					<label class="control-label">Id no.</label>
					<input  name="enroll" maxlength="100" value="<?php echo $id;?>" type="text" class="form-control" >
				  </div>
				
				<div class="form-group">
				 <select name="branch">
					<option value="MECH">Department of Mechanical Engineering</option>
					<option value="MANUFACTURING">Department of Manufacturing Engineering</option>
					<option value="CIVIL">Department of Civil Engineering</option>
					<option value="EEE">Department of Electrical and Electronics Engineering</option>
					<option value="EIE">Department of Electronics and Instrumentation Engineering</option>
					<option value="CE">Department of Chemical Engineering</option>
					<option value="CSE">Department of Computer Science</option>
					<option value="PHARM">Department of Pharmacy</option>
					<option value="MATH">Department of Mathematics</option>
					<option value="SCIENCE">Department of Science</option>
					<option value="ECONOMICS">Department of Economics</option>
				  </select>
				</div>
				
				<button type="submit" name="submit" class="btn btn-default">Sign Up</button>
				
		  </form>
		  </div>
		  </div>
		 
                </div>
                <!-- <div class="col2">
                  
                  
                  
                </div>-->
            </div>
        </div>
    </div>
    <div class="footerWrapper">
    </div>
    <div class="cpInfoFixWrapper">
        <div class="cpInfoFix">
            <p class="info">
                An institution deemed to be a University estd. vide Sec.3 of the UGC Act,1956 under
                notification # F.12-23/63.U-2 of Jun 18,1964</p>
            <p>
                &copy; 2012 Centre for Software Development,SDET Unit, BITS-Pilani, India.
            </p>
        </div>
    </div>
</body>
</html>
