<?php
session_start();
$_SESSION["admin"] = 0;
$_SESSION = array();
session_destroy();

header("Location: login.php");
exit();
?>
