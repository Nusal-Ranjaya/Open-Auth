<?php
session_start();

if (isset($_SESSION['user_name'])) {
    $userName = $_SESSION['user_name'];
    echo "Hello, $userName! Welcome to Pandora Company Limited.";  
} else {
    header("Location: login.php");
}
