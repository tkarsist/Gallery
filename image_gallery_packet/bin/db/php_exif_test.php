<?php
include ('db_functions.php');
//echo "test1.jpg:<br />\n";
//$exif = exif_read_data('tests/test1.jpg', 'IFD0');
//echo $exif===false ? "No header data found.<br />\n" : "Image contains headers<br />\n";

$exif = exif_read_data('img01.jpg', 0, true);

foreach ($exif as $key => $section) {
    foreach ($section as $name => $val) {
    	if ($name=="FileName"){
    		$img=$val;
    		addImage($val);
			    		
    	}
    	else{
    	addAttribute($name);
    	addImageAttributeV($img,$name,$val);	
    	}
        
    }
$koe=listAllImageAttributes($img);
//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
	echo $nimi." : ".getImageAttributeV($img,$nimi)."\n";
}
}
?>