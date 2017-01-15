<?php
	session_start();
	error_reporting(0);
	include "conect.php";
?>
<html>
	<head>
		<title>ManagerInsert</title>
		<meta charset="UTF-8">
	</head>
<body>
<center>
<?php
	$date=$_POST['date'];
	$time=$_POST['time'];
	$data=$_POST['data'];
	
	$db -> query( 'INSERT INTO `billboard`(`data`, `date`, `time`) VALUES ("'.$data.'","'.$date.'","'.$time.'")');
	
	header("Location: manager.php");

?>
</center>
</body>
</html>