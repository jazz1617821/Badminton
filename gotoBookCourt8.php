<?php
session_start();
$_SESSION['courtNumber'] = 8;
header("Location: bookCourt.php");
?>