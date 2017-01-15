<?php
	session_start();
	error_reporting(0);
	include "conect.php";
?>
<html>
	<head>
		<title>ManagerDelete</title>
		<meta charset="UTF-8">
	</head>
<body>
<center>
<?php
	$Check_Box=$_POST['bb'];
	
	for($i=0; $i<count($Check_Box); $i++)
	{
		
		$query = 'DELETE FROM billboard WHERE data = "'.$Check_Box[$i].'"'; 
		$db -> query($query);
	}
	
	header("Location: manager.php");
?>
</center>
</body>
</html>