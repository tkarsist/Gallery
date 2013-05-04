<?php
session_start();
include_once('config_pub_ui.php');
include_once('album_det_get.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title></title>

<link rel="stylesheet" href="style.css" type="text/css">

</head>
<!-- ei lataa arvostelu java-skriptia, jos kuvaa ei ole arvostelu -->
<BODY>
<table width="100%">
<tr>
<td class="texttop" width="20%">
<?php
include_once('config_pub_ui.php');
include_once ($db_functions_file);
//korjaa id:n
echo '<a href="album.php?album='.getAlbumID($_SESSION['albumi']).'">Paluu</a>';
//echo '<a href="album.php?album='.$_SESSION['albumi'].'">Paluu</a>';
?>
</td>
<td class="texttop" style="padding-left:20px">
<?php
include_once('config_pub_ui.php');
include_once ($db_functions_file);
echo $_SESSION['albumi']." -- ".getImageAttributeV($_SESSION['current_image'],"OriginalFileName");
?>
</td>
<td align="right">
<form name="size_f" method="get" action="album_det.php?image=<?php echo $_SESSION['current_image'].'&';?>">

<select name="size" OnChange ="document.size_f.submit()">
<!-- <noscript><input type="submit" value="go"></noscript>  -->

<?php if (!isset($_SESSION['size'])){
	$_SESSION['size']="800_600";
}
?>
<option value="800_600"<?php if ($_SESSION['size']=="800_600") {echo " SELECTED";} ?>>800x600
</option><option value="1024_768"<?php if ($_SESSION['size']=="1024_768") {echo " SELECTED";} ?>>1024x768
</option><option value="1280_960"<?php if ($_SESSION['size']=="1280_960") {echo " SELECTED";} ?>>1280x960
</option><option value="1400_1050"<?php if ($_SESSION['size']=="1400_1050") {echo " SELECTED";} ?>>1400x1050
</option><option value="1600_1200"<?php if ($_SESSION['size']=="1600_1200") {echo " SELECTED";} ?>>1600x1200
</option></select>
</form>
</td>
</tr>
</table>

<hr size="1">

<table style="text-align: left; width: 100%;">
<tbody>
<tr bgcolor="#000000">
<td style="width: 20%;" valign="top">
<table>
<tbody>
<tr>

<td valign="bottom" bgcolor="#232323" align="right" class="bodytext">
Edellinen <br>
<?php
echo '<a href="album_det.php?image='.$_SESSION['prev_image'].'"><img src="'.$location."thumb"."/".$_SESSION['prev_image'].'.thumb.jpg"></a><br>'."\n";
?>
<br>
</td>
</tr>
<tr>
<td bgcolor="#f3f2c0" style="vertical-align: top;">
<br>
<?php
include_once('config_pub_ui.php');
include_once ($db_functions_file);
echo "Nimi: ".$_SESSION['current_image']."<br>";
$kuvaatr=listAllImageAttributesByLevel($_SESSION['current_image'],"1");

//tulostetaan koetaulukko
foreach($kuvaatr as $key => $nimi){
		//$arvo=getImageAttributeV($_SESSION['current_image'],$nimi);
        //echo $nimi." : ".$arvo."<br>";
        echo $nimi." :  ";
        echo getImageAttributeV($_SESSION['current_image'],$nimi);
		echo "<br>";	
}

?>

</td>
</tr>
</tbody>
</table>
</td>

<td style="vertical-align: top; width="80%"">

<td style="vertical-align: top;" align="center" bgcolor="#000000">
<!-- iso kuva ja linkki siita seuraavaan -->
<div class="img">
 <?php
			echo '<a href="album_det.php?image='.$_SESSION['next_image'].'"><img src="'.$location.$_SESSION['size']."/".$_SESSION['current_image'].".".$_SESSION['size'].".jpg".'"></a>'."\n";
?>
 
 <div class="desc">
 <?php
echo getImageAttributeV($_SESSION['current_image'],"own_description");

 ?>
</div>
</div>
</td>
</tr>
</tbody>
</table>

</body></html>