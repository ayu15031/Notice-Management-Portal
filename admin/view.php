<?php
include'config.php';
include'session.php';

$uname = $_SESSION['uname'];
if($uname==""){
	header('location:../login.php?data=1');
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
          <h2>Modified Notices</h2>
         
        </div>

</section>

<div class="container">
    <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    
					

                    
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                   
					<div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            
                            <div class="x_content">
                               	<table class="table table-striped" style="margin-top:30px;">
										  <thead>
										  <tr>
										  <th>ID</th>
										  <th>TITLE</th>
										  <th>NOTICE</th>
										  <th>TIME</th>
										  </tr>
										  </thead>
										  <tbody>
								

                                
                                <?php
							
      
                                $data=mysqli_query($con,"SELECT * FROM modifications");
                                $rows=mysqli_num_rows($data);
                                while($arr=mysqli_fetch_assoc($data)):
                                
                                   {   
                                    ?>
									
										
										
										<tr>
										<td><?php echo $arr['id']?></td>
										<td><?php echo $arr['title']?></td>
										<td><a target="_blank" href="upload/<?php echo $arr['pdf_src']?>"><?php echo $arr['pdf_src']?></a></td>
										<td><?php echo $arr['date']?></td>
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
            </div>
             
                     <!--  <a href="msg.php"><u>View previous requests</u></a>-->
        </div> 				</div>
                <!-- <div class="col2">
                  
                  
                  
                </div>-->
            </div>
          <?php 
include 'footer.php';
?>
</body>
</html>
