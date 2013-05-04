<?php
session_start();

function ldap_authenticate() {
    global $ldapconfig;
    global $user;
    global $pw;

    if ($user != "" && $pw != "") {
        $ds=@ldap_connect($ldapconfig['host'],$ldapconfig['port']) or die("Could not connect to $ldaphost");
        if ($ds){
                //$user='cn='.$PHP_AUTH_USER.',o=veikko,c=fi';
                $ldapbind = @ldap_bind($ds, $user, $pw);
        if ($ldapbind) {
                return '1';

                }
        else {
                return NULL;
                }
        }
    }
      return NULL;
}

//if (($result = ldap_authenticate()) == NULL) {
//    echo('Authorization Failed');
//    echo 'cn='.$PHP_AUTH_USER.',o=veikko,c=fi';
//    exit(0);
//}
//echo('Authorization success');
//print_r($result);
if (empty($_SESSION['hiiripippeli'])){

include ('ldap_properties.php');

if (isset($_POST['login'])) {
	$user='cn='.$_POST['nimi'].',ou=Users,o=veikko,c=fi';
	$pw=$_POST['salis'];
	if (($result = ldap_authenticate()) == NULL) {
    	echo('Authorization Failed');
	}
	else{
        $_SESSION['hiiripippeli']=$_POST['nimi'];
		echo "Autentikointi natsas ".$_SESSION['hiiripippeli'].", paina F5";
		header( 'Location:'.$_SESSION['urli']);
		unset($_SESSION['urli']);
		die();
	}

}

echo '<html>'."\n";
echo '<head>'."\n";
echo '<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">'."\n";
echo '<title></title>'."\n";
echo '</head>'."\n";
echo '<body>'."\n";
echo '<table style="text-align: left; width: 300px; height: 156px;" border="2" cellpadding="25" cellspacing="2">'."\n";
echo '<tbody>'."\n";
echo '<tr>'."\n";
echo '<td style="text-align: left; background-color: rgb(0, 153, 0);">'."\n";
echo '<form action="/login/login.php" method="post"><span style="font-weight: bold;">Tunnus:</span><br>'."\n";
echo '<input name="nimi" type="text"><br>'."\n";
echo '<span style="font-weight: bold;">Salasana: </span><br>'."\n";
echo '<input name="salis" type="password"><br>'."\n";
echo '<br>'."\n";
echo '<input name="login" value="Kirjaudu" type="submit"></form>'."\n";
echo '</td>'."\n";
echo '</tr>'."\n";
echo '</tbody>'."\n";
echo '</table>'."\n";
echo '<br>'."\n";
echo '</body>'."\n";
echo '</html>';

if (empty($_SESSION['urli'])){
$_SESSION['urli']=$_SERVER['PHP_SELF'];}
die();
}

?> 