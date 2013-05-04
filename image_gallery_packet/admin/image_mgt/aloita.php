<?php
include_once ('config_img_mgt.php');
include_once ($ldap_login_file);

//session_start();
$_SESSION['size']="1024_768";
?>
<HTML>
<head>
<title></title>
</head>
<BODY>
<form action="vertailu.php" method="post">
 <table border="2">
 <tr><td valign="middle" bgcolor="#8bb86b"><br>  
<input type="submit" name="valitut" value="Valitse Käsittelyyn">
  
</td></tr><tr><td><br>

<?php
include ($db_functions_file);
$koe=listAllOwnImages($_SESSION['hiiripippeli']);

//tulostetaan koetaulukko
foreach($koe as $key => $nimi){
        //echo $nimi." : ".getImageAttributeV($img,$nimi)."\n";
        echo '<input type="hidden" name="kuvat[]" value="'.$nimi.'">'."\n";
}
?>
</td></tr>
</table>
</form>
</body></html>
