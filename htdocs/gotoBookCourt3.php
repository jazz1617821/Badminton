<?php
session_start();
$_SESSION['courtNumber'] = 3;
header("Location: bookCourt.php");
?>