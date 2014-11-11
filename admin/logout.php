<?php
require_once('../includes/config.php');
require_once('../libraries/libraries.php');

$db->logout_sess();
header("location: login.php");
exit();
?>

