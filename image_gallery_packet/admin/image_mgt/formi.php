<?php
	echo '<form action="vertailu.php" method="post">';
	echo'<table border="2"><tr><td valign="middle" bgcolor="#8bb86b"><br>';	
	echo '<input type="submit" name="nappi" value="Vertaa">   ';
    echo '<input type="submit" name="poisto" value="Poista">   ';
    echo '<input type="submit" name="valmis" value="Valmis">   ';
    #echo '<input type="submit" name="nollaa" value="Aloita alusta">';
    echo '<a href="aloita.php"">  Aloita alusta</a><br/>';
    echo '  Select: <a href="#" onclick="check(1); return false;">All</a>, <a href="#" onclick="check(0); return false;">None</a><br><br>';
 	echo '</td></tr><tr><td><br>';
?>