<?php
session_start();
if (isset($_GET['album'])) {

    		
			
    		include_once('config_pub_ui.php');
			include_once($db_functions_file);
			//korjaa id:seen alla olevat
			$album_safe=strip_tags($_GET['album']);
			$albumi=getAlbumNameByID($album_safe);
			$_SESSION['albumi']=$albumi;
			//$_SESSION['albumi']=$_GET['album'];
			$_SESSION['kuvat']=listAllImagesInAlbum($_SESSION['albumi']);
    		
	}	   

?>

<html> <head> <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"> 
<title>Albumit</title> <link rel="stylesheet" href="style.css" type="text/css"> </head> 
<body bgcolor="#FFFFff" text="#FFFFFF"> 
<table width="100%">
<tr><td width="20%" class="texttop">
<a href="index.php">Paluu</a>
</td>
<td class="texttop">
Albumi --
<?php
echo $_SESSION['albumi'];
?>
</td>
</tr>
</table>
<hr size="1">

<?php

foreach ($_SESSION['kuvat'] as $key =>$nimi){

		echo '<div class="img">';
		echo '<a href="album_det.php?image='.$nimi.'"><img src="/processed/thumb/'.$nimi.'.thumb.jpg" alt="'.$nimi.'" border="0"></a>';
		echo '</div>';
	}

?>



</body>
</html>