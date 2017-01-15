<html>
	<head>
		<title>Regist</title>
		<meta charset="UTF-8">
	</head>
<body>
<center>
<?php
	error_reporting(0);
	include "conect.php";
	$Stu_Name=$_POST[Stu_Name];
	$Stu_ID=$_POST[Stu_ID];
	$Stu_Password=$_POST[Stu_Password];
	$Stu_Email=$_POST[Stu_Email];

	$query = "SELECT * FROM student"; 
	$res = $db->query($query);
	$row = $res-> fetchAll();
	for($i=0; $i<count($row); $i++)
	{
		if($row[$i]['Student_id']==$Stu_ID)
		{	
			echo "<p>帳號已存在。</p>";
			echo "<input type =button onclick=history.back() value=回到上一頁></input>";
			break;
		}
	}
	
	$query=('INSERT INTO student(Student_id, password, Student_name, Student_mail) VALUES(?,?,?,?)');
	$res=$db->prepare($query);
	$res->execute(array($Stu_ID,$Stu_Password,$Stu_Name,$Stu_Email));
	
	header("Location: home.php");
	
?>
</center>
</body>
</html>