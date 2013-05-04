<?php
//funktio ottaa koko polun parametrina missa on kuvat joiden exifit pitaa vieda kantaan, owner pitaa olla mukana
//poistuva funktio
function addExifFromDir($dir, $owner){
	include_once ('db_functions.php');
	# $dir setataan muualla esim exec pwd:lla
	if (is_dir($dir)) {
		if ($dh=opendir($dir)){
			#tehdaan taulukko tiedostoja varten
			$dir_array=array();
			#luetaan kaikki tiedostot
			while (($file=readdir($dh))!==false){

				#otetaan tiedotpaatteet                                                                                             ;
				$joku=substr(strrchr($file, '.'), 1);
				#valitaan vain kuvat
				if($joku=="jpg" || $joku=="JPG"){
					#thumbnailit jatetaan pois
					if(stristr($file, "thumb.jpg") === FALSE){
						$dir_array[]=$file;
					}
				}
			}
			closedir($dh);
		}
	}
	sort($dir_array);
	foreach($dir_array as $filu){
	 //echo $dir.$filu;
		$exif = exif_read_data($dir.$filu, 0, true);

		foreach ($exif as $key => $section) {
			foreach ($section as $name => $val) {
				if ($name=="FileName"){
					$img=$val;
					$owner_atr="owner";
					//delImage($val);
					addImage($img);
					addAttribute($owner_atr);
					addImageAttributeV($img,$owner_atr,$owner);
					//$id=getImageID($img);

				}
				else{
					//$atr_id=getAttributeID($name);

					//delAttribute($name);
					addAttribute($name);
					addImageAttributeV($img,$name,$val);
				}

			}

		}
	}
}

//poistuva-funktio

//kutsuu addExifFromDir:ia ja vie skaalaa kuvat ja vie ne oikeisiin hakemistoihin ja tietenkin exifit kantaan
function moveImagesToSystem($dir,$owner){
	include_once ('dbconfig.php');
	$fulldir=$basedir.$dir."/";
	$param='sh /gallery/php_image/generate_php.sh '.$dir;
	addExifFromDir($fulldir, $owner);
	echo exec($param);


}

function delImageFromSystem($img_name, $owner){
	include_once ('db_functions.php');
	include_once('dbconfig.php');
	//valiaikaisesti poistettu
	//include ('config.php');
	$atr_name="owner";
	if (getImageAttributeV($img_name, $atr_name)==$owner){
	delImage($img_name);
	$thumb=$processeddir."thumb/".$img_name.".thumb.jpg";
	$X800_600=$processeddir."800_600/".$img_name.".800_600.jpg";
	$X1024_768=$processeddir."1024_768/".$img_name.".1024_768.jpg";
	$X1280_960=$processeddir."1280_960/".$img_name.".1280_960.jpg";
	$X1400_1050=$processeddir."1400_1050/".$img_name.".1400_1050.jpg";
	$X1600_1200=$processeddir."1600_1200/".$img_name.".1600_1200.jpg";
	$full=$processeddir."full/".$img_name;
	unlink($thumb);
	unlink($X800_600);
	unlink($X1024_768);
	unlink($X1280_960);
	unlink($X1400_1050);
	unlink($X1600_1200);
	unlink($full);
	}
}


//uusi funktio, menee tauluun, joka toimii tyojonona
function addImagesFromDirToWorkQueue($dir_short, $owner){
	include_once ('db_functions.php');
	include_once ('dbconfig.php');
	$dir=$basedir.$dir_short."/";

	//echo exec('cd ".$dir."; for file in *; do mv "$file" `echo $file | sed -e '."'s/  */_/g' -e 's/_-_/-/g'`; done");
	
	# $dir on koko polku
	if (is_dir($dir)) {
		if ($dh=opendir($dir)){
			#tehdaan taulukko tiedostoja varten
			$dir_array=array();
			#luetaan kaikki tiedostot
			while (($file=readdir($dh))!==false){

				#otetaan tiedotpaatteet                                                                                             ;
				$joku=substr(strrchr($file, '.'), 1);
				#valitaan vain kuvat
				if($joku=="jpg" || $joku=="JPG"){
					$dir_array[]=$file;

				}
			}
		}
		closedir($dh);
	}

	foreach($dir_array as $filu){

		addImageToWorkQueue($filu, $dir, $owner);
	}
}

//funktio, joka purkaa jonoa
function moveImagesFromQueueToSystem(){
	include_once ('db_functions.php');
	include_once ('dbconfig.php');
	//haetaan seuraava jonosta
	$row=getImageFromWorkQueue();
	$filu=$row[0];
	$dir=$row[1];
	$owner=$row[2];

	//luetaan exiffit
	if($filu!="" && $dir!="" && $owner!=""){
	$exif = exif_read_data($dir.$filu, 0, true);
	
	//tahan valiin tulee tiedoston nimen muuttaminen ja generointi
	$aikaleima=date("Ymdhis");
	$random_num=rand(1000,9999);
	$unique_filename=$aikaleima.$random_num.".jpg";
	rename($dir.$filu, $dir.$unique_filename);
	
	convertAndMoveImage($dir.$unique_filename);
	foreach ($exif as $key => $section) {
		foreach ($section as $name => $val) {
			if ($name=="FileName"){
				$img=$val;
				$owner_atr="owner";
				$orig_name="OriginalFileName";
				//delImage($val);
				addImage($unique_filename);
				addAttribute($owner_atr);
				addAttribute($orig_name);
				addImageAttributeV($unique_filename,$orig_name,$img);
				addImageAttributeV($unique_filename,$owner_atr,$owner);
				//$id=getImageID($img);

			}
			else{
				//$atr_id=getAttributeID($name);

				//delAttribute($name);
				addAttribute($name);
				addImageAttributeV($unique_filename,$name,$val);
			}

		}
	}
	
	delImageFromQueue($row);
	echo exec("rmdir ".$dir);
	return true;
	}
	return false;
}

function convertAndMoveImage($img_name_full){
	include('dbconfig.php');
	if(file_exists($img_name_full)){
		$X1600_1200="convert -quality 95 -auto-orient -sample 1800x1200 ".$img_name_full." ".$img_name_full.".1600_1200.jpg";
		$X1400_1050="convert -quality 95 -auto-orient -sample 1575x1050 ".$img_name_full." ".$img_name_full.".1400_1050.jpg";
		$X1280_960="convert -quality 95 -auto-orient -sample 1440x960 ".$img_name_full." ".$img_name_full.".1280_960.jpg";
		$X1024_768="convert -quality 95 -auto-orient -sample 1152x768 ".$img_name_full." ".$img_name_full.".1024_768.jpg";
		$X800_600="convert -quality 95 -auto-orient -sample 900x600 ".$img_name_full." ".$img_name_full.".800_600.jpg";
		$Xthumb="convert -thumbnail 400x150 ".$img_name_full. " ".$img_name_full.".thumb.jpg";
		echo exec($X1600_1200);
		echo exec($X1400_1050);
		echo exec($X1280_960);
		echo exec($X1024_768);
		echo exec($X800_600);
		echo exec($Xthumb);
		echo exec("mv ".$img_name_full." ".$processeddir."full/");
		echo exec("mv ".$img_name_full.".1600_1200.jpg ".$processeddir."1600_1200/");
		echo exec("mv ".$img_name_full.".1400_1050.jpg ".$processeddir."1400_1050/");
		echo exec("mv ".$img_name_full.".1280_960.jpg ".$processeddir."1280_960/");
		echo exec("mv ".$img_name_full.".1024_768.jpg ".$processeddir."1024_768/");
		echo exec("mv ".$img_name_full.".800_600.jpg ".$processeddir."800_600/");
		echo exec("mv ".$img_name_full.".thumb.jpg ".$processeddir."thumb/");
	}
}
?>