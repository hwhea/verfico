<?php
session_start();
//requirements for the settings section.
$g1 = rand(100,999);

//SETTINGS
$_SESSION['ver_uid'] = ""; //The session variable where your user ID is stored. 
$_SESSION['authKey'] = $uid . TIME(); //used to authenticate the user. 
$_SESSION['ver_tablename'] = "ver_verify"; //ver_verify is the default table name. You may change this. 
$_SESSION['ver_success'] = ""; //The page to navigate to on succesful email validation.
$_SESSION['ver_hostname'] = ""; //hostname for your database.
$_SESSION['ver_user'] = ""; //username for your database.
$_SESSION['ver_pass'] = ""; //password for your database. 
$_SESSION['ver_dbname'] = ""; //Change this to whatever you like. 

//Connect to the database. 
$db = mysqli_connect($_SESSION['ver_hostname'], $_SESSION['ver_user'], $_SESSION['ver_pass'], $_SESSION['ver_dbname']);
		if (mysqli_connect_errno()) {
  			echo "Failed to connect to database in ver settings. Check the settings file.";
  		}

 //require
require "classes/verfico.php";
$ver = new Verfico();

?>