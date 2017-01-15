<?php
	session_start();
	error_reporting(0);
	include "conect.php";
?>
<html>
	<head>
		<title>Book</title>
		<meta charset="UTF-8">
	</head>
<body>
<center>
<?php
	
	$query = 'DELETE FROM reservation_courts WHERE Student_id = "'.$_SESSION['Student_id'].'"'; 
	$res =  $db->query($query);
	
	header("Location: bookCourt.php");
?>
</center>
</body>
</html>