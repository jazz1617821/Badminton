<?php
	session_start();
	error_reporting(0);
	include "conect.php";
?>
<html>
	<head>
		<title>Login</title>
		<meta charset="UTF-8">
	</head>
<body>
<center>
<?php
	$_SESSION['Student_id'] = null;
	$_SESSION['Student_name'] = null;
	$_SESSION['management_id'] = null;
	$_SESSION['timeSelect'] = null;
	$_SESSION['courtNumber'] = null;
	
	$date = date('Y-m-d', strtotime('+7HOUR') );
	$query = "DELETE FROM reservation_courts WHERE courts_date <> ?"; 
	$res=$db->prepare($query);
	$res->execute(array($date));
	
	
	
	
	
	header("Location: home.php");
?>
</center>
</body>
</html>