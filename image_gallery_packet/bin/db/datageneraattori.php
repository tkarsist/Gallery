<?php
datageneraattori("IMG_1059.JPG","SIKA");
function datageneraattori($img_name,$ownerX){
	include_once ('db_functions.php');
	$exif = exif_read_data($img_name, 0, true);

	$owner_atr="owner";
	$owner=$ownerX;
	for ( $counter = 1; $counter <= 2; $counter += 1) {
		foreach ($exif as $key => $section) {
			foreach ($section as $name => $val) {
				if ($name=="FileName"){
					//$img=$val;
					
					addImage($img_name.$counter);
					addImageAttributeV($img_name.$counter,$owner_atr,$owner);
					//delImage($val);
					//$id=getImageID($img);

				}
				else{
					
					addAttribute($name);
					addImageAttributeV($img_name.$counter,$name,$val);
					
					//$atr_id=getAttributeID($name);
					//delAttribute($name);
				}
				//echo $val."\n";
			}

		}
	}
}
	?>