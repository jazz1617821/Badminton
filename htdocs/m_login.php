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
	$Manager_ID=$_POST[Manager_ID];
	$Manager_Password=$_POST[Manager_Password];
	$query = "SELECT * FROM management"; 
	$res = $db->query($query);
	$row = $res-> fetchAll();
	for($i=0; $i<count($row); $i++)
	{
		if($row[$i]['management_id']==$Manager_ID&&$row[$i]['password']==$Manager_Password)
		{	
			$_SESSION['management_id']=$row[$i]['management_id'];
			header("Location: fuck.html");
		}
	}
	
	if($_SESSION['management_id'] == null){
		header("Location: m_loginError.html");
	}
	
?>
</center>
</body>
</html>