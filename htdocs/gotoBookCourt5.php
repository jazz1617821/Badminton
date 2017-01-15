<?php
session_start();
$_SESSION['courtNumber'] = 5;
header("Location: bookCourt.php");
?>