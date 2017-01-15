<?php
session_start();
$_SESSION['courtNumber'] = 4;
header("Location: bookCourt.php");
?>