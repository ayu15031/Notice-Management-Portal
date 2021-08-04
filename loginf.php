<?php
	include('config.php');
	include_once 'gpConfig.php';
    include_once 'User.php';

if(isset($_GET['code'])){
	
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
	//header('location:register.php?data=$userData["email"]');
}



if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	
	//Initialize User class
	$user = new User();
	
	//Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        //'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
		'link'          => $gpUserProfile['link']
    );
    $userData = $user->checkUser($gpUserData);
	
	//Storing user data into session
	//session_start();
	
	$_SESSION['userData'] = $userData;
	
	$_SESSION['email'] = $userData['email'];
	//setcookie ("mail", $userData['email'] ,time()+3600);
	
	//Render facebook profile data
	if(!empty($userData)){
		$email=$userData['email'];
		$q="select * from faculty_email where email='$email'";
		$result = mysqli_query($con,$q);
		$num = mysqli_num_rows($result);

		if($num>0){
			$output = '<a href="register.php">CONTINUE</a>';
		}
		else{
			$output = '<a href="logout.php">NO FACULTY EXIST. CLICK TO GO BACK</a>';
		}
        //$output = '<a href="register.php">CONTINUE</a>';
        /*$output .= '<img src="'.$userData['picture'].'" width="300" height="220">';
        $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
       // $output .= '<br/>Gender : ' . $userData['gender'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Google';
        $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Google+ Page</a>';
        $output .= '<br/>Logout from <a href="logout.php">Google</a>'; */
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
	$authUrl = $gClient->createAuthUrl();
	$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" style="height:200px; width:350px;" alt=""/></a>';
}
	
?>


<?php
	include('header.php');
	?>

<section>
      <div class="container">
        <div class="section-header">
          <h2>Faculty Login</h2>
         
        </div>

</section>

<div class="container">
    <div class="col-md-4">
		</div>
		 <div class="col-md-4" ><?php echo $output; ?></div>
        </div>

        
 </div>




<?php
	include('footer.php');
?>