<?php
session_start();
if (!isset($_SESSION['hiiripippeli'])){
	die();
}
?>
<?php

include_once ('detailed_get.php');
include_once ('config_img_mgt.php');
include_once ('funktiot.php');
if(!isset($_SESSION[$_SESSION['current_image']])){
getOwnRating();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Kuvien Luokittelu</title>

<link rel="stylesheet" href="style.css" type="text/css">

<script type="text/javascript" language="javascript" src="arvostelu.js">
</script>
<script>
function nav()
{
var w = document.myform.mylist.selectedIndex;
var url_add = document.myform.mylist.options[w].value;
window.location.href = url_add;
}
</script>
<?php
if (isset($_SESSION[$_SESSION['current_image']])) {
		echo '<script type="text/javascript" language="javascript">'."\n";
		echo 'function rate(){'."\n";	
		echo 'var h=document.getElementsByTagName('."'*');"."\n";
    	echo 'for (var v=0; v<h.length;v++){'."\n";
    	echo 'if (h[v].title=="'.$_SESSION[$_SESSION['current_image']].'"){'."\n";
    	
    	echo 'preSet=h[v];'."\n";
    	echo 'rating(h[v]);'."\n";
    	
		echo '}}}'."\n";
		echo '</script>'."\n";
		
}

?>	

</head>
<!-- ei lataa arvostelu java-skriptia, jos kuvaa ei ole arvostelu -->
<BODY <?php if (isset($_SESSION[$_SESSION['current_image']])) { echo 'onload="rate()"';} ?>>

<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
<tbody>
<tr bgcolor="#8bb86b">
<td style="width: 15%;">
<form action="vertailu.php" method="post"><input name="palaa" value="Palaa päänäkymään" type="submit"></form>
</td>
<td>
<table>
<tbody>
<tr><td>
<!-- vertaa edelliseen formi -->
<form action="vertailu.php" method="post">
<input type="submit" name="nappi" value="Vertaa Edelliseen">
<input type="hidden" name="ref" value="detailed_vertailu.php">
<?php			
			echo '<input type="hidden" name="kuvat[]" value="'.$_SESSION['prev_image'].'">';
			echo '<input type="hidden" name="kuvat[]" value="'.$_SESSION['current_image'].'">';
 ?>			
</form>
</td>
<td>
<!-- poisto formi -->
<form action="detailed_vertailu.php" method="post">
<?php
			echo '<input type="hidden" name="kuvat[]" value="'.$_SESSION['current_image'].'">';
?>
<input type="submit" name="poisto" value="Poista Kokonaan">   
</form>
</td>
<td width="100%" align="right">


<form name="koko" method="post" action="detailed_vertailu.php"> <b>Kuvakoko: </b>
<select name="kuvakoko" OnChange ="document.koko.submit()">
<!-- <noscript><input type="submit" value="go"></noscript>  -->

<!-- <select name="mylist" onchange="nav()"> -->
<option value="800_600"<?php if ($_SESSION['size']=="800_600") {echo " SELECTED";} ?>>800x600
</option><option value="1024_768"<?php if ($_SESSION['size']=="1024_768") {echo " SELECTED";} ?>>1024x768
</option><option value="1280_960"<?php if ($_SESSION['size']=="1280_960") {echo " SELECTED";} ?>>1280x960
</option><option value="1400_1050"<?php if ($_SESSION['size']=="1400_1050") {echo " SELECTED";} ?>>1400x1050
</option><option value="1600_1200"<?php if ($_SESSION['size']=="1600_1200") {echo " SELECTED";} ?>>1600x1200
</option></select>
</form>
</td>
</tr>
</tbody>
</table>
</td>
<td style="width: 20%">
<form name="Exif"><b>Exif-tiedot : </b>
<select name="mylist" onchange="nav()"><option value="../../index.html">Perus
</option><option value="../../basics/index.php3">Semi
</option><option value="../../tutorials/index.php3">Super
</option><option value="../../templates/index.php3">Kaikki
</option></select>
</form>
</td>
</tr>
<tr bgcolor="#d5d5d5">
<td style="vertical-align: top;">
<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2" bgcolor="#f3f2c0">
<tbody>
<tr>
<td valign="bottom" bgcolor="#000000" align="right">
<b>Edellinen</b><br>
<?php			
			echo '<a href="detailed_vertailu.php?kuva='.$_SESSION['prev_image'].'"><img src="'.$location."thumb"."/".$_SESSION['prev_image'].'.thumb.jpg"></a><br>'."\n";
			
?>
</td>
</tr>
<tr>
<td >
<form name="Albumi" method="post" action="detailed_vertailu.php">Albumi lisää/poista:
<select name="Albumit" onchange="document.Albumi.submit()">
<option selected value=""></option>
<?php
include_once ($db_functions_file);
$albumit=listAllOwnAlbums($_SESSION['hiiripippeli']);
if(isset($albumit)){
foreach($albumit as $key => $nimi){
		echo '<option value="'.$nimi.'" >'.$nimi."</option>";
		//$arvo=getImageAttributeV($_SESSION['current_image'],$nimi);
        //echo $nimi." : ".$arvo."<br>";
        //echo $nimi."<br>";
}
}
 ?>
   
</select>
</form>
</td>
</tr>
<tr>
<td>
<b>Albumit: </b> <br>
<?php
$kuvan_albumit=listAlbumsWhereImageIs($_SESSION['current_image']);
if(isset($kuvan_albumit)){
foreach ($kuvan_albumit as $key => $nimi){
        echo $nimi."<br>";
}
}
?>

</td>
</tr>
</tbody>
</table>
</td>
<td style="vertical-align: top;">
<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="vertical-align: top;" align="center" bgcolor="#000000">
<!-- iso kuva ja linkki siita seuraavaan -->
<?php
			echo '<a href="detailed_vertailu.php?kuva='.$_SESSION['next_image'].'"><img src="'.$location.$_SESSION['size']."/".$_SESSION['current_image'].".".$_SESSION['size'].".jpg".'"></a>'."\n";
?>
</td>
</tr>
<tr>
<td>
<table style="width: 100%;" bgcolor="#f3f2c0">
<tbody>
<tr>
<td>
<!-- arvostelukikkare -->
<span id="rateStatus">Arvostele...</span><span id="ratingSaved">Arvostelu tallennettu!</span>
<div id="rateMe" title="Arvostele...">
    <a onclick="rateIt(this)" id="_1" title="aarhg..." onmouseover="rating(this)" onmouseout="off(this)"></a>
    <a onclick="rateIt(this)" id="_2" title="no jaaa..." onmouseover="rating(this)" onmouseout="off(this)"></a>
    <a onclick="rateIt(this)" id="_3" title="Menettelee" onmouseover="rating(this)" onmouseout="off(this)"></a>
    <a onclick="rateIt(this)" id="_4" title="Aika kurko" onmouseover="rating(this)" onmouseout="off(this)"></a>
    <a onclick="rateIt(this)" id="_5" title="Megasumee!!!" onmouseover="rating(this)" onmouseout="off(this)"></a>

</div>
</td>
<td align="right">
<form action="detailed_vertailu.php" method="post"><b>Kuvaus:</b>
<input name="kuvaus" size="80" maxlength="80" type="text" 
<?php 
$value=getImageAttributeV($_SESSION['current_image'], "own_description");
echo ' value="'.$value.'"'; 
?>
>
<br>
<input name="paivita_kuv" value="Päivitä" type="submit"></form>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
<td style="vertical-align: top;">
<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2" bgcolor="#f3f2c0">
<tbody>
<tr>
<td style="vertical-align: top;">
<?php
include_once ($db_functions_file);
echo "Nimi: ".$_SESSION['current_image']."<br>";
$kuvaatr=listAllImageAttributes($_SESSION['current_image']);

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
</tr>
</tbody>
</table>
<br>
</body></html>