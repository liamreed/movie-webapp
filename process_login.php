<?php
include_once 'functions.php';
include_once '../database.php';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
 	 
    if (login($email, $password, $pdo) == true) {
        // Login success 
        echo 'login successful';
        //header('Location: ../dashboard.php');
    } else {
        // Login failed 
        echo 'error';
        //header('Location: ../login.php?error=1');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}