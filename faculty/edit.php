<?php
include'config.php';
include'session.php';
$success="";
$message="";

	
	if(isset($_GET['id']))
	$id=$_GET['id'];
	
	if(isset($_POST['submit'])){
		$q="select * from notices where id='$id'";
				$result=mysqli_query($con, $q);
				$row=mysqli_fetch_assoc($result);
                $num=mysqli_num_rows($result);
				$notice=$row['pdf_src'];
				$title1=$row['title'];
				$title=$_POST['new'];
		$title=$_POST['new'];
		mysqli_query($con,"update notices set title='$title' where id='$id'");
		$q="insert into modifications values('$id','$title1','$notice')";
				mysqli_query($con, $q);
		header('location:rejected.php');
	}
	
if(isset($_POST['upload']))
{												
	$f_name =$_FILES['myfile']['name'];
	$f_tmp = $_FILES['myfile']['tmp_name'];
	$f_size = $_FILES['myfile']['size']; 
	$f_extension = explode('.',$f_name);
	$f_extension = strtolower(end($f_extension)); 			
	$f_newfile = uniqid().'.'.$f_extension; 				
	$store = "../admin/upload/".$f_newfile; 							
	if($f_extension=='pdf')
	{
		
		
			if(move_uploaded_file($f_tmp,$store))
			{
				$success= "Uploded";
				$q="select * from notices where id='$id'";
				$result=mysqli_query($con, $q);
				$row=mysqli_fetch_assoc($result);
                $num=mysqli_num_rows($result);
				$notice=$row['pdf_src'];
				$title=$row['title'];
				$q="update notices set pdf_src='$f_newfile' where id='$id'";
				mysqli_query($con, $q);
				$q="insert into modifications values('$id','$title','$notice')";
				mysqli_query($con, $q);
				header('location:rejected.php');
			}
	}
	else
	{
		$error= "you can upload pdf only";
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
				 <li><a href="index.php">Upload a notice</a></li>
				<li><a href="view.php">VIEW NOTICES</a></li>
                <li  class="active"><a href="rejected.php">NOTICE STATUS</a></li>
                <li><a href="update.php">Update info</a></li>
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
          <h2>Edit</h2>
         
        </div>

</section>
                <div class="clearfix"></div>
                <div class="row" >
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				</div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
						<form method="POST">
						<div class="form-group">
							<label>Enter new title</label>
							<input type="text" name="new" />
						</div>
						<div class="form-group">
						<button type="submit" name="submit" class="btn btn-default">EDIT</button>
						</div>
						</form>
					</div>
					</div>
					
				 <div class="row">
			 <div class="col-md-4">
			 </div>
			 <div class="col-md-4">
				<form action="" method="POST" enctype="multipart/form-data" style="margin-top:30px; margin-left:auto; margin-right:auto;">
				<div class="form-group">
				 <input type="file" name="myfile"  style="font-size:15px; color:black; "/>
				</div>
				<div class="form-group">
				 
			    <input type="submit" value="Upload" style="margin-left:30%;" name="upload"/>
				</div>
				</form>
				</div>
				</div>
				 <p style="color:green; text-align:center;"><?php echo $success;?></p>
				 <p style="text-align: center; color:blue;" ><?php echo $message;?></p>
                </div>
		
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
