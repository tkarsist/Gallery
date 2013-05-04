<?php
include_once("image_functions.php");

// config 
$lockfile = './cronjob.lock'; // lockfile name 
 
//how many minutes to just sit there before removing a stale lockfile and trying again  
//in case of failure on prior run 
$hardstart = 60;  
 
// end config 
////////////////////////////////////////// 
 
//is lockfile stale ? 
$seconds = $hardstart * 60; 
if (file_exists("$lockfile")){ 
        if (file_exists("$lockfile") && ((time() - filemtime("$lockfile")) > $seconds)) { 
                if (unlink("$lockfile")){ 
                        $del = $del + 1; 
                        echo "Deleted: $lockfile "; 
                } 
        } else { 
        echo "\n".'last batch is still running. Exiting '."\n"; die(); 
           } 
} else { 
// create lockfile and start fetching 
$handle = fopen("$lockfile", "w");  
$stamp = date("YmdHis"); 
fwrite($handle , $stamp); 
fclose($handle); 
 
// put the rest of your script here 
while(moveImagesFromQueueToSystem()){

} 
 
// remove the lockfile just before exiting ... 
 unlink("$lockfile"); 
} 
//  die() is preferable to exit()  on command line scripts,  while very similar 
// die() halts processing and immdediatly frees the resources, exit() actually  
// continues to be parsed, and only frees resources afterwards. 
die(); 


?>