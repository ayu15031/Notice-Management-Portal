<?php
include'config.php';
include'session.php';
$error="";
$success="";
$ame = $_SESSION['uname'];
if($ame==""){
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
 
                 
                    $uname = $row[0];
                    $pass = $row[1];
                     $id= $row[2];
                     $name= $row[1];
					 $branch=$row[3];
					 $cource=$row[4];
					 $year=$row[5];
					 $email=$row[6];
					 
                     
                    //Here, You can insert data into database. 
                   $q="insert into student_login values('$uname','$pass','$cource','$branch','$year','$name','$id','$email')";
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
    


$uname="";
$year="";
$name="";
$id="";
$mob="";
$email="";
if(isset($_POST['submit'])){
		$uname = $_POST['uname'];
		$pass = $_POST['pass'];
		$branch = $_POST['branch'];
		$name= $_POST['name'];
		$email=$_POST['email'];

		$id=$_POST['enroll'];
		$cource = $_POST['cource'];
		
		$q="select * from student_login where id_no='$id'";
		$result = mysqli_query($con, $q);
		$num = mysqli_num_rows($result);
		if($num>0)
			$error="Student already added";
		
		else{
		
		$q="select * from student_login where username='$uname'";
		$result = mysqli_query($con, $q);
		$num = mysqli_num_rows($result);
		if($num>0)
			$error="Username already exists";
		else if($cource=='BTech'){
			$year = $_POST['B'];
			$q="insert into student_login values('$uname','$pass','$cource','$branch','$year','$name','$id','$email')";
			$result = mysqli_query($con, $q);
			$success="Student Added";
		}
		else if($cource=='MTech'){
			$year = $_POST['M'];
			$q="insert into student_login values('$uname','$pass','$cource','$branch','$year','$name','$id','$email')";
			$result = mysqli_query($con, $q);
			$success="Student Added";
		}
		else if($cource=='Phd'){
			$year = $_POST['P'];
			$q="insert into student_login values('$uname','$pass','$cource','$branch','$year','$name','$id','$email')";
			$result = mysqli_query($con, $q);
			$success="Student Added";
		}
		
}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Notice</title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/main.css" rel="stylesheet">
	<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
	<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="lib/animate/animate.min.css" rel="stylesheet">
	<link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
	<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
	<link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


	<style>
	</style>
	<script>
		$(document).ready(function(){
		$('ul li').click(function(){
		$('li').removeClass("active");
		$(this).addClass("active");
		}
		)})
	</script>
</head>
<body id="body">
	
<header id="header">
	<nav class="navbar">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand" href="#"><img src="images/nit.png"  height="50px" width="200px"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			
			  <ul class="nav navbar-nav navbar-right menu-design">
			  <li class="dropdown" class="active">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Add<span class="caret"></span></a>
						  <ul class="dropdown-menu">
						  <li><a href="adda.php">Admin</a></li>
							  <li><a href="index.php">Student</a></li>
							  <li><a href="add_istudent.php">Student Incharge</a></li>
						  </ul>
				  </li>
				 <li><a href="upload.php">Upload</a></li>
                <li><a href="request.php">Manage Notices</a></li>
                
                <li><a href="view.php">Modified notice</a></li>
				<li><a href="logout.php">Logout</a></li>
				  
				  
             </ul>
			
		   </div>
		</div>
	</nav>
</header>
<section id="intro">

    <div class="intro-content">
	
     <h2>NO<span>TICES</span> </h2>
   
    </div>
	</section>
	
<section>
      <div class="container">
        <div class="section-header">
          <h2>Add Student</h2>
         
        </div>

</section>
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
		    <p style="text-align:center; "><a target="_blank" href="student.xlsx">Get Format Of Excel File</a></p>
		  <h1 style="text-align:center; font-size:30px;"><b>OR</b></h1>
		    
		   <div class="row">
		 <div class="col-md-4">
		 </div>
		 <div class="col-md-4">
		  <p style="color:red; text-align:center; margin-top:20px;"><?php echo $error;?></p>
		 <p style="color:green; text-align:center;"><?php echo $success;?></p>
		 
		 <form method="post" style="margin-top:30px; margin-left:auto; margin-right:auto;">
				<div class="form-group">
				<label for="roll">Username :</label>
				<input type="text" name="uname" value="<?php echo $uname;?>" required="required" class="form-control">
				</div>
				
				<div class="form-group">
				<label >Password :</label>
				<input type="password" name="pass" required="required" class="form-control">
				</div>
				
				 <div class="form-group">
					<label class="control-label">Name</label>
					<input  name="name" maxlength="100" type="text" value="<?php echo $name;?>" class="form-control" >
				  </div>
				
				 <div class="form-group">
				 <label class="control-label">Email</label>
				 <input maxlength="100" name="email" type="email" required="required" value="<?php echo $email;?>" class="form-control" placeholder="Enter Email" />
			     </div>
				 
				  
				  <div class="form-group">
					<label class="control-label">Enrollment no.</label>
					<input  name="enroll" maxlength="100" value="<?php echo $id;?>" type="text" class="form-control" >
				  </div>
		  
					<div class="form-group">
					<label >Select Department :</label>
				 <select name="branch">
					<option value="MECH">Department of Mechanical Engineering</option>
					<option value="CIVIL">Department of Civil Engineering</option>
					<option value="EEE">Department of Electrical and Electronics Engineering</option>
					<option value="ECE">Department of Electronics and Communication Engineering</option>
					<option value="CSE">Department of Computer Science</option>
				  </select>
				</div>
			
				
				<div class="form-group">
				<label >Select Cource :</label>
				<select name="cource" onchange="showDiv(this)">
					<option value="Phd">Phd</option>
					<option value="MTech">MTech</option>
					<option value="BTech">BTech</option>
				  </select>
				</div>
				
				
				
				<div id="b" class="form-group" style="display:none;">
				<label >Select Year :</label>
				<select name="B">
				  <option value="I year">I year</option>
				  <option value="II year">II year</option>
				  <option value="III year">III year</option>
				  <option value="IV year">IV year</option>
				 </select>
				</div>
				
				<div id="m" class="form-group" style="display:none;">
				<label >Select Year :</label>
				  <select name="M">
				  <option value="I year">I year</option>
				  <option value="II year">II year</option>
				  </select>
				</div>
	
				
				<div id="p" class="form-group" >
				<label >Select Off/On campus :</label>
				 <select name="P">
				  <option value="Off Campus">Off Campus</option>
				  <option value="On Campus">On Campus</option>
				  </select>
				</div>
				
			<script type="text/javascript">
				function showDiv(select){
				   if(select.value=='BTech'){
					document.getElementById('b').style.display = "block";
					document.getElementById('m').style.display = "none";
					document.getElementById('p').style.display = "none";
				   } else if(select.value=='MTech'){
					document.getElementById('m').style.display = "block";
					document.getElementById('p').style.display = "none";
					document.getElementById('b').style.display = "none";
				   }
				   else if(select.value=='Phd'){
					document.getElementById('p').style.display = "block";
					document.getElementById('m').style.display = "none";
					document.getElementById('b').style.display = "none";
				   }
				} 
			</script>
				
				<div class="form-group" >
				<button type="submit" name="submit" class="btn btn-default">Add Student</button>
				</div>
				 </form>
				
		 
		  </div>
		  </div>
		 
		  <p style="color:red; text-align:center; margin-top:20px;"><?php echo $error;?></p>
		 <p style="color:green; text-align:center;"><?php echo $success;?></p>
                </div>
                <!-- <div class="col2">
                  
                  
                  
                </div>-->
            </div>
        </div>
    </div>
   <?php 
include 'footer.php';
?>
</body>
</html>
