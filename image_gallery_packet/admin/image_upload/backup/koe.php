<?php

$ruoska= exec ("date|awk '{print $2,$3,$4}'|sed 's/:/_/g'|sed 's/ /_/g'");
echo $ruoska;
?>
