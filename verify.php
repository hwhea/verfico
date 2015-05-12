<?php
//required
require "settings.php";

//Get email and authcode from the URL.
$e = $_GET['e'];
$authcode = $_GET['auth'];

$stmt = $db->prepare("SELECT * FROM " . $_SESSION['ver_tablename'] . "WHERE uid = ? AND verified = 0");
$stmt->bind_param("ss",$uid);
$uid = $_SESSION['ver_uid'];
$stmt->execute();

$rows = $stmt->num_rows;

if ($rows > 0) { //if authcode posted = authcode in db where email = $e.
	$verify = $ver->verifyUser($uid);
	if($verify){
		if($ver->isVerified()){
			echo "<script>window.location='" . $_SESSION['ver_success'] . "';</script>";
		} else {
			$error = "There was an unexpected error in your request. Report this error code : 001";
		}
	} else {
		$error = "The Verfico verification update failed. Check your settings file.";
	}
} else {
	$error = 1;
}

echo $error . if(empty($error)){echo "There were no errors.";}else{echo "An error occured";}; 


?>