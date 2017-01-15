<?php
	session_start();
	error_reporting(0);
	include "conect.php";
?>
<html>
	<head>
		<title>Court Management</title>
		<meta charset="UTF-8">
	</head>
<body>
<center>
<?php
	$db -> query("DELETE FROM `courts` WHERE 1");
	
	$CM=$_POST['CM'];
	$day = date("w", strtotime('+7HOUR'));
	$date = date("Y-m-d", strtotime('+7HOUR'));
	for($i=0; $i<count($CM); $i++)
	{
		if($day == 0||$day == 6){
			$time = (floor($CM[$i]/8)+11).":00:00";
			$id = $CM[$i]%8+1;
		}else{
			$time = (floor($CM[$i]/8)+17).":00:00";
			$id = $CM[$i]%8+1;
		}
		
		$query = 'INSERT INTO `courts`(`courts_id`, `courts_time`, `courts_date`) VALUES ("'.$id.'","'.$time.'","'.$date.'")';
		$db -> query($query);
	}
	
	header("Location: manager.php");
?>
</center>
</body>
</html>