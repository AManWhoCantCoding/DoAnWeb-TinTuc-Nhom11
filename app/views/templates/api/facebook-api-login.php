<?php

// // Call Facebook API
// $fb = new Facebook\Facebook([
// 'app_id' => APP_ID,
// 'app_secret' => APP_SECRET,
// 'default_graph_version' => API_VERSION,
// ]);
// // Get redirect login helper
// $fb_helper = $fb->getRedirectLoginHelper();
// // Try to get access token
// try {
//    if(isset($_SESSION['facebook_access_token']))
//    {$accessToken = $_SESSION['facebook_access_token'];}
//  else
//    {$accessToken = $fb_helper->getAccessToken();}
// } catch(FacebookResponseException $e) {
//     echo 'Facebook API Error: ' . $e->getMessage();
//      exit;
// } catch(FacebookSDKException $e) {
//    echo 'Facebook SDK Error: ' . $e->getMessage();
//      exit;
// }

// // must be after new Facebook\Facebook becouse it inhert from him
// if (isset($accessToken))
// {
// 	if (!isset($_SESSION['facebook_access_token']))
// 	{
// 		//get short-lived access token
// 		$_SESSION['facebook_access_token'] = (string) $accessToken;

// 		//OAuth 2.0 client handler
// 		$oAuth2Client = $fb->getOAuth2Client();

// 		//Exchanges a short-lived access token for a long-lived one
// 		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
// 		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

// 		//setting default access token to be used in script
// 		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
// 	}
// 	else
// 	{
// 		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
// 	}

// 	//redirect the user to the index page if it has $_GET['code']
// 	if (isset($_GET['code']))
// 	{
// 		header('Location: ./');
// 	}


// 	try {
// 		$fb_response = $fb->get('/me?fields=name,first_name,last_name,email');
// 		$fb_response_picture = $fb->get('/me/picture?redirect=false&height=200');

// 		$fb_user = $fb_response->getGraphUser();
// 		$picture = $fb_response_picture->getGraphUser();

// 		$_SESSION['fb_user_id'] = $fb_user->getProperty('id');
// 		$_SESSION['fb_user_name'] = $fb_user->getProperty('name');
// 		$_SESSION['fb_user_email'] = $fb_user->getProperty('email');
// 		$_SESSION['fb_user_pic'] = $picture['url'];


// 	} catch(Facebook\Exceptions\FacebookResponseException $e) {
// 		echo 'Facebook API Error: ' . $e->getMessage();
// 		session_destroy();
// 		// redirecting user back to app login page
// 		header("Location: ./");
// 		exit;
// 	} catch(Facebook\Exceptions\FacebookSDKException $e) {
// 		echo 'Facebook SDK Error: ' . $e->getMessage();
// 		exit;
// 	}
// }
// ?>
