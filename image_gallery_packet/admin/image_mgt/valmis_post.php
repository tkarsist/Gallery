<?php
include_once('config_img_mgt.php');
include_once ($ldap_login_file);
if (isset($_POST['valmis'])) {
	
	#$datalines = file ("kuvat.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach($_SESSION['kuva_taulu'] as $key => $nimi){
		echo $nimi."<br>";
	}
	echo '</body></html>';
	die();
 
}
?>

