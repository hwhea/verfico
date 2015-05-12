<?php
require "settings.php";

if($_POST['submit']){
	if($ver->requestVerification($_POST['email'])){
		echo "<p style='color:green;'>Verification sent.</p>";
	} else {
		echo $verifyError;
	}
}

if($ver->isVerified()){
	echo "The current user is verified.";
	$userVerified = true;
} else {
	echo $_SESSION['ver_uid'] . "<br>";
	echo "The user is not verified.";
	$userVerified = false;
}

if($userVerified){
	?>
	<p>The reason that you are seeing this is because
		the current user is verified on the website.</p>
	<?php
}else{
	?>
	<form action="" method="post">
		<input type="email" name="email" placeholder="Email Address">
		<input type="submit" name="submit" value="Send Verification Email">
	</form>
	<?php
}
?>