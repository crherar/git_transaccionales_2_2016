<?php
session_start();
$_SESSION = array();
session_destroy();
header("location: vista_login.php");
 ?>
