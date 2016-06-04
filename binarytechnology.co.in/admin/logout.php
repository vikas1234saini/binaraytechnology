<?php
include("../include/config.inc.php");
session_destroy();
header("Location: ".$config['siteurl']."admin");
die;
?>