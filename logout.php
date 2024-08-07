<?php
require 'config2.php';
$_SESSION = [];
session_unset();
session_destroy();
header("Location: login.php");
exit;
?>