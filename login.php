<?php
session_start();
require 'vendor/autoload.php';


use League\OAuth2\Client\Provider\Google;

//configurations 
$clientId = '221514248537-gd95hcapbfgf3venm51gprrai8pumjja.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:4000/Open_Auth/Open-Auth/redirect.php';

$provider = new Google([
    'clientId'     => $clientId,
    'clientSecret' => $clientSecret,
    'redirectUri'  => $redirectUri,
]);

// Generate a random hash and store in the session for security
$state = bin2hex(random_bytes(16)); 
$_SESSION['oauth2state'] = $state; 

$authUrl = $provider->getAuthorizationUrl(['state' => $state]);
echo "<a href='$authUrl'>Login with Google</a>";
