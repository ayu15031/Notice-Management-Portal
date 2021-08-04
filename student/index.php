<?php
include'config.php';
include'session.php';
	$sort="sort_date";
if(isset($_POST['change'])){
	$sort=$_POST['sorting'];
}
	
	
	$uname = $_SESSION['uname'];
	$result = mysqli_query($con,"select * from student_login where username='$uname'");
	$row = mysqli_fetch_assoc($result);
	$branch = $row['branch'];
	$year = $row['year'];
	$cource = $row['cource'];
     
	 
	if($sort=="sort_date"){
	$result = mysqli_query($con,"select * from student_notices where (cource='$cource' OR cource='All Students') AND (branch='$branch' OR branch='All Departments') AND (year='$year' OR year='All') ORDER BY date DESC");
	}
    else if($sort=="sort_branch"){
	$result = mysqli_query($con,"select * from student_notices where (cource='$cource' OR cource='All Students') AND (branch='$branch' OR branch='All Departments') AND (year='$year' OR year='All') ORDER BY sent_by ASC");
	}
	else if($sort=="sort_club"){
	$result = mysqli_query($con,"select * from student_notices where (cource='$cource' OR cource='All Students') AND (branch='$branch' OR branch='All Departments') AND (year='$year' OR year='All') ORDER BY club ASC");
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
				      <li class="actice"><a href="index.php">View notices</a></li>
                
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
          <h2>View Notices</h2>
         
        </div>

</section>  

<div class="container">
		   		 <div class="right_col" role="main">
            
              
				
				
				<!............................................department................................................>
				
					<div class="pull-right">
						<form name="myForm" method="POST">
						<select name="sorting">
						<option value="sort_date">SORT BY DATE</option>
						<option value="sort_branch">SORT BY BRANCH</option>
						<option value="sort_club">SORT BY CLUB</option>
						</select>
						 <input type="submit" value="Change" name="change1"/>
						</form>
					</div>
					
					
					<div class="clearfix"></div>
					<div class="row" style="min-height:500px">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
							   
								<div class="x_content">
									<table class="table table-striped" style="margin-top:30px;">
											  <thead>
											  <tr>
											 
											  <th>NOTICE</th>
											  <th>SENT BY</th>
											  <th>BRANCH</th>
											  <th>CLUB</th>
											  <th>Date and Time</th>
											  <th>Preview</th>
											  <th>ATTACHMENTS</th>
											 
											
											  </tr>
											  </thead>
											  <tbody>
									

									
									<?php
									
									
									while($row = mysqli_fetch_assoc($result)):
									
									   { 
										$sent_by = $row['sent_by'];
										$result1 = mysqli_query($con,"select * from faculty_login where email='$sent_by'");
										$row1 = mysqli_fetch_assoc($result1);
										$faculty_branch= $row1['branch'];
										?>
											<tr>
											
											<td><?php echo $row['title'];?></td>
											<td><?php echo $sent_by;?></td>
											<td><?php echo $faculty_branch;?></td>
											<td><?php echo $row['club'];?></td>
											<td><?php echo $row['date'];?></td>
											<td><a href="../admin/upload/<?php echo $row['pdf_src']?>">VIEW</a></td>
											<td><a href="add.php?id=<?php echo $row['id'];?>">VIEW</a></td>
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
				<!............................................club................................................>
			
				

            </div>
             
                     <!--  <a href="msg.php"><u>View previous requests</u></a>-->
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
