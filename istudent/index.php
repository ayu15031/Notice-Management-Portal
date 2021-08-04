<?php
include'config.php';
include'session.php';
$uname=$_SESSION['uname'];
$q="SELECT * FROM istudent_login where username='$uname'";
$result=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($result);
$club=$row['club'];
	$error="";
	$success="";
	
	$q="";
	if(isset($_POST['submit']))
{   
	$title=$_POST['title'];												
	$f_name =$_FILES['myfile']['name'];
	$f_tmp = $_FILES['myfile']['tmp_name'];
	$f_size = $_FILES['myfile']['size']; 
	$f_extension = explode('.',$f_name);
	$f_extension = strtolower(end($f_extension)); 			
	$f_newfile = uniqid().'.'.$f_extension; 				
	$store = "../admin/upload/".$f_newfile; 
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
				$q="insert into notices(title, cource, branch, club, year, sent_by, pdf_src) values('$title', 'All students','All Departments', '$club','All', '$uname', '$f_newfile')";
			        mysqli_query($con, $q);
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
                $filePath = "../admin/upload/".$_FILES['upload']['name'][$i];

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
				 <li class="active"><a href="index.php">Upload notices</a></li>
				<li><a href="view_all.php">View all</a></li>
                <li><a href="view.php">View sent by you</a></li>
                <li><a href="update.php">Update info</a></li>
                <li><a href="password.php">Change Password</a></li>
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
          <h2>Upload</h2>
         
        </div>

</section>  
		
		
		
		   <div class="row">
		 <div class="col-md-4">
		 </div>
		 <div class="col-md-4">
		 
		  <form action="" method="POST" enctype="multipart/form-data" style="margin-top:30px; margin-left:auto; margin-right:auto;">
				<div class="form-group">
					<label >Title :</label>
					<input type="text" name="title" />
				</div>
				<div class="form-group">
				 <input type="file" name="myfile"  style="font-size:15px; color:black; "/>
		     	

				</div>
				<div class="form-group">
					<div>
						<label for='upload'>Select multiple Attachments:</label>
						<input id='upload' name="upload[]" type="file" multiple="multiple" />
					</div>
				</div>
				<div class="form-group">
				 
			    <input type="submit" value="Upload" style="margin-left:30%;" name="submit"/>

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
