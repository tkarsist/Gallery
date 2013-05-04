<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"
 http-equiv="content-type">
  <title>Duunaa</title>
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['hiiripippeli'])){
	die();
}
include_once ('properties.php');
include_once ($image_functions_file);

if (isset($_GET['duunaa'])) {
	
	if (empty($_SESSION['temphakemisto_short'])) {
        echo "jotain mätää!";
        die();
	
	}
	else{
		exec($fix_file_name_script." ".$_SESSION['temphakemisto_short']);
		addImagesFromDirToWorkQueue($_SESSION['temphakemisto_short'], $_SESSION['hiiripippeli']);
		echo "Kuvat on viety jonoon, ne tulevat systeemiin jos ja vain jos croni ehtii....";
		//moveImagesToSystem($_SESSION['temphakemisto_short'], $_SESSION['hiiripippeli']);
		
	}
}
else{
		echo "väärä tie";
		die();
	}
	

?>
</body>
</html>