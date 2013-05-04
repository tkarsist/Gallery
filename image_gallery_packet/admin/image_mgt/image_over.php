<?php
session_start();
if (!isset($_SESSION['hiiripippeli'])){
	die();
}
include ('config_img_mgt.php');
if (isset($_POST['nappi'])) {
    if (empty($_POST['kuvat'])) {
        echo "Et valinnut !";
    } else {
        $kuva1="-1";
        $kuva2="-1";
                foreach ($_POST['kuvat'] as $kuva) {
                if ($kuva1=="-1"){
                		if ($kuva!=""){
                        $kuva1=$kuva;}
                }
                else {
                        if($kuva2=="-1"){
                        if ($kuva!=""){
                        $kuva2=$kuva;}
                              
                        }
                }


                }

echo '<table><tr><td>';


echo '<a href=#javascript:;" onmouseover="image.src='."'".$location.$_SESSION['size']."/".$kuva2.".".$_SESSION['size'].".jpg"."'".'" onmouseout="image.src='."'".$location.$_SESSION['size']."/".$kuva1.".".$_SESSION['size'].".jpg"."'".'">';
echo '<img name="image" src="'.$location.$_SESSION['size']."/".$kuva1.".".$_SESSION['size'].".jpg".'"></a>';

echo '</td><td valign="top">';
echo '<form action="'.$_POST['ref'].'" method="post">';
echo '<input type="hidden" name="kuvat[]" value="'.$kuva1.'">';
echo '<input type="submit" name="poisto" value="Poista Eka"><br><br>';

echo '</form>';
echo '<form action="'.$_POST['ref'].'" method="post">';
echo '<input type="hidden" name="kuvat[]" value="'.$kuva2.'">';
echo '<input type="submit" name="poisto" value="Poista Toka (Mouseover)"><br><br>';
echo '</form>';
if (isset($_POST['ref'])) {
	if ($_POST['ref']=="vertailu.php"){
		echo '<form action="vertailu.php" method="post">';
		echo '<input type="submit" name="palaa" value="Palaa päänäkymään">';}
	else {
		echo '<form action="detailed_vertailu.php" method="get"><input type="submit" name="detailed" value="Palaa detailed">';
		echo '<input type="hidden" name="kuva" value="'.$_SESSION['current_image'].'">';		
	}
	echo '</form>';
	echo "</td></tr></table></body></html>";
	die();
}


echo '</form>';
echo "</td></tr></table></body></html>";


    }
    die();
}

?>


