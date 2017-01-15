<?php
	session_start();
	$_SESSION['Student_id'] = null;
	$_SESSION['Student_name'] = null;
	header("Location: home.php");
?>