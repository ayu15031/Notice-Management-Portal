<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '463587160415-elukeqghtj616kg416c2atq3aam16vn6.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'RPcbtgMO74kmhU5q0_ZeC-Fs'; //Google client secret
$redirectURL = 'http://localhost/notice/loginf.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>