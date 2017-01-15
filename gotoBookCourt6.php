<?php
session_start();
$_SESSION['courtNumber'] = 6;
header("Location: bookCourt.php");
?>