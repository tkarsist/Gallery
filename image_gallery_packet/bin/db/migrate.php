<?php
include('db_functions.php');
$table=listAllImages();

foreach($table as $key =>$val){
addImageAttributeV($val,"OriginalFileName", $val);
}

?>
