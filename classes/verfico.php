<?php
session_start();
class Verfico{
	function __construct(){
		$db = mysqli_connect($_SESSION['ver_hostname'], $_SESSION['ver_user'], $_SESSION['ver_pass'], $_SESSION['ver_dbname']);
		if (mysqli_connect_errno()) {
  			echo "Failed to connect to database in ver class. Check the settings file.";
  		}
	}

	function verifyUser($uid){
		$update = $db->prepare("UPDATE " . $_SESSION['ver_tablename'] . "SET verified = 1 WHERE uid = ?");
		$update->bind_param("s",$uid);
		if($update->execute()){
			return true;
		} else {
			return false;
		}
	}

	function isVerified($user = null){
		if(!empty($user)){
			$uid = $user;
		} else {
			$uid = $_SESSION['ver_uid'];
		}
		$check = $db->prepare("SELECT * FROM " . $_SESSION['ver_tablename'] . " WHERE uid = ? AND verified = 1");
		$check->bind_param("s", $uid);
		$check->execute();
		$rows = $check->num_rows;
		if($rows === 1){
			return true;
		}else{
			return false;
		}
	}
}

?>