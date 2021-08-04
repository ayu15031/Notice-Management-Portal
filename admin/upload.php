<?php
include'config.php';
include'session.php';
$error="";
$success="";
$uname = $_SESSION['uname'];
if($uname==""){
	header('location:../login.php?data=1');
}
if(isset($_POST['submit'])){
	$cat=$_POST['cat'];
	$club=$_POST['club1'];
	 $students=$_POST['students'];
	$branch1=$_POST['branch1'];														
	$f_name =$_FILES['myfile']['name'];
	$f_tmp = $_FILES['myfile']['tmp_name'];
	$f_size = $_FILES['myfile']['size']; 
	$f_extension = explode('.',$f_name);
	$f_extension = strtolower(end($f_extension)); 			
	$f_newfile = uniqid().'.'.$f_extension; 				
	$store = "upload/".$f_newfile; 	
	$title=$_POST['title'];
	$result=mysqli_query($con,"select * from notices where title='$title'");
	$num=mysqli_num_rows($result);
	if($num>0){
		$error='Title already exists';
	}
	else{
	if($f_extension=='pdf')
	{
		
		
			if(move_uploaded_file($f_tmp,$store))
			{
				$success= "Uploded";
				if($cat=="dept"){
				if($students=='BTech'){
					$l=0;
				if(!empty($_POST['1B'])){
					
					$q="insert into student_notices(title, cource, branch, year, sent_by, pdf_src) values('$title', '$students', '$branch1', 'I year','$uname', '$f_newfile')";
			        mysqli_query($con, $q);
					$l=$l+1;
				}
				if(!empty($_POST['2B'])){
					
					$q="insert into student_notices(title, cource, branch, year, sent_by, pdf_src) values('$title', '$students', '$branch1', 'II year','$uname', '$f_newfile')";
			        mysqli_query($con, $q);
					$l=$l+1;
				}
				if(!empty($_POST['3B'])){
					
					$q="insert into student_notices(title, cource, branch, year, sent_by, pdf_src) values('$title', '$students', '$branch1', 'III year','$uname', '$f_newfile')";
			        mysqli_query($con, $q);
					$l=$l+1;
				}
				if(!empty($_POST['4B'])){
					
					$q="insert into student_notices(title, cource, branch, year, sent_by, pdf_src) values('$title', '$students', '$branch1', 'IV year','$uname', '$f_newfile')";
			        mysqli_query($con, $q);
					$l=$l+1;
				}
				if($l==0){
				$error="Select atleast one year";
				}
				
			}
			
			elseif($students=='All students'){
				$q="insert into student_notices(title, cource, branch, year, sent_by, pdf_src) values('$title', '$students', '$branch1', 'All','$uname', '$f_newfile')";
			        mysqli_query($con, $q);
				
 			}
			
			else if($students=='Faculty'){
				$q="insert into notices(title, cource, branch, year, pdf_src, sent_by,approval) values('$title','$students', '$branch1', 'NULL', '$f_newfile', '$uname','1')";
			        mysqli_query($con, $q);
			}
			
			else if($students=='Phd'){
				$m=0;
				if(!empty($_POST['1P'])){
					
					$q="insert into student_notices(title, cource, branch, year, sent_by, pdf_src) values('$title', '$students', '$branch1', 'On Campus','$uname', '$f_newfile')";
			        mysqli_query($con, $q);
					$m=$m+1;
				}
				 if(!empty($_POST['2P'])){
					
					$q="insert into student_notices(title, cource, branch, year, sent_by, pdf_src) values('$title', '$students', '$branch1', 'Off Campus','$uname', '$f_newfile')";
			        mysqli_query($con, $q);
					$m=$m+1;
				}
				
				if($m==0){
				$error="Select atleast one year";
				}
			}
			
				else if($students=='MTech'){
					$n=0;
				if(!empty($_POST['1M'])){
					
					$q="insert into student_notices(title, cource, branch, year, sent_by, pdf_src) values('$title', '$students', '$branch1', 'I Year','$uname', '$f_newfile')";
			        mysqli_query($con, $q);
					$n=$n+1;
				}
				 if(!empty($_POST['2M'])){
					
					$q="insert into student_notices(title, cource, branch, year, sent_by, pdf_src) values('$title', '$students', '$branch1', 'II Year','$uname', '$f_newfile')";
			        mysqli_query($con, $q);
					$n=$n+1;
				}
				
				if($n==0){
				$error="Select atleast one year";
				}
			}
			}
			else if($cat=='club'){
				$q="insert into student_notices(title, cource, branch, club, year, sent_by, pdf_src) values('$title', 'All students','All Departments', '$club','All', '$uname', '$f_newfile')";
				 mysqli_query($con, $q);
			}
			
			}
	}
	else
	{
		$error= "you can upload pdf only";
	}
	
	
	
			if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['upload']['name'][$i];

                //save the url and the file
                $filePath = "upload/".$_FILES['upload']['name'][$i];

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                    //insert into db 
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file
					
              }
        }
		}
		if(is_array($files)){
					$q="select * from notices where title='$title' AND sent_by='$uname'";
					$result=mysqli_query($con,$q);
					$k=0;
					$num=mysqli_num_rows($result);
					while($row = mysqli_fetch_assoc($result)){
								
								$id=$row['id'];
								foreach($files as $file){
								$k=$k+1;
								mysqli_query($con,"insert into attachments(id, attachment) values($id,'$file')");
							}
					}

                }
    


	
	
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
	
	.mystyle{
		color:red;
	}
	
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
			  <li class="dropdown" >
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Add<span class="caret"></span></a>
						  <ul class="dropdown-menu">
						  <li><a href="adda.php">Admin</a></li>
							  <li><a href="index.php">Student</a></li>
							  <li><a href="add_istudent.php">Student Incharge</a></li>
						  </ul>
				  </li>
				 <li class="active"><a href="upload.php">Upload</a></li>
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
          <h2>Upload Notice</h2>
         
        </div>

</section>
		  <div class="row">
		 <div class="col-md-4">
		 </div>
		 <div class="col-md-4">
		 
		 <form action="" method="POST" enctype="multipart/form-data" style="margin-top:30px; margin-left:auto; margin-right:auto;">
			<div class="form-group">
			<div class="form-group">
					<label >Title :</label>
					<input type="text" name="title" />
				</div>
			<label >Select Category :</label>
				<select name="cat" onchange="showDiv1(this)">
					<option value="club">Club</option>
					<option value="dept">Department</option>
				  </select>
			</div>
			<div id="c">
				<div class="form-group">
				<label >Select Club :</label>
				<select name="club1" onchange="showDiv(this)">
					<option value="Dramatics">Dramatics</option>
					<option value="Dance">Dance</option>
					<option value="Literary">Literary</option>
					<option value="Robotics">Robotics</option>
					<option value="Music">Music</option>
					
				  </select>
				</div>
			</div>
			<div id="d" style="display:none;">
				<div class="form-group">
				<label >Select Cource :</label>
				<select name="students" onchange="showDiv(this)">
					<option value="All students">All students</option>
					<option value="Phd">Phd</option>
					<option value="MTech">MTech</option>
					<option value="BTech">BTech</option>
					<option value="Faculty">Faculty</option>
				  </select>
				</div>
				<div id="b" class="form-group" style="display:none;">
				<label >Select Year :</label>
				  <input type="checkbox" name="1B" value="1"><label>I year</label><br/>
				  <input type="checkbox" name="2B" value="2"><label>II year</label><br/>
				  <input type="checkbox" name="3B" value="3"><label>III year</label><br/>
				  <input type="checkbox" name="4B" value="4"><label>IV year</label><br/>
				</div>
				<div id="m" class="form-group" style="display:none;">
				<label >Select Year :</label>
				  <input type="checkbox" name="1M" value="1"><label>I year</label><br/>
				  <input type="checkbox" name="2M" value="2"><label>II year</label><br/>
	
				</div>
				<div id="p" class="form-group" style="display:none;">
				<label >Select Off/On campus :</label>
				  <input type="checkbox" name="1P" value="1"><label>Off campus</label><br/>
				  <input type="checkbox" name="2P" value="2"><label>On campus</label><br/>
				</div>
				<div class="form-group">
				<label >Select Department :</label>
				 <select name="branch1">
					<option value="All Departments">All Departments</option>
					<option value="MECH">Department of Mechanical Engineering</option>
					<option value="CIVIL">Department of Civil Engineering</option>
					<option value="EEE">Department of Electrical and Electronics Engineering</option>
					<option value="ECE">Department of Electronics and Communication Engineering</option>
					<option value="CSE">Department of Computer Science</option>
				  </select>
				</div>
				</div>
				<div class="form-group">
				 <input type="file" name="myfile"  style="font-size:15px; color:black; "/>
		     	

				</div>
				
				<div class="form-group">
					<div>
						<label for='upload'>Select multiple Attachments:</label>
						<input id='upload'  name="upload[]" type="file" multiple="multiple" />
					</div>
				</div>
				<div class="form-group">
				<div class="form-group">
				 
			    <input  type="submit" value="Upload" style="margin-left:30%;" name="submit"/>

				</div>
				<script type="text/javascript">
				function showDiv1(select){
					if(select.value=='club'){
						document.getElementById('c').style.display="block";
						document.getElementById('d').style.display="none";
						
					}
					if(select.value=='dept'){
						document.getElementById('d').style.display="block";
						document.getElementById('c').style.display="none";
						
					}
				}
				
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
				     else if(select.value=='All students'||select.value=='Faculty'){
					document.getElementById('p').style.display = "none";
					document.getElementById('m').style.display = "none";
					document.getElementById('b').style.display = "none";
				   }
				} 
			</script>
				
		  </form>
		  </div>
		  </div>
		  <p style="color:red; text-align:center; margin-top:20px;"><?php echo $error;?></p>
		 <p style="color:green; text-align:center;"><?php echo $success;?></p>
                </div>
                 <?php 
include 'footer.php';
?>
</body>
</html>
