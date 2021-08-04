<?php
include'config.php';
include'session.php';
$error="";
$success="";
$uname="";
$des="";
$name="";
$id="";
$email="";
$uname = $_SESSION['uname'];
if($uname==""){
	header('location:../login.php?data=1');
}

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
require_once '../spout-2.4.3/src/Spout/Autoloader/autoload.php';


  if (isset($_POST['upload'])) {
	  if (!empty($_FILES['file']['name'])) {
      
    // Get File extension eg. 'xlsx' to check file is excel sheet
    $pathinfo = pathinfo($_FILES["file"]["name"]);
     
    // check file has extension xlsx, xls and also check 
    // file is not empty
   if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls') 
           && $_FILES['file']['size'] > 0 ) {
         
        // Temporary file name
        $inputFileName = $_FILES['file']['tmp_name']; 
    
        // Read excel file by using ReadFactory object.
        $reader = ReaderFactory::create(Type::XLSX);
 
        // Open file
        $reader->open($inputFileName);
        $count = 1;
 
        // Number of sheet in excel file
        foreach ($reader->getSheetIterator() as $sheet) {
             
            // Number of Rows in Excel sheet
            foreach ($sheet->getRowIterator() as $row) {
 
                // It reads data after header. In the my excel sheet, 
                // header is in the first row. 
                if ($count > 1) { 
 
                 
                    
                     $branch= $row[0];
					 $id =$row[1];
					 $desig=$row[2];
					 $email=$row[3];
					 
					 
                     
                    //Here, You can insert data into database. 
                   $q="insert into student_login values('$branch', '$id','$desig','$email')";
			       $result = mysqli_query($con, $q);
                     
                }
                $count++;
            }
        }
 
        // Close excel file
        $reader->close();
 
    } else {
 
       $error= "Please Select Valid Excel File";
    }
	} else {
 
    echo "Please Select Excel File";
     
}
 
} 

if(isset($_POST['submit'])){
		$uname = $_POST['uname'];
		$pass = $_POST['pass'];
		$branch = $_POST['branch'];
		$name= $_POST['name'];
		$email=$_POST['email'];
		
		$id=$_POST['enroll'];
		$des=$_POST['des'];
		$q="select * from faculty_login where id_no='$id'";
		$result = mysqli_query($con, $q);
		$num = mysqli_num_rows($result);
		if($num>0)
			$error="Faculty already added";
		
		
		else{
			$q="select * from faculty_login where email='$email'";
		$result = mysqli_query($con, $q);
		$num = mysqli_num_rows($result);
		if($num>0)
			$error="Email already added";
		
		else{
		$q="insert into faculty_login values('$branch','$id','$des','$email')";
		$result = mysqli_query($con, $q);
		$success="Faculty Added";
		}
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="Styles/reset.css" rel="stylesheet" />
    <link type="text/css" href="Styles/module.css" rel="stylesheet" />
    <link type="text/css" href="Styles/main.css" rel="stylesheet" />
	
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
                
                <li><a href="index.php">Add Student</a></li>
                <li><a href="add_istudent.php">Add Student Incharge</a></li>
				 <li><a href="upload.php">Upload</a></li>
                <li><a href="request.php">Manage Notices</a></li>
                
                <li><a href="view.php">Modified notice</a></li>
                
            </ul>
            <ul class="siteInfo">
                <li>
                    <p class="siteLog">
                    </p>
                </li>
                <li></li>
                <li></li>
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
                Add Faculty
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
		 
		  <form action="" method="POST" enctype="multipart/form-data" style="margin-top:30px; margin-left:auto; margin-right:auto;">
				<div class="form-group">
				<label style="text-align:center;">CHOOSE EXCEL FILE</label>
				 <input type="file" name="file"  style="font-size:15px; color:black; "/>
		     	

				</div>
				<div class="form-group">
				 
			    <input type="submit" value="Upload" style="margin-left:30%;" name="upload"/>

				</div>
		  </form>
		  </div>
		  </div>
		    <p style="text-align:center; "><a target="_blank" href="faculty.xlsx">Get Format Of Excel File</a></p>
		  <h1 style="text-align:center; font-size:30px;"><b>OR</b></h1>
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
				 <input maxlength="100" name="email" type="email" required="required" value="<?php echo $email;?>" class="form-control"  />
			     </div>
				 
				 
				  
				  <div class="form-group">
					<label class="control-label">Id no.</label>
					<input  name="enroll" maxlength="100" value="<?php echo $id;?>" type="text" class="form-control" >
				  </div>
				
				<div class="form-group">
				 <select name="branch">
					<option value="MECH">Department of Mechanical Engineering</option>
					<option value="CIVIL">Department of Civil Engineering</option>
					<option value="EEE">Department of Electrical and Electronics Engineering</option>
					<option value="ECE">Department of Electronics and Communication Engineering</option>
					<option value="CSE">Department of Computer Science</option>
				  </select>
				</div>
				
				<button type="submit" name="submit" class="btn btn-default">Add Faculty</button>
				
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
