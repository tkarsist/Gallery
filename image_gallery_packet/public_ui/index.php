<html> <head> <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"> 
<title>Albumit</title> <link rel="stylesheet" href="style.css" type="text/css"> </head> 
<body bgcolor="#FFFFff" text="#FFFFFF"> <span class="texttop">Albumit </span> 
<br> <hr size="1">

<?php
include_once('config_pub_ui.php');
include_once ($db_functions_file);
$albumit=listAllAlbums();
foreach ($albumit as $key =>$nimi){
	//tulostaa vain julkiset albumit
	if(getAlbumAttributeV($nimi,"status")==$statuslevel&&($owner=="-1"||getAlbumAttributeV($nimi,"owner")==$owner)){
	$thumb="";
	$thumb=getRandomImageFromAlbum($nimi);
	if (!$thumb==""){
		echo '<div class="img">';
		//alla oleva korjaa id:n
		echo '<a href="album.php?album='.getAlbumID($nimi).'"><img src="/processed/thumb/'.$thumb.'.thumb.jpg" alt="'.$thumb.'" border="0"></a>';
		
		//echo '<a href="album.php?album='.$nimi.'"><img align="center" src="/processed/thumb/'.$thumb.'.thumb.jpg" title="dsc_1135.jpg" border="0"></a>';
		echo '<div class="desc">'.$nimi.'</div>';
		echo '</div>';
	}
	}
}
?>



</body>
</html>