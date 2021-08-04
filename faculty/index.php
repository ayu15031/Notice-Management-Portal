<?php
include'config.php';
include'session.php';

	$email=$_SESSION['email'];
	$q="select * from users where email='$email'";
	$result = mysqli_query($con,$q);
	$row=mysqli_fetch_assoc($result);
	$uname=$row['first_name'];
	
	$q="select * from faculty_login where email='$email'";
	$result = mysqli_query($con,$q);
	$row= mysqli_fetch_assoc($result);
	$_SESSION['branch'] = $row['branch'];
	$error="";
	$success="";
	$q="";
	if(isset($_POST['submit']))
  { 

    $students=$_POST['students'];
	$branch1=$_POST['branch1'];			
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
				if($students=='BTech'){
					$l=0;
				if(!empty($_POST['1B'])){
					
					$q="insert into notices(title, cource, branch, year, pdf_src, sent_by) values('$title','$students', '$branch1', 'I year', '$f_newfile', '$email')";
			        mysqli_query($con, $q);
					$l=$l+1;
				}
				if(!empty($_POST['2B'])){
					
					$q="insert into notices(title, cource, branch, year, pdf_src, sent_by) values('$title','$students', '$branch1', 'II year', '$f_newfile', '$email')";
			        mysqli_query($con, $q);
					$l=$l+1;
				}
				if(!empty($_POST['3B'])){
					
					$q="insert into notices(title,cource, branch, year, pdf_src, sent_by) values('$title','$students', '$branch1', 'III year', '$f_newfile', '$email')";
			        mysqli_query($con, $q);
					$l=$l+1;
				}
				if(!empty($_POST['4B'])){
					
					$q="insert into notices(title, cource, branch, year, pdf_src, sent_by) values('$title', '$students', '$branch1', 'IV year', '$f_newfile', '$email')";
			        mysqli_query($con, $q);
					$l=$l+1;
				}
				if($l==0){
				$error="Select atleast one year";
				}
				
			}
			
			elseif($students=='All students'){
				$q="insert into notices(title, cource, branch, year, pdf_src, sent_by) values('$title','$students', '$branch1', 'All', '$f_newfile', '$email')";
			        mysqli_query($con, $q);
				
 			}
			
			else if($students=='Phd'){
				$m=0;
				if(!empty($_POST['1P'])){
					
					$q="insert into notices(title, cource, branch, year, pdf_src, sent_by) values('$title', '$students', '$branch1', 'On Campus', '$f_newfile', '$email')";
			        mysqli_query($con, $q);
					$m=$m+1;
				}
				 if(!empty($_POST['2P'])){
					
					$q="insert into notices(title, cource, branch, year, pdf_src, sent_by) values('$title', '$students', '$branch1', 'Off Campus', '$f_newfile', '$email')";
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
					
					$q="insert into notices(title, cource, branch, year, pdf_src, sent_by) values('$title','$students', '$branch1', 'I Year', '$f_newfile', '$email')";
			        mysqli_query($con, $q);
					$n=$n+1;
				}
				 if(!empty($_POST['2M'])){
					
					$q="insert into notices(title, cource, branch, year, pdf_src, sent_by) values('$title','$students', '$branch1', 'II Year', '$f_newfile', '$email')";
			        mysqli_query($con, $q);
					$n=$n+1;
				}
				
				if($n==0){
				$error="Select atleast one year";
				}
			}
			
			else if($students=='Faculty'){
				$q="insert into notices(title, cource, branch, year, pdf_src, sent_by) values('$title','$students', '$branch1', 'NULL', '$f_newfile', '$email')";
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
					$q="select * from notices where title='$title' AND sent_by='$email'";
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
<?php
include 'header.php';
?>

  
   
		  <div class="row">
		 <div class="col-md-5">
		 </div>
		 <div class="col-md-4">
		 
		 <form action="" method="POST" enctype="multipart/form-data" style="margin-top:30px; margin-left:auto; margin-right:auto;">
				<div class="form-group">
					<label >Title :</label>
					<input type="text" name="title" />
				</div>
				<div class="form-group">
				<label >Select Type :</label>
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
				<div class="form-group">
				 <label>Select notice</label>
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
