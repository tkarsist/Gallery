<?php
function create_temp_dir($newdir){
#propertiestiedostossa on asetukset
include ('properties.php');
$real_dir=$base_dir.$newdir;
mkdir($real_dir, 0700);
return $real_dir;

}
function getTempDir(){
	$newdir= exec ("date|awk '{print $2,$3,$4}'|sed 's/:/_/g'|sed 's/ /_/g'");
	return $newdir;	
}
?>
