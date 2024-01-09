<?php
header("Access-Control-Allow-Origin: http://allowed-origin.com");
header("Access-Control-Allow-Methods: POST");
session_start();
session_destroy();
header("Location:index.php");
exit();
?>
