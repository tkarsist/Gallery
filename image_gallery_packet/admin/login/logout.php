<?php
session_start();
session_unset();
//unset($_SESSION['hiiripippeli'];
session_destroy();
echo "Logout Succesful!";
?>

