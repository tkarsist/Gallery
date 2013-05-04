<?php

include_once ('config_img_mgt.php');
include_once ('funktiot.php');
include_once ($image_functions_file);
include_once ($db_functions_file);

?>
<?php
if (isset($_GET['kuva'])) {

	foreach($_SESSION['kuva_taulu'] as $key => $nimi){
		if ($_GET['kuva']==$nimi){
			$taulu=array_navigate($_SESSION['kuva_taulu'],$key);
			$next_image=$_SESSION['kuva_taulu'][$taulu['next']];
			$prev_image=$_SESSION['kuva_taulu'][$taulu['prev']];

		}
	}
	$_SESSION['current_image']=$_GET['kuva'];
	$_SESSION['next_image']=$next_image;
	$_SESSION['prev_image']=$prev_image;
}

?>

<?php
if (isset($_POST['poisto'])) {
	if (empty($_POST['kuvat'])) {
		echo "Et valinnut !";
	}
	else {

		remove_pic_permanent($_POST['kuvat']);
			
		foreach($_SESSION['kuva_taulu'] as $key => $nimi){
			if ($_SESSION['next_image']==$nimi){
					
				$taulu=array_navigate($_SESSION['kuva_taulu'],$key);
				$next_image=$_SESSION['kuva_taulu'][$taulu['next']];
				$prev_image=$_SESSION['kuva_taulu'][$taulu['prev']];
					
					
			}
		}
		$_SESSION['current_image']=$_SESSION['next_image'];
		$_SESSION['next_image']=$next_image;
		$_SESSION['prev_image']=$prev_image;


	}
}
?>

<?php
if (isset($_POST['arvosana'])) {
	//echo $_POST['arvosana'];
	switch ($_POST['arvosana']) {
		case "aarhg...":
			$value="1";
			break;
		case "no jaaa...":
			$value="2";
			break;
		case "Menettelee":
			$value="3";
			break;
		case "Aika kurko":
			$value="4";
			break;
		case "Megasumee!!!":
			$value="5";
			break;

	}

	if(getImageAttributeV($_SESSION['current_image'], "owner")==$_SESSION['hiiripippeli']){
	$atr_name="ownRating";
	addAttribute($atr_name);
	addImageAttributeV($_SESSION['current_image'],$atr_name,$value);
	$_SESSION[$_SESSION['current_image']]=$_POST['arvosana'];
	}


}

?>
<?php
if (isset($_POST['kuvakoko'])) {
	if (empty($_POST['kuvakoko'])) {

	}
	else {
		$_SESSION['size']=$_POST['kuvakoko'];
	}
}
?>

<?php
if (isset($_POST['Albumit'])) {
	if (empty($_POST['Albumit'])) {
		//echo "ei menty";
	}
	else {
		if(isImageInAlbum($_SESSION['current_image'], $_POST['Albumit'])=="1"){

			addImageToAlbum($_SESSION['current_image'], $_POST['Albumit']);
		}
		else{
			delImageFromAlbum($_SESSION['current_image'], $_POST['Albumit']);
		}
	}
}
?>

<?php
if (isset($_POST['paivita_kuv'])) {
	
	if(getImageAttributeV($_SESSION['current_image'], "owner")==$_SESSION['hiiripippeli']){
	$atr_name="own_description";
	addAttribute($atr_name);
	addImageAttributeV($_SESSION['current_image'], $atr_name, $_POST['kuvaus']);
	}
}
?>

