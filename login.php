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
	$Stu_ID=$_POST[Stu_ID];
	$Stu_Password=$_POST[Stu_Password];
	$query = "SELECT * FROM student"; 
	$res = $db->query($query);
	$row = $res-> fetchAll();
	for($i=0; $i<count($row); $i++)
	{
		if($row[$i]['Student_id']==$Stu_ID&&$row[$i]['password']==$Stu_Password)
		{	
			$_SESSION['Student_id']=$row[$i]['Student_id'];
			$_SESSION['Student_name']=$row[$i]['Student_name'];
			if($_SESSION['courtNumber'] != null){
				header("Location: bookCourt.php");
			}else{
				header("Location: home.php");
			}
		}
	}
	
	if($_SESSION['Student_id'] == null){
		header("Location: loginError.html");
	}
?>
</center>
</body>
</html>