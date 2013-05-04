<?php
$er="f/16";
$er="280/10";
$er="28/1";
#$er = preg_replace("/[^0-9]/", '', $er)*10;
#$er = preg_replace("/[^0-9]/", '', $er);

list($pt1, $pt2) = split('[/.-]', $er);
$er=$pt1/$pt2;

#koe=intval($er)/10;
#koe=inttval(intval($er)/10);
$koe=$er;

echo $koe;
?>
