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
			$w = fopen("setup_complete.ver", "true");
			echo "Setup completed correctly. Table created.";
		} else {
			echo "Setup failed. Check the settings.php file. It is likely that you have entered your DB connection details incorrectly. <br><br>" . $qry;
		}
	}else{
		echo "One or more of your fields was empty in settings.php";
	}
} elseif ($_GET['uninstall']==2) {
	if($_POST['submit']){
		$del = "DROP TABLE " . $_SESSION['ver_tablename'];
		if($db->query($del)){
			$verdir = scandir('');
			foreach($verdir as $file) {
				if(is_file($file)){
					unlink($file);
	  				echo $file . " deleted. <br>";
				}
			}
		}
	}
} else {
	if(file_exists ("setup_complete.ver")){
		echo "You have Verfico installed correctly. You can uninstall by using the ?uninstall=1 flag.";
	} else {
		echo "Verfico is not installed on this server. <br>";
		echo "Run with the ?setup=1 flag to begin setup.";
	}
}

?>

<form action="setup.php?uninstall=1" method="post">
	Warning: Uninstalling Verfico will completely remove all Verfico files and tables from your server and database.
	<input type="submit" value="Click here to confirm Verfico uninstallation." style="border:none;background-color:red;" name="submit">
</form>