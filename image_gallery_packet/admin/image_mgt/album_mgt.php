<?php
session_start();
if (!isset($_SESSION['hiiripippeli'])){
	die();
}
?>
<?php
include_once ('config_img_mgt.php');
include_once ($db_functions_file);
?>
<?php
if (isset($_POST['alb_nimi'])) {
	if (empty($_POST['alb_nimi'])) {

	}
	else {
		addOwnAlbum($_POST['alb_nimi'],$_SESSION['hiiripippeli']);
	}
}
if (isset($_POST['Albumit'])) {
	if (empty($_POST['Albumit'])) {
		//echo "ei menty";
	}
	else {
		delOwnAlbum($_POST['Albumit'], $_SESSION['hiiripippeli']);
	}
}

if (isset($_POST['Albumi_status'])) {
	if (empty($_POST['albumi_hid'])) {

	}
	else {
		$atr_name_own="owner";
		if(getAlbumAttributeV($_POST['albumi_hid'],$atr_name_own)==$_SESSION['hiiripippeli']){
		
		$atr_name_X="status";
		addAlbumAttribute($atr_name_X);
		
		addAlbumAttributeV($_POST['albumi_hid'],$atr_name_X, $_POST['Albumi_status']);
		}
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<title>Kuvien Luokittelu</title>
</head>

<BODY>
<form action="album_mgt.php" method="post"><b>Anna albumin nimi:</b> <input
	name="alb_nimi" size="40" maxlength="40" type="text">
<input value="Lisää" type="submit"></form>
<hr size="1">
<br>
<div>
<form name="Albumi" method="post" action="album_mgt.php"><b>Poista albumi:</b>
<select name="Albumit" onchange="document.Albumi.submit()">
<option selected value=""></option>
<?php
include_once ($db_functions_file);
$albumi_lista=listAllOwnAlbums($_SESSION['hiiripippeli']);
if(isset($albumi_lista)){
foreach($albumi_lista as $key => $nimi){
		echo '<option value="'.$nimi.'" >'.$nimi."</option>";
		
}
}
 ?>
 </select>
</form>
</div>
<hr size="1">

<div style="vertical-align:top">
<b> Olemassa olevat albumit: </b><br>
<table style="vertical-align:top">
<?php
include_once ($db_functions_file);
$atr_name="status";
$albumit=listAllOwnAlbums($_SESSION['hiiripippeli']);
if(isset($albumit)){
	foreach($albumit as $key => $nimi){

echo '<tr><td><form name="Albumi_'.$key.'" method="post" action="album_mgt.php">'."\n";
echo $nimi."  </td><td>";
echo '<select name="Albumi_status" onchange="document.Albumi_'.$key.'.submit()">'."\n";
echo '<option selected value=""></option>'."\n";
echo '<option ';
if(getAlbumAttributeV($nimi, $atr_name)=="0"){
	echo " selected ";
}
echo 'value="0" >Draft</option>'."\n";
echo '<option ';
if(getAlbumAttributeV($nimi, $atr_name)=="1"){
	echo " selected ";
}
echo 'value="1" >Private</option>'."\n";
echo '<option ';
if(getAlbumAttributeV($nimi, $atr_name)=="2"){
	echo " selected ";
}
echo 'value="2" >Public</option>'."\n";
echo "</select>";
echo '<input type="hidden" name="albumi_hid" value="'.$nimi.'">'."\n";
echo "</form>"."\n";
echo "</td></tr>"."\n";		
	}
	}
?>
</table>
</div>
</body>
</html>


