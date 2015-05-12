<?php
require "settings.php";
if($_GET['setup']==1){
	if(empty($_SESSION['ver_uid']) || empty($_SESSION['ver_tablename']) || empty($_SESSION['ver_success']) || empty($_SESSION['ver_hostname']) || empty($_SESSION['ver_user']) || empty($_SESSION['ver_pass']) || empty($_SESSION['ver_dbname']) || empty($_SESSION['ver_verifyURL']) || empty($_SESSION['ver_fromemail']) || empty($_SESSION['ver_subject']) || empty($_SESSION['ver_message'])){
		$tbl = $_SESSION['ver_tablename'];
		$qry = "CREATE TABLE `$tbl`
				(
				verID int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				uid int(50),
				email varchar(255),
				ver_key varchar(15),
				verified int(1)
				)";
		if($db->query($qry)){
			//$w = fopen("setup_complete.ver", "true");
			echo "Setup completed correctly. Table created.";
		} else {
			echo "Setup failed. Check the settings.php file. It is likely that you have entered your DB connection details incorrectly. <br><br>" . $qry;
		}
	}else{
		echo "One or more of your fields was empty in settings.php";
	}
} else {
	echo "No setup flag specified.";
}

?>