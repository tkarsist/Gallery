<?php

include ('funktiot.php');
include ('config_img_mgt.php');


?>

<?php
if (isset($_POST['valitut'])) {
    if (empty($_POST['kuvat'])) {
        echo "Et valinnut !";
    } else {
    	
    	$kuva_array=array();
        foreach ($_POST['kuvat'] as $kuva) {
		            	$kuva_array[]=$kuva;
        }
		sort($kuva_array);
		$_SESSION['kuva_taulu']=$kuva_array;

	
     
    
}
}
?>

<?php
if (isset($_POST['poisto'])) {
    if (empty($_POST['kuvat'])) {
        echo "Et valinnut !";
    } 
    else {
    remove_pic_permanent($_POST['kuvat']);
            			
   
}
}
?>

<?php
if (isset($_POST['palaa'])) {
		
		#include('formi.php');
 			
   
}
?>

<?php
if (isset($_POST['kuva_select'])) {
			include_once ('config_img_mgt.php');
			include_once ($db_functions_file);
		//if ($_POST['radio_sel']=="add"){
		foreach($_POST['kuvat'] as $key => $name){
			addImageToAlbum($name, $_POST['kuva_select']);
		}
}
			
		//}
		//}
			
		
		//if ($_POST['radio_sel']=="rem"){
		//	foreach($_POST['kuvat'] as $key => $name){
		//	delImageFromAlbum($name, $_POST['kuva_select']);
		//		foreach($_SESSION['kuva_taulu'] as $key2 =>$name2){
		//			if($name2==$name){
		//				unset($_SESSION['kuva_taulu'][$key2]);
		//			}
		//		}
			
		//}
   
?>

<?php
if (isset($_POST['rem_view'])) {
	remove_pic($_POST['kuvat']);
}
?>

<?php
if (isset($_POST['rem_img_alb'])) {
		include_once ('config_img_mgt.php');
		include_once ($db_functions_file);
	

	//if (!isset($_SESSION['alb_filter']) || $_SESSION['alb_filter']=="NotInAlb" || $_SESSION['alb_filter']=="All"){
		
		foreach($_POST['kuvat'] as $key => $name){
			delImageFromAlbum($name, $_SESSION['alb_filter']);
				foreach($_SESSION['kuva_taulu'] as $key2 => $name2){
					if($name2==$name){
						unset($_SESSION['kuva_taulu'][$key2]);
					}
				}
		}
	//}
}
?>



