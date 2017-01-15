<?php
	//連線
	$user = 'team04'; 
	$password = 'team04'; 
	try{ 
	    $db = new PDO('mysql:host=localhost;dbname=badminton;charset=utf8',$user,$password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);//範例的dbh不知道是不是打錯，我改成db
	}catch(PDOException $e){ 
		 Print "ERROR!:". $e->message(); //這裡有問題
		 die(); //還有這裡
	}
?>