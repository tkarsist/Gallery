<?php
include ('image_functions.php');
//include ('db_functions.php');	

//exif lisays
//addExifFromDir("/gallery/mysql_funktiot/temp_image/");

//koko lisays
$dir="paska";
$owner="simo";
moveImagesToSystem($dir, $owner);

//hae kuvan attribuutit
//$koe=listAllImageAttributes("DSC_0914.JPG");
//tulostetaan koetaulukko
//foreach($koe as $key => $nimi){
	//echo $nimi."\n";
//	echo $nimi." : ".getImageAttributeV("DSC_0914.JPG",$nimi)."\n";
//}

?>