<?php
session_start();
$_SESSION['courtNumber'] = 1;
header("Location: bookCourt.php");
?>