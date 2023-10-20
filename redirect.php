<?php
session_start();
require 'vendor/autoload.php';


use League\OAuth2\Client\Provider\Google;

// Load your configuration from a file or environment variables
$clientId = '221514248537-gd95hcapbfgf3venm51gprrai8pumjja.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:4000/Open_Auth/Open-Auth/redirect.php';

$provider = new Google([
    'clientId'     => $clientId,
    'clientSecret' => $clientSecret,
    'redirectUri'  => $redirectUri,
]);

if (isset($_GET['code']) && isset($_GET['state'])) {
    if ($_GET['state'] !== $_SESSION['oauth2state']) {
        exit('Invalid state');
    }

    $token = $provider->getAccessToken('authorization_code', ['code' => $_GET['code']]);

    $user = $provider->getResourceOwner($token);

    // Store user information as needed and redirect to the dashboard.
    $_SESSION['user_name'] = $user->getName();
    header("Location: dashboard.php");
} else {
    exit('Invalid response');
}
