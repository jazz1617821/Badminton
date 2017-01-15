<?php
session_start();
$_SESSION['courtNumber'] = 2;
header("Location: bookCourt.php");
?>