<?php
include'config.php';
include'session.php';



	$uname=$_SESSION['uname'];

if($uname==""){
	header('location:../login.php?data=1');
}
	if(isset($_GET['id']))
	$id=$_GET['id'];
	$result = mysqli_query($con,"select * from attachments where id='$id'");
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
			  <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Add<span class="caret"></span></a>
						  <ul class="dropdown-menu">
						  <li><a href="adda.php">Admin</a></li>
							  <li><a href="index.php">Student</a></li>
							  <li><a href="add_istudent.php">Student Incharge</a></li>
						  </ul>
				  </li>
				 <li><a href="upload.php">Upload</a></li>
                <li  class="active"><a href="request.php">Manage Notices</a></li>
                
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
          <h2>Attachments</h2>
         
        </div>

</section>
		
		
                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				</div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="x_panel">
                           
                            <div class="x_content">
                               	<table class="table table-striped" style="margin-top:30px;">
										  <thead>
										  <tr>
										  <th>Attachments</th>
										<th>Modify</th>
										  </tr>
										  </thead>
										  <tbody>
								

                                
                                <?php
							$result1 = mysqli_query($con,"select * from notices where id='$id'");
								$row1 = mysqli_fetch_assoc($result1);
								 if($row1['approval']=='0'){
									$status="Rejected";
								}
								else if($row1['approval']=='1'){
									$status="Accepted";
								}
								else
									$status="Pending";
								$i=0;
                                while($row = mysqli_fetch_assoc($result)):
                                
                                   { 
								   $i=$i+1;
                                    ?>
										<tr>

										<td><a href="upload/<?php echo $row['attachment']?>">ATTACHMENT <?php echo $i?></a></td>
										<?php if($status=='Pending') {?>
										<td><select onchange="location= this.value">
										<option label=" "></option>
										<option value="delete1.php?id=<?php echo $row['id'];?>&src=<?php echo $row['attachment'];?>">Delete</option>
										<option value="edit1.php?id=<?php echo $row['id'];?>&src=<?php echo $row['attachment'];?>">Update</option>
										</select>
										</td>
										<?php } ?>
										</tr>
		                 
                                    <?php
                                  
                                }endwhile;
                            
                                ?>

			</tbody>
					</table>
					</div>
					</div>
					</div>
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
