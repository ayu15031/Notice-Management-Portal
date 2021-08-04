<?php
	include('config.php');
	include('header.php');
	$x="";
	//data recieved from previos page
	if(isset($_GET["data"]))
    {
        $data = $_GET["data"];
    }
	
	//Checking which login
	if($data==1){
			$x="Admin Login";	 //If admin login
			}
			else if($data==2){   //If faculty login
				$x="Faculty Login";
			}
			else if($data==3){   //If student login
				$x="Student Login";
			}
			else if($data==4){   //If student incharge login
				$x="Student Incharge Login";
			}
	
	
	$error="";
	
	//On submitting
	if(isset($_POST['submit']))
	{
		$uname = $_POST['uname']; //get username
		$pass= $_POST['pass'];    //get password
		
		if($uname=="" || $pass=="")
		{
			$error="Please enter all fields.";  //if field left blank
		}
		
		else{
			
			//firing queries for different values of data to login
			//admin
			if($data==1){
				$q= "select * from admin_login where username = '$uname' and password='$pass'";
				$result = mysqli_query($con, $q);
				$num = mysqli_num_rows($result);
				if($num==0){
					$error="Invalid Username or Password";
		        }
				else{
					session_start();
					$row = mysqli_fetch_assoc($result);
					$_SESSION['uname']=$uname;
					header('location:admin/index.php');
				}
			}
			//faculty
			else if($data==2){
				$q= "select * from faculty_login where username = '$uname' and password='$pass'";
				$result = mysqli_query($con, $q);
				$num = mysqli_num_rows($result);
				if($num==0){
					$error="Invalid Username or Password";
				}
				else{
					session_start();
					$row = mysqli_fetch_assoc($result);
					$_SESSION['uname']=$uname;
					$branch=$row['branch'];
					$_SESSION['branch']=$branch;
					header('location:faculty/index.php');
				}
			}
			//student
			else if($data==3){
				$q= "select * from student_login where username = '$uname' and password='$pass'";
				$result = mysqli_query($con, $q);
				$num = mysqli_num_rows($result);
				if($num==0){
					$error="Invalid Username or Password";
				}
				else{
					session_start();
					$row = mysqli_fetch_assoc($result);
					$_SESSION['uname']=$uname;
					header('location:student/index.php');
				}
			}
			//student incharge
			else if($data==4){
				$q= "select * from istudent_login where username = '$uname' and password='$pass'";
				$result = mysqli_query($con, $q);
				$num = mysqli_num_rows($result);
				if($num==0){
					$error="Invalid Username or Password";
				}
				else{
					session_start();
					$row = mysqli_fetch_assoc($result);
					$_SESSION['uname']=$uname;
					header('location:istudent/index.php');
				}
			}
		}
	}
		
?>

<!--header section-->
<section>
      <div class="container">
        <div class="section-header">
          <h2><?php echo $x;?></h2>
        </div>
	  </div>
</section>

<!--login form-->
<div class="container">
    <div class="row">
        <div class="col-md-4">
		</div>
		<div class="col-md-4" >
			<div class="form-login">
				<!--Showing error-->
				<p style="text-align:center; color:red;">
				<?php echo $error;?>
				</p>
				<form method="POST" class="form" style="margin-top:40px; margin-left:0;">
					<div class="form-group">
						<input type="text" name="uname" class="form-control" placeholder="username" />
					</div>
					<div class="form-group">
						<input type="password" name="pass"  class="form-control" placeholder="password" />
					</div>
					<!--Submit button-->
					<div class="wrapper">
						<span class="group-btn">
							<div class="form-group">     
								<input type="submit" name="submit" class="btn btn-info btn-md" value="Login"  />
							</div>
						</span>
					</div>
				</form>
			</div>
        </div>
    </div>
</div>

        
 
<!--including footer-->
<?php
	include('footer.php');
?>