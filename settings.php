<?php
session_start();
//requirements for the settings section.
$g1 = rand(100,999);

//SETTINGS
$_SESSION['ver_uid'] = ; //The session variable where your user ID is stored. 
$_SESSION['ver_tablename'] = "ver_verify"; //ver_verify is the default table name. You may change this. 
$_SESSION['ver_success'] = ""; //The page to navigate to on succesful email validation. Use ../ to go back a directory.
$_SESSION['ver_hostname'] = ""; //hostname for your database.
$_SESSION['ver_user'] = ""; //username for your database.
$_SESSION['ver_pass'] = ""; //password for your database. 
$_SESSION['ver_dbname'] = ""; //Change this to whatever you like. 
$_SESSION['ver_verifyURL'] = "http://mysite.com/verfico/verify.php"; //The URL of the verify.php page.


//EMAIL SETTINGS
$_SESSION['ver_fromemail'] = ""; //An email address from which your emails will be sent. 
$_SESSION['ver_subject'] = "Verify Your Account"; //The subject of the verification email.
$_SESSION['ver_message'] = "Click this link to verify your account: "; //the text before the link to the user is presented.

//Connect to the database. 
$db = mysqli_connect($_SESSION['ver_hostname'], $_SESSION['ver_user'], $_SESSION['ver_pass'], $_SESSION['ver_dbname']);
		if (mysqli_connect_errno()) {
  			die("Failed to connect to database in ver settings. Check the settings file.");
  		}

 //require
require "classes/verfico.php";

$ver = new Verfico();

?>