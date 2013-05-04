<?php
include_once('../../bin/db/db_functions.php');
$images=listAllOwnImages("timok");
foreach($images as $key=>$value){
if(getImageAttributeV($value, "ISOSpeedRatings")=="80"){
echo $value;
}


}
#$er="f/16";
#3$er="280/10";
#3$er="28/1";
#$er = preg_replace("/[^0-9]/", '', $er)*10;
#$er = preg_replace("/[^0-9]/", '', $er);

#list($pt1, $pt2) = split('[/.-]', $er);
#$er=$pt1/$pt2;

#koe=intval($er)/10;
#koe=inttval(intval($er)/10);
#$koe=$er;

#echo $koe;
?>
