<?php
include ('functions.php');
$short=getTempDir();
$long=create_temp_dir($short);
echo $short;
echo $long;
?>
