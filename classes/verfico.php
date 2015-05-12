<?php
session_start();
class Verfico{
	function __construct(){
		$db = mysqli_connect($_SESSION['ver_hostname'], $_SESSION['ver_user'], $_SESSION['ver_pass'], $_SESSION['ver_dbname']);
		if (mysqli_connect_errno()) {
  			echo "Failed to connect to database in ver class. Check the settings file.";
  		}
  		$this->db = $db;
	}

	function verifyUser($uid){
		$update = $this->db->prepare("UPDATE " . $_SESSION['ver_tablename'] . " SET verified=1 WHERE uid=?");
		$update->bind_param("s", $uid);
		if($update->execute()){
			return true;
		} else {
			return false;
		}
	}

	function isVerified(){
		$tbl = $_SESSION['ver_tablename'];
		$uid = $_SESSION['ver_uid'];
		$check = $this->db->prepare("SELECT * FROM $tbl WHERE uid = ? AND verified = 1");
		$check->bind_param("s", $uid);
		$check->execute();
		$check->store_result(); 
		$rows = $check->num_rows;
		if($rows == 1){
			return true;
		}else{
			return false;
		}
	}

	function requestVerification($email){
		//send the email
		$key = time() . rand(100,999);
		$uid = $_SESSION['ver_uid'];
		$keylink = $_SESSION['ver_verifyURL'] . "?u=" . $uid . "&auth=" . $key;
		$to = $email;
		$from = $_SESSION['ver_fromemail'];
		$subject = $_SESSION['ver_subject'];
		$message = $_SESSION['ver_message'] . $keylink;
		$headers = "From: " . $from;
		if(mail($to, $subject, $message, $headers)){
			$ins = $this->db->prepare("INSERT INTO " . $_SESSION['ver_tablename'] . " (`uid`, `email`, `ver_key`) VALUES ( ?, ?, ?)");
			$ins->bind_param("sss", $uid, $email, $key);
			if($ins->execute()){
				return true;
			} else {
				$verifyError = "Database insert error. Check settings.php and ensure that you've run setup.php";
				return false;
			}
		} else {
			$verifyError = "Couldn't send email. Check email settings in the settings.php file.";
			return false;
		}
	}

	function resendVerification($email){
		$uid = $_SESSION['ver_uid'];
		$clear = $this->db->prepare("DELETE FROM " . $_SESSION['ver_tablename'] . " WHERE uid = ?");
		$clear->bind_param("s", $uid);
		if($clear->execute()){
			if($this->requestVerification($email)){
				return true;
			}
		}else{
			$resendError = "Error executing delete query. Check database settings.";
			return false;
		}
	}

}

?>