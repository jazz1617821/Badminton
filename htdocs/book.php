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
	
	$query = "SELECT * FROM reservation_courts";
	$res = $db->query($query);
	$row = $res-> fetchAll();
	
	for($i=0; $i<count($row); $i++){
		if($row[$i]['Student_id']==$_SESSION['Student_id']){
			header("Location: cantBook.html");
		}
	}
	$date = date('Y-m-d', strtotime('+7HOUR') );
	$query = "INSERT INTO `reservation_courts`(`Student_id`, `Student_name`, `courts_id`, `courts_time`, `courts_date`) VALUES (?,?,?,?,?)"; 
	$res=$db->prepare($query);
	$res->execute(array($_SESSION['Student_id'],$_SESSION['Student_name'],$_SESSION['courtNumber'],$_SESSION['timeSelect'],$date));
	
	header("Location: bookCourt.php");
?>
</center>
</body>
</html>