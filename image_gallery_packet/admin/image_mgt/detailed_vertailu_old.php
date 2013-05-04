<?php
session_start();
if (!isset($_SESSION['hiiripippeli'])){
	die();
}
?>
<HTML>
<head>
<title>Detailed Vertailu</title>
<link rel="stylesheet" href="style.css" type="text/css">
<script type="text/javascript" language="javascript" src="arvostelu.js">
</script>
<?php

include ('detailed_get.php');
include ('config.php');
?>
<!-- arvostelua varten, printaa vain jos on arvosteltu -->
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



<table border="2"><tr valign="top"><td>
<!-- iso kuva ja linkki siita seuraavaan -->
<?php
			echo '<a href="detailed_vertailu.php?kuva='.$next_image.'"><img src="'.$location.$_SESSION['size']."/".$_SESSION['current_image'].".".$_SESSION['size'].".jpg".'"></a>'."\n";
?>  		
</td>
<td>
<table>
<tr valign="top">
<td valign="top">
<!-- poisto formi -->
<form action="detailed_vertailu.php" method="post">
<?php
			echo '<input type="hidden" name="kuvat[]" value="'.$_SESSION['current_image'].'">';
?>
<input type="submit" name="poisto" value="Poista">   
</form>
<!-- vertaa edelliseen formi -->
<form action="vertailu.php" method="post">
<input type="submit" name="nappi" value="Vertaa Edelliseen">  <br><br>
<input type="hidden" name="ref" value="detailed_vertailu.php">
<?php			
			echo '<input type="hidden" name="kuvat[]" value="'.$prev_image.'">';
			echo '<input type="hidden" name="kuvat[]" value="'.$_SESSION['current_image'].'">';
 ?>			
<input type="submit" name="palaa" value="Palaa päänäkymään">   
</form>
</td>
</tr>
<!-- edellisen kuvan thumbnaili -->
<tr valign="bottom">
<td bgcolor="#cccccc" valign="bottom" align="right">
<b>Edellinen</b><br/>
<?php			
			echo '<a href="detailed_vertailu.php?kuva='.$prev_image.'"><img src="'.$location."thumb"."/".$prev_image.'.thumb.jpg"></a><br>'."\n";
			
?>
</td>
</tr>
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
</tr>
<!-- Koepaskaa -->
<tr><td>
<?php
include ('/gallery/mysql_funktiot/db_functions.php');
$koe=listAllImageAttributes($_SESSION['current_image']);

//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
		//$arvo=getImageAttributeV($_SESSION['current_image'],$nimi);
        //echo $nimi." : ".$arvo."<br>";
        echo $nimi." :   ";
        getImageAttributeV($_SESSION['current_image'],$nimi);
		echo "<br>";	
}

?>

</td></tr>
</table>

</td>
</tr>
</table>



</body></html>