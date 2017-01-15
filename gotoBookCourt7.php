<?php
session_start();
$_SESSION['courtNumber'] = 7;
header("Location: bookCourt.php");
?>